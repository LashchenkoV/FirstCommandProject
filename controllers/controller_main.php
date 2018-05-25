<?php
function action_index(){
    //core_loadModel("humans");
    //$humans = model_humans_getAll();
    //core_render("main",["humans"=>$humans,"title"=>"My site::Главная"]);
    return core_render("main",["title"=>"My site::Главная","m"=>action_service()]);
}

function action_service(){
    $a = rand(1,10);
    return core_render_view("service",["a"=>$a]);
}

function action_reg(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_register($_POST["login"],$_POST["pass"]))
        return "Произошла ошибка регистрации";
    header("Location:/");
}

function action_register(){
    return core_render("register",["title"=>"My site::Регистрация","m"=>action_service()]);
}
function action_login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_login($_POST["login"],$_POST["pass"])) return "Произошла ошибка авторизации";
    header("Location:/");
}

function action_logout(){
    auth_logout();
    header("Location:/");
}