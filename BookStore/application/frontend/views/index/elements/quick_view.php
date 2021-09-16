<?php
$picture            = sprintf('<img src="%s" class="img-fluid blur-up lazyload book-picture" alt="">', UPLOAD_URL . 'book' . DS . 'default.png');

// //Input Hidden
// $inputHiddenModule         = FormBackend::input('hidden', 'module', $this->arrParam['module']);
// $inputHiddenController     = FormBackend::input('hidden', 'controller', $this->arrParam['controller']);
// $inputHiddenAction         = FormBackend::input('hidden', 'action', $this->arrParam['action']);

// $inputHidden = $inputHiddenModule . $inputHiddenController . $inputHiddenAction;

// if (isset($this->arrParam['book_id'])) {
//     $inputHiddenAction         = FormBackend::input('hidden', 'book_id', $this->arrParam['book_id']);
//     $inputHidden = $inputHiddenModule . $inputHiddenController . $inputHiddenAction . $inputHiddenAction;
// }


?>
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img"><?= $picture; ?></div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <h2 class="book-name">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores,
                                distinctio.</h2>
                            <h3 class="book-price">
                                <span class="price-sale">26.910 ₫</span>
                                <del class="price">39.000 ₫</del>
                            </h3>
                            <div class="border-product">
                                <div class="book-description"><span class="description">Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Unde quae cupiditate delectus laudantium odio molestiae deleniti facilis
                                        itaque ut vero architecto nulla officiis in nam qui, doloremque iste. Incidunt,
                                        in?</span></div>
                            </div>
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
                                <a href="#" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>
                                <a href="item.html" class="btn btn-solid mb-1 btn-view-book-detail">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>