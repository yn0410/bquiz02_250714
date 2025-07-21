<!-- 老師在新分支"adv"中有改東西 在這個檔案中 -->
<!-- 老師在新分支"adv2"中有改東西 在這個檔案中 -->
<div class="nav">
    目前位置：首頁 > 人氣文章區
</div>

<style>
    .title{
        cursor: pointer;
        color: blue;
    }
    .title:hover{
        text-decoration: underline;
        color:green;
    }
    .pop{
		background:rgba(51,51,51,0.8);
		color:#FFF;
		/* min-height:100px; */
        height: 400px;
		width:500px;
		position:fixed;
		display:none;
		z-index:9999;
		overflow:auto;
	}
</style>

<table style="width: 95%; margin: auto;">
    <tr class="ct">
        <td width="20%">標題</td>
        <td width="50%">內容</td>
        <td></td>
    </tr>
    <?php 
        $total=$News->count();
        $div=3;
        $pages=ceil($total/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;
        $rows=$News->all(" order by `good` desc limit $start,$div");
        foreach($rows as $idx => $row):    
    ?>
    <tr>
        <td class="title"><?=$row['title'];?></td>
        <td>
            <div class="short"><?=mb_substr($row['text'],0,30);?>...</div>
            <div class="all">
                <div id="alerr" class="pop">
                    <h2><?=$Type[$row['type']];?></h2>
                    <pre id="ssaa">
                        <?=$row['text'];?>
                    </pre>
                </div>
            </div>
        </td>
        <td>
            <span><?=$row['good'];?></span>個人說
            <!-- <span class="num"> 同上 </span>個人說 -->
            <img src="./icon/02B03.jpg" style="width:18px;">
            <?php
            if(isset($_SESSION['login'])):
                $chk=$Log->count(['news'=>$row['id'],'user'=>$_SESSION['login']]);
            ?>
                <a href="#" onclick="good(<?=$row['id'];?>/*,this*/)"><?=($chk)?'-收回讚':'-讚';?></a>
                <!-- <a href="#" class="g" data-id="<?php //$row['id'];?>"><?php //($chk)?'-收回讚':'-讚';?></a> -->
            <?php
            endif;
            ?>
        </td>
    </tr>
    <?php 
        endforeach;
    ?>
</table>
<div>
    <?php
    if($now-1>0){
        echo "<a href='?do=pop&p=".($now-1)."' style='font-size:18px'> < </a>";
    }
    for($i=1; $i<=$pages; $i++){
        $size=($i==$now)?'24px':'18px';
        echo "<a href='?do=pop&p=$i' style='font-size:{$size}'> $i </a>";
    }
    if($now+1<=$pages){
        echo "<a href='?do=pop&p=".($now+1)."' style='font-size:18px'> > </a>";
    }

    ?>
</div>
<script>
    $(".title").hover(
        function(){
            $(this).next().find(".pop").show();
        },
        function(){
            $(this).next().find(".pop").hide();
        }
    )

    function good(news){
    // function good(news,dom){
        $.post("./api/good.php",{news},function(){
            location.reload();
            // 不用上面一行
            /*let good;
            switch($(dom).text()){
                case '-讚':
                    $(dom).text("-收回讚")
                    good=parseInt($(dom).prev().prev().text())+1
                break;
                case '-收回讚':
                    $(dom).text("-讚")
                    good=parseInt($(dom).prev().prev().text())-1
                break;
            }
                
                $(dom).prev().prev().text(good)
             */
        })

    }
    
    /* 分支"adv2": 不要function good()了
    $('.g').on('click',(event)=>{
        let target=event.target
        let news=$(target).data('id');
        
            $.post("./api/good.php",{news},()=>{
            let good;
            switch($(target).text()){
                case '-讚':
                    $(target).text("-收回讚")
                    good=parseInt($(target).prev().prev().text())+1
                break;
                case '-收回讚':
                    $(target).text("-讚")
                    good=parseInt($(target).prev().prev().text())-1
                    break;
                }
                
                $(target).prev().prev().text(good)
                //location.reload();
            })

    }) */
</script>