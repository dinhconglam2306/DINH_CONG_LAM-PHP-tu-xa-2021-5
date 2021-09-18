<?php
$userInfo = Session::get('user');
$model = new Model();


if (!empty($this->listOrderHistory)) {
    foreach ($this->listOrderHistory as $key => $item) {

        $status     = HelperFrontend::checkStatus($item['status']);
        $orderID     = $item['id'];
        $date        = date('H:i d/m/Y', strtotime($item['date']));
        $arrBookID = explode(',', $item['books']);
        $arrBookName = explode(',', $item['names']);
        $arrPrices = explode(',', $item['prices']);
        $arrQuantity = explode(',', $item['quantities']);
        $arrPicture = explode(',', $item['picture']);

        $xhtmOrderHistoryBook = '';
        $totalOrderPrice = 0;
        foreach ($arrBookName as $keyB => $valueB) {
            $picture            = HelperBackend::createImage('book', $arrPicture[$keyB], ['width' => 100, 'alt' => $valueB]);
            $bookPrice = $arrPrices[$keyB];
            $bookQuantity = $arrQuantity[$keyB];
            $bookID        = $arrBookID[$keyB];

            // Tìm tên sách, tên category theo ID
            $query = "SELECT `b`.`name`,`b`.`category_id`,`b`.`id`,`c`.`name` AS `category_name` FROM `book`  AS `b`LEFT JOIN `category` AS `c` ON `b`.`category_id` = `c`.`id`
                        WHERE `b`.`id` = $bookID";
            $result = $model->fetchAll($query);

            // => Từ đó lấy được thông tin của sách, tạo link
            $bookIDURL = $result[0]['id'];
            $bookNameURL = URL::filterURL($result[0]['name']);
            $catIdURL    = $result[0]['category_id'];
            $catNameURL  = URL::filterURL($result[0]['category_name']);

            $linkURL      = "$catNameURL/$bookNameURL-$catIdURL-$bookIDURL.html";
            $link         = URL::createLink('frontend', 'book', 'detail', ['category_id' => $catIdURL, 'book_id' => $bookIDURL], $linkURL);

            $totalBookPrice = $bookPrice * $bookQuantity;
            $totalOrderPrice += $totalBookPrice;
            $xhtmOrderHistoryBook .= sprintf('
            <tr>
                <td><a href="%s">%s</a></td>
                <td style="min-width: 200px">%s</td>
                <td style="min-width: 100px">%s đ</td>
                <td>%s</td>
                <td style="min-width: 150px">%s đ</td>
            </tr>
            ', $link, $picture, $valueB, number_format($bookPrice), $bookQuantity, number_format($totalBookPrice));
        }


        @$xhtmlOrderHistoryList .= '
        <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button style="text-transform: none;" class="btn btn-link collapsed btn-order-id" type="button" data-toggle="collapse" data-target="#' . $orderID . '">Mã đơn hàng:
                    ' . $orderID . '</button>&nbsp;&nbsp;Thời gian: ' . $date . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trạng thái : ' . $status . '
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
                            <?php require_once 'elements/menu-user.php'; ?>
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