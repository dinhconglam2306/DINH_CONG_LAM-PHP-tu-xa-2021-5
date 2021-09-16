<?php
class BookController extends Controller
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
		$this->_view->itemsStatusCount 		= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$itemCount 							= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$configPagination  					= ['totalItemsPerPage' => 5, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$status 							= $this->_arrParam['status'] ?? 'all';
		$this->_view->pagination 			= new Pagination($itemCount[$status], $this->_pagination);

		//List Items
		$this->_view->items 				= $this->_model->listItems($this->_arrParam);
		$this->_view->slbCategory 				= [0=>' - Select Category - '] + $this->_model->itemInSelectbox($this->_arrParam, null);
		$this->_view->render($this->_arrParam['controller'] . '/index');
	}

	public function changeStatusAction()
	{
		$result = $this->_model->changeStatus($this->_arrParam, ['task' => 'change-ajax-status']);
		echo json_encode($result);
	}

	public function changeSpecialAction()
	{
		$result = $this->_model->changeSpecial($this->_arrParam, ['task' => 'change-ajax-special']);
		echo json_encode($result);
	}

	public function changeNewAction()
	{
		$result = $this->_model->changeNew($this->_arrParam, ['task' => 'change-ajax-new']);
		echo json_encode($result);
	}

	public function changeCategoryAction()
	{
		$result = $this->_model->changeCategory($this->_arrParam, null);
		echo json_encode($result);
		// URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
	}
	public function changeOrderingAction()
	{
		$result = $this->_model->changeOrdering($this->_arrParam, ['task' => 'change-ajax-ordering']);
		echo json_encode($result);
	}

	public function deleteAction()
	{
		$this->_model->deleteItem($this->_arrParam);
		URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
	}

	public function multiActiveAction()
	{
		$this->_model->multiStatus($this->_arrParam, ['task' => 'active']);
		URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
	}

	public function multiInactiveAction()
	{
		$this->_model->multiStatus($this->_arrParam, ['task' => 'inactive']);
		URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
	}

	public function multiDeleteAction()
	{
		$this->_model->deleteItem($this->_arrParam);
		URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
	}

	public function formAction()
	{
		$this->_view->_title 			= ucfirst($this->_arrParam['controller']) . ' Controller :: Add';
		$this->_view->slbCategory 				= [0=>' - Select Category - '] + $this->_model->itemInSelectbox($this->_arrParam, null);
		if(!empty($_FILES))$this->_arrParam['form']['picture'] = $_FILES['picture'];
		if (@isset($this->_arrParam['id']) && !@$this->_arrParam['form']['token']) {
			$this->_view->_title 		= ucfirst($this->_arrParam['controller']) . ' Controller :: Edit';
			$this->_arrParam['form'] 	= $this->_model->infoItem($this->_arrParam,$option = null);
			if (empty($this->_arrParam['form'])) URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
		}

		if (@$this->_arrParam['form']['token'] > 0) {
			$task = 'add';
			if (isset($this->_arrParam['id'])) {
				$task = 'edit';
			}
			$validate 					= new Validate($this->_arrParam['form']);
			$validate->addRule('name', 'string', ['min' => 1,'max'=> 255])
					 ->addRule('ordering', 'int',['min' => 1,'max'=> 100])
					 ->addRule('status', 'status')
					 ->addRule('special', 'status')
					 ->addRule('category_id', 'status')
					 ->addRule('sale_off', 'int',['min' => 1,'max'=> 100])
					 ->addRule('price', 'int',['min' => 100,'max'=>2500000 ])
					 ->addRule('picture', 'file',['min' => 100, 'max' =>1000000,'entension' =>['jpg','png','jfif']],false);
			$validate->run();
			$this->_arrParam['form'] 	= $validate->getResult();
			if ($validate->isValid() 	== false) {
				$this->_view->error 	= $validate->showErrors();
			} else {
				// Insert Database
				$this->_model->saveItem($this->_arrParam, ['task' => $task]);
				URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
			}
		}
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->slbCategory 				= ['default'=>' - Select Category - '] + $this->_model->itemInSelectbox($this->_arrParam, null);
		$this->_view->render($this->_arrParam['controller'] . '/form');
	}
}
