<?php 
    $linkDashboard = URL::createLink('backend','index','index');

    $linkGroupList     = URL::createLink('backend','group','index');
    $linkGroupForm = URL::createLink('backend','group','form');

    $linkUserList = URL::createLink('backend','user','index');
    $linkUserForm = URL::createLink('backend','user','form');

    $linkCategoryList = URL::createLink('backend','category','index');
    $linkCategoryForm = URL::createLink('backend','category','form');

    $linkBookList = URL::createLink('backend','book','index');
    $linkBookForm = URL::createLink('backend','book','form');


    $dashBoard   =HelperBackend::BackEndMenuDashBoard($linkDashboard);
    
    $group     = HelperBackend::BackEndMenu('group','fas fa-users','Group',$linkGroupList,$linkGroupForm);
    $user     = HelperBackend::BackEndMenu('user','fas fa-user','User',$linkUserList,$linkUserForm);
    $category     = HelperBackend::BackEndMenu('category','fas fa-thumbtack','Category',$linkCategoryList,$linkCategoryForm);
    $book     = HelperBackend::BackEndMenu(' ','fas fa-book-open','Book',$linkBookList,$linkBookForm);
?>
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
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
                <a href="#" class="d-block">ZendVN</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <?= $dashBoard . $group . $user . $category . $book; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>