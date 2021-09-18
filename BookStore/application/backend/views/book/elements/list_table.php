<?php
if (!empty($this->items)) {
    foreach ($this->items as $key => $item) {
        $id                 = $item['id'];
        $ckb                = sprintf('<input type="checkbox" name="cid[]" value="%s">', $id);
        $name               = HelperBackend::highlight(@$arrParams['search'], $item['name']);


        $picture            = HelperBackend::createImage('book',$item['picture'],['width' =>100]);
        
        $price              = $item['price'];
        $saleOff            = $item['sale_off'];
        $categoryLink       = URL::createLink($arrParams['module'], $arrParams['controller'], 'changeCategory', ['category_id' => 'value_new', 'id' => $id]);
        $attr               = sprintf('data-url=%s', $categoryLink);
        $selectCategory     = FormBackend::selectBox('change_category', $this->slbCategory, $item['category_id'], $attr, 'form-control w-auto');
        $status             = HelperBackend::itemStatus($arrParams['module'], $arrParams['controller'], $id, $item['status']);
        $special            = HelperBackend::itemSpecial($arrParams['module'], $arrParams['controller'], $id, $item['special']);
        $new                = HelperBackend::itemNew($arrParams['module'], $arrParams['controller'], $id, $item['new']);
        $dataOrdering       = URL::createLink('backend', 'book', 'changeOrdering', ['ordering' => 'value_new', 'id' => $id]);
        $ordering           = sprintf('<input data-ordering="%s" type="number" name="ordering" value="%s" class="form-control text-center" style="width:70px;">', $dataOrdering, $item['ordering']);
        $created            = HelperBackend::itemHistory($item['created_by'], $item['created']);
        $modified           = HelperBackend::itemHistory($item['modified_by'], $item['modified'], $id);

        $optionsBtnAction   = ['small' => true, 'circle' => true];
        $linkEdit           = URL::createLink($arrParams['module'], $arrParams['controller'], 'form', ['id' => $id]);
        $btnEdit            = HelperBackend::buttonLink($linkEdit, '<i class="fas fa-pen"></i>', 'btn-info', $optionsBtnAction);
        $linkDelete         = URL::createLink($arrParams['module'], $arrParams['controller'], 'delete', ['id' => $id]);
        $btnDelete          = HelperBackend::buttonLink($linkDelete, '<i class="fas fa-trash"></i>', 'btn-danger btn-delete', $optionsBtnAction);



        @$xhtml .= '
        <tr>
            <td>' . $ckb . '</td>
            <td>' . $id . '</td>
            <td>' . $name . '</td>
            <td>' . $picture . '</td>
            <td>' . number_format($price) . '</td>
            <td>' . $saleOff . '</td>
            <td class="position-relative">' . $selectCategory . '</td>
            <td class="position-relative">' . $status . '</td>
            <td class="position-relative">' . $special . '</td>
            <td class="position-relative">' . $new . '</td>
            <td class="position-relative">' . $ordering . '</td>
            <td>' . $created . '</td>
            <td>' . $modified . '</td>
            <td>' . $btnEdit . '
                ' . $btnDelete . '
            </td>
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
                    <th>Name</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>Sale Off</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Special</th>
                    <th>New</th>
                    <th>Ordering</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= @$xhtml ?>
            </tbody>
        </table>
        <?= @$xhtmlDefault ?>
    </div>
</form>