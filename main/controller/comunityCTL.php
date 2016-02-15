<?php
	include_once ("../model/comunityMD.php");
	include_once "../model/commonMD.php";
	switch ($action) {
   //커뮤니티 게시판 글 목록
      case 600 :
            $_SESSION['PageInfo'] = getPageInfo($pageNum,$action);
            $_SESSION['comunityList'] = selectComunnity($_SESSION['PageInfo']);
         break;
   //글쓰기 저장 버튼 액션
		case 602 : 
			$data['login_write_member_id']=$_SESSION['login_seccess_member_id'];
			$data['subject']=isset($_REQUEST['subject'])?$_REQUEST['subject']:"제목이 없습니다.";
			$data['content']=isset($_REQUEST['content'])?$_REQUEST['content']:"내용이 없습니다.";
			$data['file']=isset($_REQUEST['file'])?$_REQUEST['file']:null;

			$fileSavePath = "../../uploadFile/";
			$thumbnailImgHeight = 300;
			$fileMaxSize = 2000000;

			$retArr = insertComunity($data);
			//파일업로드
			if( ! $retArr['result'] ){
                $action = 601; //다시 입력하도록 실패메시지 뷰로 리다이렉트
                header("location:../view/MainView.php?action=$action");
            }else{

                $getPnum = $retArr['autoPnum']; // 자동 입력된 pnum 값을 가져온다.

                // 이미지 정보 로드
                $upImgFileInfo['name'] = isset($_FILES['file']['name'])?$_FILES['file']['name']:null;
                $upImgFileInfo['tmp_name'] = isset($_FILES['file']['tmp_name'])?$_FILES['file']['tmp_name']:null;
                $upImgFileInfo['type'] = isset($_FILES['file']['type'])?$_FILES['file']['type']:null;
                $upImgFileInfo['size'] = isset($_FILES['file']['size'])?$_FILES['file']['size']:null;
                $upImgFileInfo['error'] = isset($_FILES['file']['error'])?$_FILES['file']['error']:null;

                // 파일 업로드를 시도했고 오류가 없다면.
                if( $upImgFileInfo['name'] && $upImgFileInfo['error'] == 0){
                    // 이미지 업로드 실행
                    $imgFileType = pathinfo($upImgFileInfo['name'],PATHINFO_EXTENSION); //이미지 파일 확장자 추출
                   
                    $saveFileName = $data['pcategory'].strval($getPnum);
                    $saveFileNameWithExt = $saveFileName.".".strval($imgFileType);
                    $thumbnailFileNameWithExt = $saveFileName."_S".".".strval($imgFileType);

                    $retArr2 = singleFileUpload($upImgFileInfo, $fileSavePath, $saveFileNameWithExt, $fileMaxSize);  // commonLIB.php 포함 함수
     
                    if( $retArr2['uploadOk'] ){ // 업로드가 성공 했다면.
                            $data['file'] = $saveFileNameWithExt; // file1 값 설정
                    }
                }

                if( $result ){
                    $action = 600; // 입력 성공후 상품리스트 보기 콘트롤로 리다이렉트
                    header("location:../controller/MainCTL.php?action=$action");
                }else{
                    $action = 601; //다시 입력하도록 실패메시지 뷰로 리다이렉트
                    header("location:../view/MainView.php?action=$action");
                }
           }
			$action=600;
		break;
        //글 자세히 보기
        case 610 : 
                $fnum=isset($_REQUEST['fnum'])?$_REQUEST['fnum']:false;
                hitUp($fnum);
                $_SESSION['detail_content']=selectFnumComunnity($fnum);
                $action=610;
            break;
        //글 삭제하기
        case 611 :
                $fnum=isset($_REQUEST['fnum'])?$_REQUEST['fnum']:false;
                deleteComunity($fnum);
                $action=600;
            break;
        //댓글 달기
        case 620 :
                $CC=isset($_REQUEST['comment_content'])?$_REQUEST['comment_content']:false;
                $fnum=isset($_REQUEST['fnum'])?$_REQUEST['fnum']:false;
                $mnum=isset($_REQUEST['mnum'])?$_REQUEST['mnum']:false;
                insertComment($fnum,$mnum,$CC);
                $action=610;
	       break;
    }
?>