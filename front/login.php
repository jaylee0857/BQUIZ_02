<form action="" method="post">
    <fieldset>
        <legend>會員登入</legend>
        <table>
            <tr>
                <td>帳號</td>
                <td><input type="text" name="acc" id="acc"></td>
            </tr>
            <tr>
                <td>密碼</td>
                <td><input type="password" name="pw" id="pw"></td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="登入" onclick="login()">
                    <input type="reset" value="清除">
                </td>
                <td>
                    <a href="?do=forget">忘記密碼</a>
                    <a href="?do=reg">尚未註冊</a>
                </td>
            </tr>
        </table>
    </fieldset>
</form>

<script>
    function login() {
        let user= {
            'acc':$('#acc').val(),
            'pw':$('#pw').val(),
        }
        $.get("./api/chk_acc.php",user,(res)=>{
            if (Number(res) > 0) {
                $.post("./api/chk_pw.php",user,(res)=>{
                    if (Number(res) > 0) {
                        console.log('登入成功');
                        if (user.acc == 'admin') {
                            location.href = "back.php"
                            
                        }else {
                            location.href = "index.php"
                        }
                        
                    }else {
                        alert("密碼錯誤")
                    }
                })
            }else{
                alert("查無帳號")
            }
        })
    }


</script>