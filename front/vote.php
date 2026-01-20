<fieldset>
    <legend>目前位置: 首頁 > 問卷調查 > <?=$_GET['text']?></legend>
    <p><?=$_GET['text']?></p>
    <?php
        $rows = $Que->all(['main_id'=>$_GET['id']]);
        foreach ($rows as $row):
    ?>
    <div>
        <input type="radio" name="opt" value="<?=$row['id']?>">
        <?=$row['text']?>
    </div>
    <?php
        endforeach;
    ?>
    <input type="button" value="我要投票" onclick="vote()">
</fieldset>

<script>

    function vote(){
        let id = $("input:checked").val();
        
        $.post("./api/vote.php",{id},function(res){
            console.log(id);
            console.log(res);
            
            location.href="?do=res&id=<?=$_GET['id']?>&text=<?=$_GET['text']?>"
        })
    }
</script>