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
		$query[] 	= "SELECT `id`,`username`,`books`,`prices`,`quantities`,`names`,`picture`,`status`,`date`";
		$query[]	= "FROM `{$this->table}`";
		$query[]	= "WHERE `id` != ''";

		if (!empty(trim(@$params['search']))) {
			$keyword = '"%' . $params['search'] . '%"';
			$query[] = "AND `username` LIKE $keyword";
		}
		if (isset($params['select_cart_status']) && $params['select_cart_status'] != 'default') {
			$query[] = "AND `status` = '{$params['select_cart_status']}'";
		}

		$query[] = 'ORDER BY `date` DESC';

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

	//Thay đổi trạng thái của 1 item
	public function changeStatusCart($params, $options = null)
	{
		if ($options['task'] == 'change-ajax-status-cart') {
			if (!empty($params['status'])) {
				$status = $params['status'];
				$data = ['status' => $status];
				$id   = $params['id'];
				$where = [['id', $id]];
				$this->update($data, $where);
				$link = URL::createLink($params['module'], $params['controller'], 'changeStatusCart', ['id' => $id, 'status' => $status]);
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
			$query[] = "SELECT `status`, COUNT(*) AS `count`";
			$query[] = "FROM `{$this->table}` WHERE `id` !=''";

			if (!empty(trim(@$params['search']))) {
				$keyword = '"%' . $params['search'] . '%"';
				$query[] = "AND `username` LIKE $keyword";
			}

			$query[] = "GROUP BY `status`";
			$query = implode(' ', $query);
			$items = $this->fetchAll($query);

			return $items;
		}
	}
}
