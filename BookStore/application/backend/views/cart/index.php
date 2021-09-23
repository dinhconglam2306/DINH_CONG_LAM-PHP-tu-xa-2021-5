<?php
$arrParams = $this->arrParam;
?>
<!-- Search & Filter -->
<?php require_once 'elements/search_filter.php' ?>
<!-- List -->
<div class="card card-outline card-info">
    <?php require_once 'elements/list_card_header.php' ?>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between mb-2">
            </div>
        </div>
        <?php require_once 'elements/list_table.php' ?>
    </div>
    <?php require_once 'elements/list_card_footer.php' ?>
</div>