<?php

$rowName  = HeplerCart::createDivClassMb3('text', 'username', 'Họ tên người nhận', 'receiver[name]');
$rowPhone  = HeplerCart::createDivClassMb3('text', 'phone', 'Số điện thoại', 'receiver[phone]');
$rowEmail  = HeplerCart::createDivClassMb3('email', 'email', 'Email', 'receiver[email]');
$rowAddress  = HeplerCart::createDivClassMb3('text', 'address', 'Địa chỉ', 'receiver[address]');

$row = $rowName . $rowPhone . $rowEmail . $rowAddress;

$radioMoney  = HeplerCart::radio('money', 'payment', 'money', 'money', 'Trả tiền mặt khi nhận hàng');
$radioDebit  = HeplerCart::radio('debit', 'payment', 'debit', 'debit', 'Thẻ ATM nội địa/Internet Banking');
$radioCredit  = HeplerCart::radio('credit', 'payment', 'credit', 'credit', 'Thanh toán bằng thẻ quốc tế Visa, Master, JCB');

$radioPay = $radioMoney . $radioDebit . $radioCredit;

$radioShipInShop = HeplerCart::radio('inShop', 'ship', 'inShop', 'inShop', 'Nhận hàng tại shop');
$radioShipAtHome = HeplerCart::radio('atHome', 'ship', 'atHome', 'atHome', 'Nhận hàng tại nhà');

$radioShip = $radioShipInShop . $radioShipAtHome;



if (!empty($this->Items)) {
    $cart = '';
    $totalItem = count($this->Items);
    foreach ($this->Items as $key => $item) {
        $bookID = $item['id'];
        $catID  = $item['category_id'];
        $link = $link = URL::createLink('frontend', 'book', 'detail', ['category_id' => $catID, 'book_id' => $bookID]);


        $name = $item['name'];
        $picture            = HelperBackend::createImage('book', $item['picture'], ['alt' => $name, 'width' => 100]);
        $price = $item['price'];
        $totalPrice = $item['totalPrice'];
        @$totalPrices += intval($totalPrice);
        $quantity = $item['quantity'];

        $dataLinkChangeQuantity     = URL::createLink('frontend', 'user', 'changeQuantity', ['book_id' => $bookID, 'quantity' => 'value_new']);
        $dataLinkDeleteBookInCart   = URL::createLink('frontend', 'user', 'deleteBookInCart', ['book_id' => $bookID]);

        $cart .= '
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div style="width:15%;">
                <a href="' . $link . '">' . $picture . '</a>
            </div>
            <div style="width:40%;">
                <h5 class="my-0">' . $name . '</h5>
            </div>
            <div>
                <h5 class="my-0">' . number_format($price) . 'đ</h5>
            </div>
            <div>
                <a href="" class="icon"><i data-delete="' . $dataLinkDeleteBookInCart . '" class="ti-close"></i></a>
            </div>
            <div style="width:15%;">
                <div style="width:50%; class="input-group text-center">
                    <input type="number" data-quantity="' . $dataLinkChangeQuantity . '" name="quantity-cart" value="' . $quantity . '" class="form-control input-number" id="quantity-' . $quantity . '" min="1">
                </div>
            </div>
            <div>
                <h5 class="my-0">' . number_format($totalPrice) . 'đ</h5>
            </div>
        </li>
        <input type="hidden" name="form[book_id][]" value="' . $bookID . '" id="input_book_id_' . $bookID . '">
        <input type="hidden" name="form[price][]" value="' . $price . '" id="input_price_' . $bookID . '">
        <input type="hidden" name="form[quantity][]" value="' . $quantity . '" id="input_quantity_' . $bookID . '">
        <input type="hidden" name="form[name][]" value="' . $name . '" id="input_name_' . $bookID . '">
        <input type="hidden" name="form[picture][]" value="' . $item['picture'] . '" id="input_picture_' . $bookID . '">
        ';
    }
    $linkSubmit                 = URL::createLink('frontend', 'user', 'buy');

    $table = '
    <div class="container">
        <div class="row checkoutPage">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">THÔNG TIN ĐƠN HÀNG</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Tổng tiền</h6>
                        </div>
                        <span class="text-muted">' . number_format($totalPrices) . ' đ</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Phí giao hàng dự kiến</h6>
                        </div>
                        <span class="text-muted">0 đ</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Cần thanh toán</span>
                        <strong>' . number_format($totalPrices) . ' đ</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">CÓ ' . $totalItem . ' SẢN PHẨM TRONG GIỎ HÀNG</h4>
                <form action="' . $linkSubmit . '" method="POST" name="admin-form" id="admin-form" class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <ul class="list-group mb-3">
                            ' . $cart . '
                        </ul>
                    </div>
                    ' . $row . '
                    <p><span class="note-order">Lưu ý * :</span> Trong trường hợp thông tin người nhận không được ghi thì sản phẩm sẽ được gửi đến địa chỉ của chủ tài khoản!</p>
                    <hr class="mb-4">
                    <h4 class="mb-3">THANH TOÁN</h4>
                    <div class="d-block my-3">
                        ' . $radioPay . '
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">NHẬN HÀNG</h4>
                    <div class="d-block my-3">
                        ' . $radioShip . '
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" name="form[submit]" value="submit" type="submit">Đặt hàng</button>
                    <hr class="mb-4">
                </form>
            </div>
        </div>
    </div>
    ';
} else {
    $linkHome = URL::createLink('frontend', 'index', 'index');
    $table = ' <div class="container">
                <div class="row">
                    <div style="margin:50px;"class="col-12">
                        <h3 class="text-center mb-50">Chưa có quyển sách nào trong rỏ hàng</h3>
                        <div class="text-center"><a href="' . $linkHome . '" class="btn btn-solid">Quay lại trang chủ!</a></div>
                        </div>
                    </div>
               </div>';
}
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
<?= $table; ?>