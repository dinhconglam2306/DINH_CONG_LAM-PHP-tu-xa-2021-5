<?php
class UserController extends Controller
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('frontend/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function registerAction()
	{
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
				URL::redirect('frontend','index','notice',['type'=>'register-success']);
			}
		}
		$this->_view->render($this->_arrParam['controller'] . '/register');
		
	}
}
