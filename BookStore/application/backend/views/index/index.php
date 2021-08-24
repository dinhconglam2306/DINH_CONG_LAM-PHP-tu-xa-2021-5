<?php
$arrMenu = [
    ['link' => URL::createLink('backend', 'group', 'index'), 'name' => 'Group', 'icon' => 'ion ion-ios-people', 'total' => $this->totalGroups],
    ['link' => URL::createLink('backend', 'user', 'index'), 'name' => 'User', 'icon' => 'ion ion-ios-person', 'total' => $this->totalItems],
    ['link' => URL::createLink('backend', 'category', 'index'), 'name' => 'Category', 'icon' => 'ion ion-clipboard', 'total' => 10],
    ['link' => URL::createLink('backend', 'book', 'index'), 'name' => 'Book', 'icon' => 'ion ion-ios-book', 'total' => 20],
];

foreach ($arrMenu as $key => $value) {
    @$xhtml .= sprintf('
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>%s</h3>
                <p>%s</p>
            </div>
            <div class="icon">
                <i class="%s"></i>
            </div>
            <a href="%s" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    ', $value['total'], $value['name'], $value['icon'], $value['link']);
}
?>
<div class="container-fluid">
    <div class="row">
        <?= $xhtml; ?>
    </div>
</div>