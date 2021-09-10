<?php
class CategoryController extends Controller
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('backend/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function indexAction()
	{
		
		$this->_view->_title 				= ucfirst($this->_arrParam['controller']) . " Controller :: List";
		//Total Items
		$this->_view->itemsStatusCount 		= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$itemCount 	= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);

		//set Pagination
		$configPagination  = ['totalItemsPerPage' => 4, 'pageRange' => 3];
		$this->setPagination($configPagination);

		$status = $this->_arrParam['status'] ?? 'all';
		$this->_view->pagination 			= new Pagination($itemCount[$status], $this->_pagination);
		//List Items
		$this->_view->items 				= $this->_model->listItems($this->_arrParam);
		$this->_view->render($this->_arrParam['controller'] . '/index');
	}
	

	public function changeStatusAction()
	{
		$result = $this->_model->changeStatus($this->_arrParam, ['task' => 'change-ajax-status']);
		echo json_encode($result);
	}

	public function changeIshomeAction()
	{
		$result = $this->_model->changeIshome($this->_arrParam, ['task' => 'change-ajax-ishome']);
		echo json_encode($result);
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

		if(!empty($_FILES))$this->_arrParam['form']['picture'] = $_FILES['picture'];

		if (@isset($this->_arrParam['id']) && !@$this->_arrParam['form']['token']) {
			$this->_view->_title 		= ucfirst($this->_arrParam['controller']) . ' Controller :: Edit';
			$this->_arrParam['form'] 	= $this->_model->infoItem($this->_arrParam);
			if (empty($this->_arrParam['form'])) URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
		}

		if (@$this->_arrParam['form']['token'] > 0) {
			$validate 					= new Validate($this->_arrParam['form']);
			$validate->addRule('name', 'string', ['min' => 3, 'max' => 30])
					->addRule('status', 'status')
					->addRule('is_home', 'status')
					->addRule('ordering', 'int',['min' => 1, 'max' =>20 ])
					->addRule('picture', 'file',['min' => 100, 'max' =>1000000,'entension' =>['jpg','png']],false);
			$validate->run();
			$this->_arrParam['form'] 	= $validate->getResult();
			if ($validate->isValid() 	== false) {
				$this->_view->error 	= $validate->showErrors();
			} else {
				$task = isset($this->_arrParam['id']) ? 'edit' : 'add';
				// Insert Database
				$this->_model->saveItem($this->_arrParam, ['task' => $task]);
				URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
			}
		}
		$this->_view->arrParam = $this->_arrParam;
		$this->_view->render($this->_arrParam['controller'] . '/form');
	}
}
