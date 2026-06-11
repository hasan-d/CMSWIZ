<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "cms_db";

$conn = new mysqli($host, $user, $password, $database);
if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

define('BASE_PATH',__DIR__);
define('UPLOADS_PATH',BASE_PATH . '/uploads');
define('SITE_URL','http://localhost/CMSWIZ');

$site_settings = [];
$result = $conn->query("SELECT `key`, `value` FROM settings");
if($result){
    while($row = $result->fetch_assoc()){
        $site_settings[$row['key']] = $row['value'];
    }
}


require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/functions/auth.php';
require_once __DIR__ . '/functions/media.php';
require_once __DIR__ . '/functions/menu.php';
require_once __DIR__ . '/functions/helpers.php';
?>