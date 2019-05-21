<?php
session_start();

define('SITE_DIR', __DIR__ . '/../');
define('CONFIG_DIR', SITE_DIR . 'config/');
define('DATA_DIR', SITE_DIR . 'data/');
define('ENGINE_DIR', SITE_DIR . 'engine/');
define('WWW_DIR', SITE_DIR . 'public/');
define('TEMPLATES_DIR', SITE_DIR . 'templates/');

define('IMG_DIR', 'img/');


define('DB_HOST', 'localhost');
define('DB_USER', 'geek_brains');
define('DB_PASS', '123123');
define('DB_NAME', 'php-lv1');


require_once ENGINE_DIR . 'functions.php';
require_once ENGINE_DIR . 'db.php';
require_once ENGINE_DIR . 'news.php';
require_once ENGINE_DIR . 'gallery.php';
require_once ENGINE_DIR . 'reviews.php';
require_once ENGINE_DIR . 'calc.php';
require_once ENGINE_DIR . 'catalog.php';
require_once ENGINE_DIR . 'login.php';

