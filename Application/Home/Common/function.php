<?php
/**
 * 组装AJAX节点加载的数据分页函数
 * @param unknown $page  当前页
 * @param unknown $total 总页数
 * @return string
 */
function PageList($page,$total,$type){
    if ($page==1){
        $f="class=disabled";
    }
    if ($page==$total){
        $n="class=disabled";
    }
    
    $_pagelist.='<ul class="pagination">';
    
    $_pagelist.='<li '.$f.'><a href="javascript:void(0)" aria-label="Previous" page="1" class="'.$type.'"><span aria-hidden="true">&laquo;</span></a></li>';
    
    for ($i=C('PAGE_NUM');$i>=1;$i--){
    
        $_page=$page-$i;
        if ($_page<1)continue;
        $_pagelist.='<li><a href="javascript:void(0)" page="'.$_page.'" class="'.$type.'">'.$_page.'</a></li>';
    
    }
    $_pagelist.='<li class="active"><a href="javascript:void(0)" page="'.$page.'" class="'.$type.'">'.$page.'</a></li>';
    for ($i=1;$i<=C('PAGE_NUM');$i++){
        $_page=$page+$i;
        if ($_page>$total)break;
        $_pagelist.='<li><a href="javascript:void(0)" page="'.$_page.'" class="'.$type.'">'.$_page.'</a></li>';
    }
    $_pagelist.='<li '.$n.'><a href="javascript:void(0)" aria-label="Next" page="'.$total.'" class="'.$type.'"><span aria-hidden="true">&raquo;</span></a></li>';
    $_pagelist.='</ul>';
    return $_pagelist;
}