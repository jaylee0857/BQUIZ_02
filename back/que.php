<form action="" method="post"></form>
<fieldset>
    <legend>新增問卷</legend>
    <form action="./api/add_que.php" method="post">
        <div>
            <label for="">
                問卷調查
            </label>
            <input type="text" name="subject">
        </div>
        <div id="option">
            <div>
                <label for="">選項</label>
                <input type="text" name="opt[]" id="">
                <input type="button" value="更多" onclick="more()">
            </div>
        </div>
        <input type="submit" value="新增">|
        <input type="reset" value="清空">
    </form>
</fieldset>
<script>
    function more() {
        let opt = `
            <div>
                <label for="">選項</label>
                <input type="text" name="opt[]" id="">
            </div>
        `
        $('#option').append(opt);
    }
</script>