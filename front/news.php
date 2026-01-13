
<fieldset>
    <legend>目前位置：首頁 > 最新文章</legend>
<form action="">
        <table>
            <tr>
                <td width="40%">標題</td>
                <td width="40%">內容</td>
                <td></td>
            </tr>
            <?php
                $total = $News->count(['sh'=>1]);
                $div = 5;
                $pages = ceil($total/$div);
                $now = $_GET['p'] ?? 1 ;
                $start =($now-1) * $div;
                $rows = $News->all(['sh'=>1]," limit $start,$div");
                
                foreach ($rows as $key=> $row) :
            ?>
        <tr>
            <td class="news_title"><?=$row['title']?></td>
            <td>
                
                <span class="news_short"><?=mb_substr($row['text'],0,25)?>...</span>
                <span style="display:none" class="news_content"><?=nl2br($row['text'])?></span>
            </td>
            <td>
                <?php
                    if (isset($_SESSION['login'])) {
                        $news_id = $row['id'];
                        $member_id = $Member->find(['acc'=>$_SESSION['login']])['id'];
                        if (($Log->count(['news_id'=>$news_id,'member_id'=>$member_id]))>0) {
                            echo "<a href=\"#\" class=\"good-link\" data-news-id=\"{$row['id']}\">收回讚</a>";
                            }else {
                            echo "<a href=\"#\" class=\"good-link\" data-news-id=\"{$row['id']}\">讚</a>";
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
<div class="">
    <?php
        if($now-1>0){
            $prev = $now-1;
            echo "<a href='?do=news&p=$prev'> < </a>";
        }
        for ($i=1; $i <=$pages ; $i++) { 
            $font =($i == $now) ? "24px":"16px";
            echo "<a href='?do=news&p=$i' style='font-size:$font'> $i </a>";

        }

        if ($now < $pages) {
            $next = $now+1;
            echo "<a href='?do=news&p=$next'> > </a>";

        }
    ?>
</div>
</fieldset>

<script>
$('.news_title').on('click', function () {
  const $td = $(this).next('td');
  $td.find('.news_short, .news_content').toggle();
});

$(".good-link").on('click', function (e) {
  e.preventDefault();
  const id = $(this).data('news-id'); 
  const text = $(this).text(); 


  //重要!! 用箭頭涵式把this取消

  $.post("./api/good.php",{id},()=>{
        // console.log(text);
        if (text == "讚") {
            $(this).text("收回讚")
        }else {
            $(this).text("讚")
                    
        }

  })              
});


</script>