<?php
function updateProductByNum( $data ){

    $sql = " UPDATE product SET ";
    $sql.= " pcategory = '".strval($data['pcategory'])."',"."pcode = '".strval($data['pcode'])."',pname = '".strval($data['pname'])."',pstock = '".strval($data['pstock'])."',pprice = '".strval($data['pprice'])."',pfimage = '".strval($data['pfimage'])."',psimage = '".strval($data['psimage'])."'";
    $sql.= " WHERE pnum = ".strval($data['pnum']);

    $result = SQL_CON($sql);
    return $result;
}

// 파일 업로드 처리 함수
function singleFileUpload($uploadFileInfo, $uploadPath, $saveFileName, $fileMaxSize){

    $targetDir = $uploadPath;
    $targetFile = $targetDir.basename($saveFileName);
    $imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);

    // 이미지 파일이 가짜 이미지 파일 인지 확인 
    $check = getimagesize($uploadFileInfo["tmp_name"]);
    if($check != false) {
         $returnArr['msg'][0] = "File is an image - " . $check["mime"] . ".";
         $returnArr['uploadOk'] = 1;
    } else {
         $returnArr['msg'][0] = "File is not an image.";
         $returnArr['uploadOk'] = 0;
    }

    // 대상 파일이 이미 존재하고 있는지 확인
    if (file_exists($targetFile)) {
        $returnArr['msg'][1] = "Sorry, file already exists.";
        $returnArr['uploadOk'] = 0;
    }
    
     // 파일의 SIZE가 정해진 크기 이내에 있는지 확인
    if ($uploadFileInfo["size"] > $fileMaxSize) {
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
        if (move_uploaded_file($uploadFileInfo["tmp_name"], $targetFile)) {
            $returnArr['msg'][5] = "The file ". basename( $uploadFileInfo["name"]). " has been uploaded.";
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


