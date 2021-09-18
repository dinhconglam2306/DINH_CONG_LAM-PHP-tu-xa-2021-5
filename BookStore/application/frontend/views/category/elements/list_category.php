<?php
if (!empty($this->category)) {
    foreach ($this->category as $item) {
        $id                 = $item['id'];
        $name               = $item['name'];
        $nameURL            = URL::filterURL($name) . '-' . $id . '.html';
        $link               = URL::createLink('frontend','book','list',['category_id' => $item['id']], $nameURL);
        $linkAdd            = '#';
        $linkView           = '#';

        $picture            = HelperBackend::createImage('category',$item['picture'],['class'=>'img-fluid blur-up lazyload bg-img','alt'=>$name]);
        $dataUrlview = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'quickViewCategory', ['category_id' => 'value_new']);
        @$xhtmlListCategory .= '
        <div class="col-xl-3 col-6 col-grid-box">
            <div class="product-box">
                <div class="img-wrapper">
                    <div class="lable-block"><span class="lable4 badge badge-danger"> -30%</span></div>
                    <div class="front">
                        <a href="' . $link . '">' . $picture . '</a>
                    </div>
                    <div class="cart-info cart-wrap">
                        <a href="#" title="Quick View"><i class="ti-search category-show" data-id="' . $item['id'] . '" data-url="'.$dataUrlview.'" data-toggle="modal" data-target="#quick-view"></i></a>
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
                    <a href="3" title="' . $name . '">
                        <h6>' . $name . '</h6>
                    </a>
                </div>
            </div>
        </div>
        ';
    }
} else {
    $xhtmlListCategory = 'Dữ liệu đang cập nhật!';
}
?>
<?= $xhtmlListCategory; ?>
