<?php

function model_humans_add(string $name,string $surname,int $year):void{
    core_appendToArrayInFile("humans",[
        "id"=>time(),
        "name"=>$name,
        "surname"=>$surname,
        "year"=>$year,
    ]);

}


function model_humans_getAll():array {
    return core_loadArrayFromFile("humans");
}


function model_humans_getById(int $id){
    $humans = model_humans_getAll();
    foreach ($humans as $human){
       if($human["id"]==$id)return $human;
    }
    return NULL;
}


function model_humans_deleteById(int $id):void{
    $humans = model_humans_getAll();
    $res = [];
    foreach ($humans as $human){
        if ($human["id"]!=$id) $res[]= $human;
    }
    core_saveArrayToFile("humans",$res);
}