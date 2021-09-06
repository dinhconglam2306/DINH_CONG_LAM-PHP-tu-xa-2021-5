<?php
$dataForm       = @$this->arrParam['form'];

$inputID        = FormBackend::input('text', 'form[id]', @$dataForm['id'],'readonly');
$inputUserName  = FormBackend::input('text', 'form[username]', @$dataForm['username'],'readonly');
$inputMail      = FormBackend::input('email', 'form[email]', @$dataForm['email'],'readonly');
$inputFullName  = FormBackend::input('text', 'form[fullname]', @$dataForm['fullname']);

$rowID          = FormBackend::rowForm('ID', $inputID);
$rowUserName    = FormBackend::rowForm('Username', $inputUserName);
$rowMail        = FormBackend::rowForm('Email', $inputMail);
$rowFullName    = FormBackend::rowForm('FullName', $inputFullName,false);

$inputHidden    = FormBackend::input('hidden', 'form[token]', time());

$rowTotal       = $rowID . $rowUserName . $rowMail . $rowFullName;
//button Save
$saveButton     = FormBackend::button('submit', 'Save', 'btn btn-success');

//button cancel
$cancelHref     =   URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'index');
$cancelButton   = FormBackend::cancel($cancelHref);

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