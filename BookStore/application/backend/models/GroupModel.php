<?php
class GroupModel extends Model
{
	private $_columns = [
		'id',
		'name',
		'group_acp',
		'created',
		'created_by',
		'modified',
		'modified_by',
		'status',
		'ordering'
	];
	private $_userInfo;
	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_GROUP);
		$userObj = Session::get('user');
		$this->_userInfo = $userObj['info'];
	}

	//Hiện danh sách items
	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`";
		$query[]	= "FROM `{$this->table}` WHERE `id` > 0";

		if (!empty(trim(@$params['search']))) {
			$keyword = '"%' . $params['search'] . '%"';
			$query[] = "AND `name` LIKE $keyword";
		}

		if (@$params['status'] && $params['status'] != 'all') {
			$query[] = "AND `status` = '{$params['status']}'";
		}

		if (isset($params['group_acp']) && $params['group_acp'] != 'default') {
			$query[] = "AND `group_acp` = '{$params['group_acp']}'";
		}

		// $query[] = 'ORDER BY `id` DESC';

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

	//Thay đổi trạng thái của groupACP
	public function changeGroupACP($params, $options = null)
	{
	

		if ($options['task'] == 'change-ajax-group-acp') {
			$groupACP = ($params['group_acp'] == 1) ? 0 : 1;
			$modified = $params['modified']= date('Y-m-d H:i:s', time());
			$data = ['group_acp' => $groupACP,'modified' => $modified];
			$id   = $params['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
			$link = URL::createLink($params['module'], $params['controller'], 'changeGroupACP', ['id' => $id, 'group_acp' => $groupACP]);
			return [$id, $groupACP, $link,$modified];
			Session::set('message', SUCCESS_UPDATE_GROUP_ACP);
		}
	}

	//Thay đổi trạng thái của 1 item
	public function changeStatus($params, $options = null)
	{
		if ($options['task'] == 'change-ajax-status') {
			$status = ($params['status'] == 'active') ? 'inactive' : 'active';
			$modified = $params['modified']= date('Y-m-d H:i:s', time());
			$modified_by = $params['form']['modified_by'] = $this->_userInfo['username'];
			$data = ['status' => $status,'modified' => $modified,'modified_by' => $modified_by];
			$id   = $params['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
			$link = URL::createLink($params['module'], $params['controller'], 'changeStatus', ['id' => $id, 'status' => $status]);
			return [$id, $status, $link,$modified,$modified_by];
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
		Session::set('message', SUCCESS_DELETE_GROUP);
	}

	// Tổng số items
	public function countItems($params, $options = null)
	{
		if ($options['task'] == 'count-items-status') {
			$query[] = "SELECT `status`, COUNT(*) AS `count`";
			$query[] = "FROM `{$this->table}` WHERE `id` > 0";

			if (!empty(trim(@$params['search']))) {
				$keyword = '"%' . $params['search'] . '%"';
				$query[] = "AND `name` LIKE $keyword";
			}
			if (isset($params['group_acp'])) {
				$query[] = "AND `group_acp` = '{$params['group_acp']}'";
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
		$userObj = Session::get('user');
		$userInfo = $userObj['info'];
		if ($options['task'] == 'add') {
			$params['form']['created'] = date('Y-m-d G.i:s<br>', time());
			$params['form']['created_by'] = $userInfo['username'];
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', SUCCESS_ADD_ITEM);
		}
		if ($options['task'] == 'edit') {
			$params['form']['modified'] = date('Y-m-d G.i:s<br>', time());
			$params['form']['modified_by'] = $userInfo['username'];
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
}
