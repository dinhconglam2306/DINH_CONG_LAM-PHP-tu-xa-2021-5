<?php
class UserModel extends Model
{

	private $_userInfo;

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);

		$userObj = Session::get('user');
		$this->_userInfo = $userObj['info'];
	}

	//Hiện danh sách items

	//Lưu Item
	public function listItems($params, $options = null)
	{
		if ($options['task'] == 'book-in-cart') {
			$cart	 = Session::get('cart');
			$result = [];
			if (!empty($cart)) {
				$ids = "(";
				foreach ($cart['quantity'] as $key => $value) $ids .= "'$key',";
				$ids .= "'0')";

				$query[] = "SELECT `name`,`category_id`,`id`,`picture`";
				$query[] = "FROM `book`";
				$query[] = "WHERE `status` = 'active'";
				$query[] = "AND `id` IN $ids";
				$query[] = "ORDER BY `ordering` ASC";



				$query		= implode(' ', $query);

				$result = $this->fetchAll($query);

				foreach ($result as $key => $value) {
					$result[$key]['quantity'] = $cart['quantity'][$value['id']];
					$result[$key]['price'] = $cart['price'][$value['id']];
					$result[$key]['totalPrice'] = $result[$key]['quantity'] * $result[$key]['price'];
				}
			}
			return $result;
		}
		if ($options['task'] == 'cart-new') {

			$query[] = "SELECT `id`";
			$query[] = "FROM `cart`";
			$query[] = "ORDER BY `date` DESC";
			$query[] = "LIMIT 0,1";
			$query		= implode(' ', $query);

			$result = $this->fetchAll($query);
			return $result['0']['id'];
		}
	}
	public function saveItem($params, $options = null)
	{
		if ($options['task'] == 'edit-user-info') {
			$id    = $params['form']['user_id'];
			$phone = $params['form']['phone'];
			$fullname = $params['form']['fullname'];
			$address = $params['form']['address'];
			$query = "UPDATE `user` SET `phone` = '$phone', `fullname` = '$fullname',`address` = '$address' WHERE `id` = '$id'";
			$this->query($query);

			$userInfo = Session::get('user');
			$userInfo['info']['phone'] = $phone;
			$userInfo['info']['fullname'] = $fullname;
			$userInfo['info']['address'] = $address;
			Session::set('user', $userInfo);

			$success = ['type' => 'success', 'title' => 'Cập nhật thông tin thành công!'];
			Session::set('success', $success);
		}
		if ($options['task'] == 'submit-cart') {

			$id		= $this->randomString(7);
			$username = $this->_userInfo['username'];
			$books = implode(',', $params['form']['book_id']);
			$prices = implode(',', $params['form']['price']);
			$quantities = implode(',', $params['form']['quantity']);
			$names = implode(',', $params['form']['name']);
			$pictures = implode(',', $params['form']['picture']);
			$receiver = implode('</br>', $params['receiver']);
			$date = date('Y-m-d H:i:s', time());

			$ship = $params['ship'];
			$pay = $params['payment'];

			$query = "INSERT INTO `cart` (`id`,`username`,`books`,`prices`,`quantities`,`names`,`picture`,`status`,`date`,`receiver`,`ship`,`pay`)
					VALUES('$id','$username','$books','$prices','$quantities','$names','$pictures','not-handle','$date','$receiver','$ship','$pay') ";

			$this->query($query);
			Session::delete('cart');

			$queryStatusCart  = "INSERT INTO `cart_status` (`id`,`not-handle`) VALUES('$id','$date')";
			$this->query($queryStatusCart);
		}
	}
	public function categoryList($params, $option = null)
	{
		if ($option['task'] == 'category-list') {

			$query = "SELECT `name`,`id` FROM `category` WHERE `status` = 'active'";
			$result  = $this->fetchAll($query);
			return $result;
		}
		if ($option['task'] == 'category-list-special') {
			$query = "SELECT `name`,`id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active' AND `is_home` = 1";
			$categorySpecial  = $this->fetchAll($query);
			foreach ($categorySpecial as $key => $value) {
				$queryBook 	= "SELECT  `name`,`id`,`price`,`description`,`picture`,`sale_off` FROM `book` WHERE `category_id` = $value[id] AND `status` = 'active' AND `special` = 1 LIMIT 0,8 ";
				$books 		=  $this->fetchAll($queryBook);
				$categorySpecial[$key]['books'] = $books;
			}
			return $categorySpecial;
		}
	}

	public function orderHisTory($params, $option = null)
	{
		if ($option['task'] == 'list-order-history') {
			$userInfo = Session::get('user');
			$userName = $userInfo['info']['username'];

			$query = "SELECT `id`,`books`,`status`,`username`,`prices`,`quantities`,`names`,`picture`,`date`";
			$query .= " FROM `cart`";
			$query .= " WHERE `username` = '$userName' AND `status` <> 'cancelled'";

			if (isset($params['status']) && $params['status'] != 'default') {
				$query .= " AND `status` = '{$params['status']}'";
			}



			$query .= " ORDER BY `date` DESC";

			//PAGINATION
			$pagination = $params['pagination'];
			$totalItemsPerPage = $pagination['totalItemsPerPage'];
			if ($totalItemsPerPage > 0) {
				$position = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
				$query .= " LIMIT $position, $totalItemsPerPage";
			}
			$result = $this->fetchAll($query);

			return $result;
		}
	}

	public function changePass($params, $option = null)
	{
		if ($option['task'] == 'change-pass-user') {
			$password = md5($params['form']['password_new']);
			$username = $params['form']['username'];

			$query = "UPDATE `user` SET `password` = '$password' WHERE `username` = '$username'";
			$this->query($query);
		}
	}

	public function deleteOrder($params, $option = null)
	{
		if ($option['task'] == 'cancel-order') {
			$orderID = $params['order_id'];
			$query = "UPDATE `cart` SET `status` = 'cancelled' WHERE `id` = '$orderID'";
			$this->query($query);
		}
	}

	public function checkPass($params, $option = null)
	{
		if ($option['task'] == 'check-password') {
			$password = md5($params['form']['password_old']);
			$query = "SELECT `password` FROM `user` WHERE `password` = '$password'";
			$result = $this->fetchRow($query);
			return $result;
		}
	}

	public function checkStatusOrder($params, $option = null)
	{
		if ($option['task'] == 'order-infomation') {
			$id = $params['id'];
			$query = "SELECT `id`,`date`,`status` FROM `cart` WHERE `id` = '$id'";
			$result = $this->fetchRow($query);
			return $result;
		}

		if ($option['task'] == 'order-status') {
			$id = $params['id'];
			$query = "SELECT `not-handle`,`processing`,`not-delivery`,`delivery`,`delivered` FROM `cart_status` WHERE `id` = '$id'";
			$result = $this->fetchRow($query);
			return $result;
		}
	}

	public function countItems($params, $options = null)
	{
		if ($options['task'] == 'count-order') {
			$query[] = "SELECT COUNT(`id`) AS `count`";
			$query[] = "FROM `cart` WHERE `status` <> 'cancelled'";

			$query = implode(' ', $query);
			$items = $this->fetchRow($query);
			return $items['count'];
		}
	}

	private function randomString($length = 5)
	{
		$arrCharacter = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
		$arrCharacter = implode('', $arrCharacter);
		$arrCharacter = str_shuffle($arrCharacter);

		$result 	  = substr($arrCharacter, 0, $length);

		return $result;
	}
}
