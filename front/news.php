<style>

    .all_text{
        display: none;
    }
</style>
<fieldset>
    <legend>目前位置: 首頁 > 最新文章區 </legend>
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
                $rows = $News->all(['sh'=>1], " LIMIT $start, $div");

                foreach ($rows as $row) :
            ?>
            <tr>
                <td class="news_title clo"><?=$row['title']?></td>
                <td>
                    <span class="short"><?=mb_substr($row['text'],0,30)?>...</span>
                    <span class="all_text">
                        <?=nl2br($row['text'])?>
                    </span>
                    
                </td>
                <td>
                    <?php
                        if (!empty($_SESSION['login'])) {
                            $news_id = $row['id'];
                            $member_id = $Member->find(['acc'=>$_SESSION['login']])['id'];
                            if ($Log->count(['member_id'=>$member_id,'news_id'=>$news_id ])) {
                                echo "<div onclick=\"good({news_id:$news_id,member_id:$member_id,is_good:1})\">收回讚</div>";
                            }else{
                                echo "<div onclick=\"good({news_id:$news_id,member_id:$member_id,is_good:0})\">讚</div>";
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
                    echo "<a href=\"?do=news&p=$prev\"> < </a>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                    $size = ($i == $now) ? "24px":"16px";
                    echo "<a style=\"font-size: $size\" href=\"?do=news&p=$i\"> $i </a>";

                }

                if ($now < $pages) {
                    $next = $now+1;
                    echo "<a href=\"?do=news&p=$next\"> > </a>";
                }
            ?>
    </div>
</fieldset>
<script>
    $(".news_title").click(function(){
        let c = $(this).next("td");
        c.find(".short,.all_text").toggle();
    })

    function good(payload){
        console.log(payload);
        $.post("./api/good.php",payload,function(res){
            location.reload();
            
        })
        
    }
</script>