<?php

//Thông tin đơn thàng
$linkBack = URL::createLink('frontend', 'user', 'orderHistory');
$orderID = $this->orderInformation['id'];
$date        = date('H:i d/m/Y', strtotime($this->orderInformation['date']));
$status        = $this->orderInformation['status'];

$arrStatus = [
    ['status' => 'not-handle', 'number' => 0],
    ['status' => 'processing', 'number' => 1],
    ['status' => 'not-delivery', 'number' => 2],
    ['status' => 'delivery', 'number' => 3],
    ['status' => 'delivered', 'number' => 4]
];

$xhtmlLi = '';
$active = 'active';
foreach ($arrStatus as $key => $value) {
    $xhtmlLi .= sprintf('<li data-staus="%s" class=" %s step0"></li>', $value['status'], $active);
    if ($value['status'] == $status) $active = '';
}

//Ngày giờ trạng thái đơn hàng
$orderStatus = $this->orderStatus;
$orderStatus = array_diff($orderStatus, [""]);
$orderStatusXhtml = '';
foreach ($orderStatus as $key => $value) {
    $statusOrder     = HelperFrontend::checkStatusChange($key);
    $dateStatus      = $value;
    $orderStatusXhtml .= sprintf('
            <div class="row d-flex justify-content-between px-3 top">
                <div class="d-flex">
                    <h6><span class="text-primary font-weight-bold">%s </span>%s</h6>
                </div>
            </div>
            ', $dateStatus, $statusOrder);
}


?>
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Trạng thái đơn hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
                <h5>Mã đơn hàng : <span class="text-primary font-weight-bold">#<?= $orderID; ?></span></h5>
            </div>
            <div class="d-flex flex-column text-sm-right">
                <p class="mb-0">Ngày đặt hàng: <span><?= $date; ?></span></p>
            </div>
        </div> <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <?= $xhtmlLi; ?>
                </ul>
            </div>
        </div>
        <div class="row justify-content-between top">
            <div class="row d-flex icon-content"> <img class="icon" src="<?= $this->_dirImg ?>dang-xu-ly.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đang chờ<br>xử lý</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="<?= $this->_dirImg ?>dang-xu-ly-1.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đang<br>xử lý</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="<?= $this->_dirImg ?>dang-chuan-bi.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đang<br>chuẩn bị</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="<?= $this->_dirImg ?>dang-giao-hang.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đang<br>giao hàng</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="<?= $this->_dirImg ?>da-giao-hang.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Đã<br>giao hàng</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <?= $orderStatusXhtml; ?>
    </div>
    <a href="<?= $linkBack; ?>" class="btn btn-info rounded "><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> LỊCH SỬ ĐƠN HÀNG</a>
</div>