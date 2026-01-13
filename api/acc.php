<?php
include_once "db.php";

$is_ues = $Member->count(['acc'=>$_POST['acc']]);

echo $is_ues;

?>