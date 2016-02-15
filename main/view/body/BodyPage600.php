<?php
	$comunnityList=isset($_SESSION['comunityList'])?$_SESSION['comunityList']:false;
	$pageInfo=isset($_SESSION['PageInfo'])?$_SESSION['PageInfo']:false;

	echo"현재 ".$pageInfo['all_record_num']."개의 글이 있습니다.";
?>
<html>
    <!-- <form action="../controller/MainCTL.php?action=916" method="post"> -->
       
    <table width=500 border=0 cellpadding=2 cellspacing=1 bgcolor=#eeeee  style="font-size: 11" class="table">

    <tr height=10 bgcolor=#eeeeee>
        <td width=10 align=center><b>글번호</b></td>
        <td width=50 align=center><b>제목</b></td>
        <td width=50 align=center><b>작성자</b></td>
        <td width=50 align=center><b>작성일</b></td>
        <td width=50 align=center><b>조회</b></td>
    </tr>
<?php  
	// 커뮤니티 게시판 글목록
	for($i=0;$i<count($comunnityList);$i++){
		echo"<tr>";
		echo("<td>".$comunnityList[$i]['fnum']."</td>");
		echo("<td><a href='../controller/MainCTL.php?action=610&fnum=".$comunnityList[$i]['fnum']."'>".$comunnityList[$i]['subject']."</a></td>");
		echo("<td>".$comunnityList[$i]['nick']."</td>");
		echo("<td>".$comunnityList[$i]['registdate']."</td>");
		echo("<td>".$comunnityList[$i]['hitcount']."</td>");
		echo"</tr>";
	}
	echo"<a href='../controller/MainCTL.php?action=601'>글쓰기<a>";

?>

</table>
<?php include "../view/common/pageNavigation.php"; ?>