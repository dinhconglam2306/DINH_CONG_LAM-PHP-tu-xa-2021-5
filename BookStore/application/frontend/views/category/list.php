<?php
// Danh sách book special of category
if (!empty($this->specialBook)) {
    foreach ($this->specialBook as $key => $item) {
        $xhtmlSpecial =HelperFrontend::showMedia($item);
        if ($key < 4) {
            @$xhtmlSpecialOnetofour .= $xhtmlSpecial;
        } else {
            @$xhtmlSpecialFivetoend .= $xhtmlSpecial;
        }
    }
}
?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Danh mục</h2>
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
                                                if (!empty($this->category)) {
                                                    require_once 'elements/filter.php';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-wrapper-grid" id="my-product-list">
                                        <div class="row margin-res justify-content-center">
                                            <?php require_once 'elements/list_category.php' ?>
                                        </div>
                                    </div>
                                    <div class="product-pagination">
                                        <?php
                                        if (!empty($this->category)) {
                                            require_once 'elements/pagination.php';
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

<?php require_once 'elements/quick_view.php'; ?>