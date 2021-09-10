<?php
class BookModel extends Model
{
	private $_columns = [
		'id',
		'name',
		'picture',
		'description',
		'price',
		'special',
		'sale_off',
		'category_id',
		'created',
		'created_by',
		'modified',
		'modified_by',
		'status',
		'ordering'
	];
	private $_userInfo;

	private $_fieldSearchAccpted  = ['name'];

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_BOOK);

		$userObj = Session::get('user');
		$this->_userInfo = $userObj['info'];
	}

	//Hiện danh sách items
	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `b`.`id`,`b`.`ordering`,`b`.`category_id`, `b`.`name`, `b`.`special`,`b`.`sale_off`,`b`.`picture`,`b`.`price` ,`c`.`name` AS `category_name`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`, `b`.`status`";
		$query[]	= "FROM `{$this->table}` AS `b`LEFT JOIN `" . TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id`";
		$query[]	= "WHERE `b`.`id` > 0";

		if (!empty(trim(@$params['search']))) {
			$keyword = '"%' . $params['search'] . '%"';
			$fieldSearchAccpted = HelperBackend::fieldSearchAccepted($this->_fieldSearchAccpted, $keyword, 'b');
			$query[] = "AND ($fieldSearchAccpted)";
		}

		if (@$params['status'] && $params['status'] != 'all') {
			$query[] = "AND `b`.`status` = '{$params['status']}'";
		}

		if (isset($params['category_id']) && $params['category_id'] != '0') {
			$query[] = "AND `b`.`category_id` = '{$params['category_id']}'";
		}
		if (isset($params['special']) && $params['special'] != 'default') {
			$query[] = "AND `b`.`special` = '{$params['special']}'";
		}

		$query[] = 'ORDER BY `id` DESC';

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

	//Thay đổi  Category của item
	public function changeCategory($params, $options = null)
	{
		if ($options == null) {
			$modified = $params['modified'] = date('Y-m-d H:i:s', time());
			$modified_by = $params['form']['modified_by'] = $this->_userInfo['username'];
			$data = ['category_id' => $params['category_id'], 'modified' => $modified,'modified_by' => $modified_by];
			
			$id   = $params['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
			return [$id, $modified,$modified_by];
			// Session::set('message', SUCCESS_UPDATE_GROUP_USER);
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

	public function changeSpecial($params, $options = null)
	{
		if ($options['task'] == 'change-ajax-special') {
			$special = ($params['special'] == 1) ? 0 : 1;
			$modified = $params['modified']= date('Y-m-d H:i:s', time());
			$modified_by = $params['form']['modified_by'] = $this->_userInfo['username'];
			$data = ['special' => $special,'modified' => $modified,'modified_by' => $modified_by];
			$id   = $params['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
			$link = URL::createLink($params['module'], $params['controller'], 'changeSpecial', ['id' => $id, 'special' => $special]);
			return [$id, $special, $link,$modified,$modified_by];
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
			if (isset($params['category_id']) && $params['category_id'] != 0) {
				$query[] = "AND `category_id` = '{$params['category_id']}'";
			}

			if (isset($params['special']) && $params['special'] != 'default') {
				$query[] = "AND `special` = '{$params['special']}'";
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
			$params['form']['picture'] = $uploadObj->uploadFile($params['form']['picture'], 'book');
			$params['form']['created'] = date('Y-m-d H:i:s', time());
			$params['form']['created_by'] = $this->_userInfo['username'];
			// $params['form']['description'] = mysqli_real_escape_string($connect,$params['form']['description']);
			// $params['form']['name'] 	   = mysqli_real_escape_string($connect,$params['form']['name']);
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', SUCCESS_ADD_ITEM);
		}
		if ($options['task'] == 'edit') {
			if ($params['form']['picture']['name'] == null) {
				unset($params['form']['picture']);
			} else {
				$params['form']['picture'] = $uploadObj->uploadFile($params['form']['picture'], 'book');
				$uploadObj->removeFile('category', $params['form']['picture_hidden']);
			}
			$params['form']['modified'] = date('Y-m-d H:i:s', time());
			$params['form']['modified_by'] = $this->_userInfo['username'];
			// $params['form']['description'] = mysqli_real_escape_string($connect,$params['form']['description']);
			// $params['form']['name'] 	   = mysqli_real_escape_string($connect,$params['form']['name']);
			
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->update($data, [['id', $params['id']]]);
			Session::set('message', SUCCESS_EDIT_ITEM);
		}
	}

	//Item Info
	public function infoItem($params, $options = null)
	{
		if ($options == null) {
			$query[] 	= "SELECT  `id`, `name`,`price`,`sale_off`,`picture`,`special`, `description`,`ordering`,`category_id`, `status`";
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
			$query[]	= "FROM `" . TBL_CATEGORY . "`";
			$query = implode(' ', $query);
			$result = $this->fetchPairs($query);
			return $result;
		}
	}
}
