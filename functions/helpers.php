<?php 
function set_flash($key, $message){
    $_SESSION['flash'][$key] = $message;
}
function get_flash($key){
    if(isset($_SESSION['flash'][$key])){
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return '';
}

function has_flash($key){
    return isset($_SESSION ['flash'][$key]);
}
function sanitize($input){
    return trim(htmlspecialchars($input));
}

function slugify($text) {
    $text = preg_replace('/[^a-zA-Z0-9-]/', '-', strtolower(trim($text)));
    return trim(preg_replace('/-+/', '-', $text), '-');
}
?>