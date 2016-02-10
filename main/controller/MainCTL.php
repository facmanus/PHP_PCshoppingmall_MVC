<?php
    //함수를 사용하기 위한 참조 
    include_once ("../model/MainMD.php");
    include_once ("../model/PageNationMD.php");
    include_once("../model/ProductMD.php");
    session_start();
    //VIEW에서 날라온 세션, 리퀘스트의 유무를 확인 후 변수에 대입.
    $action = isset($_REQUEST['action'])? $_REQUEST['action'] : 110;
    $_SESSION['pageNum']=$pageNum = isset($_REQUEST['pageNum'])?$_REQUEST['pageNum']:1;
    $_SESSION['msg'] = isset($_REQUEST['msg'])?$_REQUEST['msg'] :"";
    $_SESSION['search'] = isset($_REQUEST['search'])?$_REQUEST['search']:null;
    $_SESSION['login_seccess_level'] = isset($_SESSION['login_seccess_level'])?$_SESSION['login_seccess_level']:0;
    $_SESSION['productlist']=isset($_SESSION['productlist'])?$_SESSION['productlist']:null;

    //action에 다른 처리 방식

    //550의 이하일 시에 물건을 출력한다는 의미.
    if($action<=550){
        include("./productCTL.php");
    }

    //900번대의 action은 회원가입, 수정, 삭제 , 로그인, 로그아웃 등 회원 정보와 관련 액션.
    elseif($action==911||$action==915){
            //from으로 부터 받은 리퀘스트 값을 member변수에 대입한다.
            $member[0] = isset($_REQUEST['id'])? $_REQUEST['id'] : false;
            $member[1] = isset($_REQUEST['name'])? $_REQUEST['name'] : false;
            $member[2] = isset($_REQUEST['passwd'])? $_REQUEST['passwd'] : false;
            $member[3] = 1;
            $member[4] = isset($_REQUEST['gender'])? $_REQUEST['gender'] : false;
            //휴대폰 번호는 3칸으로 한칸씩 받은 배열을 합쳐야한다.
            $member[5] = isset($_REQUEST['phone1'])? $_REQUEST['phone1'] : false;
            $member[5] .= isset($_REQUEST['phone2'])? $_REQUEST['phone2'] : false;
            $member[5] .= isset($_REQUEST['phone3'])? $_REQUEST['phone3'] : false;
            $member[6] = isset($_REQUEST['address'])? $_REQUEST['address'] : false;
            $member[7] = isset($_REQUEST['movie'])? 'O' : 'X';
            $member[8] = isset($_REQUEST['book'])?  'O' : 'X';
            $member[9] = isset($_REQUEST['shop'])?  'O' : 'X';
            $member[10] = isset($_REQUEST['sport'])? 'O' : 'X';
            $member[11] = isset($_REQUEST['intro'])? $_REQUEST['intro'] : 'null';
            $member[12] = isset($_REQUEST['member_id'])? $_REQUEST['member_id'] : false;
        //회원 가입 코드
        if($action==911){
            $result=joining($member);

            if($result==true){
                $_SESSION['msg'] =" <p><kbd>회원가입</kbd>  성공했습니다.</p>";
            }
            else{
                $_SESSION['msg'] ="회원가입 실패했습니다.";
            }

            $action=110; 
             header("location:../controller/MainCTL.php?action=$action&pageNum=$pageNum");
        }
        //회원 정보 수정 코드
        elseif($action==915){
            $result=updateing($member);

            if($result==true){
                $_SESSION['msg'] ="회원정보수정 성공했습니다.";
            }
            else{
                $_SESSION['msg'] ="회원정보수정 실패했습니다.";
            }

            $action=110; 
            
            header("location:../controller/MainCTL.php?action=$action&pageNum=1");
        }
        
    }
    //로그인
    elseif($action==912){
        $login_id=isset($_REQUEST['login_id'])?$_REQUEST['login_id']:false;
        $login_passwd=isset($_REQUEST['login_passwd'])?$_REQUEST['login_passwd']:false;
        $user_result=logining($login_id,$login_passwd);
        if($user_result==1){
            $_SESSION['msg']="비밀번호가 다릅니다.";
        }
        elseif($user_result==0){
            $_SESSION['msg']="아이디가 없습니다.";
        }
        elseif($user_result!=false){
            $_SESSION['msg']="<p><kbd>로그인 성공</kbd>".$_SESSION['login_seccess_id']."님 로그인 중, 당신의 레벨은 ".$_SESSION['login_seccess_level']."입니다.</p>";
            $_SESSION['login_seccess_member_id']=$user_result['member_id'];
            $_SESSION['login_seccess_id']=$user_result['id'];
            $_SESSION['login_seccess_level']=$user_result['level'];
        }

        $action=110;
        header("location:../controller/MainCTL.php?action=$action&pageNum=1");
    }
    //로그아웃 처리
    elseif ($action==913) {
        unset($_SESSION['login_seccess_id']);
        unset($_SESSION['login_seccess_level']);
        // session_destroy();
        $_SESSION['msg']="로그아웃 되었습니다.";
        $action=110;
        header("location:../controller/MainCTL.php?action=$action&pageNum=1");
    }

    //수정액션
    elseif($action==914){
        $update_member_id=isset($_REQUEST['up_member_id'])?$_REQUEST['up_member_id']:0;

        $user_info=selecting($update_member_id);

        $_SESSION['update_member_id']=$user_info['member_id'];
        $_SESSION['update_id']=$user_info['id'];
        $_SESSION['update_name']=$user_info['name'];
        $_SESSION['update_passwd']=$user_info['passwd'];
        $_SESSION['update_gender']=$user_info['gender'];
        $_SESSION['update_phone']=$user_info['phone'];
        $_SESSION['update_address']=$user_info['address'];
        $_SESSION['update_movie']=$user_info['movie'];
        $_SESSION['update_book']=$user_info['book'];
        $_SESSION['update_shop']=$user_info['shop'];
        $_SESSION['update_sport']=$user_info['sport'];
        $_SESSION['update_intro']=$user_info['intro'];
    }

    //삭제
    elseif($action==916){
        $del_member_id=($_REQUEST['member_id'])?$_REQUEST['member_id']:null;
        for($i=0;$i<count($del_member_id);$i++){
            deleteing($del_member_id[$i]);
        }
        if($_SESSION['login_seccess_level']!=99)
            $action=100;
        else
            $action=9100;
        header("location:../controller/MainCTL.php?action=$action&pageNum=$pageNum");
    }

    elseif($action==920){
        $pnum=($_REQUEST['pnum'])?$_REQUEST['pnum']:null;
        $product_info=deteil_seleting($pnum);
        $_SESSION['product_info']=$product_info;
    }



    //관리자 모드를 눌렸을 시에 관리자 모드로 진입한다.
    elseif(intval($action/1000)==9){
        //로그인한 회원이 레벨이 99이고 id가 admin이면 관리자 모드로 진입할 수 있도록 한다.
        if($_SESSION['login_seccess_id']=='admin'&&$_SESSION['login_seccess_level']==99){
            include ("./adminCTL.php");

        }
        else{
            $_SESSION['msg'] = '관리자가 아니라서 관리자모드에 접근할 수 없습니다.';
        }
    }
        //유저 상태창에 메세지를 띄운다.
        $_SESSION['msg'] = isset($_SESSION['login_seccess_id'])?"<kbd>".$_SESSION['login_seccess_id']."</kbd>님 환영합니다. 당신의 레벨은 <kbd>".$_SESSION['login_seccess_level']."</kbd>입니다.     " : $_SESSION['msg'] ;
        header("location:../view/MainView.php?action=$action&pageNum=$pageNum");
    

?>

