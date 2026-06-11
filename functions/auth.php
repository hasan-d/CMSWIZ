<?php

function login($email, $password){
    $user = db_selectOne('users', ['email' => $email]);
    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        return true;
    }
    return false;
}

function is_logged_in(){
    return isset($_SESSION['user_id']);
}

function has_role($role){
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function logout(){
    session_destroy();
}

function redirect($url){
    header("Location: ". $url);
    exit();
}
?>