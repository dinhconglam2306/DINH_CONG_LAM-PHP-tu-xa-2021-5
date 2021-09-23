<?php
$userInfo = Session::get('user');
$userInfo = $userInfo['info'];

//input
$inputPasswordOld = FormFrontend::input('text', 'password_old', 'form[password_old]', '');
$inputPasswordNew = FormFrontend::input('text', 'password_new', 'form[password_new]', '');
$inputPasswordNewCheck = FormFrontend::input('text', 'password_new_check', 'form[password_new_check]', '');

$inputHiddenToken = FormFrontend::input('hidden', 'token', 'form[token]', time());
$inputHiddenId = FormFrontend::input('hidden', 'id', 'form[username]', $userInfo['username']);

//Row
$icon ='<i class="fa fa-eye check-eye"></i>';
$rowPasswordOld = FormFrontend::rowForm('password_old', 'Nhập mật khẩu cũ', $inputPasswordOld . $icon , 'form-group change-pass');
$rowPasswordNew  = FormFrontend::rowForm('password_new', 'Nhập mật khẩu mới', $inputPasswordNew . $icon , 'form-group change-pass');
$rowPasswordNewCheck  = FormFrontend::rowForm('password_new_check', 'Nhập lại mật khẩu mới', $inputPasswordNewCheck . $icon, 'form-group change-pass');



$row  = $rowPasswordOld . $rowPasswordNew . $rowPasswordNewCheck . $inputHiddenToken . $inputHiddenId ;
//Button

$button = FormFrontend::button('submit', 'submit-edit-pass-user', 'form[submit]', 'Đổi mật khẩu', 'Đổi mật khẩu');

$submitForm = URL::createLink('frontend', 'user', 'changePw');

?>
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="page-title">
          <h2 class="py-2">
            Thông Tin Tài khoản </h2>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="faq-section section-b-space">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="account-sidebar">
          <a class="popup-btn">Menu</a>
        </div>
        <h3 class="d-lg-none">Tài khoản</h3>
        <div class="dashboard-left">
          <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> Ẩn</span></div>
          <div class="block-content">
            <ul>
              <?php require_once 'elements/menu-user.php' ;?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="dashboard-right">
          <div class="dashboard">
            <form action="<?= $submitForm; ?>" method="post" id="admin-form" class="theme-form">
              <?= $row . $button; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>