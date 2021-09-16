<?php
if (!empty($this->Items)) {
    $xhtml = '';
    // $totalPrices = '';
    foreach ($this->Items as $key => $item) {
        $bookID = $item['id'];
        $link = $link = URL::createLink('frontend', 'book', 'detail', ['book_id' => $bookID]);

        $name = $item['name'];
        $picture            = sprintf('<img class="img-fluid blur-up lazyload" src="%s" alt="%s">', UPLOAD_URL . 'book' . DS . 'default.png', $name);
        $picturePath        = UPLOAD_PATH . 'book' . DS . $item['picture'];
        if (file_exists($picturePath) && !empty($item['picture']))  $picture  = sprintf('<img class="img-fluid blur-up lazyload" src="%s" alt="%s">', UPLOAD_URL . 'book' . DS . $item['picture'], $name);

        $price = $item['price'];
        $totalPrice = $item['totalPrice'];
        @$totalPrices += intval($totalPrice);
        $quantity = $item['quantity'];

        $dataLinkChangeQuantity     = URL::createLink('frontend', 'user', 'changeQuantity', ['book_id' => $bookID,'quantity' => 'value_new']);
        $dataLinkDeleteBookInCart   = URL::createLink('frontend', 'user', 'deleteBookInCart', ['book_id' => $bookID]);
        $xhtml .= '
        <tr>
            <td>
                <a href="' . $link . '">' . $picture . '</a>
            </td>
            <td>
                <a href="' . $link . '">' . $name . '</a>
            </td>
            <td>
                <h2 class="text-lowercase">' . number_format($price) . ' đ</h2>
            </td>
            <td>
                <div class="qty-box">
                    <div class="input-group">
                        <input type="number" data-quantity="'.$dataLinkChangeQuantity.'" name="quantity-cart" value="' . $quantity . '" class="form-control input-number" id="quantity-' . $quantity . '" min="1">
                    </div>
                </div>
            </td>
            <td><a href="#" class="icon"><i data-delete="'.$dataLinkDeleteBookInCart.'" class="ti-close"></i></a></td>
            <td>
                <h2 class="td-color text-lowercase">' . number_format($totalPrice) . ' đ</h2>
            </td>
        </tr>
        <input type="hidden" name="form[book_id][]" value="' . $bookID . '" id="input_book_id_' . $bookID . '">
        <input type="hidden" name="form[price][]" value="' . $price . '" id="input_price_' . $bookID . '">
        <input type="hidden" name="form[quantity][]" value="' . $quantity . '" id="input_quantity_' . $bookID . '">
        <input type="hidden" name="form[name][]" value="' . $name . '" id="input_name_' . $bookID . '">
        <input type="hidden" name="form[picture][]" value="' . $item['picture'] . '" id="input_picture_' . $bookID . '">';
    }

    $linkBook = URL::createLink('frontend', 'book', 'list',['category_id' => 'all']);
    $table = '
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên sách</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col"></th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            ' . $xhtml . '
                        </tbody>
                    </table>
                    <table class="table cart-table table-responsive-md">
                        <tfoot>
                            <tr>
                                <td>Tổng :</td>
                                <td>
                                    <h2 class="text-lowercase">' . number_format($totalPrices) . ' đ</h2>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="' . $linkBook . '" class="btn btn-solid">Tiếp tục mua sắm</a></div>
                <div class="col-6"><button type="submit" class="btn btn-solid btn-buy-book">Đặt hàng</button></div>
            </div>
        </div>';
} else {
    $linkHome = URL::createLink('frontend', 'index', 'index');
    $table = ' <div class="container">
                    <h3 class="text-center mb-50">Chưa có quyển sách nào trong rỏ hàng</h3>
                    <div class="text-center"><a href="' . $linkHome . '" class="btn btn-solid">Quay lại trang chủ!</a></div>
               </div>';
}
$linkSubmit                 = URL::createLink('frontend', 'user', 'buy');
?>
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Giỏ hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="<?= $linkSubmit ;?>" method="POST" name="admin-form" id="admin-form">
    <section class="cart-section section-b-space">
        <?= $table; ?>
    </section>
</form>