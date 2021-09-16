<?php

$btnSearch          = HelperBackend::button('submit', 'Search');
$linkClear          = URL::createLink($arrParams['module'], $arrParams['controller'], $arrParams['action']);
$btnClear           = HelperBackend::buttonLink($linkClear, 'Clear', 'btn-danger');
//Input Search
$inputSearch =  FormBackend::input('text', 'search', @$arrParams['search']);

//Input Hidden
$inputHiddenModule         = FormBackend::input('hidden', 'module', $arrParams['module']);
$inputHiddenController     = FormBackend::input('hidden', 'controller', $arrParams['controller']);
$inputHiddenAction         = FormBackend::input('hidden', 'action', $arrParams['action']);

//Search item
$formSearch = $inputHiddenModule . $inputHiddenController . $inputHiddenAction . $inputSearch;


//Search Status Cart

$arrStatus  = ['default' => ' -Select Status Cart- ', 'not-delivery' => 'Chưa giao hàng', 'delivery' => 'Đang giao hàng', 'delivered' => 'Đã giao hàng'];
$selectBoxStatusCart = FormBackend::selectBoxCartStatus('select_cart_status', $arrStatus, @$arrParams['select_cart_status'],'','','select_cart_status');

//Select book -> category 
$formSlStatusCart = $inputHiddenModule . $inputHiddenController . $inputHiddenAction  . $selectBoxStatusCart;
?>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Search & Filter</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="area-filter-group-acp mb-2 ">
                    <form action="" method="GET" id="formCart">
                        <?= $formSlStatusCart ?>
                    </form>
                </div>
                <div class="area-search mb-2">
                    <form action="" method="GET">
                        <div class="input-group">
                            <?= $formSearch ?>
                            <span class="input-group-append">
                                <?= $btnSearch . $btnClear ?>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>