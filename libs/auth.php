<?php

session_start();

function _auth_getUsersArray(){
    return core_loadArrayFromFile("users");
}

function _auth_saveUsersArray($users){
    core_saveArrayToFile("users", $users);
}

function _auth_getUserById($id){
    foreach (_auth_getUsersArray() as $u) if($u["id"]==$id) return $u;
    return NULL;
}

function auth_register(string $login, string $pass1, string $pass2): bool
{
    if($pass1!=$pass2 || strlen($pass1)<3) return false;
    $users = _auth_getUsersArray();
    foreach ($users as $user)
        if ($user["login"] == $login) return false;

    $users[] = [
        "id" =>getRandomId(),
        "login" => $login,
        "pass" => md5($pass1)
    ];

    _auth_saveUsersArray($users);
    return true;
}

function auth_login(string $login,string $pass):bool
{
    $users = _auth_getUsersArray();
    $current_user = NULL;
    foreach ($users as $user)
        if ($user["login"] == $login) {
            $current_user = $user;
            break;
        }
    if ($current_user === NULL) return false;
    if($current_user["pass"]!==md5($pass)) return false;

    $_SESSION["user_id"] = $current_user["id"];
    $_SESSION["user_ip"] = md5($_SERVER["REMOTE_ADDR"]);
    $_SESSION["user_agent"] = md5($_SERVER["HTTP_USER_AGENT"]);
    return true;
}


function auth_is_auth():bool{
    $id = @$_SESSION["user_id"];
    $agent = @$_SESSION["user_agent"];
    $ip = @$_SESSION["user_ip"];
    if(is_empty($id,$agent,$ip))return false;
    if($ip!=md5($_SERVER["REMOTE_ADDR"])||$agent!=md5($_SERVER["HTTP_USER_AGENT"])) return false;
    if(_auth_getUserById($id)===NULL) return false;
    return true;
}

function auth_logout(){
    session_destroy();
}

function auth_getCurrentUser(){
    if(!auth_is_auth()) return NULL;
    return _auth_getUserById($_SESSION["user_id"]);
}