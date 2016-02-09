<?php
    $memberList = isset($_SESSION['memberList'])?         $_SESSION['memberList']     :   null;
?>

<html>
    <form action="../controller/MainCTL.php?action=916" method="post">
        <table width=500 border=0 cellpadding=2 cellspacing=1 bgcolor=#eeeee  style="font-size: 11" class="table">

    <tr height=10 bgcolor=#eeeeee>
        <td width=20 align=center><b>num</b></td>
        <td width=50 align=center><b>id</b></td>
        <td width=50 align=center><b>name</b></td>
        <td width=50 align=center><b>passwd</b></td>
        <td width=50 align=center><b>level</b></td>
        <td width=50 align=center><b>gender</b></td>
        <td width=50 align=center><b>phone</b></td>
        <td width=50 align=center><b>address</b></td>
        <td width=50 align=center><b>movie</b></td>
        <td width=50 align=center><b>book</b></td>
        <td width=50 align=center><b>shop</b></td>
        <td width=50 align=center><b>sport</b></td>
        <td width=50 align=center><b>intro</b></td>
        <td width=50 align=center><b>UPD</b></td>
        <td width=30 align=center><b>DEL</b></td>
    </tr>
    <?php
        if(!$memberList){
            echo "<tr><td> 회원정보가 존재하지 않습니다.</td></tr>";
        }
        else{
            foreach($_SESSION['memberList'] as $member){
                echo "<tr>";
                foreach($member as $mykey => $myValue){
                    echo"<td>";
                    echo"$myValue";
                    echo"</td>";
                }
                
                echo "<td align='center'><a href = '../controller/MainCTL.php?action=914&up_member_id={$member['member_id']}'><img src='../../img/UPD.png'></a></td>"; 
                echo "<td align='center'><input type='checkbox' name='member_id[]' value='{$member['member_id']}'</td>";
                echo "</tr>";
            }
        }
    ?>
        
    
        <tr ><td colspan='14'>
   <?php include "../view/common/pageNavigation.php"; ?>
    </td><td align="center"><input type="submit" value="삭제"  class="btn btn-danger"></td></tr>
         </table>    
    </form>
<?php include "../view/common/pageSearch.php"; ?>
</html>
