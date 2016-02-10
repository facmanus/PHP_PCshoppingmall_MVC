<?php $content=isset($_SESSION['detail_content'])?$_SESSION['detail_content']:false ?>
<table border="1">
	<?php
			echo"<tr><td>".$content[0]['fnum']."번글</td><td colspan='5'>".$content[0]['subject']."</td></tr>";
			echo"<tr><td>조회수</td><td>".$content[0]['hitcount']."</td><td>작성일</td><td>".$content[0]['registdate']."</td><td>글쓴이</td><td>".$content[0]['nick']."</td></tr>";
			echo"<tr><td colspan='6'>내용</td></tr>";
			echo"<tr><td colspan='6'>".$content[0]['content']."</td></tr>";
			echo"<tr><td colspan='6'>댓글</td></tr>";
			echo"<tr><td colspan='6'>";
			include"./body/comment.php";
			echo"</td></tr>";
	?>
</table>