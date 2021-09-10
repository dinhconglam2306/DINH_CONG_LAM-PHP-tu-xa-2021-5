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
		if ($option['task'] == 'book-special-list-category') {
			$catID = @$params['category_id'];
			$query = "SELECT `name`,`id`,`price`,`picture`,`sale_off` FROM `{$this->table}` WHERE `status` = 'active' AND `category_id`= $catID AND `special` = 1 ORDER BY `ordering` ASC";
			$result  = $this->fetchAll($query);
			return $result;
		}
		if ($option['task'] == 'book-special-list-book') {
			$query[] = "SELECT `b`.`name`,`b`.`id`,`b`.`price`,`b`.`picture`,`b`.`sale_off` ";
			$query[] = "FROM `book` AS b , `category` AS c";
			$query[] = "WHERE `b`.`category_id` = `c`.`id`";
			$query[] = "AND `b`.`category_id` IN";
			$query[] = "(SELECT `id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active') ";
			$query[] = "AND `b`.`status` = 'active' AND `b`.`special` = 1 ORDER BY `b`.`ordering` ASC LIMIT 0,8";

			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			return $result;
		}
		if ($option['task'] == 'book-new-list') {
			$query[] = "SELECT `b`.`name`,`b`.`id`,`b`.`price`,`b`.`picture`,`b`.`sale_off` ";
			$query[] = "FROM `book` AS b , `category` AS c";
			$query[] = "WHERE `b`.`category_id` = `c`.`id`";
			$query[] = "AND `b`.`category_id` IN";
			$query[] = "(SELECT `id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active') ";
			$query[] = "AND `b`.`status` = 'active' AND `b`.`special` = 1 ORDER BY `b`.`id` DESC LIMIT 0,6 ";

			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			return $result;
		}
		if ($option['task'] == 'book-connection') {
			$bookID = $params['book_id'];
			$query[] = "SELECT `name`,`id`,`price`,`description`,`picture`,`sale_off` ";
			$query[] = "FROM `{$this->table}`";
			$query[] = "WHERE `category_id` = (SELECT `category_id` FROM `{$this->table}` WHERE `id` = $bookID)";
			$query[] = "AND `id` <> $bookID ORDER BY `ordering` ASC LIMIT 0,6";

			$query = implode(' ', $query);
			$result  = $this->fetchAll($query);
			return $result;
		}
	}
	public function CategoryList($params, $option)
	{
		if ($option['task'] == 'category-list') {

			$query = "SELECT `name`,`id` FROM `category` WHERE `status` = 'active' ";
			$result  = $this->fetchAll($query);
			return $result;
		}
		if ($option['task'] == 'category-list-special') {
			$query = "SELECT `name`,`id` FROM `category` WHERE `is_home` = 1 AND `status` = 'active' AND `is_home` = 1";
			$categorySpecial  = $this->fetchAll($query);
			return $categorySpecial;
		}
	}

	public function infoBook($params, $option)
	{
		if ($option['task'] == 'book-info') {
			$bookID = $params['book_id'];
			$query = "SELECT `name`,`id`,`price`,`description`,`picture`,`sale_off` FROM `book` WHERE `status` = 'active' AND `id` = $bookID";
			$result  = $this->fetchRow($query);
			return $result;
		}
	}
	public function countItems($params, $options = null)
	{
		if ($options['task'] == 'count-items-status') {
			$query[] = "SELECT COUNT(`id`) AS `count`";
			$query[] = "FROM `{$this->table}` WHERE `id` > 0";

			$query = implode(' ', $query);
			$items = $this->fetchRow($query);
			return $items['count'];
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
