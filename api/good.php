<?php
include_once "db.php";

$news_id = $_POST['id'];
$news = $News->find($news_id);
$member_id = $Member->find(['acc'=>$_SESSION['login']])['id'];

dd($news_id);
dd($member_id);

dd($Log->count(['news_id'=>$news_id,'member_id'=>$member_id]));
if ($Log->count(['news_id'=>$news_id,'member_id'=>$member_id]) > 0) {
    $Log->del(
        ['news_id'=>$news_id,'member_id'=>$member_id]
    );
    $news['good']--;
}else {
    $Log->save(
        ['news_id'=>$news_id,'member_id'=>$member_id]
    );
    $news['good']++;

}
$News->save($news);



?>