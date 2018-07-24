<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'freshpages');

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

// Create connection
$pdo = new PDO(
    "mysql:host=" . HOST . ";dbname=" . DB, //DSN
    USER, 
    PASS,
    $pdoOptions 
);

