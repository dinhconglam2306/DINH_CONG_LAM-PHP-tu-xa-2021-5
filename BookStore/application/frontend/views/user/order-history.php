<?php
$userInfo = Session::get('user');
$model = new Model();


if (!empty($this->listOrderHistory)) {
    foreach ($this->listOrderHistory as $key => $item) {
        $status     = HelperFrontend::checkStatus($item['status']);
        $orderID     = $item['id'];
        $icon = '';
        $linkDelete = URL::createLink('frontend', 'user', 'deleteOrder', ['order_id' => $orderID]);
        if ($item['status'] == 'not-handle' || $item['status'] == 'processing' || $item['status'] == 'not-delivery') {
            $icon = sprintf(' <a href="%s" class="btn btn-info rounded btn-delete-cart "><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Xóa đơn hàng</a>', $linkDelete);
        }


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
                <td></td>
            </tr>
            ', $link, $picture, $valueB, number_format($bookPrice), $bookQuantity, number_format($totalBookPrice));
        }

        $linkCheckStatus = URL::createLink('frontend', 'user', 'checkStatusOrder', ['id' => $orderID]);
        @$xhtmlOrderHistoryList .= '
        <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button style="text-transform: none;" class="btn btn-link collapsed btn-order-id" type="button" data-toggle="collapse" data-target="#' . $orderID . '">Mã đơn hàng:
                    ' . $orderID . '</button>&nbsp;&nbsp;Thời gian: ' . $date . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trạng thái : <a href="' . $linkCheckStatus . '" title="Check trạng thái đơn hàng"><span class="infomation-order">' . $status . ' <i class="fa fa-eye eye-cart"></i></span></a>
                   
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
                            <td> ' . $icon . '</td>
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
    $linkHome = URL::createLink('frontend', 'index', 'index');
    $xhtmlOrderHistoryList = '
    <div class="col-lg-9">
        <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div>
                    <a href="#" class="btn btn-warning rounded-circle btn-change btn-sm"><i class="fa fa-exclamation-triangle error-icon" aria-hidden="true"></i></a>
                    <h2 class="order-success">Chưa có đơn nào trong giỏ hàng</h3>
                        <div class="container">
                            <div class="text-center btn-order"><a href="' . $linkHome . '" class="btn btn-solid">Quay lại trang chủ</a></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    ';
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
                    <br />
                    <div class="block-content">
                        <?php require_once 'elements/search-order.php'; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="accordion theme-accordion" id="accordionExample">
                    <div class="accordion theme-accordion" id="accordionExample">
                        <?= $xhtmlOrderHistoryList; ?>
                    </div>
                    <div class="theme-paggination-block">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <nav aria-label="Page navigation">
                                        <nav>
                                            <?= $this->pagination->showPaginationFrontEnd(); ?>
                                        </nav>
                                    </nav>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="product-search-count-bottom">

                                        <?php
                                        if (!empty($this->listOrderHistory)) {
                                            echo $this->pagination->showingItem();
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>