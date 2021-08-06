<?php
$dataForm = @$this->arrParam['form'];
//Input
$inputName          = HelperBackend::createInput('text', 'form-control', 'form[name]', @$dataForm['name']);
$inputHidden        = HelperBackend::createInput('hidden', 'form-control', 'form[token]', time());

//Select Box GroupACP
$arrValueGACP       = ['default' => ' - Select Group ACP - ', 1 => 'Active', 0 => 'Inactive'];
$selectBoxGACP      = HelperBackend::createSelectbox('form[group_acp]', 'custom-select', $arrValueGACP, @$dataForm['group_acp']);

//Select Box Status
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = HelperBackend::createSelectbox('form[status]', 'custom-select', $arrValueStatus, @$dataForm['status']);

//Row Form

$rowName            = HelperBackend::createRowForm('Name', $inputName, null);
$rowGroupACP        = HelperBackend::createRowForm('Group ACP ', $inputName, $selectBoxGACP, false);
$rowGroupStatus     = HelperBackend::createRowForm('Status ', $inputName, $selectBoxStatus, false);
$rows               = $rowName . $rowGroupACP . $rowGroupStatus;

//Button

$saveButton = HelperBackend::createButtonForm('submit', 'btn btn-success', 'Save');

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
            <a href="<?= URL::createLink('backend', 'group', 'index') ?>" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</form>