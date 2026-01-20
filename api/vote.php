<?php
include_once "db.php";

$id = $_POST['id'];
$opt = $Que->find(['id'=>$id]);
$opt['vote']++;
$Que->save($opt);
$main_id = $opt['main_id'];
$main = $Que->find(['id'=>$main_id]);
$main['vote']++;
$Que->save($main);

?>