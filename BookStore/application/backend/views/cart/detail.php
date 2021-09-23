<?php
$linkBack = URL::createLink('backend', 'cart', 'index');
$btnBack = HelperBackend::buttonLink($linkBack, '<i class="far fa-arrow-alt-circle-left"></i> Quay về');
?>
<?= $strMessage = HelperBackend::createMessage(); ?>
<div class="card card-outline card-info">
    <?php require_once 'elements_detail/list_card_header.php' ?>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between mb-2">
                <div>
                    <div class="input-group">
                        <span class="input-group-append">
                        </span>
                    </div>
                </div>
                <div><?= $btnBack ?></div>
            </div>
        </div>
        <?php require_once 'elements_detail/list_table.php' ?>
    </div>
</div>