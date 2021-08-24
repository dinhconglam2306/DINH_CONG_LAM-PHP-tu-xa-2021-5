<?php
class IndexController extends Controller
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('frontend/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function indexAction()
	{
		$this->_view->render('index/index');
	}

	//Login
	public function loginAction()
	{

		$userInfo = Session::get('user');
		if ($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()) {
			URL::redirect('frontend', 'user', 'index');
		};
		$this->_view->_title 				= "Admin :: Login";
		if (@$this->_arrParam['form']['token'] > 0) {
			$validate = new Validate($this->_arrParam['form']);
			$email = $this->_arrParam['form']['email'];
			$password = md5($this->_arrParam['form']['password']);

			$query    = "SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'";

			$validate->addRule('email', 'existRecord', ['database' => $this->_model, 'query' => $query]);
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
				URL::redirect($this->_arrParam['module'], 'user', 'index');
			} else {
				$this->_view->errors = $validate->showErrorsFrontEnd();
			}
		}

		$this->_view->render($this->_arrParam['controller'] . '/login');
	}
	public function registerAction()
	{
		$userInfo = Session::get('user');
		if ($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()) {
			URL::redirect('frontend', 'user', 'index');
		};
		if (isset($this->_arrParam['form']['submit'])) {
			URL::checkRefreshPage($this->_arrParam['form']['token'], $this->_arrParam['module'], $this->_arrParam['controller'], 'register');
			$queryUserName 	= "SELECT `id` FROM `" . TBL_USER . "` WHERE `username` = '" . $this->_arrParam['form']['username'] . "'";
			$queryEmail		= "SELECT `id` FROM `" . TBL_USER . "` WHERE `email` = '" . $this->_arrParam['form']['email'] . "'";

			$validate 					= new Validate($this->_arrParam['form']);
			$validate->addRule('username', 'string-notExistRecord', ['database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 255])
				->addRule('email', 'email-notExistRecord', ['database' => $this->_model, 'query' => $queryEmail])
				->addRule('password', 'password', ['action' => 'add']);
			$validate->run();
			$this->_arrParam['form'] 	= $validate->getResult();

			if ($validate->isValid() 	== false) {
				$this->_view->errors 	= $validate->showErrorsFrontEnd();
			} else {
				// Insert Database
				$id = $this->_model->saveItem($this->_arrParam, ['task' => 'register-user']);
				URL::redirect('frontend', 'index', 'notice', ['type' => 'register-success']);
			}
		}
		$this->_view->render($this->_arrParam['controller'] . '/register');
	}
	public function noticeAction()
	{
		$this->_view->render('index/notice');
	}
	public function logoutAction()
	{
		Session::delete('user');
		URL::redirect('frontend', 'index', 'index');
	}
}
