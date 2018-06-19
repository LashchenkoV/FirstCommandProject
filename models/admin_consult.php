<?php
/**
 * Стартует консультацию
 * @return bool
 */
function _consultStart(){
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
        "id"=>getRandomId(),
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

/**
 * Завершает консультацию
 * @return bool
 */
function consult_end(){
    $studentsOnConsult = core_loadArrayFromFile('consult');
    $date = date("Y-m-j");
    $time = date("H:i:s");
    foreach ($studentsOnConsult as &$consult){
        if($consult['id'] == $_SESSION['id_active_consult']){
            $consult["date_end"]=$date;
            $consult["time_end"]=$time;
            break;
        }
    }
    core_saveArrayToFile("consult", $studentsOnConsult);
    unset($_SESSION['id_active_consult']);
    return true;
}

/**
 * Проверяет еть ли активная консультация
 * @return bool
 */
function consult_isStart(){
    $list = core_loadArrayFromFile("consult");
    $i=0;
    foreach ($list as $consult){
        if($consult['id'] == @$_SESSION['id_active_consult'] && $consult['id_admin'] == $_SESSION["user_id"] && $consult['date_end'] == ''){
            $i=1;
            break;
        }
    }
    if($i!=1) return false;
    return true;
}

/**
 * Удаляет консультацию и всё что с ней связано
 * @param $id
 * @return bool
 */
function delConsult($id){
    core_loadModel("admin_student");
    $consults = core_loadArrayFromFile("consult");
    $newListConsult=[];
    foreach ($consults as $consult){
        if($consult['id']==$id) continue;
        else $newListConsult[]=$consult;
    }
    core_saveArrayToFile("consult", $newListConsult);
    student_delAllFromConsult($id);
    return true;
}

/**
 * Возвращает инфо о консульации
 * @param $id
 * @return array [длительность, колл_студентов]
 */
function consult_getInfo($id){
    core_loadModel("admin_student");
    $consults = core_loadArrayFromFile('consult');
    foreach ($consults as $consult) {
        if ($consult['id'] == $id) {
            $consult['time'] = core_getDeltaTime($consult['time_end'],$consult['time_start']);
            $consult['countStudent'] = student_getCountAllOnConsult($id);
            return $consult;
        }
    }
    return [];
}

/**
 * Возвращает список консультаций пользователя
 * @return array
 */
function consult_getList(){
    core_loadModel("admin_student");
    $consults = core_loadArrayFromFile("consult");
    $list = [];
    foreach ($consults as $consult){
        if($consult['id_admin']==$_SESSION['user_id']){
            $consult['delta_time'] = $consult['time_end']==''?"Не закончена":core_getDeltaTime($consult['time_end'],$consult['time_start']);
            $consult['count_student'] = $consult['time_end']==''?"-":student_getCountAllOnConsult($consult['id']);
            $list[]=$consult;
        }
    }
    return $list;
}