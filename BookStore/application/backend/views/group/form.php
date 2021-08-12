<?php
$dataForm = @$this->arrParam['form'];
//Input
$inputName          = FormBackend::input('text', 'form[name]', @$dataForm['name']);
$inputHidden        = FormBackend::input('hidden', 'form[token]', time());

//Select Box GroupACP
$arrValueGACP       = ['default' => ' - Select Group ACP - ', 1 => 'Active', 0 => 'Inactive'];
$selectBoxGACP      = FormBackend::selectBox('form[group_acp]', $arrValueGACP, @$dataForm['group_acp'], '', '');

//Select Box Status
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = FormBackend::selectBox('form[status]', $arrValueStatus, @$dataForm['status'], '', '');

//Row Form

$rowName            = FormBackend::rowForm('Name', $inputName);
$rowGroupACP        = FormBackend::rowForm('Group ACP ',$selectBoxGACP);
$rowGroupStatus     = FormBackend::rowForm('Status ',$selectBoxStatus);
$rows               = $rowName . $rowGroupACP . $rowGroupStatus;

//ButtonSave
$saveButton         = FormBackend::button('submit', 'Save', 'btn btn-success');

//Button Cancel
$cancelHref         =   URL::createLink($this->arrParam['module'],$this->arrParam['controller'], 'index');
$cancelButton       = FormBackend::cancel($cancelHref);

?>
<?= $xhtmlError = $this->error ?? ''; ?>
<form action="#" method="post" name="adminForm" id="adminForm">
    <div class="card card-outline card-info">
        <div class="card-body">
            <?= $rows ?>
        </div>
        <div class="card-footer">
            <?= $inputHidden; ?>
            <?= $saveButton; ?>
            <?=$cancelButton;?>
        </div>
    </div>
</form>