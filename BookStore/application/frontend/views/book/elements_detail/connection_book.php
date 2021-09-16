<?php
if (!empty($this->connectionBook)) {
    foreach ($this->connectionBook as $item) {
        @$xhtmlConnectionBook .= sprintf(
            '<div class="col-xl-2 col-md-4 col-sm-6">%s</div>',HelperFrontend::showProduct($item,$this->arrParam));
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