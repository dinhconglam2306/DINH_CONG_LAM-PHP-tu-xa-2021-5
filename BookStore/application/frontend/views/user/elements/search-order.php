<?php

//Input Hidden
$inputHiddenModule         = FormBackend::input('hidden', 'module', $this->arrParam['module']);
$inputHiddenController     = FormBackend::input('hidden', 'controller', $this->arrParam['controller']);
$inputHiddenAction         = FormBackend::input('hidden', 'action', $this->arrParam['action']);


$arrValueOrderStatus = ['default' => ' -Select Status Order- ', 'not-handle' => 'Đang chờ xử lý', 'processing' => 'Đã tiếp nhận', 'not-delivery' => 'Đang chuẩn bị sách', 'delivery' => 'Đang giao hàng', 'delivered' => 'Đã nhận'];
$selectBoxOrderStatus = FormBackend::selectBox('status', $arrValueOrderStatus, @$this->arrParam['status'], '', 'slb-order-status');


$inputHidden = $inputHiddenModule . $inputHiddenController . $inputHiddenAction;
?>

<form action="" method="GET" id="select-order-status">
    <?php
    if (URL_FRIENDLY == false) {
        echo   $inputHidden;
    }
    ?>
    <?= $selectBoxOrderStatus ?>
</form>