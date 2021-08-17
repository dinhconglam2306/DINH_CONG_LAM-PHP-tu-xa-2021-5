<?php
$inputID        = FormBackend::input('text', 'form[id]', @$dataForm['id']);
$inputUserName  = FormBackend::input('text', 'form[username]', @$dataForm['username']);
$inputMail      = FormBackend::input('email', 'form[email]', @$dataForm['email']);
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
$rowFullName       = FormBackend::rowForm('FullName', $inputFullName);
$rowslbStatus      = FormBackend::rowForm('Status', $selectBoxStatus);
$rowslbGroup       = FormBackend::rowForm('Group', $selectBoxGroup);


$rowTotal          = $rowUserName . $rowMail . $rowPassword . $rowFullName . $rowslbStatus . $rowslbGroup;
