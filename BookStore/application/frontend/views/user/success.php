<?php
$linkHome = URL::createLink('frontend', 'index', 'index');

?>
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Đặt hàng thành công</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div>
                    <a href="#" class="btn btn-success rounded-circle btn-change btn-sm"><i class="fa fa-check"></i></a>
                    <h2 class="order-success">Cảm ơn bạn đã mua hàng</h3>
                        <div class="container">
                            <h5 class="text-center order-content">Sách bạn đã đặt sẽ được chuyển đến bạn trong thời gian sớm nhất</h5>
                            <span class="order-pass">Mã đơn hàng:</span>
                            <div class="text-center btn-order"><a href="<?= $linkHome; ?>" class="btn btn-solid">Tiếp tục mua hàng</a></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>