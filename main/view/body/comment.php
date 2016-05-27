<table border="1">
	<tr>
		<td colspan="3">
		<?php 			
			if($_SESSION['login_seccess_member_id']!=false){
		?>
			<form action='../controller/MainCTL.php?action=620' method='POST'>
				<textarea name='comment_content'>댓글내용을 남겨주세요.</textarea>
				<input type='hidden' name='fnum' value=<?=$content[0]['fnum']?>>
				<input type='hidden' name='mnum' value=<?=$content[0]['mnum']?>>
				<input type='submit' value='댓글남기기'>
			</form>
		<?php 
			} 
		?>
		</td>
	</tr>
	<tr>

		<?php
			for($i=1;$i<count($content);$i++){
				echo"<tr><td>".$content[$i]['content']."</td>";
				echo"<td>".$content[$i]['nick']."</td>";
				echo"<td>".$content[$i]['registdate']."</td></tr>";
			}
		?>

	</tr>
</table>