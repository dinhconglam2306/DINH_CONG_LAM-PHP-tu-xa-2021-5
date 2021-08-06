<?php
$message = Session::get('message');
Session::delete('message');
$strMessage = HelperBackend::createMessage($message);

?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $this->_title ?></h1>
            </div>
        </div>
    </div>
    <?= $strMessage; ?>
</div>