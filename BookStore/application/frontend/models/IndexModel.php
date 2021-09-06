<?php
class IndexModel extends Model
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
		'register_ip',
		'status',
		'ordering'
	];



	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);
	}

	//Hiện danh sách items

	//Lưu Item
	public function saveItem($params, $options = null)
	{
		if ($options['task'] == 'register-user') {
			$params['form']['password']	= md5($params['form']['password']);
			$params['form']['register_date'] = date('Y-m-d H:m:s', time());
			$params['form']['register_ip'] = $_SERVER['REMOTE_ADDR'];
			$params['form']['created'] = date('Y-m-d H:m:s', time());
			$params['form']['status'] = 'inactive';
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);

			return $this->lastID();
		}
	}
	public function infoItem($params, $option)
	{
		if ($option == null) {
			$email = $params['form']['email'];
			$password = md5($params['form']['password']);

			$query[] = "SELECT `u`.`id`,`u`.`email`,`u`.`fullname`,`u`.`email`,`u`.`status`,`g`.`group_acp`";
			$query[] = "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[] = "WHERE `email` = '$email' AND `password` = '$password'";

			$query   = implode(" ", $query);
			$result  = $this->fetchRow($query);

			return $result;
		}
	}
	public function CategoryList($params, $option)
	{
		if ($option == null) {
			
			$query = "SELECT `name` FROM `category` WHERE `status` = 'active'";
			$result  = $this->fetchAll($query);
			return $result;
		}
	}
}
