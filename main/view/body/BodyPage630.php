<?php
	$parentinfo=isset($_SESSION['parentinfo'])?$_SESSION['parentinfo']:"none";
	var_dump($parentinfo);
	echo($parentinfo['parent_sub']);
    echo($parentinfo['parent_con']);
    echo($parentinfo['parent_fam']);
    echo($parentinfo['parent_ord']);
    echo($parentinfo['parent_stp']);
?>
<table border="1">
	<form name="memberJoin" action="../controller/MainCTL.php" method="post" enctype="multipart/form-data">
    	<input type="hidden" name='fam' value=<?=$parentinfo['parent_fam'] ?>>
		<input type="hidden" name='ord' value=<?=$parentinfo['parent_ord'] ?>>
		<input type="hidden" name='stp' value=<?=$parentinfo['parent_stp'] ?>> 
		<input type="hidden" name="action" value="631">
		<tr>
			<td>제목</td><td><input type="text" name="subject"  value="<?="&nbsp;&nbsp;└>".$parentinfo['parent_sub']?>"placeholder="제목"></td>
		</tr>
		<tr>
			<td>내용</td>
			<td><input type="checkbox" name="ishtml" value="Y">HTML쓰기</td>
		</tr>
		<tr>
			<td colspan="2"><textarea name="content" rows="5" cols="60"><?=$parentinfo['parent_con'] ?></textarea></td>
		</tr>
		<tr>
			<td>첨부</td><td><input type="file" name="file[]" multiple></td>
		</tr>
		
	    <tr>
	    	<td><input type="reset" value="취소"></td>
	    	<td>
	    		<input type="submit" value="저장">
	    		
	    	</td>

	    </tr>
	</form>
</table>
