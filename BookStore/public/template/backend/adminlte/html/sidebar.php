<?php
$userObj = Session::get('user');
$sidebarName = $userObj['info']['fullname'];
$linkProfile  = URL::createLink('backend', 'dashboard', 'profile');

$linkDashboard = URL::createLink('backend', 'dashboard', 'index');

$linkGroupList     = URL::createLink('backend', 'group', 'index');
// $linkGroupForm = URL::createLink('backend','group','form');

$linkUserList = URL::createLink('backend', 'user', 'index');
$linkUserForm = URL::createLink('backend', 'user', 'form');

$linkCategoryList = URL::createLink('backend', 'category', 'index');
$linkCategoryForm = URL::createLink('backend', 'category', 'form');


$linkBookList = URL::createLink('backend', 'book', 'index');
$linkBookForm = URL::createLink('backend', 'book', 'form');


$dashBoard   = HelperBackend::BackEndMenuDashBoard($linkDashboard);

@$group     = HelperBackend::BackEndMenu('group', 'fas fa-users', 'Group', ['List|index' => $linkGroupList]);
$user     = HelperBackend::BackEndMenu('user', 'fas fa-user', 'User', ['List|index' => $linkUserList, 'Add|form' => $linkUserForm]);
$category     = HelperBackend::BackEndMenu('category', 'fas fa-thumbtack', 'Category', ['List|index' => $linkCategoryList, 'Add|form' => $linkCategoryForm]);
$book     = HelperBackend::BackEndMenu('book', 'fas fa-book-open', 'Book', ['List|index' => $linkBookList, 'Add|form' => $linkBookForm]);
?>
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $linkDashboard; ?>" class="brand-link">
        <img src="<?= $this->_dirImg ?>logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Admin Control Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $this->_dirImg ?>avatar.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $sidebarName; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" id="nav-parent" data-widget="treeview" role="menu" data-accordion="false">
                <?= $dashBoard . $group . $user . $category . $book; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>