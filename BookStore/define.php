<?php

// ====================== PATHS ===========================
define('DS', '/');
define('ROOT_PATH', dirname(__FILE__));						        // Định nghĩa đường dẫn đến thư mục gốc
define('LIBRARY_PATH', ROOT_PATH . DS . 'libs' . DS);			    // Định nghĩa đường dẫn đến thư mục thư viện
define('LIBRARY_EXT_PATH', LIBRARY_PATH . 'extends' . DS);			    // Định nghĩa đường dẫn đến thư mục thư viện
define('PUBLIC_PATH', ROOT_PATH . DS . 'public' . DS);			    // Định nghĩa đường dẫn đến thư mục public							
define('UPLOAD_PATH', PUBLIC_PATH . 'files' . DS);			    // Định nghĩa đường dẫn đến thư mục public							
define('APPLICATION_PATH', ROOT_PATH . DS . 'application' . DS);	// Định nghĩa đường dẫn đến thư mục public							
define('TEMPLATE_PATH', PUBLIC_PATH . 'template' . DS);		        // Định nghĩa đường dẫn đến thư mục public							

define('ROOT_URL', DS . 'DINH_CONG_LAM-PHP-tu-xa-2021-5' . DS . 'BookStore' . DS);
define('APPLICATION_URL', ROOT_URL . 'application' . DS);
define('PUBLIC_URL', ROOT_URL . 'public' . DS);
define('UPLOAD_URL', PUBLIC_URL . 'files' . DS);
define('TEMPLATE_URL', PUBLIC_URL . 'template' . DS);

define('DEFAULT_MODULE', 'backend');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'login');

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

// ====================== CONFIG ===========================
define('TIME_LOGIN', 3600);


