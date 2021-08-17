<?php
// $dataUrl = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'changePassword', ['id' => @$this->arrParam['id']]);
$plusButton = FormBackend::button('button', 'Generate', 'btn btn-info btn-sm btn-generate', '<i class="fas fa-sync-alt"></i>');

$inputPassword     = FormBackend::input('text', 'form[password]', HelperBackend::randomString(),'',$plusButton);
$rowPassword       = sprintf('<div class ="password-row">%s</div>',$inputPassword);
//row UserName
$inputUserName  = FormBackend::input('text', 'form[username]', @$dataForm['username'],$readonly);
$rowUserName       = FormBackend::rowForm('Username', $inputUserName);

//Row Mail
$inputMail      = FormBackend::input('email', 'form[email]', @$dataForm['email'],$readonly);
$rowMail           = FormBackend::rowForm('Email', $inputMail);