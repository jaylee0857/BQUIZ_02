<fieldset>
    <legend>目前位置: 首頁 > 問卷調查 </legend>
    <form>
        <table>
            <tr>
                <td>編號</td>
                <td>問卷題目</td>
                <td>投票總數</td>
                <td>結果</td>
                <td>狀態</td>
            </tr>
            <?php
                $rows = $Que->all(['main_id'=>0]);
                foreach ($rows as $index => $row) :
            ?>
            <tr>
                <td><?=$index+1?></td>
                <td><?=$row['text']?></td>
                <td><?=$row['vote']?></td>
                <td><a href="?do=res&id=<?=$row['id']?>&text=<?=$row['text']?>">結果</a></td>
                <td>
                    <?php
                        if (!empty($_SESSION['login'])) {
                            echo "<a href=\"?do=vote&id={$row['id']}&text={$row['text']}\">參與投票</a>";
                        }else {
                        echo "請先登入";
                        }
                    ?>
                </td>

            </tr>
            <?php
                endforeach
            ?>
        </table>
    </form>
</fieldset>