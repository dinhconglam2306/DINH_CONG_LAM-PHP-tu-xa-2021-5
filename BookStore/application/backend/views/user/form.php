<?php

$dataForm = @$this->arrParam['form'];
$readonly = '';
if (isset($this->arrParam['id']))$readonly = 'readonly';
require_once 'elements/form_add.php';



//Action Edit
if (isset($this->arrParam['id']) && $this->arrParam['action'] == 'form') {
    require_once 'elements/form_edit.php';
    $rowTotal          = $rowUserName . $rowMail . $inputPassword . $rowFullName . $rowslbStatus . $rowslbGroup;
}

//Action Change PassWord
if (isset($this->arrParam['id']) && $this->arrParam['action'] == 'changePassword') {
    require_once 'elements/form_change_password.php';
    $rowTotal          =  $rowUserName . $rowMail .$rowPassword;
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