<?php

/**
 * Проверяет есть ли студент на консультации
 * @param $idConsult
 * @param $idStudent
 * @return int - его id в файле, или -1 если не найден
 */
function student_isOnConsult($idConsult, $idStudent){
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
function student_del(int $id):bool{
    $isStudentOnConsult = student_isOnConsult($_SESSION['id_active_consult'], $id);
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
function student_getInfo(int $id) {
    $students = core_loadArrayFromFile('students');
    foreach ($students as $student){
        if($student['id']==$id) return $student;
    }
    return false;
}

/**
 * Возвращает готовые данные для таблицы консультации
 * @return array
 */
function student_getListForTable():array {
    core_loadModel("admin_group");
    $studOnConsult = student_getAllOnConsult(@$_SESSION['id_active_consult']);
    $dataStudents = [];
    foreach ($studOnConsult as $on){
        $info = student_getInfo((int)$on['id_student']);
        $info['group'] = group_getName((int)$info['id_group']);
        $dataStudents[]= $info;
    }
    return $dataStudents;
}

/**
 * Возвращает массив студентов которые есть на консультации
 * @param $idConsult
 * @return array
 */
function student_getAllOnConsult($idConsult):array {
    if($idConsult == null) return [];
    $studentsOnConsult = core_loadArrayFromFile('studentsOnConsult');
    $studOnConsult = [];
    foreach ($studentsOnConsult as $student) {
        if ($student['id_consult'] == $idConsult) $studOnConsult[] = $student;
    }
    return $studOnConsult;
}

/**
 * Возвращает список студентов конкретной консультации
 * @param $idConsult
 * @return array
 */
function student_getListStudentsOnConsult($idConsult){
    core_loadModel("admin_group");
    $studentsOnConsult = student_getAllOnConsult($idConsult);
    $studentsAll = core_loadArrayFromFile('students');
    $returnArr = [];
    foreach ($studentsAll as $studentA){
        foreach ($studentsOnConsult as $student) {
            if ($studentA['id'] == $student['id_student']){
                $studentA['name_group']=group_getName($studentA['id_group']);
                $returnArr[]= $studentA;
            }
        }
    }
    return $returnArr;
}

/**
 * Возвращает список студентов конкретной группы
 * @param $group_id
 * @return array
 */
function student_getListInGroup($group_id){
    $students = core_loadArrayFromFile('students');
    $listStudents = [];
    foreach ($students as $student) {
        if($student['id_group'] == $group_id) $listStudents[]=$student;
    }
    return $listStudents;
}

/**
 * Возвращает колличество людей посетивших консультацию
 * @param $idConsult
 * @return int
 */
function student_getCountAllOnConsult($idConsult){
    $studentsOnConsult = core_loadArrayFromFile('studentsOnConsult');
    $i = 0;
    foreach ($studentsOnConsult as $student) {
        if ($student['id_consult'] == $idConsult) $i++;
    }
    return $i;
}

/**
 * Добавляет нового студента на консультацию
 * @param $groupId - какая группа
 * @param $info - имя, фамилия студента
 * @return bool
 */
function student_add($groupId, $info):bool{
    core_loadModel("admin_group");
    $idGroup = group_isGroup($groupId)===false?group_addNew($groupId):$groupId;
    if($idGroup == false) return false;
    $data = [
        "id"=>getRandomId(),
        "id_admin"=>$_SESSION['user_id'],
        "id_group"=>$idGroup,
        "info"=>$info,
    ];
    core_appendToArrayInFile("students", $data);
    student_addOnConsult($data['id']);
    return true;
}

/**
 * Добавляет готового студента на консультацию
 * @param $idStudent
 * @return bool
 */
function student_addOnConsult($idStudent){
    if(student_is_emptyOnConsult($_SESSION['id_active_consult'], $idStudent)) return false;
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
function student_is_emptyOnConsult($idConsult, $idStudent){
    $students = core_loadArrayFromFile('studentsOnConsult');
    foreach ($students as $student)
        if($student['id_student']==$idStudent && $student['id_consult']==$idConsult) return true;
    return false;
}
