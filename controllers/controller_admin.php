<?php
function action_index(){
    return core_render("consult",["title"=>"Админ панель"], "admin");
}

function action_list(){
    return core_render("listConsult",["title"=>"Список консультаций"], "admin");
}

function action_dataTableConsult(){
    return core_render_view("dataTableConsult");
}
function action_startConsult(){
    if($_POST ||  _startConsult()==false){
        $arr = [
          "start"=>"0",
          "error"=>"Ошибка старта консультации!",
        ];
    }
    else {
        $arr = [
            "start"=>"1",
            "text"=>action_dataTableConsult()
        ];
    }
    return json_encode($arr);
}