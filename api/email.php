<?php
include_once "db.php";

$member = $Member->find(['email'=>$_POST['email']]);

if ($member) {
    echo "您的密碼為:".$member['pw'];
}else {
    echo "查無此資料";
}

?>