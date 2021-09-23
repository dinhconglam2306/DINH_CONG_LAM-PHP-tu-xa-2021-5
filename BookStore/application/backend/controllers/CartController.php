<?php
class CartController extends Controller
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('backend/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}


	//ACTION : LIST BOOK
	public function indexAction()
	{
		$this->_view->_title 				= ucfirst($this->_arrParam['controller']) . " Controller :: List";

		//Total Items
		$itemCount 							= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$configPagination  					= ['totalItemsPerPage' => 5, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination 			= new Pagination($itemCount[0]['count'], $this->_pagination);
		//List Items
		$this->_view->items 				= $this->_model->listItems($this->_arrParam);
		$this->_view->render($this->_arrParam['controller'] . '/index');
	}
	public function detailAction()
	{
		$this->_view->_title 				= ucfirst($this->_arrParam['controller']) . " Controller :: Detail";

		//Detail Items
		$this->_view->item 					= $this->_model->infoOrder($this->_arrParam,$option = null);
		$this->_view->render($this->_arrParam['controller'] . '/detail');
	}

	public function changeStatusCartAction()
	{
		$result = $this->_model->changeStatusCart($this->_arrParam, ['task' => 'change-ajax-status-cart']);
		echo json_encode($result);
	}

	public function multiDeleteAction()
	{
		$this->_model->deleteItem($this->_arrParam);
		URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
	}
	public function deleteAction()
	{
		$this->_model->deleteItem($this->_arrParam);
		URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
	}

}
