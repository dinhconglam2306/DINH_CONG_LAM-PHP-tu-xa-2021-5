<?php
$dataForm = @$this->arrParam['form'];
//Input
$inputName          = HelperBackend::createInput('text', 'form[name]', @$dataForm['name']);
$inputHidden        = HelperBackend::createInput('hidden', 'form[token]', time());

//Select Box GroupACP
$arrValueGACP       = ['default' => ' - Select Group ACP - ', 1 => 'Active', 0 => 'Inactive'];
$selectBoxGACP      = HelperBackend::createSelectbox('form[group_acp]', $arrValueGACP, @$dataForm['group_acp'], '', '');

//Select Box Status
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = HelperBackend::createSelectbox('form[status]', $arrValueStatus, @$dataForm['status'], '', '');

//Row Form

$rowName            = HelperBackend::createRowForm('Name', $inputName, null);
$rowGroupACP        = HelperBackend::createRowForm('Group ACP ', $inputName, $selectBoxGACP, false);
$rowGroupStatus     = HelperBackend::createRowForm('Status ', $inputName, $selectBoxStatus, false);
$rows               = $rowName . $rowGroupACP . $rowGroupStatus;

//Button

$saveButton = HelperBackend::createButtonForm('submit', 'Save', 'btn btn-success');

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