<?php
$status = (isset($arrParams['status'])) ? ['status' => $arrParams['status']] : ['status' => 'all'];
if(isset($arrParams['search'])){
    $search = ['search' => $arrParams['search']];
    $params = $status + $search;
}else if(isset($arrParams['group_acp'])){
    $groupACP = ['group_acp' => $arrParams['group_acp']];
    $params = $status + $groupACP;
}else{
    $params = $status;
}

$paginationHTML = $this->pagination->showPagination(URL::createLink($arrParams['module'],$this->arrParam['controller'],'index',$params));
?>
<?= $paginationHTML; ?>