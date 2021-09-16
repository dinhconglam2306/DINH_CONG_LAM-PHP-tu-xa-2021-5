<?php
// Danh sách book special of category
foreach ($this->newBook as $key => $item) {
    $xhtmlNewBook = HelperFrontend::showMedia($item);
    if ($key < 3) {
        @$xhtmlNewBookOnetofour .= $xhtmlNewBook;
    } else {
        @$xhtmlNewBookFivetoend .= $xhtmlNewBook;
    }
}

?>
<div class="theme-card mt-4">
    <h5 class="title-border">Sách mới</h5>
    <div class="offer-slider slide-1">
        <div><?= @$xhtmlNewBookOnetofour; ?></div>
        <div><?= @$xhtmlNewBookFivetoend; ?></div>
    </div>
</div>