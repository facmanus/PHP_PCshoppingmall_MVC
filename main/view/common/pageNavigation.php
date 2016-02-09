<center>
    <?php
    $PageInfo = isset($_SESSION['PageInfo'])?$_SESSION['PageInfo']:null;
    echo "<table width='400'><tr>";
    // 처음페이지 이동
    echo "<td width='30'>";
    if($PageInfo['first_page'] == 0){
        echo "△";
    }else{
        echo "<a href='../controller/MainCTL.php?action={$action}&pageNum={$PageInfo['first_page']}'>▲</a>";
    }
    echo "</td>";
    // 이전 블럭으로 이동
    echo "<td width='30'>";
    if($PageInfo['pre_block'] == 0){
        echo "□";
    }else{
        echo "<a href='../controller/MainCTL.php?action={$action}&pageNum={$PageInfo['pre_block']}'>■</a>";
    }
    echo "</td>";
    // 이전 페이지 이동
    echo "<td width='30'>";
    if($PageInfo['first_page'] == false){
        echo "◁";
    }else{
        $prePageNum = $PageInfo['current_page_num']-1;
        echo "<a href='../controller/MainCTL.php?action={$action}&pageNum={$prePageNum}'>◀</a>";
    }
    echo "</td>";
    //현재 블럭의 페이지 표시
    
    for( $cnt = 0; $cnt < $PageInfo['countpage_inblock']; $cnt++ ){
        echo "<td width='30'>";
    echo"<ul class='pagination'>";
        $currentBlockPageNum = $PageInfo['start_page_num']+$cnt;
        if( $currentBlockPageNum == $PageInfo['current_page_num'])
            echo "<li class='active'><a href='../controller/MainCTL.php?action={$action}&pageNum={$currentBlockPageNum}'  >[{$currentBlockPageNum}]</a></li>";
        else
            echo "<li><a href='../controller/MainCTL.php?action={$action}&pageNum={$currentBlockPageNum}'>  {$currentBlockPageNum}  </a></li>";
        echo"</ul>";
    echo "</td>";
    }

    // 다음 페이지 이동
    echo "<td width='30'>";
    if($PageInfo['last_page'] == false){
        echo "▷";
    }else{
        $nextPageNum = $PageInfo['current_page_num']+1;
        echo "<a href='../controller/MainCTL.php?action={$action}&pageNum={$nextPageNum}'>▶</a>";
    }
    echo "</td>";
    // 다음 블럭으로 이동
    echo "<td width='30'>";
    if($PageInfo['next_block'] == 0){
        echo "□";
    }else{
        echo "<a href='../controller/MainCTL.php?action={$action}&pageNum={$PageInfo['next_block']}'>■</a>";
    }
    echo "</td>";
    // 마지막 페이지 이동
    echo "<td width='30'>";
    if($PageInfo['last_page'] == 0){
        echo "▽";
    }else{
        echo "<a href='../controller/MainCTL.php?action={$action}&pageNum={$PageInfo['all_page_num']}'>▼</a>";
    }
    echo "</td>";

    echo "</tr></table>";

    ?>

    <form action="../controller/MainCTL.php?action={$action}" method="post">
        <input type='text' name='search' placeholder='디버깅하다가 구현실패'>
        <input type='submit' value='찾기'>
    </form>
</center>