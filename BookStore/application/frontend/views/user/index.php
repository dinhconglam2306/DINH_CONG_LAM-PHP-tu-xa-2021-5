<?php
$userInfo = Session::get('user');
$userInfo = $userInfo['info'];
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
              <li class="active"><a href="account-form.html">Thông tin tài khoản</a></li>
              <li class=""><a href="change-password.html">Thay đổi mật khẩu</a></li>
              <li class=""><a href="order-history.html">Lịch sử mua hàng</a></li>
              <li class=""><a href="index.html">Đăng xuất</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="dashboard-right">
          <div class="dashboard">
            <form action="" method="post" id="admin-form" class="theme-form">

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="form[email]" value="<?= $userInfo['email'] ?>" class="form-control" id="email" readonly="1">
              </div>

              <div class="form-group">
                <label for="fullname">Họ tên</label>
                <input type="text" name="form[fullname]" value="<?= $userInfo['fullname'] ?>" class="form-control" id="fullname">
              </div>

              <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="form[phone]" value="" class="form-control" id="phone">
              </div>

              <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" name="form[address]" value="Số 19, Đường 23, KDC Ấp 5, Phong Phú, Bình Chánh, HCM" class="form-control" id="address">
              </div>
              <input type="hidden" id="form[token]" name="form[token]" value="1599258345"><button type="submit" id="submit" name="submit" value="Cập nhật thông tin" class="btn btn-solid btn-sm">Cập nhật thông tin</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>