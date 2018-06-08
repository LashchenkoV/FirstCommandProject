<?php
function action_index(){
    return core_render("consult",[
        "title"=>"Админ панель",
        "table"=>action_getTableStudentsView(),
    ],"admin");
}

function action_list(){
    return core_render("listConsult", [
        "title"=>"Список консультаций",
        "listConsult"=>consult_getListConsult()
    ],"admin");
}

function action_getModalAddStudent(){
    return core_render_view("modalAddStudent",["listGroups"=>consult_getGroupList()]);
}
function action_getGroupList(){
    return json_encode(consult_getGroupList());
}
function action_getStudentList(){
    if(is_empty(@$_POST['id_group'])) return false;
    return json_encode(consult_getStudentList($_POST['id_group']));
}
function action_list_consult(){
    return core_render("listConsult",["title"=>"Список консультаций"], "admin");
}

function action_getTableStudentsView(){
    $data = ["students"=>consult_getListStudentsForTable()];
    return core_render_view("tableStudents",$data);
}
function action_deleteStudentFromConsult(){
    if(is_empty(@$_POST['id']) || !consult_delStudent((int)@$_POST['id']))
        return json_encode(["status"=>'0', 'info'=>consult_getInfoStudent($_POST['id'])]);
    else
        return json_encode(["status"=>'1']);
}
function action_getInfoStudent(){
    return json_encode(['info'=>consult_getInfoStudent(@$_POST['id'])]);
}
function action_endConsult(){
    $id = $_SESSION['id_active_consult'];
    if(!consult_end())
        return json_encode(["status"=>'0']);
    else
        return json_encode([
            "status"=>'1',
            "text"=>consult_getInfo($id)
        ]);
}
function action_addStudentOnConsult(){
    if(is_empty(@$_POST['info']) || !consult_addStudentOnConsult(@$_POST['info']))
        return json_encode(["status"=>'0',"error"=>"Ошибка добавления!"]);
    else{
        return json_encode(["status"=>'1']);
    }
}
function action_addStudentInConsultAndJson(){
    if(is_empty(@$_POST['info'],@$_POST['group']) || !consult_addStudent(@$_POST['group'],@$_POST['info']))
        return json_encode(["status"=>'0',"error"=>"Ошибка добавления!"]);
    else
        return json_encode(["status"=>'1']);
}

function action_startConsult(){
    if($_POST ||  _consultStart()==false)
        return json_encode(["start"=>"0", "error"=>"Ошибка старта консультации!"]);
    else
        return json_encode(["start"=>"1"]);

}