<?php
// Session::delete('cart');
$cart = Session::get('cart');
$totalItems = 0;
if(!empty($cart))$totalItems = array_sum($cart['quantity']);

$linkCart = URL::createLink('frontend','user','cart',null,'cart.html');
?>
<div>
    <a href="<?= $linkCart ;?>" id="cart" class="position-relative">
        <img src="<?= $this->_dirImg ?>cart.png" class="img-fluid blur-up lazyload" alt="cart">
        <i class="ti-shopping-cart"></i>
        <span class="badge badge-warning badge-items"><?= $totalItems ;?></span>
    </a>
</div>