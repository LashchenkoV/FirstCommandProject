<?php
/**
 * Возвращает список груп пользователя
 * @return array
 */
function group_getList(){
    $groups = core_loadArrayFromFile('groups');
    $listGroup = [];
    foreach ($groups as $group) {
        if($group['id_admin'] == $_SESSION['user_id']) $listGroup[]=$group;
    }
    return $listGroup;
}

/**
 * Проверяет есть ли уже данная группа(по id)
 * @param $id
 * @return bool
 */
function group_isGroup($id){
    $groups = core_loadArrayFromFile('groups');
    foreach ($groups as $group)
        if($group['id']==$id) return true;
    return false;
}

/**
 * Возвращает имя группы по id
 * @param int $id
 * @return string|false
 */
function group_getName($id){
    $groups = core_loadArrayFromFile('groups');
    foreach ($groups as $group)
        if($group['id']==$id) return $group['name'];
    return false;
}

/**
 * Создает новую группу
 * @param $group - имя
 * @return int - id новой группы
 */
function group_addNew($group){
    define("ID_GROUP",getRandomId());
    $data = [
        "id"=>ID_GROUP,
        "id_admin"=>$_SESSION['user_id'],
        "name"=>$group,
    ];
    core_appendToArrayInFile("groups", $data);
    return ID_GROUP;
}