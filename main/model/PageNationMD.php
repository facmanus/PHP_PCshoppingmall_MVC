<?php

    //페이지당 리스트 갯수 
    define("one_page_num",5);
    //블럭당 표시 페이지네이션 갯수 
    define("one_pagenation_num",5);
    
    function getPageInfo($pageNum,$all_record_num){
    	//pageinfo 연관배열

    	//전체 레코드 수 = 전체 레코드 수 구하는 함수;
        $pageinfo['all_record_num']=$all_record_num;
    	//전체 페이지 수 = 올림(전체 레코드수 / 한 페이지당 페이지 갯수)
    	$pageinfo['all_page_num']=$all_page_num = ceil($all_record_num/one_page_num);
    	//전체 블럭 수  = 올림(전체 페이지 수 / 블럭당 표시 페이지네이션 갯수 )
    	$pageinfo['all_block_num']=$all_block_num = ceil($all_page_num/one_pagenation_num);
    	
        //현제 페이지가 포함된 블럭 넘버
    	$pageinfo['current_page_block_num']=$current_page_block_num = ceil($pageNum/one_pagenation_num);
    	//마지막 블럭에 포함된 페이지 수 =  전체 페이지 수 - ((전체 블럭수 -1)*블럭당 표시 페이지 갯수)
    	$pageinfo['last_block_page_num']=$last_block_page_num = $all_page_num-(($all_block_num-1)*one_pagenation_num);

    	//첫번째 페이지 = 현재 페이지가 1이라면 false 아니면 true
    	$pageinfo['first_page']= ($pageNum==1)?false:true;
    	//마지막 페이지 표시 여부 = 현제 페이지가 전체 페이지 수와 같을때
    	$pageinfo['last_page']= ($pageNum==$all_page_num)?false:true;
    	//현재 블럭의 페이지네이션 = (현재 페이지-1)*블럭당 표시 페이지네이션 갯수
    	$pageinfo['start_page_num']=(($current_page_block_num-1)*one_pagenation_num+1);
        
    	//이전 블럭 표시 여부 = 현재 페이지가 블럭당 표시 페이지네이션 갯수와 작거나 같으면 0 아니면 (현제의 페이지 네이션 -현재 블럭의 페이지네이션)
    	$pageinfo['pre_block'] = ($pageNum<=one_pagenation_num)?0:$pageinfo['start_page_num']-one_pagenation_num;
    	//다음 블럭 표시 여부 = 현제 페이지가 포함된 블럭 넘버가 천제 페이지 수보다 크거나 같다면 0 아니면  (현제의 페이지 네이션 +현재 블럭의 페이지네이션)
    	$pageinfo['next_block'] = ($current_page_block_num>=$all_block_num)?0:$pageinfo['start_page_num']+one_pagenation_num;
    	//현재 페이지 번호 = 현제 페이지가 전체 페이지 수보다 작거나 같으면 현제 페이지 아니면 (현재페이지-1) 
    	$pageinfo['current_page_num'] = ($pageNum<=$all_page_num)?$pageNum:$pageNum-1;
    	//현재 페이지네이션 블럭의 페이지 넘버 갯수 = 현재 페이지가 포함된 블럭넘버가 전체 페이지 갯수가 아니면 마지막 블럭에 포함된 페이지 수
    	$pageinfo['countpage_inblock'] = ($current_page_block_num!=$all_block_num)?one_pagenation_num:$last_block_page_num;
        //


    	return $pageinfo;
    }

   


    function MemberPageInfo($pageInfo){

	    $limitFirstNum = ($pageInfo['current_page_num'] - 1) * one_page_num;

            $sql = "SELECT * FROM membership ORDER BY member_id DESC limit {$limitFirstNum},".strval(one_page_num) ;

        $result = SQL_CON($sql);


	    $cnt = 0;
	    while( $row = mysql_fetch_array($result)){
	        $memberList[$cnt]['member_id'] = $row['member_id'];
            $memberList[$cnt]['id'] = $row['id'];
            $memberList[$cnt]['name'] = $row['name'];
            $memberList[$cnt]['passwd'] = $row['passwd'];
            $memberList[$cnt]['level'] = $row['level'];
            $memberList[$cnt]['gender'] = $row['gender'];
            $memberList[$cnt]['phone'] = $row['phone'];
            $memberList[$cnt]['address'] = $row['address'];
            $memberList[$cnt]['movie'] = $row['movie'];
            $memberList[$cnt]['book'] = $row['book'];
            $memberList[$cnt]['shop'] = $row['shop'];
            $memberList[$cnt]['sport'] = $row['sport'];
            $memberList[$cnt]['intro'] = $row['intro'];

	        $cnt++;
	    }


	    return $memberList;
	}

    // member데이블 레코드 갯수 확인 
	function getMemberCount(){ 
        $sql = " SELECT count(*) FROM membership; ";
	    $result = SQL_CON($sql);
	    $count = mysql_result($result, 0, 0);

	    return $count;
	}


    function  search_MemberPageInfo($search_val,$pageInfo){
        $action=$search_val['action'];
        $limitFirstNum = ($pageInfo['current_page_num'] - 1) * one_page_num;
        $query="SELECT * FROM membership WHERE ".strval($search_val['search'])."='".strval($search_val['search_keyword'])."'";
        $result=SQL_CON($query);
        $cnt=0;
        while ($row=mysql_fetch_array($result)) {
            $memberList[$cnt]= $row;

            $cnt++;
        }
        return $memberList;
    }

    function search_getMemberCount($search,$search_keyword){
        $query="SELECT count(*) FROM membership WHERE ".strval($search)."='".strval($search_keyword)."'";
        $result= SQL_CON($query);
        $count = mysql_result($result,0,0);
        return $count;
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // product 해당 카테고리 전체 레코드 수를 알기위한 함수
    function getProductCount($pcategory){ 
        $query = " SELECT count(*) FROM product WHERE pcategory LIKE '".strval($pcategory)."%'";
        $result = SQL_CON($query);
        $count = mysql_result($result, 0, 0);
        return $count;
    }


    // product의 페이지 정보를 알기위한 함수
    function productPageInfo($pageNum, $cnt, $clpp, $cppb){

        $pageInfo['CLPP'] =$CLPP = isset($clpp)?$clpp:1;
        $pageInfo['CPPB'] =$CPPB = isset($cppb)?$cppb:1;

        $pageInfo['all_record_num']=$all_record_num = $cnt;
        $pageInfo['all_page_num'] =$all_page_num = ceil($all_record_num/$CLPP);
        $pageInfo['all_block_num'] =$all_block_num = ceil($all_page_num/$CPPB); 
        $pageInfo['current_page_block_num'] = $current_page_block_num = ceil($pageNum/$CPPB); 
        $pageInfo['last_block_page_num'] =$last_block_page_num = $all_page_num - (($all_block_num -1) * $CPPB); 
        $pageInfo['first_page'] = ($pageNum == 1)?false:true;
        $pageInfo['last_page'] = ($pageNum == $all_page_num)?false:true; 
        $pageInfo['start_page_num'] = ($current_page_block_num-1) * $CPPB + 1; 
        $pageInfo['currentpage_start_gesimul_num'] = (($pageNum-1)*$clpp);
        $pageInfo['pre_block'] = ($pageNum <= $CPPB)?0:$pageInfo['start_page_num']-$CPPB; 
        $pageInfo['next_block'] = ($current_page_block_num >= $all_block_num)?0:$pageInfo['start_page_num']+$CPPB; 
        $pageInfo['current_page_num'] = ($pageNum <= $all_page_num)?$pageNum:$pageNum-1; 
        $pageInfo['countpage_inblock'] = ($current_page_block_num != $all_block_num)?$CPPB:$last_block_page_num;
        return $pageInfo;
    }




?>