<?php
$picture            = sprintf('<img src="%s" class="img-fluid blur-up lazyload book-picture" alt="">', URL_UPLOAD . 'category' . DS . 'default.png');

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
                                distinctio.
                            </h2>
                            <div class="border-product">
                                <div class="book-description">
                                    <h3 style="text-transform: uppercase;font-size:20px;">Danh sách quyển sách mới nhất</h3>
                                    <span class="description">Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Unde quae cupiditate delectus laudantium odio molestiae deleniti facilis
                                        itaque ut vero architecto nulla officiis in nam qui, doloremque iste. Incidunt,
                                        in?
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>