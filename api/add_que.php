<?php
include_once "db.php";
dd($_POST);
// Array
// (
//     [subject] => 今天吃啥
//     [text] => Array
//         (
//             [0] => 44
//             [1] => 33
//             [2] => 22
//             [3] => 11
//         )

// )
if (!empty($_POST['subject'])) {
    $Que->save(
        ['text'=>$_POST['subject'],
         'vote'=>0,
         'main_id'=>0
        ]
    );
}
$m_id = $Que->find(['text'=>$_POST['subject']])['id'];

if (!empty($_POST['text'])) {
    foreach ($_POST['text'] as $key => $value) {
        $Que->save(
            ['text'=>$value,
             'vote'=>0,
             'main_id'=>$m_id
            ]
        );
    }
}

to("../admin.php?do=que");

?>