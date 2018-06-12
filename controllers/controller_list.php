<?php

/**
 * Страница всех консультаций
 * @return string
 */
function action_list(){
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