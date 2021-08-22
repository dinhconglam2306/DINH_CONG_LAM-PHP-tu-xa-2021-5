<?php
$dataForm = @$this->arrParam['form'];
$inputUserName  = FormBackend::input('text', 'form[username]', @$dataForm['username']);
$inputMail      = FormBackend::input('email', 'form[email]', @$dataForm['email']);
$inputFullName  = FormBackend::input('text', 'form[fullname]', @$dataForm['fullname']);

$rowUserName       = FormBackend::rowForm('Username', $inputUserName);
$rowMail           = FormBackend::rowForm('Email', $inputMail);
$rowFullName       = FormBackend::rowForm('FullName', $inputFullName);

$inputHidden    = FormBackend::input('hidden', 'form[token]', time());

$rowTotal = $rowUserName . $rowMail . $rowFullName;
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