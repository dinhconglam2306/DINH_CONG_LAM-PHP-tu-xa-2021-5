<?php
//Input

$inputUserName  = FormBackend::input('text', 'form[username]', null);
$inputPassword  = FormBackend::input('text', 'form[password]', null);
$inputMail      = FormBackend::input('email', 'form[email]', null);
$inputFullName  = FormBackend::input('text', 'form[fullName]', null);
$inputHidden    = FormBackend::input('hidden', 'form[token]', time());

//select box
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = FormBackend::selectBox('form[status]', $arrValueStatus);

$arrValueGroupForm = $this->slbGroup;
$selectBoxGroup    = FormBackend::selectBox('form[group]', $this->slbGroup);


//Row

$rowUserName       = FormBackend::rowForm('Username', $inputUserName);
$rowPassword       = FormBackend::rowForm('Password', $inputPassword);
$rowMail           = FormBackend::rowForm('Email', $inputMail);
$rowFullName       = FormBackend::rowForm('FullName', $inputFullName);
$rowslbStatus      = FormBackend::rowForm('Status', $selectBoxStatus);
$rowslbGroup       = FormBackend::rowForm('Status', $selectBoxGroup);

$rowTotal          = $rowUserName . $rowPassword . $rowMail . $rowFullName . $rowslbStatus . $rowslbGroup;

//button Save
$saveButton = FormBackend::button('submit', 'Save', 'btn btn-success');

//button cancel
$cancelHref         =   URL::createLink($this->arrParam['module'],$this->arrParam['controller'], 'index');
$cancelButton       = FormBackend::cancel($cancelHref);

?>
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