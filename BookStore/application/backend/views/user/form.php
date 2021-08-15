<?php
$dataForm = @$this->arrParam['form'];
$readonly = '';
if (isset($this->arrParam['id']))$readonly = 'readonly';
//Input

$inputID        = FormBackend::input('text', 'form[id]', @$dataForm['name'], $readonly);
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

//Action ADD
$rowID             = FormBackend::rowForm('ID', $inputID);
$rowUserName       = FormBackend::rowForm('Username', $inputUserName);
$rowPassword       = FormBackend::rowForm('Password', $inputPassword);
$rowMail           = FormBackend::rowForm('Email', $inputMail);
$rowFullName       = FormBackend::rowForm('FullName', $inputFullName, false);
$rowslbStatus      = FormBackend::rowForm('Status', $selectBoxStatus);
$rowslbGroup       = FormBackend::rowForm('Group', $selectBoxGroup);
$rowTotal          = $rowUserName . $rowMail . $rowPassword . $rowFullName . $rowslbStatus . $rowslbGroup;

//Action Edit
if (isset($this->arrParam['id']) && $this->arrParam['action'] == 'form') {
    $inputPassword     = FormBackend::input('hidden', 'form[password]', @$dataForm['password']);
    $rowTotal          = $rowUserName . $rowMail . $inputPassword . $rowFullName . $rowslbStatus . $rowslbGroup;
}

//Action Change PassWord
$dataUrl = URL::createLink($this->arrParam['module'],$this->arrParam['controller'],'changePassword',['id'=>@$this->arrParam['id']]);
$plusButton = FormBackend::button('button', 'Generate', 'btn btn-info btn-sm btn-generate', '<i class="fas fa-sync-alt"></i>',$dataUrl);
if (isset($this->arrParam['id']) && $this->arrParam['action'] == 'changePassword') {
    $inputFullName     = FormBackend::input('text', 'form[fullname]', @$dataForm['fullname'], $readonly);
    $rowFullName       = FormBackend::rowForm('FullName', $inputFullName, false);
    $rowID             = FormBackend::rowForm('ID', $inputID, false);
    $rowUserName       = FormBackend::rowForm('Username', $inputUserName, false);
    $inputPassword     = FormBackend::input('text', 'form[password]', HelperBackend::randomString());
    $rowPassword       = FormBackend::rowForm('Password', $inputPassword, false, $plusButton);
    $rowMail           = FormBackend::rowForm('Email', $inputMail, false);
    $rowTotal          = $rowID .  $rowUserName . $rowMail . $rowFullName . $rowPassword;
}




//button Save
$saveButton = FormBackend::button('submit', 'Save', 'btn btn-success');

//button cancel
$cancelHref         =   URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'index');
$cancelButton       = FormBackend::cancel($cancelHref);


//Random

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