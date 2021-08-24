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

//Search item
$formSearch = $ipHdModule . $ipHdController . $ipHdAction . $ipSearch;


//Group
$arrValueGroup = $this->slbGroup;
$groupUrl = URL::createLink($arrParams['module'], $arrParams['controller'], 'index', ['group_id' => 'value_new']);
$attr  = sprintf('data-url=%s', $groupUrl);
$selectBoxGroup = FormBackend::selectBox('group_id', $arrValueGroup, @$arrParams['group_id'], $attr, 'slb-select-group-acp');

//Select item -> group
$formSlGroup = $ipHdModule . $ipHdController . $ipHdAction . $selectBoxGroup ;
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
                <div class="area-filter-group-acp mb-2 ">
                <form action="" method="GET" id="select-user">
                    <?= $formSlGroup ?>
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