<fieldset>
    <p>請輸入信箱以查詢密碼</p>
    <input type="email" name="" id="email">
    <div id="tip"></div>
    <div>
        <input type="button" value="尋找" onclick="forget()">
    </div>
</fieldset>

<script>

function forget(){

    let user = {
        email : $('#email').val(),
    }

    $.post("./api/email.php",user,function(res){
        $('#tip').text(res)
    })
}
</script>