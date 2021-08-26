<?php
$items              = @$this->arrParam['status'] ?? 'all';
$btnSearch          = HelperBackend::button('submit', 'Search');
$linkClear          = URL::createLink($arrParams['module'], $arrParams['controller'], $arrParams['action']);
$btnClear           = HelperBackend::buttonLink($linkClear, 'Clear', 'btn-danger');
$xhtmlFilterStatus  = HelperBackend::showFilterStatus($arrParams['module'], $arrParams['controller'], $this->itemsStatusCount, $arrParams['status'] ?? 'all', trim(@$arrParams['search']));
//Input Search
$ipSearch =  FormBackend::input('text', 'search', @$arrParams['search']);

//Input Hidden
$ipHdModule         = FormBackend::input('hidden', 'module', $arrParams['module']);
$ipHdController     = FormBackend::input('hidden', 'controller', $arrParams['controller']);
$ipHdAction         = FormBackend::input('hidden', 'action', $arrParams['action']);


$input = $ipHdModule . $ipHdController . $ipHdAction . $ipSearch;

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
                <div class="area-filter-status mb-2">
                    <?= $xhtmlFilterStatus ?>
                </div>
                <!-- <div class="area-filter-group-acp mb-2 ">
                    <?= $selectBoxGrACP ?>
                </div> -->
                <div class="area-search mb-2">
                    <form action="" method="GET">
                        <div class="input-group">
                            <?= $input ?>
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