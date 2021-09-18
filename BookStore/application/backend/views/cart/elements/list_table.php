<?php
if (!empty($this->items)) {
    foreach ($this->items as $key => $item) {
        $id = $item['id'];


        $arrStatus  = ['not-delivery' => 'Chưa giao hàng', 'delivery' => 'Đang giao hàng', 'delivered' => 'Đã giao hàng'];
        $dataStatusLink = URL::createLink($arrParams['module'], $arrParams['controller'], 'changeStatusCart', ['status' => 'value_new', 'id' => $id]);
        $atttStatus = sprintf('data-url = %s', $dataStatusLink);
        $selectStatus = FormBackend::selectBoxCartStatus('status-cart', $arrStatus, @$item['status'], $atttStatus, 'cart-status', $id);
        $date               = $item['date'];

        $ckb                = sprintf('<input type="checkbox" name="cid[]" value="%s">', $id);
        $username               = HelperBackend::highlight(@$arrParams['search'], $item['username']);


        $arrBookName = explode(',', $item['names']);
        $arrPrices = explode(',', $item['prices']);
        $arrQuantity = explode(',', $item['quantities']);
        $arrPicture = explode(',', $item['picture']);


        $nameBooks = '';
        foreach ($arrBookName as $key => $value) $nameBooks .= sprintf('<p class="list">%s</p>', $value);

        $prices = '';
        $quantities = '';
        $nameBooks = '';
        $totalPriceList=0;
        foreach ($arrPrices as $key => $value) {
            $prices .= sprintf('<p class="list">%s đ</p>', number_format($value));
            $quantities .= sprintf('<p class="list">%s</p>', $arrQuantity[$key]);
            $nameBooks .= sprintf('<p class="list">%s</p>', $arrBookName[$key]);
            $totalPriceList  += $value * $arrQuantity[$key];
        }
    
        // foreach ($arrQuantity as $key => $value) $quantities .= sprintf('<p class="list">%s</p>', $value);

        $listPicture = '<ul class= "list-picture">';
        foreach ($arrPicture as $key => $value) {
            $picture            =sprintf('<li>%s</li>',HelperBackend::createImage('book',$value,['width' =>100]));
            $listPicture .= $picture;
        }
        $listPicture .= '</ul>';




        $optionsBtnAction   = ['small' => true, 'circle' => true];
        // $linkEdit           = URL::createLink($arrParams['module'], $arrParams['controller'], 'form', ['id' => $id]);
        // $btnEdit            = HelperBackend::buttonLink($linkEdit, '<i class="fas fa-pen"></i>', 'btn-info', $optionsBtnAction);
        $linkDelete         = URL::createLink($arrParams['module'], $arrParams['controller'], 'delete', ['id' => $id]);
        $btnDelete          = HelperBackend::buttonLink($linkDelete, '<i class="fas fa-trash"></i>', 'btn-danger btn-delete', $optionsBtnAction);


        @$xhtml .= '
        <tr>
            <td>' . $ckb . '</td>
            <td>' . $id . '</td>
            <td>' . $username . '</td>
            <td>' . $nameBooks . '</td>
            <td>' . $prices . '</td>
            <td>' . $quantities . '</td>
            <td>' . number_format($totalPriceList) . 'đ</td>
            <td>' . $listPicture . '</td>
            <td class="position-relative">' . $selectStatus . '</td>
            <td>' . $date . '</td>
            <td>' . $btnDelete . '</td>

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
                    <th><input type="checkbox" id="check-all-cid"></th>
                    <th>ID</th>
                    <th>UserName</th>
                    <th>Book Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Picture</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="list-cart ">
                <?= @$xhtml ?>
            </tbody>
        </table>
        <?= @$xhtmlDefault ?>
    </div>
</form>