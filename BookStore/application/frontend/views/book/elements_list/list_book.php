<?php
if (!empty($this->listBooks)) {
    foreach ($this->listBooks as $item) {
        $link = URL::createLink('frontend','book','detail',['book_id' => $item['id']]);
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
        @$xhtmlListBook .= '
        <div class="col-xl-3 col-6 col-grid-box">
            <div class="product-box">
                <div class="img-wrapper">
                    <div class="lable-block"><span class="lable4 badge badge-danger"> -' . $saleOff . '%</span></div>
                    <div class="front">
                        <a href="' . $link . '">' . $picture . '</a>
                    </div>
                    <div class="cart-info cart-wrap">
                        <a href="' . $linkAdd . '" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                        <a href="' . $linkView . '" title="Quick View"><i class="ti-search" data-id="' . $item['id'] . '" data-url="'.$dataUrl.'" data-toggle="modal" data-target="#quick-view"></i></a>
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
                    <a href="' . $link . '" title="' . $name . '">
                        <h6>' . $name . '</h6>
                    </a>
                    <p>' . $description . '</p>
                    <h4 class="text-lowercase">' . $priceSale . ' đ <del>' . $price . ' đ</del></h4>
                </div>
            </div>
        </div>
        ';
    }
} else {
    $xhtmlListBook = 'Dữ liệu đang cập nhật!';
}
?>
<?= $xhtmlListBook; ?>
