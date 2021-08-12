<?php
class UserModel extends Model
{
	private $_columns = [
		'id',
		'name',
		'fullname',
		'email',
		'group_id',
		'created',
		'created_by',
		'modified',
		'modified_by',
		'status',
		'ordering'
	];
	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);
	}

	//Hiện danh sách items
	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `u`.`id`,`u`.`group_id`, `u`.`name`,`u`.`fullname`,`u`.`email` ,`g`.`name` AS `group_name`, `u`.`created`, `u`.`created_by`, `u`.`modified`, `u`.`modified_by`, `u`.`status`";
		$query[]	= "FROM `{$this->table}` AS `u`,`" . TBL_GROUP . "` AS `g`";
		$query[]	= "WHERE `u`.`group_id` = `g`.`id`";

		if (!empty(trim(@$params['search']))) {
			$keyword = '"%'.$params['search'].'%"';
			$query[] = "AND (`u`.`name` LIKE $keyword OR `u`.`fullname` LIKE $keyword OR `u`.`email` LIKE $keyword)";
		}

		if (@$params['status'] && $params['status'] != 'all') {
			$query[] = "AND `u`.`status` = '{$params['status']}'";
		}

		if (isset($params['group_id']) && $params['group_id'] != 'default') {
			$query[] = "AND `u`.`group_id` = '{$params['group_id']}'";
		}

		$query[] = 'ORDER BY `id` ASC';

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

	//Thay đổi  Group của item
	public function changeGroup($params, $options = null)
	{
		if ($options == null) {
			$data = ['group_id' => $params['group_id']];
			$where = [['id', $params['id']]];
			$this->update($data, $where);
			Session::set('message', SUCCESS_UPDATE_GROUP_USER);
		}
	}

	//Thay đổi trạng thái của 1 item
	public function changeStatus($params, $options = null)
	{
		$status = $params['status'] == 'active' ? 'inactive' : 'active';
		$data = ['status' => $status];
		$where = [['id', $params['id']]];
		$this->update($data, $where);
		Session::set('message', SUCCESS_UPDATE_STATUS);
	}


	//Thay đổi trạng thái của nhiều items
	public function multiStatus($params, $options = null)
	{
		if ($options['task'] == 'active' || $options['task'] == 'inactive') {
			$ids = implode(', ', $params['cid']);
			$query = "UPDATE `{$this->table}` SET `status` = '{$options['task']}' WHERE `id` IN ({$ids})";
			$this->query($query);
			Session::set('message', SUCCESS_UPDATE_STATUS);
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
			$query[] = "FROM `{$this->table}` WHERE `id` > 0";

			if (!empty(trim(@$params['search']))) {
				$keyword = '"%'.$params['search'].'%"';
				$query[] = "AND (`name` LIKE $keyword OR `fullname` LIKE $keyword OR `email` LIKE $keyword)";
				// $query[] = "AND `name` LIKE '%{$params['search']}%'";
			}
			if (isset($params['group_id'])) {
				$query[] = "AND `group_id` = '{$params['group_id']}'";
			}


			$query[] = "GROUP BY `status`";
			$query = implode(' ', $query);
			$items = $this->fetchAll($query);
			$result = array_combine(array_column($items, 'status'), array_column($items, 'count'));
			if (empty($result['inactive'])) $result = $result + ['inactive' => 0];
			if (empty($result['active'])) $result = ['active' => 0] + $result;
			$result = ['all' => array_sum($result)] + $result;
			return $result;
		}
	}

	//Lưu Item
	public function saveItem($params, $options = null)
	{
		if ($options['task'] == 'add') {
			$params['form']['created'] = date('Y-m-d G.i:s<br>', time());
			$params['form']['created_by'] = 1;
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', SUCCESS_ADD_ITEM);
		}
		if ($options['task'] == 'edit') {
			$params['form']['modified'] = date('Y-m-d G.i:s<br>', time());
			$params['form']['modified_by'] = 10;
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->update($data, [['id', $params['id']]]);
			Session::set('message', SUCCESS_EDIT_ITEM);
		}
	}

	//Item Info
	public function infoItem($params, $options = null)
	{

		if ($options == null) {
			$query[] 	= "SELECT  `id`, `name`, `group_acp`, `status`";
			$query[]	= "FROM `{$this->table}`";
			$query[]	= "WHERE `id` = {$params['id']}";
			$query = implode(' ', $query);
			$result = $this->fetchRow($query);
			return $result;
		}
	}
	//Item in select box
	public function itemInSelectbox($params, $options = null)
	{
		$result = [];
		if ($options == null) {
			$query[] 	= "SELECT `id`,`name`";
			$query[]	= "FROM `" . TBL_GROUP . "`";
			$query = implode(' ', $query);
			$result = $this->fetchPairs($query);
			return $result;
		}
	}
}