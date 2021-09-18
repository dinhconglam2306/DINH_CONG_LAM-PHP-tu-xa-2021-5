<?php
$xhtml = '';
if (!empty($this->items)) {
    foreach ($this->items as $key => $item) {
        $id                 = $item['id'];
        $ckb                = sprintf('<input type="checkbox" name="cid[]" value="%s">', $id);
        $name               = HelperBackend::highlight(@$arrParams['search'], $item['name']);
        
        $picture            = HelperBackend::createImage('category',$item['picture'],['width' =>100]);

        $status             = HelperBackend::itemStatus($arrParams['module'], $arrParams['controller'], $id, $item['status']);
        $isHome             = HelperBackend::itemIshome($arrParams['module'], $arrParams['controller'], $id, $item['is_home']);
        $dataOrdering       = URL::createLink('backend', 'category', 'changeOrdering', ['ordering' => 'value_new', 'id' => $id]);
        $ordering           = sprintf('<input data-ordering="%s" type="number" name="ordering" value="%s" style = "width:50px; padding-left:11px;border-radius:5px;border:1px solid grey;">', $dataOrdering, $item['ordering']);
        $created            = HelperBackend::itemHistory($item['created_by'], $item['created']);
        $modified           = HelperBackend::itemHistory($item['modified_by'], $item['modified'], $id);

        $optionsBtnAction   = ['small' => true, 'circle' => true];
        $linkEdit           = URL::createLink($arrParams['module'], $arrParams['controller'], 'form', ['id' => $id]);
        $btnEdit            = HelperBackend::buttonLink($linkEdit, '<i class="fas fa-pen"></i>', 'btn-info', $optionsBtnAction);
        $linkDelete         = URL::createLink($arrParams['module'], $arrParams['controller'], 'delete', ['id' => $id]);
        $btnDelete          = HelperBackend::buttonLink($linkDelete, '<i class="fas fa-trash"></i>', 'btn-danger btn-delete', $optionsBtnAction);

        $xhtml .= '
        <tr>
            <td>' . $ckb . '</td>
            <td>' . $id . '</td>
            <td>' . $name . '</td>
            <td >' . $picture . '</td>
            <td class="position-relative">' . $isHome . '</td>
            <td class="position-relative">' . $status . '</td>
            <td class="position-relative">' . $ordering . '</td>
            <td>' . $created . '</td>
            <td>' . $modified . '</td>
            <td>
                ' . $btnEdit . '
                ' . $btnDelete . '
            </td>
        </tr>
        ';
    }
} else {
    $xhtmlDefault = '<p class="form-control text-center">Dữ liệu đang được cập nhật</p>';
}

?>

<form action="" method="post" id="table-form">
    <div class="table-responsive">
        <table class="table align-middle text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 3%"><input type="checkbox" id="check-all-cid"></th>
                    <th style="width: 3%">ID</th>
                    <th style="width: 15%">Name</th>
                    <th style="width: 5%">Picture</th>
                    <th style="width: 5%">Show at home</th>
                    <th style="width: 3%">Status</th>
                    <th style="width: 5%">Ordering</th>
                    <th style="width: 10%">Created</th>
                    <th style="width: 10%">Modified</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $xhtml ?>
            </tbody>
        </table>
        <?= @$xhtmlDefault ?>
    </div>
</form>