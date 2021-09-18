<?php
class UserModel extends Model
{
	private $_columns = [
		'id',
		'username',
		'fullname',
		'email',
		'password',
		'group_id',
		'created',
		'created_by',
		'modified',
		'modified_by',
		'register_date',
		'status',
		'ordering'
	];

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

				$query[] = "SELECT `name`,`id`,`picture`";
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
			$userInfo['info']['phone']= $phone;
			$userInfo['info']['fullname']= $fullname;
			$userInfo['info']['address']= $address;
			Session::set('user',$userInfo);

			$success = ['type' => 'success', 'title' => 'Cập nhật thông tin thành công!'];
			Session::set('success',$success);
		}
		if ($options['task'] == 'submit-cart') {
			$id		= $this->randomString(7);
			$username = $this->_userInfo['username'];
			$books = implode(',',$params['form']['book_id']);
			$prices = implode(',',$params['form']['price']);
			$quantities = implode(',',$params['form']['quantity']);
			$names = implode(',',$params['form']['name']);
			$pictures = implode(',',$params['form']['picture']);
			$date = date('Y-m-d H:i:s',time());
			
			$query = "INSERT INTO `cart` (`id`,`username`,`books`,`prices`,`quantities`,`names`,`picture`,`status`,`date`)
					VALUES('$id','$username','$books','$prices','$quantities','$names','$pictures','not-delivery','$date') ";

			$this->query($query);
			Session::delete('cart');

			
		}
	}
	public function CategoryList($params, $option = null)
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

	public function OrderHisTory($params,$option = null){
		if($option['task'] == 'list-order-history'){
			$userInfo = Session::get('user');
			$userName = $userInfo['info']['username'];
			
			$query = "SELECT `id`,`books`,`status`,`username`,`prices`,`quantities`,`names`,`picture`,`date` FROM `cart` WHERE `username` = '$userName' ORDER BY `date` DESC";
			$result = $this->fetchAll($query);
			
			return $result;
		}
	}

	public function changePass($params,$option = null){
		if($option['task'] == 'change-pass-user'){
			$password = md5($params['form']['password']);
			$username = $params['form']['username'];

			$query = "UPDATE `user` SET `password` = '$password' WHERE `username` = '$username'";
			$this->query($query);
		}
	}

	private function randomString($length = 5)
	{
		$arrCharacter = array_merge(range('a', 'z'),range('A', 'Z'), range('0', '9'));
		$arrCharacter = implode('',$arrCharacter);
		$arrCharacter = str_shuffle($arrCharacter);

		$result 	  = substr($arrCharacter, 0, $length);

		return $result;
	}
}
