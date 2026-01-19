<?php
include_once "db.php";

dd($_POST);
$row = $News->find($_POST['news_id']);
dd($row);
if ($_POST['is_good']) {
    $row['good']--;
    $Log->del(['member_id'=>$_POST['member_id'],'news_id'=>$_POST['news_id'] ]);
}else{
    $row['good']++;
    $Log->save(['member_id'=>$_POST['member_id'],'news_id'=>$_POST['news_id'] ]);
}

$News->save($row);
?>