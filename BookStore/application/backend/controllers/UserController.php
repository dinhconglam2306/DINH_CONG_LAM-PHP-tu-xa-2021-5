<?php
class UserController extends Controller
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
		$itemCount 							= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$configPagination  					= ['totalItemsPerPage' => 4, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$status 							= $this->_arrParam['status'] ?? 'all';
		$this->_view->pagination 			= new Pagination($itemCount[$status], $this->_pagination);

		//List Items
		$this->_view->items 				= $this->_model->listItems($this->_arrParam);
		$this->_view->slbGroup 				= [0=>' - Select Group - '] + $this->_model->itemInSelectbox($this->_arrParam, null);
		$this->_view->render($this->_arrParam['controller'] . '/index');
	}

	public function changeStatusAction()
	{
		$result = $this->_model->changeStatus($this->_arrParam, ['task' => 'change-ajax-status']);
		echo json_encode($result);
	}

	public function changeGroupAction()
	{
		$result = $this->_model->changeGroup($this->_arrParam, null);
		echo json_encode($result);
		// URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
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

		if (@isset($this->_arrParam['id']) && !@$this->_arrParam['form']['token']) {
			$this->_view->_title 		= ucfirst($this->_arrParam['controller']) . ' Controller :: Edit';
			$this->_arrParam['form'] 	= $this->_model->infoItem($this->_arrParam);
			if (empty($this->_arrParam['form'])) URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
		}

		if (@$this->_arrParam['form']['token'] > 0) {
			$task = 'add';
			$requirePass = true;
			$queryUserName 	= "SELECT `id` FROM `" . TBL_USER . "` WHERE `username` = '" . $this->_arrParam['form']['username'] . "'";
			$queryEmail		= "SELECT `id` FROM `" . TBL_USER . "` WHERE `email` = '" . $this->_arrParam['form']['email'] . "'";
			if (isset($this->_arrParam['id'])) {
				$task = 'edit';
				$requirePass = false;
				$queryUserName 	.= " AND `id` <> '" . $this->_arrParam['id'] . "'";
				$queryEmail 	.= " AND `id` <> '" . $this->_arrParam['id'] . "'";
			}
			$validate 					= new Validate($this->_arrParam['form']);
			$validate->addRule('username', 'string-notExistRecord', ['database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 255])
				->addRule('email', 'email-notExistRecord', ['database' => $this->_model, 'query' => $queryEmail])
				->addRule('password', 'password', ['action' => $task], $requirePass)
				->addRule('group_id', 'group')
				->addRule('status', 'status');
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
		$this->_view->slbGroup 				= ['default'=>' -Select Group ACP- '] + $this->_model->itemInSelectbox($this->_arrParam, null);
		$this->_view->render($this->_arrParam['controller'] . '/form');
	}
	public function changePasswordAction()
	{
		$this->_view->_title 			= ucfirst($this->_arrParam['controller']) . ' Controller :: Change Password';
		if (@isset($this->_arrParam['id']) && !@$this->_arrParam['form']['token']) {
			$this->_arrParam['form'] 	= $this->_model->infoItem($this->_arrParam);
			if (empty($this->_arrParam['form'])) URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
		}
		if (@$this->_arrParam['form']['token'] > 0) {
			$validate 					= new Validate($this->_arrParam['form']);
			$validate->addRule('password', 'password', ['action' => 'edit']);
			$validate->run();
			$this->_arrParam['form'] 	= $validate->getResult();
			if ($validate->isValid() 	== false) {
				$this->_view->error 	= $validate->showErrors();
			} else {
				// Insert Database
				$this->_model->saveItem($this->_arrParam, ['task' => 'change-pass']);
				URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
			}
		}

		$this->_view->arrParam = $this->_arrParam;
		$this->_view->slbGroup 				= $this->_model->itemInSelectbox($this->_arrParam, null);
		$this->_view->render($this->_arrParam['controller'] . '/form');
	}
}
