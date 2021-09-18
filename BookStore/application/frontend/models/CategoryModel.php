<?php
class CategoryModel extends Model
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

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_BOOK);
	}

	//Hiện danh sách book
	public function BookList($params, $option)
	{
		if ($option['task'] == 'book-list') {
			$catID = $params['category_id'];
			$query[] = "SELECT `name`,`id`,`price`,`description`,`picture`,`sale_off`";
			$query[] = "FROM `{$this->table}`";
			$query[] = "WHERE `status` = 'active' AND `category_id`= $catID";

			if (isset($params['sort']) && $params['sort'] != 'default') {
				$arrSort = explode('_', $params['sort']);
				$query[] = "ORDER BY `$arrSort[0]` $arrSort[1]";
			}
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
		if ($option['task'] == 'book-special-list-book') {
			$query[] = "SELECT `b`.`name`,`b`.`category_id`,`b`.`id`,`b`.`price`,`b`.`picture`,`b`.`sale_off`,`c`.`name` AS `category_name` ";
			$query[] = "FROM `book`  AS `b`LEFT JOIN `" . TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id`";
			$query[] = "WHERE `b`.`category_id` IN";
			$query[] = "(SELECT `id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active') ";
			$query[] = "AND `b`.`status` = 'active' AND `b`.`special` = 1 ORDER BY `b`.`ordering` ASC LIMIT 0,8";

			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			return $result;
		}
	}
	public function CategoryList($params, $option)
	{
		if ($option['task'] == 'category-list') {
			$query[] = "SELECT `name`,`picture`,`id` ";
			$query[] = "FROM `category`";
			$query[] = "WHERE `status` = 'active' ";

			if (isset($params['sort']) && $params['sort'] != 'default') {
				$arrSort = explode('_', $params['sort']);
				$query[] = "ORDER BY `$arrSort[0]` $arrSort[1]";
			}
			//PAGINATION
			$pagination = $params['pagination'];
			$totalItemsPerPage = $pagination['totalItemsPerPage'];
			if ($totalItemsPerPage > 0) {
				$position = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
				$query[] = "LIMIT $position, $totalItemsPerPage";
			}

			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			return $result;
		}
		if ($option['task'] == 'category-list-special') {
			$query = "SELECT `name`,`id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active'";
			$categorySpecial  = $this->fetchAll($query);
			foreach ($categorySpecial as $key => $value) {
				$queryBook 	= "SELECT  `name`,`id`,`price`,`description`,`picture`,`sale_off` FROM `book` WHERE `category_id` = $value[id] AND `status` = 'active' AND `special` = 1 LIMIT 0,8 ";
				$books 		=  $this->fetchAll($queryBook);
				$categorySpecial[$key]['books'] = $books;
			}
			return $categorySpecial;
		}
	}
	public function countItems($params, $options = null)
	{
		if ($options['task'] == 'count-items-status') {
			$query[] = "SELECT COUNT(`id`) AS `count`";
			$query[] = "FROM `category` WHERE `status` = 'active'";
			$query = implode(' ', $query);
			$items = $this->fetchRow($query);
			return $items['count'];
		}
	}
	public function quickViewCategory($params, $option)
	{
		if ($option['task'] == 'ajax-quick-view-category') {
			$catID = $params['category_id'];
			$query[] = "SELECT `name`,`id`,`picture`";
			$query[] = "FROM `category`";
			$query[] = "WHERE `status` = 'active' AND `id`= $catID";

			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			$queryBooks = "SELECT `name`, `id` FROM `book` WHERE `category_id` =  $catID AND `status` = 'active'";
			$result[0]['books']  = $this->fetchAll($queryBooks);
			return $result;
		}
	}
}
