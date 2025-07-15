<div class="nav">
    目前位置：首頁 > 人氣文章區
</div>

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
        <td><?=$row['title'];?></td>
        <td>
            <div class="short"><?=mb_substr($row['text'],0,30);?>...</div>
            <div class="all"></div>
        </td>
        <td></td>
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