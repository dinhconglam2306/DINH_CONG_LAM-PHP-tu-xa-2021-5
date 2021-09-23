<?php
/*----------SEARCH-START-----------------*/

//Input Search
$inputSearch =  FormBackend::inputSearch('text', 'search', 'search_input', 'Tìm kiếm sách...');

//Input Hidden

$categoryID = $this->arrParam['category_id'] ?? 'all';

$inputHiddenModule         = FormBackend::input('hidden', 'module', 'frontend');
$inputHiddenController     = FormBackend::input('hidden', 'controller', 'book');
$inputHiddenAction         = FormBackend::input('hidden', 'action', 'list');
$inputHiddenCategoryId     = FormBackend::input('hidden', 'category_id', $categoryID);

$formSearch = $inputHiddenModule . $inputHiddenController . $inputHiddenAction  . $inputHiddenCategoryId;


$actionForm = '';
if (URL_FRIENDLY == true) {
    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $url = explode('/', $url);
    $link = $url[count($url) - 1];
    // $url = explode('&', $url);
    // if (array_key_exists('search', $url)) unset($url['search']);
    // $link = $url[0];
    // $link = URL::getURL('search');
    if ($link == 'index.html') {
        $actionForm = 'tat-ca-all.html';
    } else {
        $actionForm = $link;
    }
    $formSearch = '';
}

/*----------SEARCH-END-----------------*/

$userObj    = Session::get('user');

$model      = new Model();

$query      = "SELECT `name`,`id` FROM `category` WHERE `status` = 'active' ORDER BY `ordering` ASC";
$category   = $model->fetchAll($query);


$categoryXhtml = '<ul>';
if (!empty($category)) {
    foreach ($category as $key => $value) {
        $id = $value['id'];
        $name = $value['name'];
        $nameURL = URL::filterURL($name) . '-' . $id . '.html';
        $link = URL::createLink('frontend', 'book', 'list', ['category_id' => $id], $nameURL);
        $categoryXhtml .= sprintf('<li><a href="%s">%s</a></li>', $link, $name);
    }
}

$categoryXhtml .= '</ul>';

//Link menu
$linkListBook               = URL::createLink('frontend', 'book', 'list', ['category_id' => 'all'], 'tat-ca-all.html');
$linkHome                   = URL::createLink('frontend', 'index', 'index', null, 'index.html');
$linkRegister               = URL::createLink('frontend', 'index', 'register', null, 'register.html');
$linkLogin                  = URL::createLink('frontend', 'index', 'login', null, 'login.html');
$linkLogout                 = URL::createLink('frontend', 'index', 'logout', null, 'logout.html');
$linkAdminControllPanel     = URL::createLink('backend', 'dashboard', 'index');
$linkMyProfile              = URL::createLink('frontend', 'user', 'index', null, 'my-account.html');
$linkCategory               = URL::createLink('frontend', 'category', 'list', null, 'category.html');

$userName = '';

//Menu Đăng nhập -  Đăng ký - Admin Control Panel
$controlMenu = [];

if (@$userObj['login'] == 1 && @$userObj['info']['group_acp'] == 1) {
    $controlMenu[] = ['link' => $linkAdminControllPanel, 'name' => 'Quản lý web'];
    $controlMenu[] = ['link' => $linkMyProfile, 'name' => 'My Profile'];
    $controlMenu[] = ['link' => $linkLogout, 'name' => 'Thoát'];
    $userName = sprintf('<span>%s</span>', @$userObj['info']['fullname']);
}
if (@$userObj['group_acp'] == 0 && @$userObj['status'] == 'active') {
    $controlMenu[] = ['link' => $linkMyProfile, 'name' => 'My Profile'];
    $controlMenu[] = ['link' => $linkLogout, 'name' => 'Thoát'];
    $userName = sprintf('<span>%s</span>', @$userObj['info']['fullname']);
}
if (@$userObj['login'] != 1) {
    $controlMenu[] = ['link' => $linkLogin, 'name' => 'Đăng nhập'];
    $controlMenu[] = ['link' => $linkRegister, 'name' => 'Đăng ký'];
}


foreach ($controlMenu as $key => $value) {
    @$xhtml .= sprintf(' <li><a href="%s">%s</a></li>', $value['link'], $value['name']);
}
?>
<div class="loader_skeleton">
    <div class="typography_section">
        <div class="typography-box">
            <div class="typo-content loader-typo">
                <div class="pre-loader"></div>
            </div>
        </div>
    </div>
</div>
<header class="my-header sticky">
    <div class="mobile-fix-option"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="brand-logo">
                            <a href="<?= $linkHome; ?>">
                                <h2 class="mb-0" style="color: #5fcbc4">BookStore</h2>
                            </a>
                        </div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                                    </li>
                                    <li><a href="<?= $linkHome; ?> " data-controller='index'>Trang chủ</a></li>
                                    <li><a href="<?= $linkListBook; ?>" data-controller='book'>Sách</a></li>
                                    <li><a href="<?= $linkCategory; ?>" data-controller='category'>Danh mục</a><?= $categoryXhtml; ?></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="top-header">
                            <ul class="header-dropdown">
                                <li class="onhover-dropdown mobile-account">
                                    <img id="avatar" src="<?= $this->_dirImg ?>avatar.png" alt="avatar">
                                    <?= $userName; ?>
                                    <ul class="onhover-show-div">
                                        <?= $xhtml; ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div>
                                            <img src="<?= $this->_dirImg ?>search.png" onclick="openSearch()" class="img-fluid blur-up lazyload" alt="">
                                            <i class="ti-search" onclick="openSearch()"></i>
                                        </div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div>
                                                <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form action="<?= $actionForm; ?>" method="GET">
                                                                    <div class="form-group">
                                                                        <?= $formSearch; ?>
                                                                        <?= $inputSearch; ?>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-cart">
                                        <?php require_once 'elements/cart.php'; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>