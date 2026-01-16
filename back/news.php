
<form action="./api/news.php" method="post">
    <table>
        <tr>
            <td>編號</td>
            <td>標題</td>
            <td>顯示</td>
            <td>刪除</td>
        </tr>
        <?php
            $total = $News->count();
            $now = $_GET['p'] ?? 1;
            $div=3;
            $pages = ceil($total/$div);
            $start = ($now -1) *$div;
            $rows = $News->all(" limit $start, $div");
            foreach ($rows as $key => $row) :
        ?>
        <tr>
            <td><?=$key+1+$start?></td>
            <td><?=$row['title']?></td>
            <td>
                <input type="checkbox" name="sh[]" value="<?=$row['id']?>" <?=$row['sh']==1?"checked":""?> >
            </td>
            <td>
                <input type="checkbox" name="del[]" value="<?=$row['id']?>">
                <input type="hidden" name="id[]" value="<?=$row['id']?>">

            </td>
        </tr>
        <?php
            endforeach;
        ?>
    </table>
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
    <div class="ct">
        <input type="submit" value="確定修改">
    </div>
</form>