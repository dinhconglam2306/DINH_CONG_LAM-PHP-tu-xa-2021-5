<?php
$name               = $bookItem['name'];
$description        = $bookItem['description'];
$content            = $bookItem['content'];
$price              = $bookItem['price'];
$priceSale          = ($bookItem['price'] * (100 - $bookItem['sale_off'])) / 100;
$picture            = sprintf('<img src="%s" class="img-fluid w-100 blur-up lazyload image_zoom_cls-0" alt="">', UPLOAD_URL . 'book' . DS . $bookItem['picture']);
$saleOff            = $bookItem['sale_off'];

$bookID             = $bookItem['id'];
$dataUrl            = URL::createLink('frontend','user','order',['book_id' => $bookID,'price' => $priceSale,'quantity'=>'value_new']);
$href               = URL::createLink('frontend','book','detail',['book_id' => $bookID]);

?>
<div class="col-lg-9 col-sm-12 col-xs-12">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> filter</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="product-slick">
                    <div><?= $picture ?></div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8 rtl-text">
                <div class="product-right">
                    <h2 class="mb-2"><?= $name ?></h2>
                    <h4><del><?= number_format($price); ?>đ</del><span> -<?= $saleOff ?>%</span></h4>
                    <h3><?= number_format($priceSale); ?> đ</h3>
                    <div class="product-description border-product">
                        <h6 class="product-title">Số lượng</h6>
                        <div class="qty-box">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                        <i class="ti-angle-left"></i>
                                    </button>
                                </span>
                                <input type="text" name="quantity" class="form-control input-number" value="1">
                                <span class="input-group-prepend">
                                    <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                                        <i class="ti-angle-right"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="product-buttons">
                        <a href="#" class="btn btn-solid ml-0 btn-add-to-cart-detail" data-url="<?= $dataUrl ;?>"data-href="<?= $href ;?>"><i class="fa fa-cart-plus"></i> Chọn mua</a>
                    </div>
                    <div class="border-product">
                        <span class="description"></span>
                        <?= $description ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="tab-product m-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true">Mô tả sản phẩm</a>
                            <div class="material-border"></div>
                        </li>
                    </ul>
                    <div class="tab-content nav-material" id="top-tabContent">
                        <div class="tab-pane fade show active ckeditor-content" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <?= $content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>