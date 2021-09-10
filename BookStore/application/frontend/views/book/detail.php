<?php 
$bookItem = $this->bookItem;
?>
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2"><?= $bookItem['name'];?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section-b-space">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <?php require_once 'elements_detail/book_info.php'; ?>
                <div class="col-sm-3 collection-filter">
                    <?php require_once 'elements_detail/service.php'; ?>
                    <?php require_once 'elements_detail/special_book.php'; ?>
                    <?php require_once 'elements_detail/new_book.php'; ?>
                </div>
            </div>
            <div class="row">
                <section class="section-b-space j-box ratio_asos pb-0">
                    <?php require_once 'elements_detail/connection_book.php'; ?>
                </section>
                <div class="modal fade bd-example-modal-lg theme-modal cart-modal" id="addtocart" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body modal1">
                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="modal-bg addtocart">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="media">
                                                    <a href="#">
                                                        <img class="img-fluid blur-up lazyload pro-img" src="" alt="">
                                                    </a>
                                                    <div class="media-body align-self-center text-center">
                                                        <a href="#">
                                                            <h6>
                                                                <i class="fa fa-check"></i>Sản phẩm
                                                                <span class="font-weight-bold">Chờ Đến Mẫu Giáo Thì
                                                                    Đã Muộn</span>
                                                                <span> đã được thêm vào giỏ hàng!</span>
                                                            </h6>
                                                        </a>
                                                        <div class="buttons">
                                                            <a href="../gio-hang.html" class="view-cart btn btn-solid">Xem giỏ hàng</a>
                                                            <a href="#" class="continue btn btn-solid" data-dismiss="modal">Tiếp tục mua sắm</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<?php require_once 'elements_detail/quick_view.php' ;?>