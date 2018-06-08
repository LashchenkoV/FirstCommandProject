<?php
/**
 * Стартует консультацию
 * @return bool
 */
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
function consult_isStart():bool{
    $list = core_loadArrayFromFile("consult");
    $i=0;
    foreach ($list as $consult){
        if($consult['id'] == @$_SESSION['id_active_consult'] && $consult['id_admin'] == $_SESSION["user_id"] && $consult['date_end'] == ''){
            $i=1; break;
        }
    }
    if($i!=1) return false;
    return true;
}

/**
 * Проверяет есть ли студент на консультации
 * @param $idConsult
 * @param $idStudent
 * @return int - его id в файле, или -1 если не найден
 */
function consult_isStudentOnConsult($idConsult, $idStudent){
    $studentsOnConsult = core_loadArrayFromFile('studentsOnConsult');
    for($i=0;$i<count($studentsOnConsult);$i++){
        if($studentsOnConsult[$i]['id_student']==$idStudent && $studentsOnConsult[$i]['id_consult']==$idConsult){
            return $i;
        }
    }
    return -1;
}

/**
 * Удаляет сутдента из консультации по id
 * @param int $id
 * @return bool
 */
function consult_delStudent(int $id):bool{
    $isStudentOnConsult = consult_isStudentOnConsult($_SESSION['id_active_consult'], $id);
    if($isStudentOnConsult == -1) return false;
    $studentsOnConsult = core_loadArrayFromFile("studentsOnConsult");
    array_splice($studentsOnConsult, $isStudentOnConsult,1);
    core_saveArrayToFile("studentsOnConsult", $studentsOnConsult);
    return true;
}

/**
 * Возвращает инфо о студенте по id
 * @param $id
 * @return int
 */
function consult_getInfoStudent(int $id) {
    $students = core_loadArrayFromFile('students');
    foreach ($students as $student){
        if($student['id']==$id) return $student;
    }
    return false;
}

/**
 * Возвращает массив студентов которые есть на консультации
 * @param $idConsult
 * @return array
 */
function consult_getStudentsOnConsult($idConsult):array {
    if($idConsult == null) return [];
    $studentsOnConsult = core_loadArrayFromFile('studentsOnConsult');
    $studOnConsult = [];
    foreach ($studentsOnConsult as $student) {
        if ($student['id_consult'] == $idConsult) $studOnConsult[] = $student;
    }
    return $studOnConsult;
}

/**
 * Возвращает список груп пользователя
 * @return array
 */
function consult_getGroupList(){
    $groups = core_loadArrayFromFile('groups');
    $listGroup = [];
    foreach ($groups as $group) {
        if($group['id_admin'] == $_SESSION['user_id']) $listGroup[]=$group;
    }
    return $listGroup;
}

/**
 * Возвращает список студентов конкретной группы
 * @param $group_id
 * @return array
 */
function consult_getStudentList($group_id){
    $students = core_loadArrayFromFile('students');
    $listStudents = [];
    foreach ($students as $student) {
        if($student['id_group'] == $group_id) $listStudents[]=$student;
    }
    return $listStudents;
}

/**
 * Возвращает инфо о консульации
 * @param $id
 * @return array [длительность, колл_студентов]
 */
function consult_getInfo($id){
    $consults = core_loadArrayFromFile('consult');
    $time = '';
    foreach ($consults as $consult) {
        if ($consult['id'] == $id) {
            $time = core_getDeltaTime($consult['time_end'],$consult['time_start']);
            break;
        }
    }
    return ["time"=>$time,"countStudent"=>consult_getCountStudentOnConsult($id)];
}

/**
 * Возвращает колличество людей посетивших консультацию
 * @param $idConsult
 * @return int
 */
function consult_getCountStudentOnConsult($idConsult){
    $studentsOnConsult = core_loadArrayFromFile('studentsOnConsult');
    $i = 0;
    foreach ($studentsOnConsult as $student) {
        if ($student['id_consult'] == $idConsult) $i++;
    }
    return $i;
}

/**
 * Возвращает готовые данные для таблицы консультации
 * @return array
 */
function consult_getListStudentsForTable():array {
    $studOnConsult = consult_getStudentsOnConsult(@$_SESSION['id_active_consult']);
    $dataStudents = [];
    foreach ($studOnConsult as $on){
        $info = consult_getInfoStudent((int)$on['id_student']);
        $info['group'] = consult_getGroupName((int)$info['id_group']);
        $dataStudents[]= $info;
    }
    return $dataStudents;
}

/**
 * Возвращает имя группы по id
 * @param int $id
 * @return string|false
 */
function consult_getGroupName(int $id){
    $groups = core_loadArrayFromFile('groups');
    foreach ($groups as $group)
        if($group['id']==$id) return $group['name'];
    return false;
}

/**
 * Проверяет есть ли уже данная группа(по id)
 * @param $id
 * @return bool
 */
function consult_isGroup(int $id):bool{
    $groups = core_loadArrayFromFile('groups');
    foreach ($groups as $group)
        if($group['id']==$id) return true;
    return false;
}

/**
 * Добавляет нового студента на консультацию
 * @param $groupId - какая группа
 * @param $info - имя, фамилия студента
 * @return bool
 */
function consult_addStudent($groupId, $info):bool{
    $idGroup = consult_isGroup($groupId)===false?consult_addNewGroup($groupId):$groupId;
    if($idGroup == false) return false;
    $data = [
        "id"=>getRandomId(),
        "id_admin"=>$_SESSION['user_id'],
        "id_group"=>$idGroup,
        "info"=>$info,
    ];
    core_appendToArrayInFile("students", $data);
    consult_addStudentOnConsult($data['id']);
    return true;
}

/**
 * Добавляет готового студента на консультацию
 * @param $idStudent
 * @return bool
 */
function consult_addStudentOnConsult($idStudent){
    if(consult_is_emptyStudentOnConsult($_SESSION['id_active_consult'], $idStudent)) return false;
    core_appendToArrayInFile("studentsOnConsult", [
        "id"=>getRandomId(),
        "id_student"=>$idStudent,
        "id_consult"=>$_SESSION['id_active_consult']
    ]);
    return true;
}

/**
 * Проверяет есть ли студент на консултации
 * @param $idConsult
 * @param $idStudent
 * @return bool
 */
function consult_is_emptyStudentOnConsult($idConsult, $idStudent){
    $students = core_loadArrayFromFile('studentsOnConsult');
    foreach ($students as $student)
        if($student['id_student']==$idStudent && $student['id_consult']==$idConsult) return true;
    return false;
}

/**
 * Создает новую группу
 * @param $group - имя
 * @return int - id новой группы
 */
function consult_addNewGroup(string $group):int{
    define("ID_GROUP",getRandomId());
    $data = [
        "id"=>ID_GROUP,
        "id_admin"=>$_SESSION['user_id'],
        "name"=>$group,
    ];
    core_appendToArrayInFile("groups", $data);
    return ID_GROUP;
}

/**
 * Возвращает список консультаций пользователя
 * @return array
 */
function consult_getListConsult():array {
    $consults = core_loadArrayFromFile("consult");
    $list = [];
    foreach ($consults as $consult){
        if($consult['id_admin']==$_SESSION['user_id']){
            $consult['delta_time'] = $consult['time_end']==''?"Не закончена":core_getDeltaTime($consult['time_end'],$consult['time_start']);
            $consult['count_student'] = $consult['time_end']==''?"-":consult_getCountStudentOnConsult($consult['id']);
            $list[]=$consult;
        }
    }
    return $list;
}