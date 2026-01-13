
<fieldset>
    <legend>目前位置：首頁 > 人氣文章</legend>
    <form action="">
        <table>
            <tr>
                <td width="30%">標題</td>
                <td width="50%">內容</td>
                <td></td>
            </tr>
            <?php
        $total = $News->count(['sh'=>1]);
        $div = 5;
        $pages = ceil($total/$div);
        $now = $_GET['p'] ?? 1 ;
        $start =($now-1) * $div;
        $rows = $News->all(['sh'=>1],"ORDER BY `good` DESC limit $start,$div");
        $typetext = ["","健康新知",  
                    "菸害防治",
                    "癌症防治",
                    "慢性病防治",
                    ];
        foreach ($rows as $key=> $row) :
            ?>
        <tr>
            <td class="news_title"><?=$row['title']?></td>
            <td>
                
                <span class="news_short"><?=mb_substr($row['text'],0,25)?>...</span>
                <span style="display:none" class="news_content">
                    <!-- <h3><?=$typetext[$row['type']]?></h3> -->
                    <h3><?=$News->type_text[$row['type']]?></h3>

                    <?=nl2br($row['text'])?>
                </span>
            </td>
            <td><?=$row['good']?>個人說<span class="good"></span>
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
            echo "<a href='?do=pop&p=$prev'> < </a>";
        }
        for ($i=1; $i <=$pages ; $i++) { 
            $font =($i == $now) ? "24px":"16px";
            echo "<a href='?do=pop&p=$i' style='font-size:$font'> $i </a>";

        }

        if ($now < $pages) {
            $next = $now+1;
            echo "<a href='?do=pop&p=$next'> > </a>";

        }
    ?>
</div>
</fieldset>

<script>
    $('.news_title').hover(function(){
            $("#alerr").html($(this).next("td").find(".news_content").html()).show();
    },function(){
            $("#alerr").html($(this).next("td").find(".news_content").html()).hide();

    })
    $("#alerr").hover(function(){
            $(this).show();
    },function(){
            $(this).hide();

    })


    $(".good-link").on('click', function (e) {
        e.preventDefault();
        const id = $(this).data('news-id'); 
        const text = $(this).text(); 


        //重要!! 用箭頭涵式把this取消

        $.post("./api/good.php",{id},()=>{
            // console.log(text);
            // if (text == "讚") {
            //     $(this).text("收回讚")
            // }else {
            //     $(this).text("讚")
                        
            // }
            location.reload();
        })              
    });
</script>