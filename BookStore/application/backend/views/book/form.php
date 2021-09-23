<?php
$dataForm = @$this->arrParam['form'];

//Input
$inputName              = FormBackend::input('text', 'form[name]', @$dataForm['name']);
// $description            = sprintf('<textarea class="form-control "name="form[description]">%s</textarea>', @$dataForm['description']);
$description            = FormBackend::textarea('form[description]','description',@$dataForm['description']);
$content                = FormBackend::textarea('form[content]','content',@$dataForm['content'],'',10,80);
$inputPrice             = FormBackend::input('text', 'form[price]', @$dataForm['price']);
$inputSaleOff           = FormBackend::input('text', 'form[sale_off]', @$dataForm['sale_off']);
$inputHidden            = FormBackend::input('hidden', 'form[token]', time());
$inputOrdering          = FormBackend::input('number', 'form[ordering]', @$dataForm['ordering']);
$inputPicture           = '<input type="file" class="form-control-file" name="picture" value="" id="imgInp">';
$pathImage              = '';
$picture                = '<div id="picture"></div>';
$inputPictureHidden = '';
if (isset($this->arrParam['id'])) {
    @$pathImage          = URL_UPLOAD . 'book' . DS . @$dataForm['picture'];
    if (is_array($dataForm['picture']) == true) {
        $pathImage          = URL_UPLOAD . 'book' . DS . @$dataForm['picture_hidden'];
    }
    $picture            = sprintf('<div id="picture"><img id="old" src="%s" style ="max-width:250px;" /></div>', $pathImage);
    @$inputPictureHidden        = FormBackend::input('hidden', 'form[picture_hidden]', @$dataForm['picture']);
}

//Select Box Status
$arrValueStatus     = ['default' => ' - Select Status - ', 'active' => 'Active', 'inactive' => 'Inactive'];
$selectBoxStatus    = FormBackend::selectBox('form[status]', $arrValueStatus, @$dataForm['status'], '', '');

//Select Box Special
$arrValueSpecial = ['default' => ' -Select Special- ', 1 => 'Yes', 0 => 'No'];
$selectBoxSpecial = FormBackend::selectBox('form[special]', $arrValueSpecial, @$dataForm['special'], '', '');

//Select Box New
$arrValueNew = ['default' => ' -Select New- ', 1 => 'Yes', 0 => 'No'];
$selectBoxNew = FormBackend::selectBox('form[new]', $arrValueNew, @$dataForm['new'], '', '');

//Select Box Category
$arrValueCategory = @$this->slbCategory;
$selectBoxCategory = FormBackend::selectBox('form[category_id]', $arrValueCategory, @$dataForm['category_id'], '', '');

//Row Form
$rowName                = FormBackend::rowForm('Name', $inputName);
$rowPrice               = FormBackend::rowForm('Price', $inputPrice);
$rowSaleOff             = FormBackend::rowForm('Sale Off', $inputSaleOff);
$rowStatus              = FormBackend::rowForm('Status ', $selectBoxStatus);
$rowSpecial             = FormBackend::rowForm('Special ', $selectBoxSpecial);
$rowNew                 = FormBackend::rowForm('New ', $selectBoxNew);
$rowCategory            = FormBackend::rowForm('Category ', $selectBoxCategory);
$rowOrdering            = FormBackend::rowForm('Ordering', $inputOrdering);
$rowPicture             = FormBackend::rowForm('Picture', $inputPicture . $picture,false);
$rowDescription         = FormBackend::rowForm('Description', $description,false);
$rowContent             = FormBackend::rowForm('Contents', $content,false);

$rows                   = $rowName  .  $rowPrice . $rowSaleOff .  $rowStatus . $rowSpecial. $rowNew . $rowCategory .  $rowOrdering . $rowDescription . $rowContent . $rowPicture;

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