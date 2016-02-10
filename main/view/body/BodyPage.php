<?php
	$actionIndex = floor($action/100) - 1; // 액션코드에 따른 메뉴 인덱스 계산
	$actionIndex2 = floor($action/10)%10; // 액션코드에 따른 서브메뉴 인텍스 계산

	$productImagePath = "../../img/product/"; // 상품이미지 저장 디렉터리
	$productThumbnailPath = "../../img/product_s/"; // 상품 썸네일 이미지 저장 디렉터리
	$staticImagePath = "../../img/static_img/"; // 정적 이미지 저장 디렉터리

	$noImgFileName = "NOIMG_S.JPG"; // 이미지가 존재하지 않을 때 표시할 이미지 파일명

	if($productlist==false){
		echo"상품이 없습니다.";
	}
	else{
		echo "<table width=500 border=0 cellpadding=2 cellspacing=1 bgcolor=#eeeee  style='font-size: 11' class='table'>";
		if( ! $productlist ){
		    echo "<tr><td colspan='3'>저장된 데이터가 없습니다</td></tr>";
		}else {
		    echo "<tr>";
		    $cnt=0;
		    foreach ($productlist as $product) {
		    	 $fImgFileName = strval($productImagePath).strval($product['pfimage']);
		    	 $thumbImgFileName = strval($productThumbnailPath).strval($product['psimage']);

			    echo "<td>";
			      echo "<a href='../controller/MainCTL.php?action=920&pnum=".strval($product['pnum']); //상세페이지 보기 액션처리
			      echo "&retaction=".strval($action); //retaction : 되돌아가기 액션 정보
			      echo "'><img class='img-responsive' src = '";
			      if( !file_exists($thumbImgFileName) || !$product['psimage']){ // 썸네일 이미지 파일이 존재 하지 않거나 null 이라면.
			      		if( !file_exists($fImgFileName) || !$product['pfimage']) // 썸네일 이미지는 없지만 fimage는 존재 한다면.
			      			echo($staticImagePath.$noImgFileName);
			      		else
			      			echo($fImgFileName);
			      }else{                          // 썸네일 이미지 파일이 존재 하면. 
			      	    echo($thumbImgFileName);
			      }
			      echo "' height='150' border='0'/></a><br/>";
			      echo($product['pcode']); echo "<br/>";
			      echo($product['pname']); echo "<br/>";
			      echo($product['pstock']); echo "개<br/>";
			      echo($product['pprice']); echo "원<br/>";
			    echo "</td>";
			    $cnt++;
			    if($cnt==5){
			    	echo"<tr></tr>";
			    	$cnt=0;
			    }
		    }
		    echo "</tr>";

	}
?>
        <tr ><td colspan='8'>
   <?php include "../view/common/pageNavigation.php"; ?>
    </td></tr>
    </table>
<?php
	}
?>

