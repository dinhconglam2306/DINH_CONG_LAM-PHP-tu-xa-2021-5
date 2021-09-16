<?php
$userInfo = Session::get('user');

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
                    <h2 class="py-2">Lịch sử mua hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

if (!empty($this->listOrderHistory)) {
    foreach ($this->listOrderHistory as $key => $item) {

        $status     = HelperFrontend::checkStatus($item['status']);
        $orderID     = $item['id'];
        $date        = date('H:i d/m/Y', strtotime($item['date']));

        $arrBookName = explode(',', $item['names']);
        $arrPrices = explode(',', $item['prices']);
        $arrQuantity = explode(',', $item['quantities']);
        $arrPicture = explode(',', $item['picture']);

        $xhtmOrderHistoryBook = '';
        $totalOrderPrice = 0;
        foreach ($arrBookName as $keyB => $valueB) {
            $picture            = sprintf('<img src="%s" alt="%s" style="width: 100px">', UPLOAD_URL . 'book' . DS . 'default.png', $valueB);
            $picturePath        = UPLOAD_PATH . 'book' . DS . $arrPicture[$keyB];
            if (file_exists($picturePath) && !empty($arrPicture[$keyB]))  $picture  = sprintf('<img src="%s" alt="%s" style="width: 100px">', UPLOAD_URL . 'book' . DS . $arrPicture[$keyB], $valueB);

            $bookPrice = $arrPrices[$keyB];
            $bookQuantity = $arrQuantity[$keyB];

            $totalBookPrice = $bookPrice * $bookQuantity;
            $totalOrderPrice += $totalBookPrice;
            $xhtmOrderHistoryBook .= sprintf('
            <tr>
                <td><a href="#">%s</a></td>
                <td style="min-width: 200px">%s</td>
                <td style="min-width: 100px">%s đ</td>
                <td>%s</td>
                <td style="min-width: 150px">%s đ</td>
            </tr>
            ', $picture, $valueB, number_format($bookPrice), $bookQuantity, number_format($totalBookPrice));
        }


        @$xhtmlOrderHistoryList .= '
        <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button style="text-transform: none;" class="btn btn-link collapsed btn-order-id" type="button" data-toggle="collapse" data-target="#' . $orderID . '">Mã đơn hàng:
                    ' . $orderID . '</button>&nbsp;&nbsp;Thời gian: ' . $date . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trạng thái : '.$status.'
            </h5>
        </div>
        <div id="' . $orderID . '" class="collapse" data-parent="#accordionExample" style="">
            <div class="card-body table-responsive">
                <table class="table btn-table">

                    <thead>
                        <tr>
                            <td>Hình ảnh</td>
                            <td>Tên sách</td>
                            <td>Giá</td>
                            <td>Số lượng</td>
                            <td>Thành tiền</td>
                        </tr>
                    </thead>

                    <tbody>
                        ' . $xhtmOrderHistoryBook . '
                        <tr></tr>
                    </tbody>
                    <tfoot>
                        <tr class="my-text-primary font-weight-bold">
                            <td colspan="4" class="text-right">Tổng: </td>
                            <td>' . number_format($totalOrderPrice) . ' đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>';
    }
} else {
    $xhtmlOrderHistoryList = '<h3>Chưa có đơn hàng nào!</h3>';
}
?>
<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="account-sidebar">
                    <a class="popup-btn">Menu</a>
                </div>
                <h3 class="d-lg-none">Lịch sử mua hàng</h3>
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
                <div class="accordion theme-accordion" id="accordionExample">
                    <div class="accordion theme-accordion" id="accordionExample">
                        <?= $xhtmlOrderHistoryList; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>