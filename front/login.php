<style>
    .login_box{
        display: flex;
        justify-content: space-between;
    }
</style>

<fieldset class="cent" style="width:500px">
    <legend>會員登入</legend>
    <form action="">
        <table width="60%" class="mt">
            <tr>
                <td>帳號</td>
                <td><input type="text" id="acc"></td>
            </tr>
            <tr>
                <td>密碼</td>
                <td><input type="password" name="" id="pw"></td>
            </tr>
        </table>
    </form>
    <div class="login_box">
        <div>
            <input type="button" value="登入" onclick="login()">
            <input type="reset" value="清除">
        </div>
        <div>
            <a href="?do=forget">忘記密碼</a>|
            <a href="?do=reg">尚未註冊</a>
        </div>
    </div>

</fieldset>

<script>

function login(){

    let user = {
        acc : $('#acc').val(),
        pw : $('#pw').val(),
    }

    $.post("./api/acc.php",{acc:user.acc},function(res){
        if (Number(res) <= 0) {
            alert("查無帳號");
            $('form')[0].reset()
        }
        else{
            $.post("./api/pw.php",user,function(res){
                if (Number(res) > 0 ) {
                    if (user.acc == "admin") {
                        location.href = "admin.php"
                    }else {
                        location.href = "index.php"
                    }
                }else {
                    alert("密碼錯誤");
                    $('form')[0].reset()
                }
            })
        }
    })


}

</script>