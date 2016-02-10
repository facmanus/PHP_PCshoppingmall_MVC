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
	<table border="1" >
		<tr>
			<td colspan='2'><img class='img-responsive' src=<?=$productImagePath?><?=$fImgFileName?> width=600 border="0"/></td>
		</tr>
		<tr>
			<td>옵션</td>
			<td>
				<select name="pcategory"  placeholder="상품카테고리">
					<option value="option1">일반유리</option>
					<option value="option2">강화유리</option>
					<option value="option3">무광유리</option>
					<option value="option4">우광유리</option>
				</select>	
			</td>
		</tr>
		<tr>
			
			<td colspan="2">
				<div ng-app="myApp" ng-controller="costCtrl">

					수량  : <input type="number" ng-model="quantity">
					<br>
					가격  : <input type="number" ng-model="price">

					<p>합계 = {{ (quantity * price) | currency }}</p>

				</div>

				<script>
					var app = angular.module('myApp', []);
					app.controller('costCtrl', function($scope) {
						$scope.quantity = 1;
						$scope.price = <?=$product_info['pprice']?>;
					});
				</script>
		</td>
	</tr>
	<tr>
		<td>장바구니</td>
	</tr>
	<tr>
		<td>바로구매</td>
	</tr>
	<tr>
		<td>모바일구매</td>
	</tr>
	<tr>
		<td>관심상품등록</td>
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