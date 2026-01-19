<style>

    .all_text{
        display: none;
    }
</style>
<fieldset>
    <legend>目前位置: 首頁 > 人氣文章區 </legend>
    <form>
        <table>
            <tr>
                <td width="25%">標題</td>
                <td width="55%">內容</td>
                <td></td>
            </tr>
            <?php
                $now = $_GET['p']??1;
                $div = 5;
                $total = $News->count(['sh'=>1]);
                $pages = ceil($total/$div);
                $start = ($now -1 ) *$div;
                $rows = $News->all(['sh'=>1], "ORDER BY `good` DESC LIMIT $start, $div");
                                $type_title=['','健康新知',
'菸害防治',
'癌症防治',
'慢性病防治',];
                foreach ($rows as $row) :
            ?>
            <tr>
                <td class="news_title clo"><?=$row['title']?></td>
                <td>
                    <span class="short"><?=mb_substr($row['text'],0,30)?>...</span>
                    <span class="all_text">
                        <h3><?=$type_title[$row['type']]?></h3>
                        
                    <?=nl2br($row['text'])?></span>
                    
                </td>
                <td>
                    <?=$News->find($row['id'])['good']?>個人說
                    <!-- <img style="width: 25px;" src="./icon/02B03.jpg" alt=""> -->
                    <span class="good"></span>
                    <?php
                        if (!empty($_SESSION['login'])) {
                            $news_id = $row['id'];
                            $member_id = $Member->find(['acc'=>$_SESSION['login']])['id'];
                            if ($Log->count(['member_id'=>$member_id,'news_id'=>$news_id ])) {
                                echo "<span onclick=\"good({news_id:$news_id,member_id:$member_id,is_good:1})\">收回讚</span>";
                            }else{
                                echo "<span onclick=\"good({news_id:$news_id,member_id:$member_id,is_good:0})\">讚</span>";
                            }
                        }
                    ?>
                </td>
            </tr>
            <?php
                endforeach
            ?>
        </table>
    </form>
    <div class="cent ct">
            <?php
                if ($now > 1) {
                    $prev = $now-1;
                    echo "<a href=\"?do=pop&p=$prev\"> < </a>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                    $size = ($i == $now) ? "24px":"16px";
                    echo "<a style=\"font-size: $size\" href=\"?do=pop&p=$i\"> $i </a>";

                }

                if ($now < $pages) {
                    $next = $now+1;
                    echo "<a href=\"?do=pop&p=$next\"> > </a>";
                }
            ?>
    </div>
</fieldset>
<script>
    $(".news_title").hover(function(){
        let c = $(this).next("td");
        let text = c.find(".all_text").html();
        $('#alerr').html(text).show()
    },function(){
        $('#alerr').hide();
    })
    
    $('#alerr').hover(function(){
        $('#alerr').show();

    },function(){
        $('#alerr').hide();

    })




    function good(payload){
        console.log(payload);
        $.post("./api/good.php",payload,function(res){
            location.reload();
            
        })
        
    }
</script>