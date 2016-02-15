<?php $content=isset($_SESSION['detail_content'])?$_SESSION['detail_content']:false 
	
?>
<table width=500 border=1 cellpadding=2 cellspacing=1 bgcolor=#eeeee  style="font-size: 11" class="table">
	<?php
			echo"<tr><td bgcolor=#ffe3ee>".$content[0]['fnum']."번글</td><td colspan='5'>".$content[0]['subject']."</td></tr>";
			echo"<tr><td bgcolor=#ffe3ee>조회수</td><td>".$content[0]['hitcount']."</td><td bgcolor=#ffe3ee>작성일</td><td>".$content[0]['registdate']."</td><td bgcolor=#ffe3ee>글쓴이</td><td>".$content[0]['nick']."</td></tr>";
			echo"<tr><td colspan='6' bgcolor=#ffe3ee>내용</td></tr>";
			echo"<tr><td colspan='6'>".$content[0]['content']."</td></tr>";
			echo"<tr><td colspan='6' bgcolor=#ffe3ee>댓글</td></tr>";
			echo"<tr><td colspan='6'>";
			include"./body/comment.php";
			echo"</td></tr>";
	?>
</table>
<?php
 	if(($_SESSION['login_seccess_member_id']==$_SESSION['detail_content'][0]['mnum'])||($_SESSION['login_seccess_level']==99)){
		echo"<a>수정</a>";
		
		echo"<a href='../controller/MainCTL.php?action=611&fnum=".strval($content[0]['fnum'])."'>삭제</a>";
	}

	echo"<a href='../controller/MainCTL.php?action=620'>답글</a>";
	$parent['subject']=$content[0]['subject'];
	$parent['content']=$content[0]['content'];
	$parent['family']=$content[0]['family'];
	$parent['orderby']=$content[0]['orderby'];
	$parent['step']=$content[0]['step'];
?>

<form name="comunnityAnswer" action="../controller/MainCTL.php?action=630" method="post">
	<input type='submit' value="답글">
	<input type='hidden' name='parent_sub' value="<?=$parent['subject'] ?>">
	<input type='hidden' name='parent_con' value="<?=$parent['content'] ?>">
	<input type='hidden' name='parent_fam' value="<?=$parent['family'] ?>">
	<input type='hidden' name='parent_ord' value="<?=$parent['orderby'] ?>">
	<input type='hidden' name='parent_stp' value="<?=$parent['step'] ?>">
</form>
