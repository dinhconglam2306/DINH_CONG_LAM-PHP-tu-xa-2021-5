<?php

class HelperFrontend
{
    public static function showProduct($producInfo, $params, $showRating = true)
    {
        $bookName               = HelperBackend::highlight(@$params['search'], $producInfo['name']);
        // $bookName               = $producInfo['name'];
        $bookID                 = $producInfo['id'];
        $bookNameURL            = URL::filterURL($bookName);

        $catID                  = $producInfo['category_id'];
        $catNameURL             =   URL::filterURL($producInfo['category_name']);
        

        $linkNameURL            = "$catNameURL/$bookNameURL-$catID-$bookID.html";



        // $link = URL::createLink('frontend', 'book', 'detail', ['book_id' => $producInfo['id']],$nameURL);
        $link = URL::createLink('frontend', 'book', 'detail', ['category_id' => $producInfo['category_id'], 'book_id' => $producInfo['id']], $linkNameURL);
        $saleOff            = $producInfo['sale_off'];

        $picture            = HelperBackend::createImage('book', $producInfo['picture'], ['class' => 'img-fluid blur-up lazyload bg-img', 'alt' => $bookName]);

        $linkView = '#';
        $linkAdd = '#';
        $description        = $producInfo['description'];

        $price              = ($producInfo['price']);
        $priceSale          = (($producInfo['price'] * (100 - $producInfo['sale_off'])) / 100);


        $dataUrlview = URL::createLink($params['module'], $params['controller'], 'quickViewBook', ['book_id' => 'value_new']);
        $dataUrladd = URL::createLink('frontend', 'user', 'order', ['book_id' => $producInfo['id'], 'price' => $priceSale]);


        $rating  = ' <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>';
        if ($showRating == false) $rating = '';

        $xhtml = '
        <div class="product-box">
            <div class="img-wrapper">
                <div class="lable-block">
                    <span class="lable4 badge badge-danger"> -' . $saleOff . '%</span>
                </div>
                <div class="front">
                    <a href="' . $link . '">' . $picture . '</a>
                </div>
                <div class="cart-info cart-wrap">
                    <a href="' . $linkAdd . '" title="Add to cart"><i class="ti-shopping-cart" data-id="' . $producInfo['id'] . '" data-url="' . $dataUrladd . '"></i></a>
                    <a href="' . $linkView . '" title="Quick View"><i class="ti-search" data-id="' . $producInfo['id'] . '" data-url="' . $dataUrlview . '" data-toggle="modal" data-target="#quick-view"></i></a>
                </div>
            </div>
            <div class="product-detail">
               ' . $rating . '
                <a href="' . $link . '" title="' . $bookName . '">
                    <h6 class="description"><span>' . $bookName . '</span></h6>
                </a>
                <h4 class="text-lowercase">' . number_format($priceSale) . ' đ <del>' . number_format($price) . ' đ</del></h4>
            </div>
        </div>
        ';

        return $xhtml;
    }

    public static function showMedia($mediaInfo, $showRating = true)
    {

        $bookName               = $mediaInfo['name'];
        $bookID                 = $mediaInfo['id'];
        $bookNameURL            = URL::filterURL($bookName);

        $catID                  = $mediaInfo['category_id'];
        $catNameURL             =   URL::filterURL($mediaInfo['category_name']);

        $linkNameURL            = "$catNameURL/$bookNameURL-$catID-$bookID.html";
        $link = URL::createLink('frontend', 'book', 'detail', ['category_id' => $mediaInfo['category_id'], 'book_id' => $mediaInfo['id']], $linkNameURL);
        $name = $mediaInfo['name'];
        $picture            = HelperBackend::createImage('book', $mediaInfo['picture'], ['class' => 'img-fluid blur-up lazyload', 'alt' => $name]);
        $price = number_format(($mediaInfo['price'] * (100 - $mediaInfo['sale_off'])) / 100);

        if ($showRating == false) $rating = '';
        $xhtml = sprintf('
            <div class="media">
                <a href="%s"> %s </a>
                <div class="media-body align-self-center">
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="%s" title="%s">
                        <h6 class="description"><span>%s</span></h6>
                    </a>
                    <h4 class="text-lowercase">%s đ</h4>
                </div>
            </div>
        ', $link, $picture, $link, $name, $name, $price);

        return $xhtml;
    }

    public static function checkStatus($value)
    {
        $status = '';
        switch ($value) {
            case 'not-handle':
                $status = '<input class="btn btn-danger rounded input-order" type="button" value=" Đang chờ xử lý">';
                break;
            case 'processing':
                $status = '<input class="btn btn-primary rounded input-order" type="button" value=" Đã tiếp nhận">';
                break;
            case 'not-delivery':
                $status = '<input class="btn btn-warning rounded input-order" type="button" value=" Đang chuẩn bị sách">';
                break;
            case 'delivery':
                $status = '<input class="btn btn-info rounded input-order" type="button" value=" Đang giao hàng">';
                break;
            case 'delivered':
                $status = '<input class="btn btn-success rounded input-order" type="button" value=" Đã nhận">';
                break;
        }
        return $status;
    }

    public static function checkStatusChange($value)
    {
        $status = '';
        switch ($value) {
            case 'not-handle':
                $status = 'ĐANG CHỜ XỬ LÝ';
                break;
            case 'processing':
                $status = 'ĐANG XỬ LÝ';
                break;
            case 'not-delivery':
                $status = 'ĐANG CHUẨN BỊ SÁCH';
                break;
            case 'delivery':
                $status = 'ĐANG GIAO HÀNG';
                break;
            case 'delivered':
                $status = 'ĐANG GỬI HÀNG';
                break;
        }
        return $status;
    }
    public static function checkShip($value)
    {
        $xhtml = '';
        switch ($value) {
            case 'inShop':
                $xhtml = 'Nhận tại cửa hàng';
                break;
            case 'atHome':
                $xhtml = 'Nhận tại nhà';
                break;
        }
        return $xhtml;
    }
    public static function checkPay($value)
    {
        $xhtml = '';
        switch ($value) {
            case 'money':
                $xhtml = 'Trả khi nhận hàng';
                break;
            case 'credit':
                $xhtml = 'Thanh toán bằng thẻ quốc tế Visa, Master, JCB';
                break;
            case 'debit':
                $xhtml = 'Thẻ ATM nội địa/Internet Bankin';
                break;
        }
        return $xhtml;
    }
}
