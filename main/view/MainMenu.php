<center>
<?php
    $_SESSION['pageNum'] =$pageNum= isset($_REQUEST['pageNum'])?$_REQUEST['pageNum']:null;
    if(intval($action/1000)==9){
        include ("./admin_page/admin_MainMenu.php");
    }
    else{
        $mainMenuShortNum = intval($action/100);

        for($cnt = 1; $cnt <=5; $cnt++){
            $codeNum = $cnt * 100;
            echo "<a href ='../controller/MainCTL.php?action=$codeNum&pageNum=1' style='text-decoration:none'>";
            if($mainMenuShortNum==$cnt){
                echo "<img src='../../img/{$codeNum}c.png'>";
            }
            else{
                echo "<img src='../../img/$codeNum.png'>";
            }
            echo "</a>";
        }
    }

?>
</center>