<?php
class DashboardController extends Controller
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
		$this->_view->_title 				= "Admin :: Dashboard";
		$userInfo = Session::get('user');
		$this->_view->totalGroups			= $this->_model->count($this->_arrParam, ['task' => 'count-groups']);
		$this->_view->totalItems			= $this->_model->count($this->_arrParam, ['task' => 'count-items']);
		$this->_view->render('dashboard/index');
	}


	public function profileAction()
	{
		$this->_view->_title 				= "Profile";
		$userInfo = Session::get('user');
		$this->_view->arrParam['form'] = $userInfo['info'];
		if (isset($this->_arrParam['form']['token']) == true) {
			$this->_model->saveItem($this->_arrParam, $option = null);
			$this->_view->arrParam['form'] = $userInfo['info'];
			URL::redirect('backend', 'index', 'index');
		}
		$this->_view->render($this->_arrParam['controller'] . '/profile');
	}
	public function logoutAction()
	{
		Session::delete('user');
		URL::redirect('backend', 'index', 'login');
	}
}
