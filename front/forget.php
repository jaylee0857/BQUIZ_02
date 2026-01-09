    <fieldset>
        <legend>忘記密碼</legend>
        <form action="./api/forget.php" method="post">
            <div>請輸入信箱以查詢密碼</div>
            <div>
                <input type="email" name="email" id="email">
            </div>
            <div id="result"></div>
            <div>
                <input type="button" value="尋找" onclick="forget()">
            </div>
        </form>
    </fieldset>

<script>

    function forget(){
        let email = $('#email').val();
        $.post("./api/chk_email.php",{email},(res)=>{
            $('#result').text(res);
        })
    }

</script>