<?php
$arrCollection[] = ['number' => 2];
$arrCollection[] = ['number' => 3];
$arrCollection[] = ['number' => 4];
$arrCollection[] = ['number' => 6];
foreach ($arrCollection as $value) {
    $active = '';
    if ($value['number'] == 4) $active = 'active';
    @$xhtmlCollection .= sprintf('
    <li class="my-layout-view %s" data-number="%s">
        <img src="%sicon/%s.png" alt="" class="product-%s-layout-view">
    </li>', $active, $value['number'], $this->_dirImg, $value['number'], $value['number']);
}
//input

$inputHiddenModule         = FormBackend::input('hidden', 'module', @$this->arrParam['module']);
$inputHiddenController     = FormBackend::input('hidden', 'controller', @$this->arrParam['controller']);
$inputHiddenAction         = FormBackend::input('hidden', 'action', @$this->arrParam['action']);



$arrValueSort = ['default' => ' - Sắp xếp - ', 'price_asc' => 'Giá tăng dần', 'price_desc' => 'Giá giảm dần', 'id_desc' => 'Mới nhất'];
$selectSort   = FormFrontend::selectBox('sort', 'sort', $arrValueSort, @$this->arrParam['sort']);

$inputHidden = $inputHiddenModule . $inputHiddenController . $inputHiddenAction;
if (isset($this->arrParam['category_id'])) {
    $inputHiddenCategoryId     = FormBackend::input('hidden', 'category_id', @$this->arrParam['category_id']);
    $inputHidden .= $inputHiddenCategoryId;
}

?>
<div class="product-filter-content">
    <div class="collection-view">
        <ul>
            <li><i class="fa fa-th grid-layout-view"></i></li>
            <li><i class="fa fa-list-ul list-layout-view"></i></li>
        </ul>
    </div>
    <div class="collection-grid-view">
        <ul>
            <?= $xhtmlCollection; ?>
        </ul>
    </div>
    <div class="product-page-filter">
        <form action="" id="sort-form" method="GET">
            <?= $inputHidden; ?>
            <?= $selectSort; ?>
        </form>
    </div>
</div>