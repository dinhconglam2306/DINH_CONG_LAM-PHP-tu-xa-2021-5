<?php
class CategoryController extends Controller
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
		$this->_view->_title 					= "Danh sách danh mục";

		$itemCount 								= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$configPagination  						= ['totalItemsPerPage' => 8, 'pageRange' => 2];
		$this->setPagination($configPagination);
		$this->_view->pagination 				= new Pagination($itemCount, $this->_pagination);
		$this->_view->specialBook    			=  $this->_model->bookList($this->_arrParam, ['task' => 'book-special-list-book']);
		$this->_view->category 					= $this->_model->categoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->render('category/list');
	}
	public function quickViewCategoryAction()
	{
		$result = $this->_model->quickViewCategory($this->_arrParam, ['task' => 'ajax-quick-view-category']);
		echo json_encode($result);
	}
}
