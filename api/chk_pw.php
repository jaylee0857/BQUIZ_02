<?php 
include_once "db.php";

$is_check = $Member->count($_POST);

echo $is_check;

if ($is_check>0) {
    $_SESSION['login']=$_POST['acc'];
}


?>