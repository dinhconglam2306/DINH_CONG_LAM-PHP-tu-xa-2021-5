<?php

// ====================== PATHS ===========================
define('DS', '/');
define('PATH_ROOT', dirname(__FILE__));						        // Định nghĩa đường dẫn đến thư mục gốc
define('PATH_LIBRARY', PATH_ROOT . DS . 'libs' . DS);			    // Định nghĩa đường dẫn đến thư mục thư viện
define('PATH_LIBRARY_EXT', PATH_LIBRARY . 'extends' . DS);			    // Định nghĩa đường dẫn đến thư mục thư viện
define('PATH_PUBLIC', PATH_ROOT . DS . 'public' . DS);			    // Định nghĩa đường dẫn đến thư mục public							
define('PATH_UPLOAD', PATH_PUBLIC . 'files' . DS);			    // Định nghĩa đường dẫn đến thư mục public							
define('PATH_APPLICATION', PATH_ROOT . DS . 'application' . DS);	// Định nghĩa đường dẫn đến thư mục public							
define('PATH_TEMPLATE', PATH_PUBLIC . 'template' . DS);		        // Định nghĩa đường dẫn đến thư mục public							

define('URL_ROOT', DS . 'DINH_CONG_LAM-PHP-tu-xa-2021-5' . DS . 'BookStore' . DS);
define('URL_APPLICATION', URL_ROOT . 'application' . DS);
define('URL_PUBLIC', URL_ROOT . 'public' . DS);
define('URL_UPLOAD', URL_PUBLIC . 'files' . DS);
define('URL_TEMPLATE', URL_PUBLIC . 'template' . DS);

define('DEFAULT_MODULE', 'frontend');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');

// ====================== DATABASE ===========================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bookstore');
define('DB_TABLE', 'group');

// ====================== DATABASE GROUP ===========================
define('TBL_GROUP', 'group');
define('TBL_USER', 'user');
define('TBL_PRIVILEGE', 'privilege');
define('TBL_CATEGORY', 'category');
define('TBL_BOOK', 'book');
define('TBL_CART', 'cart');

// ====================== CONFIG ===========================
define('TIME_LOGIN', 3600);

define('URL_FRIENDLY',true);


