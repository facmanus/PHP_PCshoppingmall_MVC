<?php
	if($productlist==false){
		echo"상품이 없습니다.";
	}
	else{
?>
 <form action="../controller/MainCTL.php?action=9212" method="post">
<table width=500 border=0 cellpadding=2 cellspacing=1 bgcolor=#eeeee  style="font-size: 11" class="table">
	<tr height=10 bgcolor=#eeeeee>
		<td align=center>상품번호</td>
		<td align=center>카테고리</td>
		<td align=center>코드</td>
		<td align=center>상품명</td>
		<td align=center>재고량</td>
		<td align=center>가격</td>
		<td align=center>이미지명</td>
		<td align=center>썸네일명</td>
		<td align=center>UPD</td>
		<td align=center>DEL</td>
	</tr>

<?php


	   	foreach($productlist as $product){
	   		echo"<tr>";
	   		foreach($product as $pro => $value){
	   			echo"<td>";
	   			echo($value);
	   			echo"</td>";
	   		}
	   		
	   		echo "<td align='center'><a href = '../controller/MainCTL.php?action=9213&up_product_num={$product['pnum']}'><img src='../../img/UPD.png'></a></td>"; 
            echo "<td align='center'><input type='checkbox' name='product_num[]' value='{$product['pnum']}'</td>";
            echo "</tr>";
	   	}
    
?>
        <tr ><td colspan='9'>
   <?php include "../view/common/pageNavigation.php"; ?>
    </td>
    <td>
    <a href='../controller/MainCTL.php?action=9210' class="btn btn-danger">상품정보입력</a>
    </td>
        </td><td align="center"><input type="submit" value="삭제"  class="btn btn-danger"></td>
</table>
<?php
	}
?>



