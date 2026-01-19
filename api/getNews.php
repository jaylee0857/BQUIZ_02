<?php
include_once "db.php";

$row = $News->find($_POST['id']);

echo nl2br($row['text']);
?>