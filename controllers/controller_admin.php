<?php
function action_index(){
    return core_render("consault",["title"=>"Админ панель"], "admin");
}

function action_list(){
    return core_render("listConsult",["title"=>"Список консультаций"], "admin");
}