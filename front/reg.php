<fieldset>
    <legend>會員註冊</legend>
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
                    <input type="button" value="註冊" onclick="reg()">
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
                    console.log(!parseInt(res));
                    $.post("./api/reg.php",user,(res)=>{
                        alert("註冊成功, 歡迎加入")
                        $("form")[0].reset(); 
                    })
                    console.log(res);
                }else {
                    alert("帳號重複")
                }
            })
        }
        else {
            alert("密碼錯誤")

        }
        console.log(user);
        
    }else {
        alert("不可空白")
    }
}

</script>