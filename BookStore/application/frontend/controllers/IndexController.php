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
		$this->_view->_title 				= "Trang chủ | BookStore";
		// $this->_view->category 				= $this->_model->categoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->categoryList($this->_arrParam, ['task' => 'category-list-special']);
		$this->_view->specialItems    		=  $this->_model->bookList($this->_arrParam, ['task' => 'book-special-list']);
		$this->_view->render('index/index');
	}

	//Login
	public function loginAction()
	{

		$userInfo = Session::get('user');
		if (@$userInfo['login'] == true && @$userInfo['time'] + TIME_LOGIN >= time()) {
			URL::redirect('frontend', 'user', 'index');
		};
		$this->_view->_title 				= "Đăng nhập";
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
					'group_acp' => $infoUser['group_acp'],
					'status' => $infoUser['status']
				];
				Session::set('user', $arrSession);
				URL::redirect($this->_arrParam['module'], 'user', 'index',null,'my-account.html');
			} else {
				$notify = ['type' => 'warning', 'title' => 'Đăng nhập thất bại. Xin vui lòng kiểm tra lại thông tin đăng nhập!'];
				Session::set('notify', $notify);
			}
		}
		$this->_view->categorySpecial 		= $this->_model->categoryList($this->_arrParam, ['task' => 'category-list-special']);
		$this->_view->render('index/login');
	}
	public function registerAction()
	{
		$userInfo = Session::get('user');
		if (@$userInfo['login'] == true && @$userInfo['time'] + TIME_LOGIN >= time()) {
			URL::redirect('frontend', 'user', 'index',null,'login.html');
		};

		$this->_view->_title 				= "Đăng ký tài khoản";
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
				$this->_model->saveItem($this->_arrParam, ['task' => 'register-user']);
				URL::redirect('frontend', 'index', 'notice', ['type' => 'register-success'],'thong-bao.html');
			}
		}
		$this->_view->render($this->_arrParam['controller'] . '/register');
	}
	public function noticeAction()
	{
		$this->_view->_title 				= "Trang chủ| StoreBook";
		$this->_view->render('index/notice');
	}
	public function logoutAction()
	{
		Session::delete('user');
		URL::redirect('frontend', 'index', 'index',null,'index.html');
	}

	public function quickViewBookAction()
	{
		$result = $this->_model->quickViewBook($this->_arrParam, ['task' => 'ajax-quick-view-book']);
		echo json_encode($result);
	}
	public function orderAction()
	{
		$this->_view->_title 				= "Giỏ hàng";

		$cart = Session::get('cart');
		$bookID = $this->_arrParam['book_id'];
		$price = $this->_arrParam['price'];

		if (empty($cart)) {
			$cart['quantity'][$bookID] = 1;
			$cart['price'][$bookID] = $price;
		} else {
			if (key_exists($bookID, $cart['quantity'])) {
				$cart['quantity'][$bookID] += 1;
				$cart['price'][$bookID] = $price * $cart['quantity'][$bookID];
			} else {
				$cart['quantity'][$bookID] = 1;
				$cart['price'][$bookID] = $price;
			}
		}
		Session::set('cart',$cart);
		$totalItems = array_sum($cart['quantity']);
		echo json_encode($totalItems);
	}
}
