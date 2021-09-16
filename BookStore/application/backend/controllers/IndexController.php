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


	public function loginAction()
	{

		$userInfo = Session::get('user');
		if (@$userInfo['login'] == true && @$userInfo['time'] + TIME_LOGIN >= time()) {
			URL::redirect('backend', 'dashboard', 'index');
		};

		$this->_templateObj->setFileTemplate('login.php');
		$this->_templateObj->load();
		$this->_view->_title 				= "Admin :: Login";


		if (@$this->_arrParam['form']['token'] > 0) {
			$validate = new Validate($this->_arrParam['form']);
			$username = @$this->_arrParam['form']['username'];
			$password = md5(@$this->_arrParam['form']['password']);

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
				URL::redirect($this->_arrParam['module'], 'dashboard', 'index');
			} else {
				$notify =['type' => 'warning','title'=> 'Đăng nhập thất bại. Xin vui lòng kiểm tra lại thông tin đăng nhập!'];
				Session::set('notify',$notify);
			}
		}

		$this->_view->render('index/login');
	}

}
