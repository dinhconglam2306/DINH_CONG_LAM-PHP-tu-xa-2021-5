<?php
$link = URL::createLink('frontend', 'index', 'index');
switch ($this->arrParam['type']) {
    case 'register-success':
        @$message = 'Bạn đã đăng ký tài khoản thành công. Xin vui lòng chờ kích hoạt từ người quản trị';
        @$breadcrumbTitle = 'Đăng ký thành công!';
        @$elmATitle  = 'Quay lại trang chủ';
        break;
    case 'not-permission':
        @$message = 'Bạn không có quyền đăng nhập vào chức năng này!';
        @$breadcrumbTitle = 'Đăng nhập thất bại!';
        @$elmATitle  = 'Quay lại trang chủ';
        break;
    case 'not-permission-group':
        @$message = 'Bạn không có quyền đăng nhập vào chức năng này!';
        @$breadcrumbTitle = 'Truy cập thất bại!';
        @$elmATitle  = 'Quay lại trang quản lý';
        $link = URL::createLink('backend', 'index', 'index');
        break;
    case 'not-url':
        @$message = 'Đường dẫn không hợp lệ';
        @$breadcrumbTitle = 'đường link lỗi';
        @$elmATitle  = 'Quay lại trang chủ';
        break;
}
?>
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2"><?= $breadcrumbTitle; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="p-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="error-section">
                    <h2><?= $message; ?></h2>
                    <a href="<?= $link; ?>" class="btn btn-solid"><?= $elmATitle; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>