<style>
    .po-item {
        display:block;
    }
</style>
<div>
目前位置：首頁 > 分類網誌 > <span id="nav">健康新知</span>
</div>
<div style="display:flex">
    <fieldset style="width: 25%;">
        <legend>分類網誌</legend>
        <a href="#" class="po-item" data-type="1">健康新知</a>
        <a href="#" class="po-item" data-type="2">菸害防治</a>
        <a href="#" class="po-item" data-type="3">癌症防治</a>
        <a href="#" class="po-item" data-type="4">慢性病防治</a>
    </fieldset>
    <fieldset  style="width: 70%;">
        <legend>文章列表</legend>
        <div class="list">

        </div>
        <div class="content">

        </div>
    </fieldset>
</div>

<script>
    // init
    getList(1)
    // init end
    $(".po-item").on("click",function(){
        let text = $(this).text();
        $('#nav').text(text);
        let type = $(this).data('type')
        // console.log(type);
        getList(type);

    })

    function getList(type){
        console.log(type);
        
        $.get("./api/get_list.php",{type},function(res){
            $(".list").html(res);
        })
        $(".list").show()
        $(".content").hide()
    }

    function getPost(id){
        $.get("./api/get_news.php", {id},function(res){
            $('.content').html(res)
        })
        $(".content").show()
        $(".list").hide()

    }
</script>