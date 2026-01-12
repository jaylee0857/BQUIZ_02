<?php
include_once "db.php";

if(!empty($_POST['subject'])){
    $Que->save(['text'=>$_POST['subject'], 'main_id'=>0,'vote'=>0]);
}
$main_id=$Que->find(['text'=>$_POST['subject']])['id'];

if(!empty($_POST['opt'])){
    foreach ($_POST['opt'] as $opt) {
        $Que->save(['text'=>$opt, 'main_id'=>$main_id,'vote'=>0]);
    }
}

to("../back.php?do=que");

?>