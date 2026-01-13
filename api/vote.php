<?php
include_once "db.php";


$id = $_POST['id'] ;
$sec = $Que->find($id);
$sec['vote']++;
$Que->save($sec);

$main = $Que->find($sec['main_id']);
$main['vote']++;
$Que->save($main);

?>