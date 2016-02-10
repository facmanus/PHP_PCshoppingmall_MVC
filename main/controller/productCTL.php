<?php
	include_once("../model/ProductMD.php");
	$_SESSION['pageNum']=$pageNum = isset($_REQUEST['pageNum'])?$_REQUEST['pageNum']:1;
	//카테고리를 담기위한 2차원 배열 
	$pcategory=array(
					array('C','C1','C2','C3','C4','C5'), //100 110,120...
					array('S','S1','S2','S3','S4','S5'), //200 210,220...
					array('B','B1','B2','B3','B4','B5'), //300 310 320...
					array('H','H1','H2','H3','H4','H5'), //400 410...
					array('A','A1','A2','A3','A4','A5')  //500...
				);

	//각 카테고리 마다 한페이지당 보여줄 게시물 수, 페이지네이션 한 블럭당 보여줄 페이지네이션 넘버 
	$product_limit=array(
					array(15,5),
					array(10,5),
					array(15,5),
					array(20,5),
					array(5,5)
				);

	//액션값에 의한 카테고리, limit 배열 처리
	$main_p=intval($action/100)-1;
	$sub_p=intval($action/10)%10;

	//select한 카테고리의 레코드수를 알기위한 처리 
	if(($action%100)==0){
		$all_record_num = getProductCount($pcategory[$main_p][0]);
	}
	else{
		$all_record_num = getProductCount($pcategory[$main_p][$sub_p]);
	}

	//페이지당의 정보를 계산하기위한 처리
	$_SESSION['PageInfo']= $PageInfo = productPageInfo($pageNum,$all_record_num,$product_limit[$main_p][0],$product_limit[$main_p][1]);

	//페이지네이션 처리를 위한 한페이지당 출력할 게시물을 알기위한 처리
	if(($action%100)==0){
		$_SESSION['productlist']=product_selecting($pcategory[$main_p][0],$PageInfo);
	}
	else{
		$_SESSION['productlist']=product_selecting($pcategory[$main_p][$sub_p],$PageInfo);
	}

	
?>