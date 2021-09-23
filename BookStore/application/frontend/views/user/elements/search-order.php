<?php

//Input Hidden
$inputHiddenModule         = FormBackend::input('hidden', 'module', $this->arrParam['module']);
$inputHiddenController     = FormBackend::input('hidden', 'controller', $this->arrParam['controller']);
$inputHiddenAction         = FormBackend::input('hidden', 'action', $this->arrParam['action']);


$arrValueOrderStatus = ['default' => ' -Select Status Order- ', 'not-handle' => 'Đang chờ xử lý', 'processing' => 'Đang xử lý', 'not-delivery' => 'Đang chuẩn bị sách', 'delivery' => 'Đang giao hàng', 'delivered' => 'Đã giao hàng'];
$selectBoxOrderStatus = FormBackend::selectBox('status', $arrValueOrderStatus, @$this->arrParam['status'], '', 'slb-order-status');


$formOrderStatus = $inputHiddenModule . $inputHiddenController . $inputHiddenAction . $selectBoxOrderStatus;
?>

<form action="" method="GET" id="select-order-status">
    <?= $formOrderStatus ?>
</form>