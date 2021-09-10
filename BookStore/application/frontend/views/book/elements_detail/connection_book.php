<?php
if (!empty($this->connectionBook)) {
    foreach ($this->connectionBook as $item) {
        $link = URL::createLink('frontend', 'book', 'detail', ['book_id' => $item['id']]);
        $linkAdd = '#';
        $linkView = '#';
        $name               = $item['name'];
        $description        = $item['description'];
        $price              = number_format($item['price']);
        $priceSale          = number_format(($item['price'] * (100 - $item['sale_off'])) / 100);
        $picture            = sprintf('<img src="%s" class="img-fluid blur-up lazyload bg-img" alt="">', UPLOAD_URL . 'book' . DS . 'default.png');
        $picturePath        = UPLOAD_PATH . 'book' . DS . $item['picture'];
        if (file_exists($picturePath) && !empty($item['picture']))  $picture  = sprintf('<img src="%s" class="img-fluid blur-up lazyload bg-img" alt="">', UPLOAD_URL . 'book' . DS . $item['picture']);
        $saleOff            = $item['sale_off'];

        $dataUrl = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'quickViewBook', ['book_id' => 'value_new']);
        @$xhtmlConnectionBook .= '
        <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="product-box">
                <div class="img-wrapper">
                    <div class="lable-block">
                        <span class="lable4 badge badge-danger"> -' . $saleOff . '%</span>
                    </div>
                    <div class="front">
                        <a href="' . $link . '">' . $picture . '</a>
                    </div>
                    <div class="cart-info cart-wrap">
                        <a href="' . $linkAdd . '" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                        <a href="' . $linkView . '" title="Quick View"><i class="ti-search" data-id="' . $item['id'] . '" data-url="' . $dataUrl . '" data-toggle="modal" data-target="#quick-view"></i></a>
                    </div>
                </div>
                <div class="product-detail">
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="' . $link . '" title="' . $description . '">
                        <h6 class="description"><span>' . $description . '</span></h6>
                    </a>
                    <h4 class="text-lowercase">' . $priceSale . ' đ <del>' . $price . ' đ</del></h4>
                </div>
            </div>
        </div>';
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-12 product-related">
            <h2>Sản phẩm liên quan</h2>
        </div>
    </div>
    <div class="row search-product">
        <?= @$xhtmlConnectionBook; ?>
    </div>
</div>