    <fieldset>
        <legend>目前位置：首頁 > 問卷調查</legend>

        <table>
            <tr>
                <td width="10%">編號</td>
                <td width="50%">問卷題目</td>
                <td width="10%">投票總數</td>
                <td width="10%">結果</td>
                <td >狀態</td>
            </tr>
            <?php
                $ques = $Que->all(['main_id'=>0]);
                foreach ($ques as $index => $que) :
            ?>
            <tr>
                <td><?=$index+1?></td>
                <td><?=$que['text']?></td>
                <td><?=$que['vote']?></td>
                <td>
                    <a href="?do=res&id=<?=$que['id']?>">結果</a>
                </td>
                <td>
                    <?php
                        if (isset($_SESSION['login'])) {
                            echo "<a href=\"?do=vote&id={$que['id']}\">參與投票</a>";
                        }else
                        {
                            echo "<a href=\"?do=login \">請先登入</a>";
                        }
                    ?>
                </td>
            </tr>
            <?php
                endforeach;

            ?>
        </table>
    </fieldset>
<script>



</script>