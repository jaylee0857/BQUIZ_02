<?php 
include_once "db.php";

// 注意送的資料有pw2而欄位沒有, 要把pw2註銷
// {
//     "acc": "11",
//     "pw": "11",
//     "pw2": "11",
//     "email": "11"
// }
unset($_POST['pw2']);
$Member->save($_POST);


?>