<?php
	// product 입력
	include_once "commonMD.php";

	function insertProduct($data){
	    $query = " INSERT INTO product(pcategory,pcode,pname,pstock,pprice,pfimage,psimage) ";
	    $query.=" VALUES('";
	    $query.=strval($data['pcategory'])."','".strval($data['pcode'])."','".strval($data['pname'])."','".strval($data['pstock'])."','".strval($data['pprice'])."','".strval($data['pfimage'])."','".strval($data['psimage'])."')";
		
	    $result=SQL_CON($query);
	    $autoPnum = mysql_insert_id();

	    $retArr['result'] = $result;
	    $retArr['autoPnum'] = $autoPnum;

	    return $retArr;
	}
	
	function deteil_seleting($pnum){
		$query="SELECT * FROM product WHERE pnum = '".strval($pnum)."'";
		$result =SQL_CON($query);
		$product_info=mysql_fetch_array($result);
        return $product_info;
	}
	//product 삭제
	function produect_deleteing($del_product_num){
		$query="DELETE FROM product WHERE pnum = ".strval($del_product_num);
        $result =SQL_CON($query);
	}
	//product 수정을 위한 조회
	function product_up_selecting($up_product_num){
		$query="SELECT * FROM product WHERE pnum = ".strval($up_product_num);
		$result =SQL_CON($query);
	}
	//product 수정을 위한 함수
	function product_updating($update_product_list){
		$query="update product set pcategory='".strval($update_product_list[1])."',pcode='".strval($update_product_list[2])."',pname='".strval($update_product_list[3])."',pprice='".strval($update_product_list[4])."',pstock='".strval($update_product_list[5])."',pfimage='".strval($update_product_list[6])."' where pnum=".$update_product_list[0];
        $result =SQL_CON($query);
	}

	// product 전체 레코드 테이블 수
	function getAllProductCount(){ 

        $sql = " SELECT count(*) FROM product";
        $result = SQL_CON($sql);
        $count = mysql_result($result, 0, 0);

        return $count;
    }

   	//해당 페이지의 프러덕트 조회 
	function all_product_selecting($PageInfo){
		$query="select * from product limit ".strval($PageInfo['currentpage_start_gesimul_num']).",".strval($PageInfo['CLPP']);
		$result=SQL_CON($query);

		$cnt=0;

		while ($row=mysql_fetch_array($result)) {
			$productlist[$cnt]['pnum']=$row['pnum'];
			$productlist[$cnt]['pcategory']=$row['pcategory'];
			$productlist[$cnt]['pcode']=$row['pcode'];
			$productlist[$cnt]['pname']=$row['pname'];
			$productlist[$cnt]['pprice']=$row['pprice'];
			$productlist[$cnt]['pstock']=$row['pstock'];
			$productlist[$cnt]['pfimage']=$row['pfimage'];
			$productlist[$cnt]['psimage']=$row['psimage'];
			$cnt++;
		}
		return $productlist;
	}

	//해당 카테고리의 프러덕트 조회 
	function product_selecting($pcategory,$product_info){
		$query="select * from product where pcategory like '".strval($pcategory)."%' limit ".strval($product_info['currentpage_start_gesimul_num']).",".strval($product_info['CLPP']);
		$result=SQL_CON($query);

		$cnt=0;

		while ($row=mysql_fetch_array($result)) {
			$productlist[$cnt]['pnum']=$row['pnum'];
			$productlist[$cnt]['pcategory']=$row['pcategory'];
			$productlist[$cnt]['pcode']=$row['pcode'];
			$productlist[$cnt]['pname']=$row['pname'];
			$productlist[$cnt]['pprice']=$row['pprice'];
			$productlist[$cnt]['pstock']=$row['pstock'];
			$productlist[$cnt]['pfimage']=$row['pfimage'];
			$productlist[$cnt]['psimage']=$row['psimage'];
			$cnt++;
		}
		return $productlist;
	}

	function product_img_delete($imgname,$img_Sname){
		$productImgSavePath = "../../img/product/";
        $thumbnailImgSavePath = "../../img/product_s/";

        unlink($productImgSavePath.$imgname);
        unlink($thumbnailImgSavePath.$img_Sname);
	}

?>