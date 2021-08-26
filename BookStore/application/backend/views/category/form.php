<?php
$dataForm = @$this->arrParam['form'];

//Input
$inputName          = FormBackend::input('text', 'form[name]', @$dataForm['name']);
$inputHidden        = FormBackend::input('hidden', 'form[token]', time());
$inputOrdering      = FormBackend::input('number', 'form[ordering]', @$dataForm['ordering']);

//Select Box Status
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = FormBackend::selectBox('form[status]', $arrValueStatus, @$dataForm['status'], '', '');

//Row Form
$rowName            = FormBackend::rowForm('Name', $inputName);
$rowGroupStatus     = FormBackend::rowForm('Status ',$selectBoxStatus);
$rowOrdering        =FormBackend::rowForm('Ordering', $inputOrdering);
$rows               = $rowName  . $rowGroupStatus . $rowOrdering;

//ButtonSave
$saveButton         = FormBackend::button('submit', 'Save', 'btn btn-success');

//Button Cancel
$cancelHref         =   URL::createLink($this->arrParam['module'],$this->arrParam['controller'], 'index');
$cancelButton       = FormBackend::cancel($cancelHref);

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
            <?=$cancelButton;?>
        </div>
    </div>
</form>