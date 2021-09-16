<?php
$categoryID = $this->arrPararm['category_id'] ?? 1;
$allBookLink = URL::createLink('frontend', 'book', 'list', ['category_id' => $categoryID]);
?>
<?php require_once 'elements/slider.php'; ?>

<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Sản phẩm nổi bật</h2>
    <hr role="tournament6">
</div>
<section class="section-b-space p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="product-4 product-m no-arrow">
                    <?php require_once 'elements/special_book.php'; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'elements/service.php'; ?>

<!-- Tab product -->
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Danh mục nổi bật</h2>
    <hr role="tournament6">
</div>
<section class="p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php require_once 'elements/special_category.php' ?>
            </div>
        </div>
    </div>
</section> <!-- Tab product end -->

<!-- Quick-view modal popup start-->
<?php require_once 'elements/quick_view.php'; ?>