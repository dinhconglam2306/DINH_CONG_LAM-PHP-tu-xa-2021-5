<?php
//input hidden pass
$inputPassword     = FormBackend::input('hidden', 'form[password]', @$dataForm['password']);

//row UserName
$inputUserName  = FormBackend::input('text', 'form[username]', @$dataForm['username'],$readonly);
$rowUserName       = FormBackend::rowForm('Username', $inputUserName);

//Row Mail
$inputMail      = FormBackend::input('email', 'form[email]', @$dataForm['email'],$readonly);
$rowMail           = FormBackend::rowForm('Email', $inputMail);