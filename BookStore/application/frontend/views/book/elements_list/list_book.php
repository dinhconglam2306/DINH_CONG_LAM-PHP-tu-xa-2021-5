<?php
if (!empty($this->listBooks)) {
    foreach ($this->listBooks as $item) {
        @$xhtmlListBook .= sprintf('<div class="col-xl-3 col-6 col-grid-box">%s</div>', HelperFrontend::showProduct($item, $this->arrParam));
    }
} else {
    $xhtmlListBook = 'Dữ liệu đang cập nhật!';
}
?>
<?= $xhtmlListBook; ?>
<?php 

?>