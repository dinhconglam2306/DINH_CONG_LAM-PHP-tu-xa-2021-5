<?php
// Danh sách book special of category
foreach ($this->newBook as $key => $item) {
    $link = URL::createLink('frontend', 'book', 'detail', ['book_id' => $item['id']]);
    $name = $item['name'];
    $picture            = sprintf('<img class="img-fluid blur-up lazyload" src="%s" alt="%s">', UPLOAD_URL . 'book' . DS . 'default.png', $name);
    $picturePath        = UPLOAD_PATH . 'book' . DS . $item['picture'];
    if (file_exists($picturePath) && !empty($item['picture']))  $picture  = sprintf('<img style="max-width:90px; background-position:center,center;" class="img-fluid blur-up lazyload" src="%s" alt="%s">', UPLOAD_URL . 'book' . DS . $item['picture'], $name);
    $price = number_format(($item['price'] * (100 - $item['sale_off'])) / 100);

    $xhtmlNewBook = sprintf('
        <div class="media">
            <a href="%s"> %s </a>
            <div class="media-body align-self-center">
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <a href="%s" title="%s">
                    <h6>%s</h6>
                </a>
                <h4 class="text-lowercase">%s đ</h4>
            </div>
        </div>
    ', $link, $picture, $link, $name, $name, $price);
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