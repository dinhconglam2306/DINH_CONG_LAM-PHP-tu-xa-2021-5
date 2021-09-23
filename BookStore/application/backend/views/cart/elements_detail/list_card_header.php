<?php
if (!empty($this->item)) {
    $orderInfo = $this->item;
    $id  = $orderInfo['id'];
    $username  = $orderInfo['username'];
    $status  = $orderInfo['status'];
    $date        = date('d/m/Y H:i:s', strtotime($orderInfo['date']));
    $ship = HelperFrontend::checkShip($orderInfo['ship']);
    $pay = HelperFrontend::checkPay($orderInfo['pay']);
} 
?>
<div class="card-header">
    <h3 class="card-title"><span class="bold-title">Mã đơn hàng :</span> <?= $id ;?>  || <span class="bold-title">Khách hàng :</span> <?= $username ;?>  || <span class="bold-title">Ngày đặt hàng :</span> <?= $date ;?></h3>
    <br /><br />
    <h3 class="card-title"><span class="bold-title">Hình thức nhận hàng :</span> <?= $ship ;?>  || <span class="bold-title">Hình thức thanh toán :</span> <?= $pay ;?></h3>

    <div class="card-tools">
        <a href="#" class="btn btn-tool" data-card-widget="refresh">
            <i class="fas fa-sync-alt"></i>
        </a>
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
    </div>
</div>