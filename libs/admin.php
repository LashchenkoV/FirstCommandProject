<?php
function _startConsult():bool{
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