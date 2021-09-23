<?php
if (!empty($this->items)) {
    $xhtmlReceiver = '';
    foreach ($this->items as $key => $item) {
        $receiver = sprintf('<span>%s</span>',$item['receiver']);
        $arrReceiver = explode(',', $item['receiver']);


        $fullName       = HelperBackend::highlight(@$arrParams['search'], $item['fullname']);
        $email          = $item['email'];
        $phone          = $item['phone'];
        $address        = $item['address'];
        $id = $item['id'];


        $arrStatus  = ['not-handle' => 'Đang chờ xử lý','processing' => 'Đã tiếp nhận','not-delivery' => 'Đang chuẩn bị sách', 'delivery' => 'Đang giao hàng', 'delivered' => 'Đã giao hàng'];
        if($item['status'] == 'cancelled') $arrStatus =['cancelled' => 'Đã hủy'];
        $dataStatusLink = URL::createLink($arrParams['module'], $arrParams['controller'], 'changeStatusCart', ['status' => 'value_new', 'id' => $id]);
        $atttStatus = sprintf('data-url = %s', $dataStatusLink);
        $selectStatus = FormBackend::selectBoxCartStatus('status-cart', $arrStatus, @$item['status'], $atttStatus, 'cart-status', $id);
        $date        = date('d/m/Y H:i:s', strtotime($item['date']));



        $arrBookName = explode(',', $item['names']);
        $arrPrices = explode(',', $item['prices']);
        $arrQuantity = explode(',', $item['quantities']);



        $totalPriceList = 0;
        $details = '';
        foreach ($arrPrices as $keyB => $value) {
            @$prices     = $value;
            @$quantities = $arrQuantity[$keyB];
            @$nameBooks  = $arrBookName[$keyB];
            @$totalPrice   = $prices * $quantities;
            @$totalPriceList += $totalPrice;
            @$details  .= sprintf('<span>- %s x <span class="quantities">%s</span> = %s đ</span></br>', $nameBooks, $quantities, number_format($totalPrice));
        }


        $optionsBtnAction   = ['small' => true, 'circle' => true];
        $linkDetail         = URL::createLink($arrParams['module'], $arrParams['controller'], 'detail', ['id' => $id]);
        $btnDetail          = HelperBackend::buttonLink($linkDetail, '<i class="fas fa-eye"></i>', 'btn-info btn-detail', $optionsBtnAction);


        @$xhtml .= '
        <tr>
            <td>' . $id . '</td>
            <td class="text-left">
                <p class="mb-0"><b>Họ tên</b>: ' . $fullName . '</p>
                <p class="mb-0"><b>Email</b>: ' . $email . '</p>
                <p class="mb-0"><b>Số điện thoại</b>: ' . $phone . '</p>
                <p class="mb-0"><b>Địa chỉ</b>: ' . $address . '</p>
            </td>
            <td class="text-left">' . $receiver . '</td>
            <td class="position-relative">' . $selectStatus . '</td>
            <td class="text-left">' . $details . '</td>
            <td>' . number_format($totalPriceList) . 'đ</td>
          
            <td>' . $date . '</td>
            <td>' . $btnDetail . '</td>

        </tr>
        ';
    }
} else {
    @$xhtmlDefault = '<p class="form-control text-center">Dữ liệu đang được cập nhật</p>';
}

?>

<form action="" method="post" id="table-form">
    <div class="table-responsive">
        <table class="table align-middle text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 3%">Mã đơn hàng</th>
                    <th style="width: 20%" class="text-left">Thông tin người đặt</th>
                    <th style="width: 20%">Thông tin người nhận</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="list-cart ">
                <?= @$xhtml ?>
            </tbody>
        </table>
        <?= @$xhtmlDefault ?>
    </div>
</form>