<?php
session_start();
    $action = isset($_REQUEST['action'])?   $_REQUEST['action'] :   100;
    //현재 로그인 상태라면 세션에 login_id가 있을 것이다.
    $login_id = isset($_REQUEST['login_id'])? $_REQUEST['login_id'] : false;
    //현재 로그인 상태라면 login_id_level을 세션에 담는다.
    $login_id_level = isset($_REQUEST['login_id_level'])? $_REQUEST['login_id_level'] : null;
    $_SESSION['msg']=isset($_SESSION['msg'])?$_SESSION['msg']:null;
    $productlist=$_SESSION['productlist']=isset($_SESSION['productlist'])?$_SESSION['productlist']:null;
    $PageInfo = isset($_SESSION['PageInfo'])?$_SESSION['PageInfo']:null;
    $_SESSION['pageNum']=$pageNum = isset($_REQUEST['pageNum'])?$_REQUEST['pageNum']:1;
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <title>Beom PC Shop</title>
  <!-- 부트스트랩 적용을 위한 추가내용 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style type="text/css">
            %import url(/css/aLinkNoUnderLine.css);
        </style>
        <!-- 앙귤라js추가 -->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
    <body>
    <!-- 부트스트랩 상단 메뉴 시작 -->
            <?php
                include("./topmenu.html");
            ?>
         <!-- 부트스트랩 상단 메뉴 끝-->
         <center><?php include "./Title.php" ?></center>
        <table width = "800"align="center" border="0" class="table">
            <tr><td colspan="2" width="800" height="50"><?php include "./login_window.php" ?> </td></tr>

            <tr>
                    <?php 
                        //일반 모드일 경우
                        if(intval($action/1000)!=9){
                            if(intval($action/100)==3&&$_SESSION['login_seccess_level']<2){
                                echo("<td colspan=2 width='800' height='500'>");
                                echo"<h2 align='center'>죄송합니다.<br> 레벨2 이상만 접속가능합니다. </h2>";
                                echo("</td>");
                            }
                            elseif(intval($action/100)==4&&$_SESSION['login_seccess_level']<5){
                                echo("<td colspan=2 width='800' height='500'>");
                                echo"<h2 align='center'>죄송합니다.<br> 레벨5 이상만 접속가능합니다. </h2>";
                                echo("</td>");
                            }
                            elseif(intval($action/100)==5&&$_SESSION['login_seccess_level']<10){
                                echo("<td colspan=2 width='800' height='500'>");
                                echo"<h2 align='center'>죄송합니다.<br> 레벨5 이상만 접속가능합니다. </h2>";
                                echo("</td>");
                            }
                            elseif(intval($action/100)==6){
                                if(isset($_SESSION['login_seccess_id'])){
                                    echo("<td colspan=2 width='800' height='500'>");
                                        include("./body/BodyPage".strval($action).".php");
                                    echo("</td>");
                                }
                                else{
                                    echo("<td colspan=2 width='800' height='500'>");
                                    echo"<h2 align='center'>죄송합니다.<br> 로그인사용자만 사용가능합니다. </h2>";
                                    echo("</td>");
                                }
                            }
                            elseif(intval($action/100)==9){
                                echo("<td colspan=2 width='800' height='500'>");
                                    include "./MainBody.php";
                                echo("</td>");
                            }
                            else{
                                echo"<td width='150' height='500'> ";
                                 include "./LeftMenu.php" ;
                                echo"</td> <td width='650' height='500'>";
                                include "./MainBody.php";
                                echo"</td>";
                            }
                        }
                        //관리자 모드일 경우
                        else{
                            echo" <td colspan=2 width='800' height='500'>";
                                    if($action==9213){
                                        include "./admin_page/admin_Body9210.php";
                                    }else{
                                        include "./admin_page/admin_Body".strval($action).".php";
                                    }
                                echo"</td>";
                        }
                    ?>
            </tr>
            
            <tr>
                <td colspan="2" width="800" height="50">
                    <?php include "./Copyright.php" ?>
                </td>
            </tr>
        </table>
    </body>
</html>
