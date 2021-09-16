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
		$this->setTable(TBL_BOOK);
	}

	//Hiện danh sách nổi bật
	public function BookList($params, $option)
	{
		if ($option['task'] == 'book-special-list') {
			$query[] = "SELECT `b`.`name`,`b`.`category_id`,`b`.`id`,`b`.`price`,`b`.`description`,`b`.`picture`,`b`.`sale_off`";
			$query[] = "FROM `book` AS b , `category` AS c ";
			$query[] = "WHERE `b`.`category_id` = `c`.`id`";
			$query[] = "AND `b`.`status` = 'active' AND  `b`.`special` = 1";
			$query[] = "AND `b`.`category_id` IN (SELECT `id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active') ";
			$query[] = "ORDER BY `b`.`ordering`";


			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			return $result;
		}
		if ($option['task'] == 'book-special-category-special') {
			$query[] = "SELECT `b`.`name` AS book_name,`b`.`id`,`b`.`price`,`b`.`description`,`b`.`picture`,`b`.`sale_off`,`c`.`name` AS category_name";
			$query[] = "FROM `book` AS b , `category` AS c";
			$query[] = "WHERE `b`.`category_id` = `c`.`id`";
			$query[] = "AND `b`.`special` = 1 AND `b`.`status` = 'active' ";
			$query[] = "AND `b`.`category_id` IN";
			$query[] = "(SELECT `id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active') ";
			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			return $result;
		}
	}

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

			$query[] = "SELECT `u`.`id`,`u`.`phone`,`u`.`address`,`u`.`username`,`u`.`email`,`u`.`fullname`,`u`.`email`,`u`.`status`,`g`.`group_acp`";
			$query[] = "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[] = "WHERE `email` = '$email' AND `password` = '$password'";

			$query   = implode(" ", $query);
			$result  = $this->fetchRow($query);

			return $result;
		}
	}
	public function CategoryList($params, $option)
	{
		if ($option['task'] == 'category-list') {

			$query = "SELECT `name`,`id` FROM `category` WHERE `status` = 'active' ORDER BY `ordering` ASC";
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
	public function quickViewBook($params, $option)
	{
		if ($option['task'] == 'ajax-quick-view-book') {
			$catID = $params['book_id'];
			$query[] = "SELECT `name`,`id`,`price`,`description`,`picture`,`sale_off`";
			$query[] = "FROM `{$this->table}`";
			$query[] = "WHERE `status` = 'active' AND `id`= $catID";

			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);

			return $result;
		}
	}
}
