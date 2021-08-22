<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo '<pre>';
    print_r($this->_title);
    echo '</pre>'; ?>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <title><?= $this->_title; ?></title>
    <link rel="icon" href="<?= $this->_dirImg ?>favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?= $this->_dirImg ?>favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/phone-ring.css">
    <?php echo $this->_cssFiles; ?>
</head>

<body>
    <?php require_once 'html/header.php'; ?>
    <?php require_once APPLICATION_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
    <?php require_once 'html/footer.php'; ?>
    <?php require_once 'html/tap-top.php'; ?>

    <?php echo $this->_jsFiles; ?>
    <script>
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
            document.getElementById("search-input").focus();
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>
</body>

</html>