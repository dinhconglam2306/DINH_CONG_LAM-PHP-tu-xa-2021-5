<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->_metaHTTP; ?>
    <?= $this->_metaName; ?>
    <title><?= $this->_title; ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <?= $this->_pluginsCssFiles; ?>
    <?= $this->_cssFiles; ?>
</head>

<body class="hold-transition login-page">
    <?php require_once PATH_APPLICATION . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
    <?php echo $this->_pluginsJsFiles; ?>
    <?php echo $this->_jsFiles; ?>

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
    ?>
</body>

</html>