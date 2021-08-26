<?php
$xhtmlDefault = '';
if(empty($this->items)){
    $xhtmlDefault = '<p class="form-control text-center">Dữ liệu đang được cập nhật</p>';
}
$xhtml = '';
unset($this->slbGroup['default']);

foreach ($this->items as $key => $item) {
    
    $id                 = $item['id'];
    $ckb                = sprintf('<input type="checkbox" name="cid[]" value="%s">', $id);
    $userName           = HelperBackend::highlight(@$arrParams['search'], $item['username']);
    $fullName           = HelperBackend::highlight(@$arrParams['search'], $item['fullname']);
    // $email              = HelperBackend::highlight(@$arrParams['search'], $item['email']);
    $email              =   $item['email'];
    $groupLink          = URL::createLink($arrParams['module'], $arrParams['controller'], 'changeGroup', ['group_id' => 'value_new', 'id' => $id]);
    $attr               = sprintf('data-url=%s', $groupLink);
    $selectGroup        = FormBackend::selectBox('change_group', $this->slbGroup, $item['group_id'], $attr, 'form-control w-auto');
    $status             = HelperBackend::itemStatus($arrParams['module'], $arrParams['controller'], $id, $item['status']);
    $created            = HelperBackend::itemHistory($item['created_by'], $item['created']);
    $modified           = HelperBackend::itemHistory($item['modified_by'], $item['modified'],$id);

    $optionsBtnAction   = ['small' => true, 'circle' => true];
    $linkEdit           = URL::createLink($arrParams['module'], $arrParams['controller'], 'form', ['id' => $id]);
    $btnEdit            = HelperBackend::buttonLink($linkEdit, '<i class="fas fa-pen"></i>', 'btn-info', $optionsBtnAction);
    $linkDelete         = URL::createLink($arrParams['module'], $arrParams['controller'], 'delete', ['id' => $id]);
    $btnDelete          = HelperBackend::buttonLink($linkDelete, '<i class="fas fa-trash"></i>', 'btn-danger btn-delete', $optionsBtnAction);
    $linkChangePw       = URL::createLink($arrParams['module'], $arrParams['controller'], 'changePassword', ['id' => $id]);
    $btnChangePw        = HelperBackend::buttonLink($linkChangePw, '<i class="fas fa-key"></i>', 'btn-secondary btn-changepw', $optionsBtnAction);



    $xhtml .= '
    <tr>
        <td>' . $ckb . '</td>
        <td>' . $id . '</td>
        <td class="text-left">
            <p class="mb-0"><b>Username</b>: ' . $userName . '</p>
            <p class="mb-0"><b>FullName</b>: ' . $fullName . '</p>
            <p class="mb-0"><b>Email</b>: ' . $email . '</p>
        </td>
        <td class="position-relative">' . $selectGroup . '</td>
        <td class="position-relative">' . $status . '</td>
        <td>' . $created . '</td>
        <td>' . $modified . '</td>
        <td>' . $btnChangePw . '
            ' . $btnEdit . '
            ' . $btnDelete . '
        </td>
    </tr>
    ';
}
?>

<form action="" method="post" id="table-form">
    <div class="table-responsive">
        <table class="table align-middle text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all-cid"></th>
                    <th>ID</th>
                    <th class="text-left">Info</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $xhtml ?>         
            </tbody>
        </table>
        <?= $xhtmlDefault ?>
    </div>
</form>