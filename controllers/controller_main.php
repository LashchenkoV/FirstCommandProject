<?php
function action_index(){
    //core_loadModel("humans");
    //$humans = model_humans_getAll();
    //core_render("main",["humans"=>$humans,"title"=>"My site::Главная"]);
    return core_render("main",["title"=>"My site::Главная","m"=>action_service()]);
}

function action_service(){
    return core_render_view("service",["a"=>rand(1,10)]);
}

function action_reg(){
    if(is_empty(@$_POST["login"],@$_POST["pass1"],@$_POST["pass2"]) || !auth_register($_POST["login"],$_POST["pass1"],$_POST["pass2"])){
       $arr = [
           "register"=>'0',
           "error"=>"Ошибка регистрации"
       ];
    }
    else{
        $arr = ["register"=>'1'];
    }
    return json_encode($arr);

}

function action_register(){
    return core_render("register",["title"=>"My site::Регистрация","m"=>action_service()]);
}
function action_login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_login($_POST["login"],$_POST["pass"])){
        $arr = [
            "auth"=>'0',
            "error"=>"Ошибка авторизации"
        ];
    }
    else
        $arr = ["auth"=>'1'];
    return json_encode($arr);
}

function action_logout(){
    auth_logout();
    header("Location:/");
}