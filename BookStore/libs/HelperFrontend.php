<?php

class HelperFrontend
{
    public static function showProduct($producInfo, $params, $showRating = true)
    {
        $link = URL::createLink('frontend', 'book', 'detail', ['book_id' => $producInfo['id']]);
        $name               = $producInfo['name'];
        $saleOff            = $producInfo['sale_off'];

        $picture            = sprintf('<img src="%s" class="img-fluid blur-up lazyload bg-img" alt="">', UPLOAD_URL . 'book' . DS . 'default.png');
        $picturePath        = UPLOAD_PATH . 'book' . DS . $producInfo['picture'];
        if (file_exists($picturePath) && !empty($producInfo['picture']))  $picture  = sprintf('<img src="%s" class="img-fluid blur-up lazyload bg-img" alt="">', UPLOAD_URL . 'book' . DS . $producInfo['picture']);

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
                <a href="' . $link . '" title="' . $description . '">
                    <h6 class="description"><span>' . $name . '</span></h6>
                </a>
                <h4 class="text-lowercase">' . number_format($priceSale) . ' đ <del>' . number_format($price) . ' đ</del></h4>
            </div>
        </div>
        ';

        return $xhtml;
    }

    public static function showMedia($mediaInfo, $showRating = true)
    {
        $link = URL::createLink('frontend', 'book', 'detail', ['book_id' => $mediaInfo['id']]);
        $name = $mediaInfo['name'];
        $picture            = sprintf('<img class="img-fluid blur-up lazyload" src="%s" alt="%s">', UPLOAD_URL . 'book' . DS . 'default.png', $name);
        $picturePath        = UPLOAD_PATH . 'book' . DS . $mediaInfo['picture'];
        if (file_exists($picturePath) && !empty($mediaInfo['picture']))  $picture  = sprintf('<img class="img-fluid blur-up lazyload" src="%s" alt="%s">', UPLOAD_URL . 'book' . DS . $mediaInfo['picture'], $name);
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
            case 'not-delivery':
                $status = '<input class="btn btn-danger rounded input-order" type="button" value=" Chưa nhận">';
                break;
            case 'delivery':
                $status = '<input class="btn btn-warning rounded input-order" type="button" value=" Đang vận chuyển">';
                break;
            case 'delivered':
                $status ='<input class="btn btn-success rounded input-order" type="button" value=" Đã nhận">';
                break;
        }
        return $status;
    }
}
