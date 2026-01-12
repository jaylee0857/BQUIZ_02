<?php
include_once "db.php";

$row = $News->find($_GET['id']);

echo nl2br($row['text']);
// to("../back.php?do=que");

?>