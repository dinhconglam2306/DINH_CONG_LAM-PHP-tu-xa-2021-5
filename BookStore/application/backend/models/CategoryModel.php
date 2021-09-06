<?php
class CategoryModel extends Model
{
	private $_columns = [
		'id',
		'name',
		'picture',
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
		$this->setTable(TBL_CATEGORY);
		$userObj = Session::get('user');
		$this->_userInfo = $userObj['info'];
	}

	//Hiện danh sách items
	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `id`, `name`, `picture`, `ordering`, `created`, `created_by`, `modified`, `modified_by`, `status`";
		$query[]	= "FROM `{$this->table}` WHERE `id` > 0";

		if (!empty(trim(@$params['search']))) {
			$keyword = '"%' . $params['search'] . '%"';
			$query[] = "AND `name` LIKE $keyword";
		}

		if (@$params['status'] && $params['status'] != 'all') {
			$query[] = "AND `status` = '{$params['status']}'";
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

	//Thay đổi trạng thái của 1 item
	public function changeStatus($params, $options = null)
	{
		if ($options['task'] == 'change-ajax-status') {
			$status = ($params['status'] == 'active') ? 'inactive' : 'active';
			$modified = $params['modified'] = date('Y-m-d H:i:s', time());
			$modified_by = $params['form']['modified_by'] = $this->_userInfo['username'];
			$data = ['status' => $status, 'modified' => $modified, 'modified_by' => $modified_by];
			$id   = $params['id'];
			$where = [['id', $id]];
			$query = $this->update($data, $where);
			$link = URL::createLink($params['module'], $params['controller'], 'changeStatus', ['id' => $id, 'status' => $status]);
			return [$id, $status, $link, $modified, $modified_by];
		}
	}

	public function changeOrdering($params, $options = null)
	{
		if ($options['task'] == 'change-ajax-ordering') {
			$ordering = @$params['ordering'];
			$modified = $params['modified'] = date('Y-m-d H:i:s', time());
			$modified_by = $params['form']['modified_by'] = $this->_userInfo['username'];
			$data = ['ordering' => $ordering, 'modified' => $modified,'modified_by' => $modified_by];
			$id   = @$params['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
			return [$id,$modified,$modified_by];
			// Session::set('message', SUCCESS_UPDATE_GROUP_USER);
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
		if ($options == null) {
			$ids = isset($params['id']) ? [$params['id']] : $params['cid'];
			$ids = $this->createWhereDeleteSQL($ids);

			//remove Image
			$query[]	= "SELECT `id` ,`picture` AS `name`";
			$query[]	= "FROM `{$this->table}`";
			$query[]	= "WHERE `id` IN ($ids) ";
			$query = implode(' ', $query);

			$arrImage = $this->fetchPairs($query);

			require_once LIBRARY_EXT_PATH . 'Upload.php';
			$uploadObj = new Upload();
			foreach ($arrImage as $value) {
				$uploadObj->removeFile('category', $value);
			}

			//Remove Database
			$queryDB = "DELETE FROM `{$this->table}` WHERE `id` IN ($ids)";
			$this->query($queryDB);
			Session::set('message', SUCCESS_DELETE_GROUP);
		}
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
		require_once LIBRARY_EXT_PATH . 'Upload.php';
		$uploadObj = new Upload();
		if ($options['task'] == 'add') {

			$params['form']['picture'] = $uploadObj->uploadFile($params['form']['picture'], 'category');
			$params['form']['created'] = date('Y-m-d G.i:s<br>', time());
			$params['form']['created_by'] = $this->_userInfo['username'];
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', SUCCESS_ADD_ITEM);
		}
		if ($options['task'] == 'edit') {
			$params['form']['modified'] = date('Y-m-d G.i:s<br>', time());
			$params['form']['modified_by'] = $this->_userInfo['username'];
			if ($params['form']['picture']['name'] == null) {
				unset($params['form']['picture']);
			} else {
				$params['form']['picture'] = $uploadObj->uploadFile($params['form']['picture'], 'category');
				$uploadObj->removeFile('category', $params['form']['picture_hidden']);
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
			$query[] 	= "SELECT  `id`, `name`, `picture`, `status`,`ordering`";
			$query[]	= "FROM `{$this->table}`";
			$query[]	= "WHERE `id` = {$params['id']}";
			$query = implode(' ', $query);
			$result = $this->fetchRow($query);
			return $result;
		}
	}
}
