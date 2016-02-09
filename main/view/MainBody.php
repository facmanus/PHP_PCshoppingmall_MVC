<center>

<?php
    $mainMenuShortNum = floor($action/100);
    $codeNum = $mainMenuShortNum * 100;

    if(intval($action/1000)!=9){
        if($mainMenuShortNum<=5){
        	include "./body/BodyPage.php";
        }
        elseif($action==914){
        	include "./body/BodyPage910.php";
        }
        else{
        	include "./body/BodyPage".strval($action).".php";
    	}
    }
    else{
        include "./admin_page".strval($action).".php";
    }
?>

</center>
