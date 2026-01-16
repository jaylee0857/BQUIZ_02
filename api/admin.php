<?php
include_once "db.php";
dd($_POST);
foreach ($_POST['id'] as $key => $id) {
    if (!empty($_POST['id']) && in_array($id , $_POST['del'])) {
        $Member->del($id);
    }
}


?>

