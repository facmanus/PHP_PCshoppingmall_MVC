<?php
	if($productlist==false){
		echo"상품이 없습니다.";
	}
	else{
		$pageInfo=isset($_SESSION['PageInfo'])?$_SESSION['PageInfo']:false;
    	echo"총 상품이 ".$pageInfo['all_record_num']."개가 있습니다.";
?>
 <form action="../controller/MainCTL.php?action=9212" method="post">
<table width=500 border=0 cellpadding=2 cellspacing=1 bgcolor=#eeeee  style="font-size: 11" class="table">
	<tr height=10 bgcolor=#eeeeee>
		<td align=center>상품번호</td>
		<td align=center>카테고리</td>
		<td align=center>코드</td>
		<td align=center>상품명</td>
		<td align=center>가격</td>
		<td align=center>재고량</td>
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
	   			if($pro=='pname'){
	   				echo "<a href='../controller/MainCTL.php?action=920&pnum=".strval($product['pnum'])."''>".strval($value)."</a>";
	   			}
	   			else{
	   				echo($value);
	   			}
	   			echo"</td>";
	   		}
	   		
	   		echo "<td align='center'><a href = '../controller/MainCTL.php?action=9213&up_product_num={$product['pnum']}'><img src='../../img/UPD.png'></a></td>"; 
            echo "<td align='center'><input type='checkbox' name='product_num[]' value='{$product['pnum']}'</td>";
            echo "</tr>";
	   	}
    
?>
        <tr ><td colspan='8'>
   <?php include "../view/common/pageNavigation.php"; ?>
    </td>

    <td>
<?php
	}
?>
    
    <a href='../controller/MainCTL.php?action=9210' class="btn btn-danger">상품정보입력</a>
<?php
	if($productlist!=false){    
?>
    </td>
        </td><td align="center"><input type="submit" value="삭제"  class="btn btn-danger">
        						<input type="hidden" name="product_img[]" value="<?=$product['pfimage']?>">
        						<input type="hidden" name="product_imgS[]" value="<?=$product['psimage']?>">
			</td>

</table>
<?php
	}
?>

