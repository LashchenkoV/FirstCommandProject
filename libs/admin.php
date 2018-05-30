<?php
function _consultStart():bool{
    if(!empty($_SESSION['id_active_consult'])) return false;
    $date = date("Y-m-j");
    $time = date("H:i:s");
    $idAdmin = $_SESSION['user_id'];

    $users = _auth_getUsersArray();
    $i=0;
    foreach ($users as $user)
        if($user['id'] == $idAdmin){$i=1;break;}
    if($i!=1) return false;

    $data = [
        "id"=>time().rand(0,9999999),
        "id_admin"=>$idAdmin,
        "date_start"=>$date,
        "time_start"=>$time,
        "date_end"=>'',
        "time_end"=>''
    ];
    $_SESSION['id_active_consult'] = $data['id'];
    core_appendToArrayInFile("consult", $data);
    return true;
}
function consult_getStudents()
{
    $idConsult = $_SESSION['id_active_consult'];
    $studentsOnConsult = core_loadArrayFromFile('studentsOnConsult');
    $studOnConsult = [];
    foreach ($studentsOnConsult as $student) {
        if ($student['id_consult'] == $idConsult) {
            $studOnConsult[] = $student;
        }
    }
    $students = core_loadArrayFromFile('students');
    $dataStudents = [];
    foreach ($students as $student) {
        foreach ($studOnConsult as $studOn) {
            if ($student['id'] == $studOn['id_student']){
                $student['group'] = consult_getGroupName($student['id_group']);
                $dataStudents[] = $student;
            }
        }
    }
    return $dataStudents;
}
function consult_getGroupName($id){
    $groups = core_loadArrayFromFile('groups');
    foreach ($groups as $group){
        if($group['id']==$id) return $group['name'];
    }
    return false;
}
function consult_addStudent($group, $info):bool{
    $idGroup = consult_addGroup($group);
    if($idGroup == false) return false;
    $idAdmin = $_SESSION['user_id'];
    $idStudent=time().rand(0,9999999);
    $data = [
        "id"=>$idStudent,
        "id_admin"=>$idAdmin,
        "id_group"=>$idGroup,
        "info"=>$info,
    ];
    core_appendToArrayInFile("students", $data);
    consult_addStudentOn($idStudent);
    return true;
}

function consult_addStudentOn($idStudent){
    $idConsult = $_SESSION['id_active_consult'];
    core_appendToArrayInFile("studentsOnConsult", [
        "id"=>time().rand(0,9999999),
        "id_student"=>$idStudent,
        "id_consult"=>$idConsult
    ]);
}

function consult_addGroup($group){
    $idAdmin = $_SESSION['user_id'];
    $idGroup = time().rand(0,9999999);

    $data = [
        "id"=>$idGroup,
        "id_admin"=>$idAdmin,
        "name"=>$group,
    ];
    core_appendToArrayInFile("groups", $data);
    return $idGroup;
}

function consultGetList(){
    return core_loadArrayFromFile("consult");
}

function consult_is_start(){
    $idConsult = @$_SESSION['id_active_consult'];
    $list = consultGetList();
    $i=0;
    foreach ($list as $consult){
        if($consult['id'] == $idConsult && $consult['id_admin'] == $_SESSION["user_id"] && $consult['date_end'] == ''){
            $i=1; break;
        }
    }
    if($i!=1) return false;
    return true;
}