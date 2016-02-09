<?php

//session_start();

$product = isset($_SESSION['product'])?$_SESSION['product']:null;
$retaction = isset($_REQUEST['retaction'])?$_REQUEST['retaction']:null;

$productImagePath = "../../img/product/"; // 상품이미지 저장 디렉토리
$ProductThumbnailPath = "../../img/product_s/"; // 상품 썸네일 이미지 저장 디렉토리
$staticImagePath = "../../img/static_img/"; // 정적 이미지 저장 디렉터리

$noImgFileName = "NOIMG.JPG"; // 이미지가 존재하지 않을 때 표시할 이미지 파일명
$fImgFileName = strval($productImagePath).strval($product['pfimage']);

if( ! file_exists($fImgFileName) || ! $product['pfimage']) // 이미지 파일이 존재 하지 않거나 정보가 없다면 NOIMG.JPG파일로 대치
  $fImgFileName = strval($staticImagePath).$noImgFileName;

echo "<h2>";
echo($product['pcode']);
echo " 상품 상세정보</h2>";

if( ! $product ){
    echo "상품 상세보기 데이터를 가져올 수 없습니다.<br/>";
    echo "<a href='../controller/MainCTL.php?action=923'>상품보기</a>";
}else{  ?>
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
    <tr><td width='100'>일련번호</td><td><?=$product['pnum']?></td></tr>
    <tr><td width='100'>카테고리</td><td><?=$product['pcategory']?></td></tr>
    <tr><td width='100'>상품코드</td><td><?=$product['pcode']?></td></tr>
    <tr><td width='100'>상품명</td><td><?=$product['pname']?></td></tr>
    <tr><td width='100'>재고량</td><td><?=$product['pstock']?></td></tr>
    <tr><td width='100'>상품가격</td><td><?=$product['pprice']?></td></tr>
    <tr><td width='100'>이미지</td><td><?=$product['pfimage']?></td></tr>
    <tr><td width='100'>썸네일</td><td><?=$product['psimage']?></td></tr>
    </tr>
    <tr>
        <td colspan='2'><a href=../controller/MainCTL.php?action=<?=$retaction?>>이전목록가기</a></td>
    </tr>
  </table>


<?php } ?>