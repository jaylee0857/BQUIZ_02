<?php

    $main = $Que->find($_GET['id']);
    $sec = $Que->all(['main_id'=>$_GET['id']]) ;

?>

<fieldset>
    <legend>目前位置：首頁 > 問卷調查 > <?=$main['text']?></legend>
    <h3> <?=$main['text']?></h3>

    <?php
        foreach ($sec as $opt) :
    ?>
        <p>
            <input type="radio" name="vote" value="<?=$opt['id']?>" checked>
            <?=$opt['text']?>
        </p>
    <?php
       endforeach;
    ?>
    <div class="ct">
        <input type="button" value="我要投票" onclick="vote()">
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