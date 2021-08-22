<?php
$link = URL::createLink('frontend', 'user', 'register');
switch ($this->arrParam['type']) {
    case 'register-success':
        @$message = 'Bạn đã đăng ký tài khoản thành công. Xin vui lòng chờ kích hoạt từ người quản trị';
        @$breadcrumbTitle = 'Đăng ký thành công!';
        @$elmATitle  = 'Quay lại trang chủ';
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
                    <a href="<?= $link; ?>" class="btn btn-solid"><?= $elmATitle;?></a>
                </div>
            </div>
        </div>
    </div>
</section>