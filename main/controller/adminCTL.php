<?php
	//정말 관리자모드로 진입할 때 
	include_once("../model/ProductMD.php");
	//천자리를 제외한 백자리수를 가지고 액션 처리.
	$short_num = intval($action%9000);

	switch ($short_num) {
		case 0:

//회원관리
		case 100:
					$_SESSION['PageInfo'] = getPageInfo($pageNum);
        			$_SESSION['memberList'] = MemberPageInfo($pageNum);
			break;

// 상품관리
		case 200:
					$all_product_limit=array(10,5);
					$all_record_num = getAllProductCount();
					$_SESSION['PageInfo']= productPageInfo($pageNum,$all_record_num,$all_product_limit[0],$all_product_limit[1]);
					$_SESSION['productlist']=all_product_selecting($_SESSION['PageInfo']);
			break;
		case 210:
					
			break;

// 구매관리
		case 300:
			# code...
			break;

// 결제관리
		case 400:
			# code...
			break;

// 배송관리	
		case 500:
			# code...
			break;

// 매출관리
		case 600:
			# code...
			break;

// 게시판관리
		case 700:
			# code...
			break;

		default:
			$action=9000;
			break;
	}
    


?>