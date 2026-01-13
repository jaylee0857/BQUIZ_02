<?php
include_once "db.php";

unset($_POST['pw2']);
$Member->save($_POST);

?>