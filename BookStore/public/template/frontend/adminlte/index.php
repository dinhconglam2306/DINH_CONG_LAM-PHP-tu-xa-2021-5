<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->_metaHTTP; ?>
    <?= $this->_metaName; ?>
    <title><?= $this->_title; ?></title>
    <link rel="icon" href="<?= $this->_dirImg ?>favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?= $this->_dirImg ?>favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">
    <?= $this->_cssFiles; ?>
</head>

<body>
    <?php require_once 'html/header.php'; ?>
    <?php require_once APPLICATION_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
    <?php require_once 'html/footer.php'; ?>
    <?php require_once 'html/tap-top.php'; ?>

    <?= $this->_jsFiles; ?>
    <?php

    //Active Menu
    $controller = !empty($this->arrParam['controller']) ? $this->arrParam['controller'] : 'index';


    //Active menu of User in my-accout.html
    $controllerUser  = !empty($this->arrParam['controller']) ? $this->arrParam['controller'] : 'index'; ;
    $actionUser      = !empty($this->arrParam['action']) ? $this->arrParam['action'] : 'index'; ;
    $dataUser  =    $controllerUser . '-' . $actionUser;

    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('li a[data-controller=<?= $controller ;?>').addClass('my-menu-link active');
            $(`a[data=<?= $dataUser ;?>`).parent().addClass('active');
        })
    </script>
    <script>
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
            document.getElementById("search-input").focus();
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>
    <?php
    if (Session::get('notify')) {
        $notify = Session::get('notify');
        echo sprintf('
            <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer)
                  toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
              })
              Toast.fire({
                        position: "top-end",
                        icon:"%s",
                        title:"%s"
                    });
            </script>
            ', $notify['type'], $notify['title']);
        Session::delete('notify');
    }
    if (Session::get('success')) {
        $success = Session::get('success');
        echo sprintf('
            <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer)
                  toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
              })
              Toast.fire({
                        position: "top-end",
                        icon:"%s",
                        title:"%s"
                    });
            </script>
            ', $success['type'], $success['title']);
        Session::delete('success');
    }
    ?>
</body>

</html>