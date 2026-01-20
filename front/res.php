<style>
    .content{
        display: flex;
    }
    .title{
        width: 40%;
    }
    .line{
        width: 60%;
        display: flex;
    }
    .line span {
        width: 0;
        height: 20px;
        background:black;
    }
</style>
<fieldset>
    <legend>目前位置: 首頁 > 問卷調查 > <?=$_GET['text']?></legend>
    <p><?=$_GET['text']?></p>
    <?php
        $rows = $Que->all(['main_id'=>$_GET['id']]);
        foreach ($rows as $row):
            // $total = $Que->sum('vote',['main_id'=>$_GET['id']]) ?? 1; 
            $total = $Que->sum('vote', ['main_id'=>$_GET['id']]) ?: 1; //縮寫三元運算子
            $r = round($row['vote']/$total *100,1);

    ?>
    <div class="content">
        <div class="title">
            <?=$row['text']?>
        </div>
        <div class="line">
            <span style="width: <?=$r*0.7?>%"></span>
            <?=$row['vote']?>票(<?=$r?>%)
        </div>
    </div>
    <?php
        endforeach;
    ?>
    <input type="button" value="返回" onclick="vote()">
</fieldset>

<script>

    function vote(){
        location.href="?do=que"

    }
</script>