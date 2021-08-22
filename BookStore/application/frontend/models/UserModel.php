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
			$params['form']['status'] = 'inactive';
			$data = array_intersect_key($params['form'], array_flip($this->_columns));

			$this->insert($data);
			
			return $this->lastID();
		}
	}
}
