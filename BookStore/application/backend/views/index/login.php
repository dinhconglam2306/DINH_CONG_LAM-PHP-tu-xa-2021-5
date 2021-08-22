<?php
$linkAction = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'login');
$userName   = FormBackend::createInputFormLogin('text','form[username]','mod-login-username' ,'UserName', 'fas fa-user');
$passWord   = FormBackend::createInputFormLogin('text','form[password]','mod-login-password' , 'Password', 'fas fa-lock');
$button     = FormBackend::createButtonFormLogin('submit', "Sign In");
$inputHidden = FormBackend::input('hidden','form[token]',time());
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?= $xhtmlError = $this->errors ?? ''; ?>
            <form action="<?= $linkAction; ?>" method="post">
                <?= $userName . $passWord; ?>
                <div class="row">
                    <div class="col-12">
                        <?= $inputHidden . $button; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>