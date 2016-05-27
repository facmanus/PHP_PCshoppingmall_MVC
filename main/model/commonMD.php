<?php

//마지막 쿼리의 기본키가져오기.
function getAutoIncrementNum(){
        return mysql_insert_id();
}

//물품을 수정한다.
function updateProductByNum( $data ){

    $sql = " UPDATE product SET ";
    $sql.= " pcategory = '".strval($data['pcategory'])."',"."pcode = '".strval($data['pcode'])."',pname = '".strval($data['pname'])."',pstock = '".strval($data['pstock'])."',pprice = '".strval($data['pprice'])."',pfimage = '".strval($data['pfimage'])."',psimage = '".strval($data['psimage'])."'";
    $sql.= " WHERE pnum = ".strval($data['pnum']);

    $result = SQL_CON($sql);
    return $result;
}

// 파일을 1개를 업로드한다.
function singleFileUpload($saveFInfo, $saveFPath, $saveFName, $fileMaxSize){
    //파일의 경로
    $FPathDir = $saveFPath;
    //basename : 파일의 경로를 제외한다.
    $fullDirFile = $FPathDir.basename($saveFName);
    $imageFileType = pathinfo($fullDirFile,PATHINFO_EXTENSION);

    // 파일의 정보 출력 getimagesize
        // [0] 에는 이미지의 너비
        // $a[1] 에는 이미지의 높이
        // $a[2] 에는 이미지의 종류
        // $a[3] 에는 html로 출력시 img 태그에 넣을 요소
        // $a['mime'] 에는 이미지의 mimetype
        ///a[2]
            // 1 => 'GIF',
            // 2 => 'JPG',
            // 3 => 'PNG',
            // 4 => 'SWF',
            // 5 => 'PSD',
            // 6 => 'BMP',
            // 7 => 'TIFF(intel byte order)',
            // 8 => 'TIFF(motorola byte order)',
            // 9 => 'JPC',
            // 10 => 'JP2',
            // 11 => 'JPX',
            // 12 => 'JB2',
            // 13 => 'SWC',
            // 14 => 'IFF',
            // 15 => 'WBMP',
            // 16 => 'XBM'
    $GetfileInfo = getimagesize($saveFInfo["tmp_name"]);
    if($GetfileInfo != false) {
         $returnArr['msg'][0] = "File is an image - " . $GetfileInfo["mime"] . ".";
         $returnArr['uploadOk'] = 1;
    } else {
         $returnArr['msg'][0] = "File is not an image.";
         $returnArr['uploadOk'] = 0;
    }

    // 대상 파일이 이미 존재하고 있는지 확인
    if (file_exists($fullDirFile)) {
        $returnArr['msg'][1] = "Sorry, file already exists.";
        $returnArr['uploadOk'] = 0;
    }
    
     // 파일의 SIZE가 정해진 크기 이내에 있는지 확인
    if ($saveFInfo["size"] > $fileMaxSize) {
        $returnArr['msg'][2] = "Sorry, your file is too large.";
        $returnArr['uploadOk'] = 0;
     }

    // 이미지 파일 포맷이 jpg, jpeg, png, gif 인지 확인
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $returnArr['msg'][3] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $returnArr['uploadOk'] = 0;
    }

    // 위 모든 점검에 이상이 없는지 확인 후 파일 upload 실시
    if ($returnArr['uploadOk'] == 0) {
        $returnArr['msg'][4] = "Sorry, your file was not uploaded.";
    } else {
        //move_uploaded_file : 파일을 이동시킨다.
        if (move_uploaded_file($saveFInfo["tmp_name"], $fullDirFile)) {
            $returnArr['msg'][5] = "The file ". basename( $saveFInfo["name"]). " has been uploaded.";
        } else {
            $returnArr['msg'][5] = "Sorry, there was an error uploading your file.";
        }
    }

    return $returnArr;
}

// 썸네일 이미지 생성 함수
function makeThumbnailImage($src, $dest, $desiredHeight, $imgFileType) {

    // 이미지 소스 파일을 읽어 온다.
    if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
        $sourceImage = imagecreatefromjpeg($src);
    }elseif ( $imgFileType == "png") {
        $sourceImage = imagecreatefrompng($src);
    }else{
        $sourceImage = imagecreatefromgif($src);
    }

    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);
    
    // 이미지 크기를 조정
    $desiredWidth = floor($width * ($desiredHeight / $height));
    
    // 버추얼 이미지를 생성
    $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
    
    // 조정된 사이즈로 원본 이미지를 버추얼 이미지로 복사.
    imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
    
    // 지정된 위치에 thumbnail 이미지 생성
    if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
        imagejpeg($virtualImage, $dest);
    }elseif ( $imgFileType == "png") {
        imagepng($virtualImage, $dest);
    }else{
        imagegif($virtualImage, $dest);;
    }

}


