<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Tokyo');
require_once 'define.php';
require_once 'define_notice.php';

function __autoload($clasName)
{
	$fileName = PATH_LIBRARY . "{$clasName}.php";
	if (file_exists($fileName)) require_once $fileName;
}

Session::init();
$bootstrap = new Bootstrap();
$bootstrap->init();
