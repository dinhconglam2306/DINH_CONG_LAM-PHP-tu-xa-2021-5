<?php
$dataForm = @$this->arrParam['form'];

//Input
$inputName          = FormBackend::input('text', 'form[name]', @$dataForm['name']);
$inputHidden        = FormBackend::input('hidden', 'form[token]', time());
$inputOrdering      = FormBackend::input('number', 'form[ordering]', @$dataForm['ordering']);
$inputPicture       = '<input type="file" class="form-control-file" name="picture" value="" id="imgInp">';
$pathImage= '';
$picture = '<div id="picture"></div>';
$inputPictureHidden = '';
if (isset($this->arrParam['id'])) {
    @$pathImage          = UPLOAD_URL . 'category' . DS . @$dataForm['picture'];
    if(is_array($dataForm['picture']) == true){
        $pathImage          = UPLOAD_URL . 'category' . DS . @$dataForm['picture_hidden'];
    }
    $picture            = sprintf('<div id="picture"><img id="old" src="%s" style ="max-width:250px;" /></div>', $pathImage);
    @$inputPictureHidden        = FormBackend::input('hidden', 'form[picture_hidden]',@$dataForm['picture']);
}

//Select Box Status
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = FormBackend::selectBox('form[status]', $arrValueStatus, @$dataForm['status'], '', '');

//Row Form
$rowName            = FormBackend::rowForm('Name', $inputName);
$rowGroupStatus     = FormBackend::rowForm('Status ', $selectBoxStatus);
$rowOrdering        = FormBackend::rowForm('Ordering', $inputOrdering,false);
$rowPicture        = FormBackend::rowForm('Picture', $inputPicture . $picture);
$rows               = $rowName  . $rowGroupStatus . $rowOrdering . $rowPicture.$inputPictureHidden;

//ButtonSave
$saveButton         = FormBackend::button('submit', 'Save', 'btn btn-success');

//Button Cancel
$cancelHref         =   URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'index');
$cancelButton       = FormBackend::cancel($cancelHref);

?>
<?= $xhtmlError = $this->error ?? ''; ?>
<form action="#" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <div class="card card-outline card-info">
        <div class="card-body">
            <?= $rows ?>
        </div>
        <div class="card-footer">
            <?= $inputHidden; ?>
            <?= $saveButton; ?>
            <?= $cancelButton; ?>
        </div>
    </div>
</form>