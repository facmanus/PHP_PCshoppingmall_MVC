<?php
	include_once ("../model/comunityMD.php");
	include_once "../model/commonMD.php";
	switch ($action) {
   //커뮤니티 게시판 글 목록
      case 600 :
            $all_record_num = getComunityCount();
            $_SESSION['PageInfo'] = getPageInfo($pageNum,$all_record_num);
            $_SESSION['comunityList'] = selectComunnity($_SESSION['PageInfo']);
         break;
   //글쓰기 저장 버튼 액션
		case 602 : 
			$data['login_write_member_id']=$_SESSION['login_seccess_member_id'];
			$data['subject']=isset($_REQUEST['subject'])?$_REQUEST['subject']:"제목이 없습니다.";
			$data['content']=isset($_REQUEST['content'])?$_REQUEST['content']:"내용이 없습니다.";
			$upload_datas['file']=isset($_FILES['file'])?$_FILES['file']:"noFile";
            $data['ishtml']=isset($_REQUEST['ishtml'])?$_REQUEST['ishtml']:"N";

			$result = insertComunity($data);
            //첨부 파일이 있다면
            if( $upload_datas['file']!="noFile" ){
                $ComunityImgPath = "../../img/comunity_uploadFile/";
                $ImgMax = 5000000; 

                $ptnum = $result['fnum'];
                $uploadFiles = filerange($upload_datas['file']);

                   $cnt = 1;
                   foreach( $uploadFiles as $uploadFile ){
                                        //파일정보 반환(파일명, 파일확장자)
                        $imgFileType = pathinfo($uploadFile['name'],PATHINFO_EXTENSION);
                        $saveFile = "comunityUP".date("YmdHis").strval($ptnum).strval($cnt).".".strval($imgFileType);
                        $cnt++;

                        $upfile_info['ptnum'] = $ptnum;
                        $upfile_info['uploadfile'] = $uploadFile['name'];
                        $upfile_info['savefile'] = $saveFile;
                        $upfile_info['filetype'] = $uploadFile['type'];
  
                        $retArr = singleFileUpload($uploadFile, $ComunityImgPath, $saveFile, $ImgMax);
 
                         if( $retArr['uploadOk'] ){ 
                                $result = insertAttachFile($upfile_info);
                        
                                if( ! $result ){
                                    $action = 601;
                                    header("location:../view/MainView.php?action=$action");
                                    break;
                                }
                         }
                   }
           }
			     $action=600;
		    break;
        //글 자세히 보기
        case 610 : 
                $fnum=isset($_REQUEST['fnum'])?$_REQUEST['fnum']:false;
                hitUp($fnum);
                $_SESSION['detail_content']=selectFnumComunnity($fnum);
                $_SESSION['detail_attach']=selectAttachFile($fnum);
                $action=610;
            break;
        //글 삭제하기
        case 611 :
                $fnum=isset($_REQUEST['fnum'])?$_REQUEST['fnum']:false;
                $delete_attach_save_files=isset($_REQUEST['delete_attach_files[]'])?$_REQUEST['delete_attach_files[]']:false;
                deleteComunity($fnum);
                foreach($delete_attach_files as $delete_attach_file){
                    deleteComunity_attach_file($delete_attach_file['savefile']);
                }
                $action=600;
                header("location:../view/MainView.php?action=$action");
            break;
        //댓글 달기
        case 620 :
                $CC=isset($_REQUEST['comment_content'])?$_REQUEST['comment_content']:false;
                $fnum=isset($_REQUEST['fnum'])?$_REQUEST['fnum']:false;
                $mnum=isset($_REQUEST['mnum'])?$_REQUEST['mnum']:false;
                insertComment($fnum,$mnum,$CC);
                $action=610;
	       break;
        //답글 달기
         case 630 : 
                $parentinfo['parent_sub']=isset($_REQUEST['parent_sub'])?$_REQUEST['parent_sub']:false;
                $parentinfo['parent_con']=isset($_REQUEST['parent_con'])?$_REQUEST['parent_con']:false;
                $parentinfo['parent_fam']=isset($_REQUEST['parent_fam'])?$_REQUEST['parent_fam']:false;
                $parentinfo['parent_ord']=isset($_REQUEST['parent_ord'])?$_REQUEST['parent_ord']:false;
                $parentinfo['parent_stp']=isset($_REQUEST['parent_stp'])?$_REQUEST['parent_stp']:false;

                $_SESSION['parentinfo']=$parentinfo;
         break;
         //답글 저장 버튼 액션 (답글 저장)
         case 631 :
                $data['login_write_member_id']=$_SESSION['login_seccess_member_id'];
                $data['subject']=isset($_REQUEST['subject'])?$_REQUEST['subject']:"제목이 없습니다.";
                $data['content']=isset($_REQUEST['content'])?$_REQUEST['content']:"내용이 없습니다.";
                $upload_datas['file']=isset($_FILES['file'])?$_FILES['file']:"noFile";
                $data['ishtml']=isset($_REQUEST['ishtml'])?$_REQUEST['ishtml']:"N";
                $data['fam']=isset($_REQUEST['fam'])?$_REQUEST['fam']:0;
                $data['ord']=isset($_REQUEST['ord'])?$_REQUEST['ord']:0;
                $data['stp']=isset($_REQUEST['stp'])?$_REQUEST['stp']:0;
                insert_answer($data);
                $action=600;
        break;

    }
?>