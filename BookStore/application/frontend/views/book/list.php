<?php
// Danh sách book special of category

foreach ($this->specialItems as $key => $item) {
    $name = $item['name'];
    $id                 = $item['id'];
    $nameURL            = URL::filterURL($name);

    $catID                  = $item['category_id'];
    $catNameURL             =   URL::filterURL($item['category_name']);
   
    $linkNameURL            = "$catNameURL/$nameURL-$catID-$id.html";
    $link = URL::createLink('frontend', 'book', 'detail', ['category_id' => $item['category_id'], 'book_id' => $item['id']],$linkNameURL);
    $picture            = HelperBackend::createImage('book', $item['picture'], ['class' => 'img-fluid blur-up lazyload', 'alt' => $name]);
    $price = number_format(($item['price'] * (100 - $item['sale_off'])) / 100);

    $xhtmlSpecial = sprintf('
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
                    <h6>%s</h6>
                </a>
                <h4 class="text-lowercase">%s đ</h4>
            </div>
        </div>
    ', $link, $picture, $link, $name, $name, $price);
    if ($key < 4) {
        @$xhtmlSpecialOnetofour .= $xhtmlSpecial;
    } else {
        @$xhtmlSpecialFivetoend .= $xhtmlSpecial;
    }
}

?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2"><?= $this->_title ;?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section-b-space j-box ratio_asos">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 collection-filter">
                    <!-- side-bar colleps block stat -->
                    <?php require_once 'elements_list/category.php' ?>

                    <div class="theme-card">
                        <h5 class="title-border">Sách nổi bật</h5>
                        <div class="offer-slider slide-1">
                            <div><?= @$xhtmlSpecialOnetofour; ?></div>
                            <div><?= @$xhtmlSpecialFivetoend; ?></div>
                        </div>
                    </div>
                    <!-- silde-bar colleps block end here -->
                </div>
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="collection-product-wrapper">
                                    <div class="product-top-filter">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="filter-main-btn">
                                                    <span class="filter-btn btn btn-theme"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                if (!empty($this->listBooks)) {
                                                    require_once 'elements_list/filter.php';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-wrapper-grid" id="my-product-list">
                                        <div class="row margin-res justify-content-center">
                                            <?php require_once 'elements_list/list_book.php' ?>
                                        </div>
                                    </div>
                                    <div class="product-pagination">
                                        <?php
                                        if (!empty($this->listBooks)) {
                                            require_once 'elements_list/pagination.php';
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

<div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon">
    <div class="phonering-alo-ph-circle"></div>
    <div class="phonering-alo-ph-circle-fill"></div>
    <a href="tel:0905744470" class="pps-btn-img" title="Liên hệ">
        <div class="phonering-alo-ph-img-circle"></div>
    </a>
</div>

<?php require_once 'elements_list/quick_view.php'; ?>