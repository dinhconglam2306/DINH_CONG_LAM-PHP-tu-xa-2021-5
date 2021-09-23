<?php
$dataForm = @$this->arrParam['form'];


//Input
$inputName          = FormBackend::input('text', 'form[name]', @$dataForm['name']);
$inputHidden        = FormBackend::input('hidden', 'form[token]', time());
$inputOrdering      = FormBackend::input('number', 'form[ordering]', @$dataForm['ordering']);
$inputPicture       = '<input type="file" class="form-control-file" name="picture" value="" id="imgInp">';
$pathImage = '';
$picture = '<div id="picture"></div>';
$inputPictureHidden = '';

if (isset($this->arrParam['id'])) {
    $picture            = sprintf('<div id="picture"><img src="%s"style ="max-width :100px; margin-top:10px;"/></div>', URL_UPLOAD . 'category' . DS . 'default.png');
    @$picturePath        = PATH_UPLOAD . 'category' . DS . @$dataForm['picture'];
    if (file_exists($picturePath) && !empty($dataForm['picture'])) {
        $picture  = sprintf('<div id="picture"><img src="%s"style ="max-width :100px; margin-top:10px;"/></div>', URL_UPLOAD . 'category' . DS . $dataForm['picture']);
    } else {
        if (is_array($dataForm['picture']) == true) {
            $picture  = sprintf('<div id="picture"><img src="%s"style ="max-width :100px; margin-top:10px;"/></div>', URL_UPLOAD . 'category' . DS . $dataForm['picture_hidden']);
        }
    }
    // $picture            = sprintf('<div id="picture"><img id="old" src="%s" style ="max-width:250px;" /></div>', $pathImage);
    @$inputPictureHidden        = FormBackend::input('hidden', 'form[picture_hidden]', @$dataForm['picture']);
}

//Select Box Status
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = FormBackend::selectBox('form[status]', $arrValueStatus, @$dataForm['status']);

//Show at home

$arrValueIsHome = ['default' => ' -Select show at home- ', 1 => 'Yes', 0 => 'No'];
$selectBoxIsHome = FormBackend::selectBox('form[is_home]', $arrValueIsHome, @$dataForm['is_home']);

//Row Form
$rowName            = FormBackend::rowForm('Name', $inputName);
$rowStatus          = FormBackend::rowForm('Status ', $selectBoxStatus);
$rowShowAtHome      = FormBackend::rowForm('Show at home ', $selectBoxIsHome);
$rowOrdering        = FormBackend::rowForm('Ordering', $inputOrdering, false);
$rowPicture         = FormBackend::rowForm('Picture', $inputPicture . $picture);
$rows               = $rowName  . $rowStatus . $rowShowAtHome .  $rowOrdering . $rowPicture . $inputPictureHidden;

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