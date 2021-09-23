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
		$this->_view->render('user/cart');
	}

	public function deleteOrderAction()
	{
		$this->_model->deleteOrder($this->_arrParam, ['task' => 'cancel-order']);
		$notification = ['type' => 'success', 'title' => 'Hủy đơn hàng thành công'];
		Session::set('notify', $notification);
		URL::redirect('frontend', 'user', 'orderHistory',null,'history.html');
	}
	public function buyAction()
	{
		if (!isset($this->_arrParam['payment']) || !isset($this->_arrParam['ship'])) {
			$notification = ['type' => 'warning', 'title' => 'Vui lòng chọn hình thức thanh toán và nhận hàng'];
			Session::set('notify', $notification);
			URL::redirect('frontend', 'user', 'cart');
		} else {
			$this->_model->saveItem($this->_arrParam, ['task' => 'submit-cart']);
			URL::redirect('frontend', 'user', 'orderSuccess',null,'thong-bao.html');
		}
	}
	public function orderHistoryAction()
	{
		$this->_view->_title 				= "Lịch sử mua hàng";
		$itemCount 							= $this->_model->countItems($this->_arrParam, ['task' => 'count-order']);
		$configPagination  					= ['totalItemsPerPage' => 6, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination 			= new Pagination($itemCount, $this->_pagination);
		$this->_view->listOrderHistory 		= $this->_model->orderHisTory($this->_arrParam, ['task' => 'list-order-history']);
		$this->_view->render('user/order-history');
	}
	public function orderSuccessAction()
	{
		$this->_view->_title 				= "Đặt hàng thành công";
		$this->_view->orderID 				= $this->_model->listItems($this->_arrParam, ['task' => 'cart-new']);
		$this->_view->render('user/success');
	}

	public function checkStatusOrderAction()
	{
		$this->_view->_title 				= "Trạng thái đơn hàng";
		$this->_view->orderInformation 		= $this->_model->checkStatusOrder($this->_arrParam, ['task' => 'order-infomation']);
		$this->_view->orderStatus 			= $this->_model->checkStatusOrder($this->_arrParam, ['task' => 'order-status']);
		$this->_view->render('user/checkStatusOrder');
	}

	public function changeQuantityAction()
	{
		$bookID = $this->_arrParam['book_id'];
		$quantity = $this->_arrParam['quantity'];

		$cart = Session::get('cart');
		$cart['quantity'][$bookID] = $quantity;
		Session::set('cart', $cart);

		$notification = ['type' => 'success', 'title' => 'Thay đổi số lượng sách thành công'];
		Session::set('notify', $notification);
		URL::redirect('frontend', 'user', 'cart',null,'cart.html');
	}
	public function changePwAction()
	{
		$this->_view->_title 				= "Thay đổi mật khẩu";
		if (isset($this->_arrParam['form']['submit'])) {
			URL::checkRefreshPage($this->_arrParam['form']['token'], $this->_arrParam['module'], $this->_arrParam['controller'], 'changPw');
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('password_old', 'password', ['action' => 'edit']);
			$validate->addRule('password_new', 'password', ['action' => 'edit']);
			$validate->addRule('password_new_check', 'password', ['action' => 'edit']);
			$validate->run();

			$passwordOld = $this->_arrParam['form']['password_old'];
			$passwordNew = $this->_arrParam['form']['password_new'];
			$passwordNewCheck = $this->_arrParam['form']['password_new_check'];
			if ($validate->isValid() == true) {
				$dbPass = $this->_model->checkPass($this->_arrParam, ['task' => 'check-password']);
				if (md5($passwordOld) == $dbPass['password']) {
					if ($passwordNew == $passwordNewCheck) {
						$this->_model->changePass($this->_arrParam, ['task' => 'change-pass-user']);
						$notification = ['type' => 'success', 'title' => 'Thay đổi mật khẩu thành công!'];
						Session::set('notify', $notification);
						URL::redirect('frontend', 'user', 'index');
					} else {
						$notification = ['type' => 'warning', 'title' => 'Mật khẩu mới phải giống nhau!'];
						Session::set('notify', $notification);
					}
				} else {
					$notification = ['type' => 'warning', 'title' => 'Mật khẩu cũ không đúng. Xin vui lòng kiểm tra lại!'];
					Session::set('notify', $notification);
				}
			} else {
				if ($passwordNew = '' || $passwordNewCheck == '' || $passwordOld == '') {
					$notification = ['type' => 'warning', 'title' => 'Mật khẩu không được rỗng. Xin vui lòng nhập lại mật khẩu'];
					Session::set('notify', $notification);
				} else {
					$notification = ['type' => 'warning', 'title' => 'Độ dài mật khẩu từ 8 đến 12 ký tự và ít nhất 1 ký tự in hoa'];
					Session::set('notify', $notification);
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

		$notification = ['type' => 'success', 'title' => 'Xóa sách thành công'];
		Session::set('notify', $notification);

		URL::redirect('frontend', 'user', 'cart',null,'cart.html');
	}

	public function formAction()
	{
		if (@$this->_arrParam['form']['token'] > 0) {
			$this->_model->saveItem($this->_arrParam, ['task' => 'edit-user-info']);
			URL::redirect($this->_arrParam['module'], $this->_arrParam['controller'], 'index',null,'my-account.html');
		}
	}
}
