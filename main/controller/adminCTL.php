<?php
	//정말 관리자모드로 진입할 때 
	include_once("../model/ProductMD.php");
	include_once "../model/commonMD.php";
	//천자리를 제외한 백자리수를 가지고 액션 처리.
	$short_num = intval($action%9000);
	$_SESSION['search'] = isset($_REQUEST['search'])?$_REQUEST['search']:null;
	$_SESSION['search_keyword'] = isset($_REQUEST['search_keyword'])?$_REQUEST['search_keyword']:null;

	switch ($short_num) {
		case 0:

//회원관리
		case 100:
					if(isset($_SESSION['search_keyword'])){
						$search_val['search'] = $_SESSION['search'];
		            	$search_val['search_keyword'] = $_SESSION['search_keyword'];
		            	$search_val['action'] = $action;
		            	$_SESSION['PageInfo'] = getPageInfo($pageNum);
		            	$_SESSION['memberList'] = search_MemberPageInfo($search_val,$pageNum);

		            	// header("location:../controller/MainCTL.php?action=$action&pageNum=$pageNum");
					}else{
						$_SESSION['PageInfo'] = getPageInfo($pageNum);
        				$_SESSION['memberList'] = MemberPageInfo($pageNum);
					}
			break;

// 상품관리
		case 200:
					$all_product_limit=array(10,5);
					$all_record_num = getAllProductCount();
					$_SESSION['PageInfo']= productPageInfo($pageNum,$all_record_num,$all_product_limit[0],$all_product_limit[1]);
					$_SESSION['productlist']=all_product_selecting($_SESSION['PageInfo']);
			break;

		case 210:
					header("location:../view/MainView.php?action=$action");
			break;
	//상품 추가 버튼 액션
		case 211:
			 // 이미지 저장 디렉터리
            $productImgSavePath = "../../img/product/";
            $thumbnailImgSavePath = "../../img/product_s/";
            $thumbnailImgHeight = 300; // 썸네일 이미지 높이를 150px로 설정
            $fileMaxSize = 2000000; // 파일 최대 크기 2Mbyte 설정


            $data['pcategory'] = isset($_REQUEST['pcategory'])?$_REQUEST['pcategory']:null;
            $data['pcode'] = $data['pcategory'].strval($getPnum); // pnum값을 이용하여 pcode값 생성
            $data['pname'] = isset($_REQUEST['pname'])?$_REQUEST['pname']:null;
            $data['pstock'] = isset($_REQUEST['pstock'])?$_REQUEST['pstock']:null;
            $data['pprice'] = isset($_REQUEST['pprice'])?$_REQUEST['pprice']:null;
            $data['pfimage'] = isset($_REQUEST['pfimage'])?$_REQUEST['pfimage']:null;
            $data['psimage'] = isset($_REQUEST['psimage'])?$_REQUEST['psimage']:null;
 
            $retArr = insertProduct($data);

            if( ! $retArr['result'] ){
                $action = 9210; //다시 입력하도록 실패메시지 뷰로 리다이렉트
                header("location:../view/MainView.php?action=$action");
            }else{

                $getPnum = $retArr['autoPnum']; // 자동 입력된 pnum 값을 가져온다.

                // 이미지 정보 로드
                $upImgFileInfo['name'] = isset($_FILES['pfimage']['name'])?$_FILES['pfimage']['name']:null;
                $upImgFileInfo['tmp_name'] = isset($_FILES['pfimage']['tmp_name'])?$_FILES['pfimage']['tmp_name']:null;
                $upImgFileInfo['type'] = isset($_FILES['pfimage']['type'])?$_FILES['pfimage']['type']:null;
                $upImgFileInfo['size'] = isset($_FILES['pfimage']['size'])?$_FILES['pfimage']['size']:null;
                $upImgFileInfo['error'] = isset($_FILES['pfimage']['error'])?$_FILES['pfimage']['error']:null;

                // 파일 업로드를 시도했고 오류가 없다면.
                if( $upImgFileInfo['name'] && $upImgFileInfo['error'] == 0){
                    // 이미지 업로드 실행
                    $imgFileType = pathinfo($upImgFileInfo['name'],PATHINFO_EXTENSION); //이미지 파일 확장자 추출
                   
                    $saveFileName = $data['pcategory'].strval($getPnum);
                    $saveFileNameWithExt = $saveFileName.".".strval($imgFileType);
                    $thumbnailFileNameWithExt = $saveFileName."_S".".".strval($imgFileType);

                    $retArr2 = singleFileUpload($upImgFileInfo, $productImgSavePath, $saveFileNameWithExt, $fileMaxSize);  // commonLIB.php 포함 함수
     
                    if( $retArr2['uploadOk'] ){ // 업로드가 성공 했다면.
                            $data['pfimage'] = $saveFileNameWithExt; // pfimage 값 설정

                        // 이미지 파일이 jpg, png, gif 포맷이면 썸네일 이미지 생성
                        if( $imgFileType == "jpg" || $imgFileType == "jpeg" || $imgFileType == "png" || $imgFileType == "gif"){
                            $src = $productImgSavePath.strval($saveFileNameWithExt);
                            $dest = $thumbnailImgSavePath.strval($thumbnailFileNameWithExt);
                            makeThumbnailImage($src, $dest, $thumbnailImgHeight, $imgFileType);
                        
                            $data['psimage'] = $thumbnailFileNameWithExt; // psimage 값 설정

                        }
                    }
                }

                $data['pnum'] = $getPnum;
                $data['pcategory'] = isset($_REQUEST['pcategory'])?$_REQUEST['pcategory']:null;
                $data['pcode'] = $data['pcategory'].strval($getPnum); // pnum값을 이용하여 pcode값 생성
                $data['pname'] = isset($_REQUEST['pname'])?$_REQUEST['pname']:null;
                $data['pstock'] = isset($_REQUEST['pstock'])?$_REQUEST['pstock']:null;
                $data['pprice'] = isset($_REQUEST['pprice'])?$_REQUEST['pprice']:null;

                // 기존에 입력된 데이터를 새로운 정보로 수정한다.
                $result = updateProductByNum($data);
                if( $result ){
                    $action = 9200; // 입력 성공후 상품리스트 보기 콘트롤로 리다이렉트
                    header("location:../controller/MainCTL.php?action=$action");
                }else{
                    $action = 9210; //다시 입력하도록 실패메시지 뷰로 리다이렉트
                    header("location:../view/MainView.php?action=$action");
                }
           }

			break;
	//상품 삭제 버튼 액션
		case 212:
					$del_product_num=($_REQUEST['product_num'])?$_REQUEST['product_num']:null;
			        for($i=0;$i<count($del_product_num);$i++){
			            produect_deleteing($del_product_num[$i]);
			        }
			            $action=9200;
			        header("location:../controller/MainCTL.php?action=$action&pageNum=$pageNum");
        	break;
     //상품 수정 버튼 액션
        case 213:
        			$update_product_num=isset($_REQUEST['up_product_num'])?$_REQUEST['up_product_num']:0;
        			$product_info=product_up_selecting($update_product_num);

			        $_SESSION['update_pnum']=$product_info['pnum'];
			        $_SESSION['update_pcategory']=$product_info['pcategory'];
			        $_SESSION['update_pcode']=$product_info['pcode'];
			        $_SESSION['update_pname']=$product_info['pname'];
			        $_SESSION['update_pprice']=$product_info['pprice'];
			        $_SESSION['update_pstock']=$product_info['pstock'];
			        $_SESSION['update_pfimage']=$product_info['pfimage'];
			        $_SESSION['update_psimage']=$product_info['psimage'];
        	break;
     //실제 수정 버튼 액션
        case 214:
        			$update_product_list[0]=isset($_REQUEST['pnum'])?$_REQUEST['pnum']:null;
        			$update_product_list[1]=isset($_REQUEST['pcategory'])?$_REQUEST['pcategory']:null;
					$update_product_list[2]=isset($_REQUEST['pcode'])?$_REQUEST['pcode']:null;
					$update_product_list[3]=isset($_REQUEST['pname'])?$_REQUEST['pname']:null;
					$update_product_list[4]=isset($_REQUEST['pprice'])?$_REQUEST['pprice']:null;
					$update_product_list[5]=isset($_REQUEST['pstock'])?$_REQUEST['pstock']:null;
					$update_product_list[6]=isset($_REQUEST['file'])?$_REQUEST['file']:null;
					$result=product_updating($update_product_list);
					

					if($result==true){
	               		$_SESSION['msg'] ="회원정보수정 성공했습니다.";
		            }
		            else{
		                $_SESSION['msg'] ="회원정보수정 실패했습니다.";
		            }

		            $action=9200;
		            
		            header("location:../controller/MainCTL.php?action=$action&pageNum=1");
        	break;


// 구매관리
		case 300:
			# code...
			break;

// 결제관리
		case 400:
			# code...
			break;

// 배송관리	
		case 500:
			# code...
			break;

// 매출관리
		case 600:
			# code...
			break;

// 게시판관리
		case 700:
			# code...
			break;

		default:
			$action=9000;
			break;
	}
    


?>