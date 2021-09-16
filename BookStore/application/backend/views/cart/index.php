<?php
$arrParams = $this->arrParam;

$linkAddNew = URL::createLink('backend', 'book', 'form');
$btnAddNew = HelperBackend::buttonLink($linkAddNew, '<i class="fas fa-plus"></i> Add New');
$urlBulkAction = URL::createLink($arrParams['module'], $arrParams['controller'], 'value_new');
$btnBulkAction = HelperBackend::buttonLink($urlBulkAction, 'Apply', 'btn-info btn-apply-bulk-action');
$arrValue = ['' => 'Bulk Action', 'multiDelete' => 'Delete'];
$selectBox = FormBackend::selectBox('list_action', $arrValue, '', '', 'form-control slb-bulk-action');
?>
<?= $strMessage = HelperBackend::createMessage(); ?>
<!-- Search & Filter -->
<?php require_once 'elements/search_filter.php' ?>
<!-- List -->
<div class="card card-outline card-info">
    <?php require_once 'elements/list_card_header.php' ?>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between mb-2">
                <div>
                    <div class="input-group">
                        <?= $selectBox; ?>
                        <span class="input-group-append">
                            <?= $btnBulkAction ?>
                        </span>
                    </div>
                </div>
                <div><?= $btnAddNew ?></div>
            </div>
        </div>
        <?php require_once 'elements/list_table.php' ?>
    </div>
    <?php require_once 'elements/list_card_footer.php' ?>
</div>