<center>
<?php
    //액션에 따른 서브메뉴 처리
    $mainMenuShortNum = intval($action/100);
    $subMenuShortNum=intval($action%100);
    $_SESSION['pageNum'] =$pageNum= isset($_REQUEST['pageNum'])?$_REQUEST['pageNum']:null;
    for($cnt = 1; $cnt <=5; $cnt++){
        $codeNum = $mainMenuShortNum * 100 + $cnt * 10;
        echo "<a href='../controller/MainCTL.php?action=$codeNum&pageNum=1";
        echo "' style='text-decoration:none'>";

        if($subMenuShortNum == $cnt * 10){
            echo "<img src='../../img/leftMc/$codeNum.png'>";
        }else{
            echo "<img src='../../img/leftM/$codeNum.png'>";
        }
        echo "</a>";
        echo "<br/><br/>";
    }
?>