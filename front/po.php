<div>
    <p>目前位置: 首頁 > 分類網誌 > <span id="nav">健康新知</span></p>
</div>

<div style="display: flex;">
    <fieldset style="width: 25%;">
        <legend>分類網誌</legend>
        <div class="po" data-type="1">健康新知</div>
        <div class="po" data-type="2">菸害防治</div>
        <div class="po" data-type="3">癌症防治</div>
        <div class="po" data-type="4">慢性病防治</div>
    </fieldset>
    <fieldset style="flex: 1;">
        <legend>文章列表</legend>
        <div class="title">

        </div>        
        <div class="content">

        </div>
    </fieldset>
</div>
<script>
    $(".po").click(function(){
        let text = $(this).text()
        $("#nav").text(text)
        let type = $(this).data('type')
        getList(type);
    })
    function getList(type){
        $.post("./api/getList.php",{type},function(res){
            console.log(res);
            $(".title").html(res)
            $(".title").show()
            $(".content").hide()

        })
    }
    function getNews(id){
        console.log(id);
        $.post("./api/getNews.php",{id},function(res){
            $(".content").html(res)
            $(".content").show()
            $(".title").hide()
        })
    }
    getList(1);
</script>