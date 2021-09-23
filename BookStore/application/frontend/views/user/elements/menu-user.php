<?php

$linkUserInfo     = URL::createLink('frontend', 'user', 'index', null, 'my-account.html');
$linkChangePw       = URL::createLink('frontend', 'user', 'changePw', null, 'change-password.html');
$linkOrderHistory = URL::createLink('frontend', 'user', 'orderHistory', null, 'history.html');
$linkCheckStatusOrder = URL::createLink('frontend', 'user', 'checkStatus', null, 'history.html');
$linkLogout       = URL::createLink('frontend', 'index', 'logout');

?>

<li class=""><a data="user-index" href="<?= $linkUserInfo; ?>">Thông tin tài khoản</a></li>
<li class=""><a data="user-changePw" href="<?= $linkChangePw; ?>">Thay đổi mật khẩu</a></li>
<li class=""><a data="user-orderHistory" href="<?= $linkOrderHistory; ?>">Lịch sử đơn hàng</a></li>
<li class=""><a href="<?= $linkLogout; ?>">Đăng xuất</a></li>