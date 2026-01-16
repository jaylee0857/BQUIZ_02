<fieldset>
    <legend>新增問卷</legend>
    <form action="./api/add_que.php" method="post">
        <div>問卷名稱: <input type="text" name="subject" id=""></div>
        <div id="options">
            <div>
                <label for="">選項</label>
                <input type="text" name="text[]">
                <input type="button" value="更多" onclick="more()">
            </div>
        </div>
        <div>
            <input type="submit" value="新增">|<input type="reset" value="清空">
        </div>
    </form>

</fieldset>

<script>
    function more() {
        let op = `
            <div>
                <label for="">選項</label>
                <input type="text" name="text[]">
            </div>
        `
        $('#options').prepend(op);
    }
</script>

