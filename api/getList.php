<?php
include_once "db.php";

$rows=$News->all(['type'=>$_POST['type'], 'sh'=>1]);
foreach ($rows as $row ) {
    echo "<div onclick=\"getNews('{$row['id']}')\">";
    echo $row['title'];
    echo "</div>";
}
?>