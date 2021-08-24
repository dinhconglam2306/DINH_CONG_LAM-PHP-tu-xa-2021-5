<?php
//Link

$linkAction = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'login');
$UrlRegister = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'register');

//Input
$inputEmail = FormFrontend::input('text', 'form[email]', 'form[email]');
$inputPassword = FormFrontend::input('text', 'form[password]', 'form[password]');
$inputHidden = FormFrontend::input('hidden', 'form[token]', 'form[token]', time());

//Row
$rowUserName = FormFrontend::rowForm('email', 'Email', $inputEmail, 'form-group');
$rowPassword = FormFrontend::rowForm('password', 'Mật khẩu', $inputPassword, 'form-group');

//button

$createUserButton = FormFrontend::button('submit', 'form[submit]', 'form[submit]', 'Đăng nhập', 'Đăng nhập');


?>
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2">Đăng Nhập</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="login-page section-b-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h3>Đăng nhập</h3>
				<?= $xhtmlError = $this->errors ?? ''; ?>
				<div class="theme-card">
					<form action="<?= $linkAction; ?>" method="post" id="admin-form" class="theme-form">
						<?= $rowUserName  . $rowPassword; ?>
						<?= $inputHidden . $createUserButton ?>
					</form>
				</div>
			</div>
			<div class="col-lg-6 right-login">
				<h3>Khách hàng mới</h3>
				<div class="theme-card authentication-right">
					<h6 class="title-font">Đăng ký tài khoản</h6>
					<p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
						able to order from our shop. To start shopping click register.</p>
					<a href="<?= $UrlRegister; ?>" class="btn btn-solid">Đăng ký</a>
				</div>
			</div>
		</div>
	</div>
</section>