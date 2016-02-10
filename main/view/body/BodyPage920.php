<?php

	//session_start();

	$product_info = isset($_SESSION['product_info'])?$_SESSION['product_info']:null;
	$retaction = isset($_REQUEST['retaction'])?$_REQUEST['retaction']:null;

	$productImagePath = "../../img/product/"; // 상품이미지 저장 디렉토리
	$ProductThumbnailPath = "../../img/product_s/"; // 상품 썸네일 이미지 저장 디렉토리
	$staticImagePath = "../../img/static_img/"; // 정적 이미지 저장 디렉터리

	$noImgFileName = "NOIMG.JPG"; // 이미지가 존재하지 않을 때 표시할 이미지 파일명
	$fImgFileName = strval($productImagePath).strval($product_info['pfimage']);

	if( ! file_exists($fImgFileName) || ! $product_info['pfimage']) // 이미지 파일이 존재 하지 않거나 정보가 없다면 NOIMG.JPG파일로 대치
	  $fImgFileName = strval($staticImagePath).$noImgFileName;

	echo "<h2>";
	echo " 상품 상세정보</h2>";

	if( ! $product_info ){
	    echo "상품 상세보기 데이터를 가져올 수 없습니다.<br/>";
	    echo "<a href='../controller/MainCTL.php?action=100'>상품보기</a>";
	    echo($_SESSION['product_info']);
	}else{   ?>
	  <table border="0">
	    <tr>
	        <td colspan='2'><img src=<?=$productImagePath?><?=$fImgFileName?> width=600 border="0"/></td>
	        <td rowspan='11'>
	          <font color='red'> 
	              미션:구매관련액션처리<br/><br/>
	              <li>옵션선택<br/>
	              <li>수량선택<br/>
	              <li>장바구니<br/>
	              <li>바로구매<br/>
	              <li>모바일구매<br/>
	              <li>관심상품등록 etc.,<br/>
	        </font>
	        </td>
	    </tr>
	    <tr>
	    <tr><td width='100'>일련번호</td><td><?=$product_info['pnum']?></td></tr>
	    <tr><td width='100'>카테고리</td><td><?=$product_info['pcategory']?></td></tr>
	    <tr><td width='100'>상품코드</td><td><?=$product_info['pcode']?></td></tr>
	    <tr><td width='100'>상품명</td><td><?=$product_info['pname']?></td></tr>
	    <tr><td width='100'>재고량</td><td><?=$product_info['pstock']?></td></tr>
	    <tr><td width='100'>상품가격</td><td><?=$product_info['pprice']?></td></tr>
	    <tr><td width='100'>이미지</td><td><?=$product_info['pfimage']?></td></tr>
	    <tr><td width='100'>썸네일</td><td><?=$product_info['psimage']?></td></tr>
	    </tr>
	    <tr>
	        <td colspan='2'><a href=../controller/MainCTL.php?action=<?=$retaction?>>목록가기</a></td>
	    </tr>
	  </table>


<?php } ?>