<?php
$xhtml = '';
foreach ($this->items as $key => $item) {
    $id                 = $item['id'];
    $ckb                = sprintf('<input type="checkbox" name="cid[]" value="%s">', $id);
    $name               = HelperBackend::highlight(@$arrParams['search'], $item['name']);
    $groupACP           = HelperBackend::itemGroupACP($arrParams['module'], $arrParams['controller'], $id, $item['group_acp']);
    $status             = HelperBackend::itemStatus($arrParams['module'], $arrParams['controller'], $id, $item['status']);
    $created            = HelperBackend::itemHistory($item['created_by'], $item['created']);
    $modified           = HelperBackend::itemHistory($item['modified_by'], $item['modified'], $id);

    $optionsBtnAction   = ['small' => true, 'circle' => true];
    $linkEdit           = URL::createLink($arrParams['module'], $arrParams['controller'], 'form', ['id' => $id]);
    $btnEdit            = HelperBackend::buttonLink($linkEdit, '<i class="fas fa-pen"></i>', 'btn-info', $optionsBtnAction);
    $linkDelete         = URL::createLink($arrParams['module'], $arrParams['controller'], 'delete', ['id' => $id]);
    $btnDelete          = HelperBackend::buttonLink($linkDelete, '<i class="fas fa-trash"></i>', 'btn-danger btn-delete', $optionsBtnAction);

    // $xhtml .= '
    // <tr>
    //     <td>' . $ckb . '</td>
    //     <td>' . $id . '</td>
    //     <td>' . $name . '</td>
    //     <td class="position-relative">' . $groupACP . '</td>
    //     <td class="position-relative">' . $status . '</td>
    //     <td>' . $created . '</td>
    //     <td>' . $modified . '</td>
    //     <td>
    //         ' . $btnEdit . '
    //         ' . $btnDelete . '
    //     </td>
    // </tr>
    // ';
    $xhtml .= '
    <tr>
        <td>' . $id . '</td>
        <td>' . $name . '</td>
        <td>' . $created . '</td>
        <td>' . $modified . '</td>
    </tr>
    ';
}
?>

<form action="" method="post" id="table-form">
    <div class="table-responsive">
        <table class="table align-middle text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- <th>Group ACP</th> -->
                    <!-- <th>Status</th> -->
                    <th>Created</th>
                    <th>Modified</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?= $xhtml ?>
            </tbody>
        </table>
    </div>
</form>