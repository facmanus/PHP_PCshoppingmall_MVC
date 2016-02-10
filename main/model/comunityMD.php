<?php

	function selectComunnity($pageInfo){
		$limitFirstNum=($pageInfo['current_page_num']-1)*one_page_num;
		$sql = "SELECT * FROM freeboard inner join membership on membership.member_id = freeboard.mnum ORDER BY fnum DESC limit {$limitFirstNum},".strval(one_page_num);
		$result = SQL_CON($sql);

		$cnt = 0;
	    while( $row = mysql_fetch_array($result)){
	    	$comunnity[$cnt]['fnum'] = $row['fnum'];
	    	$comunnity[$cnt]['subject'] = $row['subject'];
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
	    	$comunnity[0]['fnum'] = $row['fnum'];
	    	$comunnity[0]['subject'] = $row['subject'];
	    	$comunnity[0]['content'] = $row['content'];
	    	$comunnity[0]['nick'] = $row['nick'];
	    	$comunnity[0]['registdate'] = $row['registdate'];
	    	$comunnity[0]['hitcount'] = $row['hitcount'];
	    	$comunnity[0]['mnum'] = $row['mnum'];

	    $sql = "SELECT free_reply.content, free_reply.registdate, membership.nick FROM free_reply inner join membership on free_reply.mnum = membership.member_id where free_reply.ptnum=".$fnum;
	    $result = SQL_CON($sql);
	    $cnt=1;
	    while($row = mysql_fetch_array($result)){
	    	$comunnity[$cnt]['content'] = $row['content'];
	    	$comunnity[$cnt]['registdate'] = $row['registdate'];
	    	$comunnity[$cnt]['nick'] = $row['nick'];
	    	$cnt++;
	    }

	    return $comunnity;
	}

	function insertComunity($data){
	    $query = " INSERT INTO freeboard ";
	    $query.=" VALUES('','";
	    $query.=strval($data['login_write_member_id'])."','".strval($data['subject'])."','".strval($data['content'])."','".strval(date("Y-m-d H:i:s"))."','','1')";
		
	    // $result=
	    SQL_CON($query);
	    // $autoFnum = mysql_insert_id();

	    // $retArr['result'] = $result;
	    // $retArr['autoFnum'] = $autoFnum;

	    // return $retArr;
	}

	function insertComment($fnum,$mnum,$content){
	    $query = " INSERT INTO free_reply ";
	    $query.=" VALUES('','";
	    $query.=strval($fnum)."','".strval($mnum)."','".strval($content)."','".strval(date("Y-m-d H:i:s"))."')";
		
	    // $result=
	    SQL_CON($query);
	    // $autoFnum = mysql_insert_id();

	    // $retArr['result'] = $result;
	    // $retArr['autoFnum'] = $autoFnum;

	    // return $retArr;	
	}

?>