<?php
/**
 * Главная страница админ панели
 * @return string
 */
function action_index(){
    $data = [
        "title"=>"Админ панель",
        "content"=>action_getContentTable()
    ];
    return core_render("consult",$data,"admin");
}

/**
 * Запускается при запросе обновления таблицы
 * @return mixed
 */
function action_getContentTable(){
    core_loadModel("admin_consult");
    return consult_isStart()?get_contentStartConsult():get_contentNoStartConsult();
}

/**
 * Запускается при запросе показа модального окна добавления студ.
 * @return mixed
 */
function action_getModalAddStudent(){
    return core_render_view("modalAddStudent");
}


/**
 * Запускается при запросе списка груп
 * @return mixed
 */
function action_getGroupList(){
    core_loadModel("admin_group");
    return json_encode(group_getList());
}


/**
 * Запускается при запросе списка студентов
 * @return mixed
 */
function action_getStudentList(){
    core_loadModel("admin_student");
    if(is_empty(@$_POST['id_group'])) return false;
    return json_encode(student_getListInGroup($_POST['id_group']));
}

/**
 * Запускается при запросе удаления студента из консультации
 * @return mixed
 */
function action_deleteStudentFromConsult(){
    core_loadModel("admin_student");
    if(is_empty(@$_POST['id']) || !student_del((int)@$_POST['id']))
        return json_encode(["status"=>'0', 'info'=>student_getInfo($_POST['id'])]);
    else
        return json_encode(["status"=>'1']);
}

/**
 * Запускается при запросе получения инфо о студенте
 * @return mixed
 */
function action_getInfoStudent(){
    core_loadModel("admin_student");
    return json_encode(['info'=>student_getInfo(@$_POST['id'])]);
}

/**
 * Запускается при запросе завершить консульацию
 * @return mixed
 */
function action_endConsult(){
    core_loadModel("admin_consult");
    $id = $_SESSION['id_active_consult'];
    if(!consult_end())
        return json_encode(["status"=>'0']);
    else
        return json_encode([
            "status"=>'1',
            "text"=>consult_getInfo($id)
        ]);
}

/**
 * Запускается при запросе добавления существующего студента в консультацию
 * @return mixed
 */
function action_addStudentOnConsult(){
    core_loadModel("admin_student");
    if(is_empty(@$_POST['info']) || !student_addOnConsult(@$_POST['info']))
        return json_encode(["status"=>'0',"error"=>"Ошибка добавления!"]);
    else{
        return json_encode(["status"=>'1']);
    }
}

/**
 * Запускается при запросе добавления нового студента в консультацию
 * @return mixed
 */
function action_addStudentInConsultAndJson(){
    core_loadModel("admin_student");
    if(is_empty(@$_POST['info'],@$_POST['group']) || !student_add(@$_POST['group'],@$_POST['info']))
        return json_encode(["status"=>'0',"error"=>"Ошибка добавления!"]);
    else
        return json_encode(["status"=>'1']);
}

/**
 * Запускается при запросе старта консультации
 * @return mixed
 */
function action_startConsult(){
    core_loadModel("admin_consult");
    if($_POST ||  _consultStart()==false)
        return json_encode(["start"=>"0", "error"=>"Ошибка старта консультации!"]);
    else
        return json_encode(["start"=>"1"]);
}