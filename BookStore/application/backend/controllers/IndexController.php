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
		echo '<pre>';
		print_r ($_SESSION);
		echo '</pre>';
		$this->_view->_title 				= "Admin :: Dashboard";
		$this->_view->render($this->_arrParam['controller'] . '/index');
	}
	public function loginAction()
	{

		//Total Items
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
				$infoUser 	= $this->_model->infoItem($this->_arrParam,$option=null);
				$arrSession = [
								'login' => true,
								'info'	=>$infoUser,
								'time'	=>time(),
								'group_acp' => $infoUser['group_acp']
				];
				Session::set('user',$arrSession);
				URL::redirect($this->_arrParam['module'],$this->_arrParam['controller'],'index');
			} else {
				$this->_view->errors = $validate->showErrors();
			}
		}

		$this->_view->render($this->_arrParam['controller'] . '/login');
	}
}
