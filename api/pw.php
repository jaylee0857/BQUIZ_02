<?php
include_once "db.php";

$is_ues = $Member->count($_POST);

echo $is_ues;

if ($is_ues > 0) {
    $_SESSION['login'] = $_POST['acc'];
}

?>