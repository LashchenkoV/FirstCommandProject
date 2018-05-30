<?php
function action_index(){
    //core_loadModel("humans");
    //$humans = model_humans_getAll();
    //core_render("main",["humans"=>$humans,"title"=>"My site::Главная"]);
    return core_render("main",["title"=>"Вход"]);
}


function action_reg(){
    if(is_empty(@$_POST["login"],@$_POST["pass1"],@$_POST["pass2"]) || !auth_register($_POST["login"],$_POST["pass1"],$_POST["pass2"])){
       return json_encode([
           "register"=>'0',
           "error"=>"Ошибка регистрации"
       ]);
    }
    return json_encode(["register"=>'1']);
}

function action_register(){
    return core_render("register",["title"=>"Регистрация","m"=>action_service()]);
}
function action_login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_login($_POST["login"],$_POST["pass"])) {
        return json_encode([
            "auth" => '0',
            "error" => "Ошибка авторизации"
        ]);
    }
    return json_encode(["auth"=>'1']);}

function action_logout(){
    auth_logout();
    header("Location:/");
}