<?php
include_once "db.php";

$rows = $News->all(['type'=>$_GET['type']]);

foreach ($rows as $row) {
        echo "<div>";
        // 重要, 用a標籤執行js
        echo "<a href='javascript:getPost({$row['id']})'>";
        echo $row['title'];
        echo "</a>";
        echo "</div>";
}

// to("../back.php?do=que");

?>