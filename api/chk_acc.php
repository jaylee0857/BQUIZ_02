<?php 
include_once "db.php";

$acc = $Member->count(['acc'=>$_GET['acc']]);

echo $acc;


?>