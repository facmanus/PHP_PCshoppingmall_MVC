<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2015-10-26
 * Time: 오후 1:53
 */
if($action>=9000){
	echo"<img class='img-responsive' src='../../img/title/admintitle.png' alt='title' width='460' height='345'> ";
}
else{
	echo"<img class='img-responsive' src='../../img/title/title".strval(intval($action/100)*100).".png' alt='title' width='460' height='345'> ";
}
?>
