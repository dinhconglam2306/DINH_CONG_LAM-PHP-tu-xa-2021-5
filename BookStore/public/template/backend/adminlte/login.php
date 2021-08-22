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
    <?php require_once APPLICATION_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
    <?php echo $this->_pluginsJsFiles; ?>
    <?php echo $this->_jsFiles; ?>
</body>

</html>