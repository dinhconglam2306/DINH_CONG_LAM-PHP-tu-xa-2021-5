<?php
$userInfo = Session::get('user');
$userInfo = $userInfo['info'];

//input
$inputEmail = FormFrontend::input('text', 'email', 'form[phone]', $userInfo['email'], '', false);
$inputFullName = FormFrontend::input('text', 'fullname', 'form[fullname]', $userInfo['fullname']);
$inputPhone = FormFrontend::input('text', 'phone', 'form[phone]', $userInfo['phone']);
$inputAddress = FormFrontend::input('text', 'address', 'form[address]', $userInfo['address']);

$inputHiddenToken = FormFrontend::input('hidden', 'token', 'form[token]', time());
$inputHiddenId = FormFrontend::input('hidden', 'id', 'form[user_id]', $userInfo['id']);

//Row

$rowEmail     = FormFrontend::rowForm('email', 'Email', $inputEmail, 'form-group', false);
$rowFullName  = FormFrontend::rowForm('fullname', 'Fullname', $inputFullName, 'form-group');
$rowPhone     = FormFrontend::rowForm('phone', 'Phone', $inputPhone, 'form-group');
$rowAddress     = FormFrontend::rowForm('address', 'Address', $inputAddress, 'form-group');


$rows = $rowEmail . $rowFullName . $rowPhone . $rowAddress;

//Button

$button = FormFrontend::button('submit', 'submit-edit-user', 'submit', 'Cập nhật thông tin', 'Cập nhật thông tin');

$submitForm = URL::createLink('frontend', 'user', 'form');



$linkChangePw       = URL::createLink('frontend', 'user', 'changePw');
$linkUserInfo     = URL::createLink('frontend', 'user', 'index');
$linkOrderHistory = URL::createLink('frontend', 'user', 'orderHistory');
$linkLogout       = URL::createLink('frontend', 'index', 'logout');
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
              <li class=""><a data="user-index" href="<?= $linkUserInfo; ?>">Thông tin tài khoản</a></li>
              <li class=""><a data="user-changePw" href="<?= $linkChangePw; ?>">Thay đổi mật khẩu</a></li>
              <li class=""><a data="user-orderHistory" href="<?= $linkOrderHistory; ?>">Lịch sử mua hàng</a></li>
              <li class=""><a href="<?= $linkLogout; ?>">Đăng xuất</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="dashboard-right">
          <div class="dashboard">
            <form action="<?= $submitForm; ?>" method="post" id="admin-form" class="theme-form">
              <?= $rows . $inputHiddenToken . $inputHiddenId . $button; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>