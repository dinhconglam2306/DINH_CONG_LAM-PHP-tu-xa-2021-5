<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Tokyo');
require_once 'define.php';
require_once 'define_notice.php';

function __autoload($clasName)
{
	require_once LIBRARY_PATH . "{$clasName}.php";
}

Session::init();
$bootstrap = new Bootstrap();
$bootstrap->init();
