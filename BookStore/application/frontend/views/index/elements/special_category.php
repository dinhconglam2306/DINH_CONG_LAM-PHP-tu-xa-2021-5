<?php
if (!empty($this->categorySpecial)) {
    foreach ($this->categorySpecial as $key => $valueCategorySpecial) {
        $categorySpecialID   = $valueCategorySpecial['id'];
        $categorySpecialName = $valueCategorySpecial['name'];
        $active = '';
        $class = '';
        if ($key == 0) {
            $active = 'current';
            $class  = 'active default';
        }
        @$xhtmlCategorySpecial .= sprintf('<li class="%s"><a href="tab-category-%s" class="my-product-tab" data-category="%s">%s</a></li>', $active, $categorySpecialID, $categorySpecialID, $categorySpecialName);

        @$xhtmlBooks .= sprintf('<div id="tab-category-%s" class="tab-content %s">
                                    <div class="no-slider row tab-content-inside">', $valueCategorySpecial['id'], $class);
        if (!empty($valueCategorySpecial['books'])) {
            foreach ($valueCategorySpecial['books'] as $keyBook => $valueBook) {
                $xhtmlBooks .= HelperFrontend::showProduct($valueBook, $this->arrParam);
            }
        }
        $link = URL::createLink('frontend', 'book', 'list', ['category_id' => $valueCategorySpecial['id']]);
        $xhtmlBooks .= sprintf('</div>
                                <div class="text-center"><a href="%s" class="btn btn-solid">Xem tất cả</a></div>
                            </div>', $link);
    }
}
?>
<div class="theme-tab">
    <ul class="tabs tab-title">
        <?= @$xhtmlCategorySpecial; ?>
    </ul>
    <div class="tab-content-cls">
        <?= @$xhtmlBooks; ?>
    </div>
</div>