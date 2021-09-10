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

                $saleOff = $valueBook['sale_off'];
                $linkBook = URL::createLink('frontend','book','detail',['book_id' => $valueBook['id']]);


                $picture            = sprintf('<img src="%s" class="img-fluid blur-up lazyload bg-img" alt="">', UPLOAD_URL . 'book' . DS . 'default.png');
                $picturePath        = UPLOAD_PATH . 'book' . DS . $valueBook['picture'];
                if (file_exists($picturePath) && !empty($valueBook['picture']))  $picture  = sprintf('<img src="%s"  class="img-fluid blur-up lazyload bg-img" alt="">', UPLOAD_URL . 'book' . DS . $valueBook['picture']);
                $linkAdd = '#';
                $linkView = '#';
                $description        = $valueBook['description'];

                $price              = number_format($valueBook['price']);
                $priceSale          = number_format(($valueBook['price'] * (100 - $valueBook['sale_off'])) / 100);

                $dataUrl = URL::createLink($this->arrParam['module'],$this->arrParam['controller'],'quickViewBook',['book_id' => 'value_new']);
                $xhtmlBooks .= '<div class="product-box">
                        <div class="img-wrapper">
                            <div class="lable-block">
                                <span class="lable4 badge badge-danger"> -' . $saleOff . '%</span>
                            </div>
                            <div class="front">
                                <a href="' . $linkBook . '">' . $picture . '</a>
                            </div>
                            <div class="cart-info cart-wrap">
                                <a href="' . $linkAdd . '" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                <a href="' . $linkView . '" title="Quick View"><i class="ti-search" data-id="'.$valueBook['id'].'" data-url="'.$dataUrl.'" data-toggle="modal" data-target="#quick-view"></i></a>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <a href="'.$link.'" title="' . $description . '">
                                <h6 class="description"><span>' . $description . '</span></h6>
                            </a>
                            <h4 class="text-lowercase">' . $priceSale . ' đ <del>' . $price . ' đ</del></h4>
                        </div>
                    </div>';
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
        <?= $xhtmlCategorySpecial; ?>
        <!-- <li class="current"><a href="tab-category-1" class="my-product-tab" data-category="1">Bà mẹ - Em bé</a></li>
        <li><a href="tab-category-5" class="my-product-tab" data-category="5">Học Ngoại Ngữ</a></li>
        <li><a href="tab-category-3" class="my-product-tab" data-category="3">Công Nghệ ThôngTin</a></li> -->
    </ul>
    <div class="tab-content-cls">
        <!-- <div id="tab-category-1" class="tab-content active default">
            <div class="no-slider row tab-content-inside">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
            </div>
            <div class="text-center"><a href="list.html" class="btn btn-solid">Xem tất cả</a></div>
        </div>
        <div id="tab-category-5" class="tab-content ">
            <div class="no-slider row tab-content-inside">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
            </div>
            <div class="text-center"><a href="list.html" class="btn btn-solid">Xem tất cả</a></div>
        </div>
        <div id="tab-category-3" class="tab-content ">
            <div class="no-slider row tab-content-inside">
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
                <div class="product-box">
                    <div class="img-wrapper">
                        <div class="lable-block">
                            <span class="lable4 badge badge-danger"> -35%</span>
                        </div>
                        <div class="front">
                            <a href="item.html">
                                <img src="<?= $this->_dirImg ?>product.jpg" class="img-fluid blur-up lazyload bg-img" alt="product">
                            </a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="item.html" title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores reprehenderit incidunt vero aperiam, ipsum natus.">
                            <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius,
                                quasi ...</h6>
                        </a>
                        <h4 class="text-lowercase">48,020 đ <del>98,000 đ</del></h4>
                    </div>
                </div>
            </div>
            <div class="text-center hello"><a href="#" class="btn btn-solid">Xem tất cả</a></div>
        </div> -->
        <?= $xhtmlBooks; ?>
    </div>
</div>