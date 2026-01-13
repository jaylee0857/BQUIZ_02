<?php

    $main = $Que->find($_GET['id']);
    $sec = $Que->all(['main_id'=>$_GET['id']]) ;

?>
<style>
.que_content{
    display:flex;
}
.title{
    width: 30%;
    margin:10px ;
}
.line {
    width: 100%;
    height: 30px;
    background-color: rgb(129, 129, 129);
    padding:0;
    margin:0;
}

.line_box{
    flex:1;
    display:flex;
    align-items: center;
}
</style>
<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$main['text']?></legend>
    <h3> <?=$main['text']?></h3>

    <?php
        foreach ($sec as $opt) :
        $main_vote = ($main['vote'] == 0) ? 1 :$main['vote'] ;
        $rate = $opt['vote']/$main_vote;
    ?>
        <div class="que_content">
            <div class="title">
                <?=$opt['text']?>
            </div>
            <div class="line_box">
                <div class="line" style="width:<?=$rate*50?>%"></div>
                <span><?=$opt['vote']?>票(<?=round($rate*100,1)?>%)</span>
            </div>
        </div>
    <?php
       endforeach;
    ?>
    <div class="ct">
        <input type="button" value="返回" onclick="location.href='?do=que'">
    </div>

</fieldset>

<script>
function vote() {
    // console.log($('input[name=vote]:checked').val());
    let id = $('input[name=vote]:checked').val();
    $.post("./api/vote.php",{id},()=>{
        location.href="?do=res&id=<?=$_GET['id']?>";
    })

}


</script>