<?php

/**
 * Страница всех консультаций
 * @return string
 */
function action_list(){
    if(!is_empty(@$_GET['id'])){
        core_loadModel("admin_consult");
        core_loadModel("admin_student");
        return core_render("moreOneConsult", [
            "title"=>"Консультация №$_GET[id]",
            "tableStudent"=>student_getListForTable($_GET['id']),
            "infoConsult"=>consult_getInfo($_GET['id'])
        ],"admin");
    }
    core_loadModel("admin_consult");
    return core_render("listConsult", [
        "title"=>"Список консультаций",
        "listConsult"=>consult_getList()
    ],"admin");
}

/**
 * Запускается при запросе списка всех консульатцяй
 * @return string
 */
function action_list_consult(){
    return core_render("listConsult",["title"=>"Список консультаций"], "admin");
}