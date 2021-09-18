<?php
foreach ($this->category as $key => $value) {
    $id = $value['id'];
    $name = $value['name'];
    $textClass = 'my-text-primary';
    
    $nameURL = URL::filterURL($value['name']);

    if (isset($this->arrParam['category_id'])) {
        $catID = $this->arrParam['category_id'];
        $nameURL = "$nameURL-$id.html";
        $link = URL::createLink('frontend', 'book', 'list', ['category_id' => $id ],$nameURL);
        $textClass = 'text-dark';
        if ($value['id'] == $catID) $textClass = 'my-text-primary'; if ($value['id'] == $catID) $textClass = 'my-text-primary';
    }

    if ($key > 10) $moreClass = 'more-item';
    @$xhtmlCategory .= sprintf('
   <div class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
        <a class="%s %s" href="%s"> %s </a>
   </div>
   ', $textClass, $moreClass, $link, $name);
}
?>
<div class="collection-filter-block">
    <!-- brand filter start -->
    <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
    <div class="collection-collapse-block open">
        <h3 class="collapse-block-title">Danh mục</h3>
        <div class="collection-collapse-block-content">
            <div class="collection-brand-filter">
                <?= @$xhtmlCategory; ?>
            </div>
        </div>
    </div>
</div>