<?php
if (!empty($this->item)) {
    $orderInfo = $this->item;

    $arrBookName = explode(',', $orderInfo['names']);
    $arrPrices = explode(',', $orderInfo['prices']);
    $arrQuantity = explode(',', $orderInfo['quantities']);
    $arrPicture = explode(',', $orderInfo['picture']);

    $xhtml = '';
    foreach ($arrBookName as $keyB => $value) {
        $bookName   = $value;
        $picture    = $arrPicture[$keyB];

        $picture    = HelperBackend::createImage('book',$arrPicture[$keyB],['width' => 200]);
        $price      = $arrPrices[$keyB];
        $quantity   =  $arrQuantity[$keyB];
        
        $totalPrice = $price * $quantity;


        $xhtml .=sprintf('
        <tr>
            <td>%s</td>
            <td>%s</td>
            <td>%s đ</td>
            <td>%s</td>
            <td>%s đ</td>
        </tr>
        ',$picture,$bookName,number_format($price),$quantity,number_format($totalPrice));
    }
}

?>

<form action="" method="post" id="table-form">
    <div class="table-responsive">
        <table class="table align-middle text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sách</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody class="list-cart ">
                <?= @$xhtml ?>
            </tbody>
        </table>
        <?= @$xhtmlDefault ?>
    </div>
</form>