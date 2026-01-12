<fieldset>
    <legend>帳號管理</legend>

    <form action="./api/admin.php" method="post">
        <table width="60%" class="ct" style="margin:auto;">
            <tr>
                <td>帳號</td>
                <td>密碼</td>
                <td>刪除</td>
            </tr>
            <?php
                $members = $Member->all();
                foreach ($members as $member) :
                    if ($member['acc'] == 'admin') {
                        continue;
                    }
            ?>
            <tr>
                <td>
                    <?=$member['acc']?>
                </td>
                <td>
                    <?= str_repeat('*', strlen($member['pw'])) ?>
                </td>
                <td>
                    <input type="checkbox" name="del[]" value="<?=$member['id']?>">
                    <input type="hidden" name="id[]" value="<?=$member['id']?>">
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </table>
    
        <div class="ct">
            <input type="submit" value="確定刪除">
            <input type="reset" value="清空選取">
        </div>
    </form>
    <h2>新增會員</h2>
    <div style="color: red;">*請設定您要註冊的帳號及密碼(最長12個字元)</div>
    <form action="./api/reg.php" method="post">
        <table>
            <tr>
                <td>Step1:登入帳號</td>
                <td>
                    <input type="text" name="acc" id="acc">
                </td>
            </tr>
            <tr>
                <td>Step2:登入密碼</td>
                <td>
                    <input type="password" name="pw" id="pw">
                </td>
            </tr>
            <tr>
                <td>Step3:再次確認密碼</td>
                <td>
                    <input type="password" name="pw2" id="pw2">
                </td>
            </tr>
            <tr>
                <td>Step4:信箱(忘記密碼時使用)</td>
                <td>
                    <input type="email" name="email" id="email">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="新增" onclick="reg()">
                    <input type="reset" value="清除">
    
                </td>
                <td></td>
            </tr>
        </table>
    </form>
</fieldset>

<script>

function reg() {
    let user= {
        'acc':$('#acc').val(),
        'pw':$('#pw').val(),
        'pw2':$('#pw2').val(),
        'email':$('#email').val(),
    }

    if (user.acc != '' && user.pw != '' && user.pw2 != '' && user.email != '' ) {
        if (user.pw == user.pw2) {
            $.get('./api/chk_acc.php',{'acc':user.acc},(res)=>{
                if (!parseInt(res)) {
                    // console.log(!parseInt(res));
                    $.post("./api/reg.php",user,(res)=>{
                        location.reload();
                        // $("form")[1].reset(); 
                    })
                    // console.log(res);
                }else {
                    alert("帳號重複")
                }
            })
        }
        else {
            alert("密碼錯誤")

        }
        // console.log(user);
        
    }else {
        alert("不可空白")
    }
}

</script>