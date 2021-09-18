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

	public function indexAction()
	{
		$this->_view->_title 				= "Thông tin tài khoản";
		$this->_view->category 				= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list-special']);

		$this->_view->render('user/index');
	}
	public function orderAction()
	{
		$this->_view->_title 				= "Giỏ hàng";

		$cart = Session::get('cart');
		$bookID = $this->_arrParam['book_id'];
		$price = $this->_arrParam['price'];
		$quantity = intval(@$this->_arrParam['quantity']);

		if (empty($cart)) {
			if ($quantity != null) {
				@$cart['quantity'][$bookID] += @$quantity;
				$cart['price'][$bookID] = $price;
			} else {
				@$cart['quantity'][$bookID] = 1;
				$cart['price'][$bookID] = $price;
			}
		} else {
			if (key_exists($bookID, $cart['quantity'])) {
				if ($quantity != null) {
					@$cart['quantity'][$bookID] += @$quantity;
					$cart['price'][$bookID] = $price;
				} else {
					@$cart['quantity'][$bookID] += 1;
					$cart['price'][$bookID] = $price;
				}
			} else {
				if ($quantity != null) {
					@$cart['quantity'][$bookID] += @$this->_arrParam['quantity'];
					$cart['price'][$bookID] = $price;
				} else {
					@$cart['quantity'][$bookID] = 1;
					$cart['price'][$bookID] = $price;
				}
			}
		}
		Session::set('cart', $cart);
		$totalItems = array_sum($cart['quantity']);
		echo json_encode($totalItems);
	}
	public function cartAction()
	{
		$this->_view->_title 				= "Thông tin giỏ hàng";
		$this->_view->Items 				= $this->_model->listItems($this->_arrParam, ['task' => 'book-in-cart']);
		$this->_view->category 				= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list-special']);
		$this->_view->render('user/cart');
	}
	public function buyAction()
	{
		$this->_model->saveItem($this->_arrParam, ['task' => 'submit-cart']);
		URL::redirect('frontend', 'user', 'orderSuccess');
	}
	public function orderHistoryAction()
	{
		$this->_view->_title 				= "Lịch sử mua hàng";
		$this->_view->category 				= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list-special']);
		$this->_view->listOrderHistory 		= $this->_model->OrderHisTory($this->_arrParam, ['task' => 'list-order-history']);
		$this->_view->render('user/order-history');
	}
	public function orderSuccessAction()
	{
		$this->_view->_title 				= "Đặt hàng thành công";
		$this->_view->category = $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list-special']);
		$this->_view->render('user/success');
	}

	public function changeQuantityAction()
	{
		$bookID = $this->_arrParam['book_id'];
		$quantity = $this->_arrParam['quantity'];

		$cart = Session::get('cart');
		$cart['quantity'][$bookID] = $quantity;
		Session::set('cart', $cart);
		URL::redirect('frontend', 'user', 'cart');
	}
	public function changePwAction()
	{
		$this->_view->_title 				= "Thay đổi mật khẩu";
		$this->_view->category 				= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->categorySpecial 		= $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list-special']);
		// $this->_model->changePass($this->_arrParam,['task' => 'change-pass-user']);
		if (isset($this->_arrParam['form']['submit'])) {
			URL::checkRefreshPage($this->_arrParam['form']['token'], $this->_arrParam['module'], $this->_arrParam['controller'], 'changPw');
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('password', 'password', ['action' => 'edit']);
			$validate->addRule('password_check', 'password', ['action' => 'edit']);
			$validate->run();

			$passWord1 = $this->_arrParam['form']['password'];
			$passWord2 = $this->_arrParam['form']['password_check'];
			if ($validate->isValid() == true) {
				if ($passWord1 == $passWord2) {
					$this->_model->changePass($this->_arrParam, ['task' => 'change-pass-user']);
					$checkPass = ['type' => 'success', 'title' => 'Thay đổi mật khẩu thành công!'];
					Session::set('notify', $checkPass);
					URL::redirect('frontend', 'user', 'index');
				} else {
					$checkPass = ['type' => 'warning', 'title' => 'Xin vui lòng kiểm tra lại mật khẩu. Mật khẩu phải giống nhau!'];
					Session::set('notify', $checkPass);
				}
			} else {
				if ($passWord1 = '' || $passWord2 == '') {
					$checkPass = ['type' => 'warning', 'title' => 'Mật khẩu không được rỗng. Xin vui lòng nhập lại mật khẩu'];
					Session::set('notify', $checkPass);
				} else {
					$checkPass = ['type' => 'warning', 'title' => 'Độ dài mật khẩu từ 8 đến 12 ký tự và ít nhất 1 ký tự in hoa'];
					Session::set('notify', $checkPass);
				}
			}
		}
		$this->_view->render('user/changePass');
	}
	public function deleteBookInCartAction()
	{
		$cart   = Session::get('cart');
		$bookID = $this->_arrParam['book_id'];
		unset($cart['quantity'][$bookID]);
		unset($cart['price'][$bookID]);

		Session::set('cart', $cart);

		URL::redirect('frontend', 'user', 'cart');
	}

	public function formAction()
	{
		if (@$this->_arrParam['form']['token'] > 0) {
			$this->_model->saveItem($this->_arrParam, ['task' => 'edit-user-info']);
			URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index');
		}
	}
}
