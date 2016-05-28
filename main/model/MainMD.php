<?php

    //DB에 접속하고 쿼리를 실행한다.
    //현재 코드의 흐름상으로는 쿼리를 실행 시키기 위한 DB연결 이기 때문에 하나의 함수로 쿼리 실행까지 묶었다.
    function SQL_CON($query){
        //DB에 접근하기 위한 주소, 아이디, 비밀번호(참고로 xampp 오류로 오토셋으로 실행)
        $connect = @mysql_pconnect("localhost","","autoset");
        mysql_select_db("beomshop", $connect);
        if($query!="noneQuery"){
            mysql_query("SET NAME utf8 ");
            $rsc=mysql_query($query,$connect);
            return $rsc;
        }
    }

    //회원가입 함수
    function joining($member){
        $query="insert into membership values (' ',";
        for($j=0;$j<=10;$j++){
                $query.="'$member[$j]',";
        }
        $query.="'$member[11]','$member[13]'";
        $query.=")";


        $result=SQL_CON($query);
        // mysql_close();
        return $result;

    }

    //로그인 함수
    function logining($login_id,$login_passwd){
        //아이디의 유무를 따지기위한 쿼리
        $query_id_check="SELECT * FROM membership WHERE id = '".strval($login_id)."'";

        //아이디와 비밀번호를 맞춰보기 위한 쿼리
        $query="SELECT * FROM membership WHERE id = '"
                .strval($login_id)
                ."' AND passwd = '"
                .strval($login_passwd)
                ."'";

        $result=SQL_CON($query);
        $user=mysql_fetch_array($result);
        mysql_close();

        //아이디와 비밀번호가 일치한다면 회원의 정보를 반환한다.
        if($user['id'] &&($user['id']==$login_id)&&($user['passwd']==$login_passwd)){
            return $user;
        }
        //아이디와 비밀번호가 일치하지 않는다면
        else{
            $result=SQL_CON($query_id_check);
            $user=mysql_fetch_array($result);
            //회원이 입력한 아이디가 실제 유무 상태를 확인한다.
            if($user['id']&&($user['id']==$login_id)){
                return 1;
            }
            //아이디가 없다면 0을 반환한다.
            else{
                return 0;
            }
        }
    }


    //회원 삭제 함수
    function deleteing($del_member_id){
            $query="DELETE FROM membership WHERE member_id = ".strval($del_member_id);
            $result =SQL_CON($query);
    }

    //회원정보 업데이트 함수
    function updateing($member){
        $query="update membership set passwd=".strval($member[2]).",gender='".strval($member[4])."',phone=".intval($member[5]).",address='".strval($member[6])."',movie='".strval($member[7])."',book='".strval($member[8])."',shop='".strval($member[9])."',sport='".strval($member[10])."',intro='".strval($member[11])."',nick='".strval($member[13]).".' where member_id=".$member[12];
        $result =SQL_CON($query);
    }

    //아이디에 해당하는 회원검색 함수
    function selecting($select_member_id){
        $query="SELECT * FROM membership WHERE member_id='".strval($select_member_id)."'";
        $result=SQL_CON($query);
        $user=mysql_fetch_array($result);
        return $user;
    }

    
?>
