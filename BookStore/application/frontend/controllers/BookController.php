<?php
class BookController extends Controller
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('frontend/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function listAction()
	{
		$this->_view->_title 				= "Danh sách quyển sách";

		$itemCount 							= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$configPagination  					= ['totalItemsPerPage' => 8, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination 			= new Pagination($itemCount, $this->_pagination);
		$this->_view->listBooks    			=  $this->_model->BookList($this->_arrParam, ['task' => 'book-list']);
		$this->_view->category 				= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list-special']);
		$this->_view->specialItems    		=  $this->_model->BookList($this->_arrParam, ['task' => 'book-special-list-category']);
		$this->_view->render('book/list');
	}

	public function detailAction()
	{
		$this->_view->_title 				= "Thông tin quyển sách";
		$this->_view->bookItem    			=  $this->_model->infoBook($this->_arrParam, ['task' => 'book-info']);
		$this->_view->category 				= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list-special']);
		$this->_view->specialItems    		=  $this->_model->BookList($this->_arrParam, ['task' => 'book-special-list-book']);
		$this->_view->newBook    			=  $this->_model->BookList($this->_arrParam, ['task' => 'book-new-list']);
		$this->_view->connectionBook    	=  $this->_model->BookList($this->_arrParam, ['task' => 'book-connection']);
		$this->_view->render('book/detail');
	}
	public function quickViewBookAction()
	{
		$result = $this->_model->quickViewBook($this->_arrParam, ['task' => 'ajax-quick-view-book']);
		echo json_encode($result);
	}
}
