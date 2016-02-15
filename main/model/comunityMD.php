<?php
	include_once "commonMD.php";
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

	function getComunityCount(){ 
        $sql = " SELECT count(*) FROM freeboard; ";
	    $result = SQL_CON($sql);
	    $count = mysql_result($result, 0, 0);

	    return $count;
	}

	function hitUp($fnum){
		$query = "UPDATE freeboard SET hitcount = hitcount + 1 WHERE fnum =".strval($fnum);
		SQL_CON($query);
	}

	function insertComunity($data){

		if( $data['ishtml'] == 'Y'){
	        $data['content'] = mysql_escape_string($data['content']);
	        $data['subject'] = mysql_escape_string($data['subject']);
	    }else{
	        $data['ishtml'] == 'N';
	        $data['content'] = htmlspecialchars($data['content']);
	        $data['subject'] = htmlspecialchars($data['subject']);
	    }

	    $query = " INSERT INTO freeboard ";
	    $query.=" VALUES('','";
	    $query.=strval($data['login_write_member_id'])."','".strval($data['subject'])."','".strval($data['content'])."','".strval(date("Y-m-d H:i:s"))."','','".strval($data['ishtml'])."','0','0','0')";
	    SQL_CON('noneQuery');
		$result['result'] = mysql_query($query);
   		$result['fnum'] = getAutoIncrementNum();
   		$query ="UPDATE freeboard SET family=".strval($result['fnum'])." WHERE fnum=".strval($result['fnum']);
   		SQL_CON($query);
   		mysql_close();
    	return $result;
	}

	function insert_answer($data){

		if( $data['ishtml'] == 'Y'){
	        $data['content'] = mysql_escape_string($data['content']);
	        $data['subject'] = mysql_escape_string($data['subject']);
	    }else{
	        $data['ishtml'] == 'N';
	        $data['content'] = htmlspecialchars($data['content']);
	        $data['subject'] = htmlspecialchars($data['subject']);
	    }
	    $data['ord']=$data['fam']+1;
	    $data['stp']=$data['stp']+1;

	    $query = " INSERT INTO freeboard ";
	    $query.=" VALUES('','";
	    $query.=strval($data['login_write_member_id'])."','".strval($data['subject'])."','".strval($data['content'])."','".strval(date("Y-m-d H:i:s"))."','','".strval($data['ishtml'])."','".strval($data['fam'])."','".strval($data['ord'])."','".strval($data['stp'])."')";
   		SQL_CON($query);
   		mysql_close();
	}




	function deleteComunity($fnum){
		deleteReply($fnum);
		deleteAttach($fnum);
		$query = "DELETE FROM freeboard WHERE ";
		$query.= "fnum=".strval($fnum);
		SQL_CON($query);
	}

	function deleteReply($fnum){
		$query = "DELETE FROM free_reply WHERE ";
		$query.= "ptnum=".strval($fnum);
		SQL_CON($query);		
	}

	function deleteAttach($fnum){
		$query = "DELETE FROM free_attach WHERE ";
		$query .= "ptnum=".strval($fnum);
	}

	function insertComment($fnum,$mnum,$content){
	    $query = " INSERT INTO free_reply ";
	    $query.=" VALUES('','";
	    $query.=strval($fnum)."','".strval($mnum)."','".strval($content)."','".strval(date("Y-m-d H:i:s"))."')";
	    SQL_CON($query);
	}

	function select_One_count($ptnum){
		$query = "SELECT count(*) FROM free_reply WHERE ptnum=".$ptnum;
		$result = SQL_CON($query);
	    $count = mysql_result($result, 0, 0);

	    return $count;
	}


	//파일 업로드

	function insertAttachFile($data){
		connectDB();
	    $data['uploadfile'] = mysql_escape_string($data['uploadfile']); // HTML처리

	    $sql=" INSERT INTO free_attach(ptnum, uploadfile, savefile, filetype) VALUES('".strval($data['ptnum'])."','".strval($data['uploadfile'])."','".strval($data['savefile'])."','".strval($data['filetype'])."')";

	    $result = SQL_CON($sql);

	    mysql_close();
	    return $result;
	}

?>