<?php
	
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

?>