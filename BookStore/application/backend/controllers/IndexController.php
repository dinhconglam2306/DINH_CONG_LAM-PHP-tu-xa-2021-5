<?php
class IndexController extends Controller
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
		$userInfo = Session::get('user');
		// echo '<pre>';
		// print_r($userInfo);
		// echo '</pre>';
		$this->_view->totalGroups			= $this->_model->count($this->_arrParam, ['task' => 'count-groups']);
		$this->_view->totalItems			= $this->_model->count($this->_arrParam, ['task' => 'count-items']);
		$this->_view->_title 				= "Admin :: Dashboard";
		$this->_view->render($this->_arrParam['controller'] . '/index');
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


	public function loginAction()
	{

		$userInfo = Session::get('user');
		if ($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()) {
			URL::redirect('backend', 'index', 'index');
		};

		$this->_templateObj->setFolderTemplate('backend/adminlte/');
		$this->_templateObj->setFileTemplate('login.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
		$this->_view->_title 				= "Admin :: Login";


		if (@$this->_arrParam['form']['token'] > 0) {
			$validate = new Validate($this->_arrParam['form']);
			$username = $this->_arrParam['form']['username'];
			$password = md5($this->_arrParam['form']['password']);

			$query    = "SELECT `id` FROM `user` WHERE `username` = '$username' AND `password` = '$password'";

			$validate->addRule('username', 'existRecord', ['database' => $this->_model, 'query' => $query]);
			$validate->run();
			if ($validate->isValid() == true) {
				$infoUser 	= $this->_model->infoItem($this->_arrParam, $option = null);
				$arrSession = [
					'login' => true,
					'info'	=> $infoUser,
					'time'	=> time(),
					'group_acp' => $infoUser['group_acp']
				];
				Session::set('user', $arrSession);
				URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
			} else {
				$this->_view->errors = $validate->showErrorsFrontEnd();
			}
		}

		$this->_view->render($this->_arrParam['controller'] . '/login');
	}
	public function logoutAction()
	{
		Session::delete('user');
		URL::redirect('backend', 'index', 'login');
	}
}
