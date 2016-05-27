<?
	// 커뮤니티 글쓰기
?>
<table border="1">
	<form name="memberJoin" action="../controller/MainCTL.php" method="post" enctype="multipart/form-data">
		<!-- action 602 = 글저장 액션 -->
    	<input type="hidden" name="action" value="602">
		<tr>
			<td>제목</td><td><input type="text" name="subject"  placeholder="제목"></td>
		</tr>
		<tr>
			<td>내용</td>
			<td><input type="checkbox" name="ishtml" value="Y">태그사용하기</td>
		</tr>
		<tr>
			<td colspan="2"><textarea name="content" rows="5" cols="60"></textarea></td>
		</tr>
		<tr>
			<td>첨부</td><td><input type="file" name="file[]" multiple></td>
		</tr>
		
	    <tr>
	    	<td><input type="reset" value="취소"></td><td><input type="submit" value="저장"></td>
	    </tr>
	</form>
</table>
