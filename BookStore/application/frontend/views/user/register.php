<?php
$dataForm = @$this->arrParam['form'];
//Link

$formLink = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'register');

//Input
$inputUserName = FormFrontend::input('text', 'form[username]', 'form[username]',$dataForm['username']);
$inputFullName = FormFrontend::input('text', 'form[fullname]', 'form[fullname]',$dataForm['fullname']);
$inputEmail = FormFrontend::input('email', 'form[email]', 'form[email]',$dataForm['email']);
$inputPassword = FormFrontend::input('text', 'form[password]', 'form[password]',$dataForm['password']);
$inputHidden = FormFrontend::input('hidden', 'form[token]', 'form[token]', time());

//Row
$rowUserName = FormFrontend::rowForm('username', 'Tên tài khoản', $inputUserName);
$rowFullName = FormFrontend::rowForm('username', 'Họ và tên', $inputFullName);
$rowEmail = FormFrontend::rowForm('username', 'Email', $inputEmail);
$rowPassword = FormFrontend::rowForm('username', 'Mật khẩu', $inputPassword);

//button

$createUserButton = FormFrontend::button('submit', 'form[submit]', 'form[submit]', 'Tạo tài khoản', 'Tạo tài khoản');


?>
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2">Đăng ký tài khoản</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="register-page section-b-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3>Đăng ký tài khoản</h3>
				<?= $xhtmlError = $this->errors ?? ''; ?>
				<div class="theme-card">
					<form action="<?= $formLink; ?>" method="post" id="admin-form" class="theme-form">
						<div class="form-row">
							<?= $rowUserName . $rowFullName . $rowEmail . $rowPassword; ?>
						</div>
						<?= $inputHidden . $createUserButton ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>