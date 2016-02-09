<?php

	if($productlist==false){
		echo"상품이 없습니다.";
	}
	else{
?>

<table border='0' class="table">
	<tr>
		<td>순번</td>
		<td>카테고리</td>
		<td>코드</td>
		<td>상품명</td>
		<td>재고량</td>
		<td>가격</td>
		<td>이미지명</td>
		<td>썸네일명</td>
	</tr>

<?php


	   	foreach($productlist as $product){
	   		echo"<tr>";
	   		foreach($product as $pro => $value){
	   			echo"<td>";
	   			echo($value);
	   			echo"</td>";
	   		}
	   		echo"</tr>";
	   	}
    
?>
        <tr ><td colspan='8'>
   <?php include "../view/common/pageNavigation.php"; ?>
    </td></tr>
    </table>
<?php
	}
?>

