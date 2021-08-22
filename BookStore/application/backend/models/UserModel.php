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
		'status',
		'ordering'
	];


	private $_fieldSearchAccpted  = ['username', 'fullname'];

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);
	}

	//Hiện danh sách items
	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `u`.`id`,`u`.`group_id`, `u`.`username`,`u`.`fullname`,`u`.`email` ,`g`.`name` AS `group_name`, `u`.`created`, `u`.`created_by`, `u`.`modified`, `u`.`modified_by`, `u`.`status`";
		$query[]	= "FROM `{$this->table}` AS `u`LEFT JOIN `" . TBL_GROUP . "` AS `g` ON `u`.`group_id` = `g`.`id`";
		$query[]	= "WHERE `u`.`id` > 0";

		if (!empty(trim(@$params['search']))) {
			$keyword = '"%' . $params['search'] . '%"';
			$fieldSearchAccpted = HelperBackend::fieldSearchAccepted($this->_fieldSearchAccpted, $keyword,'u');
			$query[] = "AND ($fieldSearchAccpted)";
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
			$modified = $params['modified']= date('Y-m-d H:i:s', time());
			$data = ['group_id' => $params['group_id'],'modified' => $modified];
			$id   = $params['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
			return [$id, $modified];
			// Session::set('message', SUCCESS_UPDATE_GROUP_USER);
		}
	}

	//Thay đổi trạng thái của 1 item
	public function changeStatus($params, $options = null)
	{
		if ($options['task'] == 'change-ajax-status') {
			$status = ($params['status'] == 'active') ? 'inactive' : 'active';
			$modified = $params['modified']= date('Y-m-d H:i:s', time());
			$data = ['status' => $status,'modified' => $modified];
			$id   = $params['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
			$link = URL::createLink($params['module'], $params['controller'], 'changeStatus', ['id' => $id, 'status' => $status]);
			return [$id, $status, $link,$modified];
		}
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
				$keyword = '"%' . $params['search'] . '%"';
				$fieldSearchAccpted = HelperBackend::fieldSearchAccepted($this->_fieldSearchAccpted, $keyword);
				$query[] = "AND ($fieldSearchAccpted)";
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
			$params['form']['created'] = date('Y-m-d H:i:s', time());
			$params['form']['created_by'] = 1;
			$params['form']['password']	= md5($params['form']['password']);
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', SUCCESS_ADD_ITEM);
		}
		if ($options['task'] == 'edit') {
			unset($params['form']['username']);
			unset($params['form']['email']);
			$params['form']['modified'] = date('Y-m-d H:i:s', time());
			$params['form']['modified_by'] = 10;
			if ($params['form']['password'] == null)unset($params['form']['password']);
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->update($data, [['id', $params['id']]]);
			Session::set('message', SUCCESS_EDIT_ITEM);
		}
		if ($options['task'] == 'change-status') {
			unset($params['form']['username']);
			unset($params['form']['email']);
			$params['form']['modified'] = date('Y-m-d H:i:s', time());
			$params['form']['modified_by'] = 10;
			if ($params['form']['password'] != null) {
				$params['form']['password'] = md5($params['form']['password']);
			}
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->update($data, [['id', $params['id']]]);
			Session::set('message', SUCCESS_EDIT_ITEM);
		}
	}

	//Item Info
	public function infoItem($params, $options = null)
	{

		if ($options == null) {
			$query[] 	= "SELECT  `id`, `username`,`email`, `fullname`,`group_id`, `status`";
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
