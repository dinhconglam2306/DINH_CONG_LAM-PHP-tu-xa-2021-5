<?php
$dataForm = @$this->arrParam['form'];
//Input
$readonly = '';
if (isset($this->arrParam['id'])) {
    $readonly = 'readonly';
}
$inputUserName  = FormBackend::input('text', 'form[name]', @$dataForm['name'], $readonly);
$inputMail      = FormBackend::input('email', 'form[email]', @$dataForm['email'], $readonly);
$inputPassword  = FormBackend::input('text', 'form[password]', @$dataForm['password']);
$inputFullName  = FormBackend::input('text', 'form[fullname]', @$dataForm['fullname']);
$inputHidden    = FormBackend::input('hidden', 'form[token]', time());


//select box
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = FormBackend::selectBox('form[status]', $arrValueStatus, @$dataForm['status']);

$arrValueGroupForm = $this->slbGroup;
$selectBoxGroup    = FormBackend::selectBox('form[group_id]', $this->slbGroup, @$dataForm['group_id']);


//Row

$rowUserName       = FormBackend::rowForm('Username', $inputUserName);
$rowPassword       = FormBackend::rowForm('Password', $inputPassword);
$rowMail           = FormBackend::rowForm('Email', $inputMail);
$rowFullName       = FormBackend::rowForm('FullName', $inputFullName, false);
$rowslbStatus      = FormBackend::rowForm('Status', $selectBoxStatus);
$rowslbGroup       = FormBackend::rowForm('Group', $selectBoxGroup);
$rowTotal          = $rowUserName . $rowMail . $rowPassword . $rowFullName . $rowslbStatus . $rowslbGroup;
if (isset($this->arrParam['id'])) {
    $inputPassword     = FormBackend::input('hidden', 'form[password]', @$dataForm['password']);
    $rowTotal          = $rowUserName . $rowMail . $inputPassword . $rowFullName . $rowslbStatus . $rowslbGroup;
}




//button Save
$saveButton = FormBackend::button('submit', 'Save', 'btn btn-success');

//button cancel
$cancelHref         =   URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'index');
$cancelButton       = FormBackend::cancel($cancelHref);

?>
<?= $xhtmlError = $this->error ?? ''; ?>
<form action="" method="post" name="userForm" id="userForm">
    <div class="card card-outline card-info">
        <div class="card-body">
            <?= $rowTotal; ?>
        </div>
        <div class="card-footer">
            <?= $inputHidden; ?>
            <?= $saveButton; ?>
            <?= $cancelButton; ?>
        </div>
    </div>
</form>