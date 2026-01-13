 <p style="color:red">*請設定你要註冊的帳號及密碼(最常12是原)</p>

    <form action="./api/admin.php" method="post">
        <table width="60%" style="margin:auto">
            <tr class="clo">
                <td>帳號</td>
                <td>密碼</td>
                <td>刪除</td>
            </tr>
            <?php
                $rows = $Member->all();
                foreach ($rows as $row) :
                    if ($row['acc'] == 'admin') {
                        continue;
                    }
            ?>
            <tr>
                <td><?=$row['acc']?></td>
                <td><?=str_repeat("*", strlen($row['pw']))?></td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id']?>" id="">
                </td>
            </tr>
            <?php
                endforeach
            ?>
        </table>
        <div class="ct">
            <input type="submit" value="確定刪除">
            <input type="reset" value="清空選取">
        </div>
    </form>

    <form action="">
        <table width="60%" class="mt">
        <tr>
            <td>Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td>Step4信箱(忘記密碼用)</td>
            <td><input type="email" name="email" id="email"></td>
        </tr>
    </table>
    </form>

    <div class="login_box">
        <div>
            <input type="button" value="註冊" onclick="reg()">
            <input type="reset" value="清除" id="reset">
        </div>
        <div>
        </div>
    </div>

    <script>

    
    function reg(){
        let user = {
            acc:$('#acc').val(),
            pw:$('#pw').val(),
            pw2:$('#pw2').val(),
            email:$('#email').val()
        }
        console.log(user);
        if (!user.acc || !user.pw || !user.pw2 || !user.email) {
            alert("不可空白");
            return
        }
        if (user.pw != user.pw2 ) {
            alert("密碼錯誤");
            return
        }
        $.post("./api/acc.php",{acc:user.acc},function(res){
            if (Number(res) > 0) {
                alert("帳號重複");
            }
            else{
                $.post("./api/reg.php",user,function(){
                    alert("註冊成功");
                    $('form')[0].reset()
                })
            }
        })
    }

</script>