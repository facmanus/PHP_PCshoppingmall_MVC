<?php
	include_once "commonMD.php";

	//커뮤니티 게시판 글 검색
	function selectComunnity($pageInfo){
		$limitFirstNum=($pageInfo['current_page_num']-1)*one_page_num;
		$sql = "SELECT * FROM freeboard inner join membership on membership.member_id = freeboard.mnum ORDER BY family desc,fnum asc, orderby desc, step asc limit {$limitFirstNum},".strval(one_page_num);
		$result = SQL_CON($sql);

		$cnt = 0;
	    while( $row = mysql_fetch_array($result)){
	    	$comunnity[$cnt]['fnum'] = $row['fnum'];
	    	$ONE_reply=select_One_count($comunnity[$cnt]['fnum']);
	    	$comunnity[$cnt]['subject'] = $row['subject']."[".$ONE_reply."]";
	    	$comunnity[$cnt]['nick'] = $row['nick'];
	    	$comunnity[$cnt]['registdate'] = $row['registdate'];
	    	$comunnity[$cnt]['hitcount'] = $row['hitcount'];

	    	$cnt++;
	    }
	    return $comunnity;
	}


	//해당 게시글의 상세내역 조회(댓글포함)
	function selectFnumComunnity($fnum){
		
		$sql = "SELECT * FROM freeboard inner join membership on membership.member_id = freeboard.mnum where fnum=".$fnum;
		$result = SQL_CON($sql);

	    $row = mysql_fetch_array($result);
	    $comunnity[0] = $row;

	    $sql = "SELECT free_reply.content, free_reply.registdate, membership.nick FROM free_reply inner join membership on free_reply.mnum = membership.member_id where free_reply.ptnum=".$fnum;
	    $result = SQL_CON($sql);
	    $cnt=1;
	    while($row = mysql_fetch_array($result)){
	    	$comunnity[$cnt]= $row;
	    	$cnt++;
	    }

	    return $comunnity;
	}

	//총 커뮤니티 게시글의 갯수 카운트
	function getComunityCount(){ 
        $sql = " SELECT count(*) FROM freeboard; ";
	    $result = SQL_CON($sql);
	    $count = mysql_result($result, 0, 0);

	    return $count;
	}

	//게시글을 봤을 시에 조회수 up
	function hitUp($fnum){
		$query = "UPDATE freeboard SET hitcount = hitcount + 1 WHERE fnum =".strval($fnum);
		SQL_CON($query);
	}

	//커뮤니티 본글 작성
	function insertComunity($data){

		//html의 작성 유무 체크
		if( $data['ishtml'] == 'Y'){
			//mysql_escape_string : 태그 표시도 문자열로 인식하여 그대로 mysql에 입력
	        $data['content'] = mysql_escape_string($data['content']);
	        $data['subject'] = mysql_escape_string($data['subject']);
	    }else{
	        $data['ishtml'] == 'N';
	        //htmlspecialchars : 태그를 문자열로 인식하여 태그 인식을 못하도록 함.
	        $data['content'] = htmlspecialchars($data['content']);
	        $data['subject'] = htmlspecialchars($data['subject']);
	    }

	    $query = " INSERT INTO freeboard ";
	    $query.=" VALUES('','";
	    $query.=strval($data['login_write_member_id'])."','".strval($data['subject'])."','".strval($data['content'])."','".strval(date("Y-m-d H:i:s"))."','','".strval($data['ishtml'])."','0','0','0')";
	    SQL_CON('noneQuery');
		$result['result'] = mysql_query($query);
   		
   		//입력한 게시글의 기본키 가져오기.
   		$result['fnum'] = getAutoIncrementNum();

   		//게시글의 family를 입력하기
   		$query ="UPDATE freeboard SET family=".strval($result['fnum'])." WHERE fnum=".strval($result['fnum']);
   		SQL_CON($query);
   		mysql_close();
    	return $result;
	}

	//본글, 답글의 답글 작성
	function insert_answer($data){

		if( $data['ishtml'] == 'Y'){
	        $data['content'] = mysql_escape_string($data['content']);
	        $data['subject'] = mysql_escape_string($data['subject']);
	    }else{
	        $data['ishtml'] == 'N';
	        $data['content'] = htmlspecialchars($data['content']);
	        $data['subject'] = htmlspecialchars($data['subject']);
	    }

	    //답글과 댓글의 순서를 정렬해주기위한 속성, 부모글의 family+1
	    $data['ord']=$data['fam']+1;

	    //본글의 답글인지 답글의 답글인지를 구분하기위한 글의 깊이, 부모글의 stp+1
	    $data['stp']=$data['stp']+1;

	    $query = " INSERT INTO freeboard ";
	    $query.=" VALUES('','";
	    $query.=strval($data['login_write_member_id'])."','".strval($data['subject'])."','".strval($data['content'])."','".strval(date("Y-m-d H:i:s"))."','','".strval($data['ishtml'])."','".strval($data['fam'])."','".strval($data['ord'])."','".strval($data['stp'])."')";
   		SQL_CON($query);
   		mysql_close();
	}

	//글을 삭제한다.
	function deleteComunity($fnum){
		//글을 삭제하기전 하위테이블인 댓글테이블의 해당 글의 댓글 삭제
		deleteReply($fnum);
		//글을 삭제하기전 하위테이블인 첨부파일테이블의 해당 글의 첨부파일 삭제		
		deleteAttach($fnum);
		$query = "DELETE FROM freeboard WHERE ";
		$query.= "fnum=".strval($fnum);
		SQL_CON($query);
	}
	
	//해당 글의 댓글 삭제
	function deleteReply($fnum){
		$query = "DELETE FROM free_reply WHERE ";
		$query.= "ptnum=".strval($fnum);
		SQL_CON($query);		
	}

	//해당 글의 첨부파일 삭제
	function deleteAttach($fnum){
		$query = "DELETE FROM free_attach WHERE ";
		$query .= "ptnum=".strval($fnum);
		SQL_CON($query);
	}

	//해당 첨부파일을 서버 파일에서 삭제한다.
	function deleteComunity_attach_file($imgname){
		$ComunityImgPath = "../../img/comunity_uploadFile/";
        unlink($ComunityImgPath.$imgname);
	}

	//댓글 입력
	function insertComment($fnum,$mnum,$content){
	    $query = " INSERT INTO free_reply ";
	    $query.=" VALUES('','";
	    $query.=strval($fnum)."','".strval($mnum)."','".strval($content)."','".strval(date("Y-m-d H:i:s"))."')";
	    SQL_CON($query);
	}

	//해당 글의 댓글 조회
	function select_One_count($ptnum){
		$query = "SELECT count(*) FROM free_reply WHERE ptnum=".$ptnum;
		$result = SQL_CON($query);
	    $count = mysql_result($result, 0, 0);

	    return $count;
	}


	//첨부파일 입력
	function insertAttachFile($data){
	    $data['uploadfile'] = mysql_escape_string($data['uploadfile']); // HTML처리

	    $sql=" INSERT INTO free_attach VALUES('',".strval($data['ptnum']).",'".strval($data['uploadfile'])."','".strval($data['savefile'])."','".strval($data['filetype'])."')";

	    $result = SQL_CON($sql);

	    mysql_close();
	    return $result;
	}

	//첨부파일 조회
	function selectAttachFile($ptnum){
		$query = "SELECT * FROM free_attach WHERE ptnum=".strval($ptnum);
		$result = SQL_CON($query);
		if($result){
			$cnt=0;
			while($row = mysql_fetch_array($result)){
        		$AttachFile[$cnt] = $row;
        		$cnt++;
        	}
    	}
    	else{
    		//첨부파일이 없을시 null값 입력
    		$AttachFile = null;
    	}
		return $AttachFile;
	}

	function filerange($files) {

	    $fsarray = array();
	    //file들의 name을 카운트한다.
	    $fcnt = count($files['name']);
	    //array_keys : 배열의 모든 키를 반환한다.
	    $fkeys = array_keys($files);

	    for ($i=0; $i<$fcnt; $i++) {
	        foreach ($fkeys as $fkey) {
	            $fsarray[$i][$fkey] = $files[$fkey][$i];
	        }
	    }

    	return $fsarray;
	}



?>