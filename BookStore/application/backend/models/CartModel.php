<?php
class CartModel extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_CART);
	}

	//Hiện danh sách items
	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `c`.`id`,`c`.`receiver`,`c`.`quantities`,`c`.`username`,`c`.`books`,`c`.`prices`,`c`.`names`,`c`.`status`,`c`.`date`,`u`.`fullname`,`u`.`email`,`u`.`phone`,`u`.`address`";
		$query[]	= "FROM `{$this->table}`  AS `c` LEFT JOIN `" . TBL_USER . "` AS `u` ON `c`.`username` = `u`.`username`";
		$query[]	= "WHERE `c`.`id` != ''";

		if (!empty(trim(@$params['search']))) {
			$keyword = '"%' . $params['search'] . '%"';
			$query[] = "AND `c`.`username` LIKE $keyword";
		}
		if (isset($params['select_cart_status']) && $params['select_cart_status'] != 'default') {
			$query[] = "AND `c`.`status` = '{$params['select_cart_status']}'";
		}

		$query[] = 'ORDER BY `c`.`date` DESC';

		//PAGINATION
		$pagination = $params['pagination'];
		$totalItemsPerPage = $pagination['totalItemsPerPage'];
		if ($totalItemsPerPage > 0) {
			$position = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
			$query[] = "LIMIT $position, $totalItemsPerPage";
		}
		$query		= implode(' ', $query);

		$result = $this->fetchAll($query);

		return $result;
	}
	public function infoOrder($params, $options = null)
	{
		if ($options == null) {
			$id = $params['id'];
			$query[] = "SELECT `id`,`username`,`prices`,`quantities`,`names`,`picture`,`status`,`date`,`pay`,`ship`";
			$query[] = "FROM `cart`";
			$query[] = "WHERE `id` = '$id'";

			$query		= implode(' ', $query);
			$result = $this->fetchRow($query);

			return $result;
		}
	}

	//Thay đổi trạng thái của 1 item
	public function changeStatusCart($params, $options = null)
	{
		if ($options['task'] == 'change-ajax-status-cart') {
			if ((isset($params['status']))) {
				$status = $params['status'];
				$data = ['status' => $status];
				$id   = $params['id'];
				$where = [['id', $id]];
				$this->update($data, $where);
				$link = URL::createLink($params['module'], $params['controller'], 'changeStatusCart', ['id' => $id, 'status' => $status]);
				

				$date = date('Y-m-d H:i:s', time());
				$query = "UPDATE `cart_status` SET `$status` = '$date' WHERE `id` = '$id'";
				$this->query($query);

				
				return [$id, $status, $link];
			}
		}
	}

	//Xóa item
	public function deleteItem($params, $options = null)
	{
		$ids = isset($params['id']) ? [$params['id']] : $params['cid'];
		$this->delete($ids);
		Session::set('message', SUCCESS_DELETE_USER);
	}

	// Tổng số items
	public function countItems($params, $options = null)
	{
		if ($options['task'] == 'count-items-status') {
			$query[] = "SELECT COUNT(*) AS `count`";
			$query[] = "FROM `{$this->table}` WHERE `id` !=''";

			if (!empty(trim(@$params['search']))) {
				$keyword = '"%' . $params['search'] . '%"';
				$query[] = "AND `username` LIKE $keyword";
			}

			$query = implode(' ', $query);
			$items = $this->fetchAll($query);

			return $items;
		}
	}
}
