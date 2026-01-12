<?php
include_once "db.php";


// $rows = $News->all();

dd($_POST);

foreach ($_POST['id'] as $key => $id) {
    if (!empty($_POST['del']) && in_array($id, $_POST['del'])) {
        $News->del($id);
    }
    else {
        $row = $News->find($id);
        $row['sh'] = (!empty($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1:0;
        $News->save($row);
    }

}

to("../back.php?do=news")
?>