<?php
// Danh sách book special of category
foreach ($this->specialItems as $key => $item) {
    $xhtmlSpecial =HelperFrontend::showMedia($item);
    if ($key < 4) {
        @$xhtmlSpecialOnetofour .= $xhtmlSpecial;
    } else {
        @$xhtmlSpecialFivetoend .= $xhtmlSpecial;
    }
}

?>
<div class="theme-card">
    <h5 class="title-border">Sách nổi bật</h5>
    <div class="offer-slider slide-1">
        <div><?= @$xhtmlSpecialOnetofour; ?></div>
        <div><?= @$xhtmlSpecialFivetoend; ?></div>
    </div>
</div>