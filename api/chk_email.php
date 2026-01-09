<?php 
include_once "db.php";

$is_check = $Member->find($_POST);
// dd($is_check);

if ($is_check) {
   echo "您的密碼為:{$is_check['pw']}";
}else {
    echo "查無此email";
}


?>