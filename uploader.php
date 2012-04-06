<?php
class html5ImageUploader {

    public function doUploadImages(){
        $upload_dir = "upload_images";// The directory for the images to be saved in
        $upload_path = $upload_dir."/";// The path to where the image will be saved

        $large_image_name = $_POST['iName'];// New name of the large image
        $file_info = $this->hashFileSavePath($upload_dir, $large_image_name);

        $return_data = array(
            "status"            =>0,
            "big_file_name"     =>"",
            "small_file_name"   =>"",
            "msg"               =>""
        );

       if(!empty($_POST["iSmallFile"])){
            $image_base64_data = $_POST["iSmallFile"];
            $image_encode_data = substr($image_base64_data, strpos($image_base64_data, ","), strlen($image_base64_data));
            $image_data = base64_decode($image_encode_data);
            $im = imagecreatefromstring($image_data);
            $small_image_name = "50_50_".$file_info["fname"].".jpg";
            if($im !== false) {
                header('Content-Type: image/jpeg');
                imagejpeg($im,$file_info["fpath"]."/".$small_image_name);
                $return_data["small_file_name"] = $file_info["fpath"]."/".$small_image_name;
                imagedestroy($im);
            } else {
                $return_data["status"] = 1;
                $return_data["msg"] = 'Save Image error.';
            }
        }

       if(!empty($_POST["iBigFile"])){
            $image_base64_data = $_POST["iBigFile"];
            $image_encode_data = substr($image_base64_data, strpos($image_base64_data, ","), strlen($image_base64_data));
            $image_data = base64_decode($image_encode_data);
            $im = imagecreatefromstring($image_data);
            $big_image_name = "180_180_".$file_info["fname"].".jpg";
            if($im !== false) {
                header('Content-Type: image/jpeg');
                imagejpeg($im,$file_info["fpath"]."/".$big_image_name);
                imagedestroy($im);
                $return_data["big_file_name"] = $file_info["fpath"]."/".$big_image_name;
            } else {
                $return_data["status"] = 1;
                $return_data["msg"] = 'Save Image error.';
            }
        }

        header("Content-Type:application/json; charset=UTF-8");
        echo json_encode($return_data);
        exit(0);
    }

    public function getMicrotime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public function randStr($len=5, $type="normal")
    {
        switch($type){
            case "num":
                $chars = '0123456789';
                $chars_len = 10;
                break;
            case "lowercase":
                $chars = 'abcdefghijklmnopqrstuvwxyz';
                $chars_len = 26;
                break;
            case "uppercase":
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $chars_len = 26;
                break;
            default:
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
                $chars_len = 62;
                break;
        }
        $string = '';
        for($len; $len>=1; $len--)
        {
            $position = rand() % $chars_len;//62 is the length of $chars
            $string .= substr($chars, $position, 1);
        }
        return $string;
    }

    public function hashFileSavePath($savePath, $fileName=''){
        $hashFileName = md5($this->randStr(20).$fileName.$this->getMicrotime().uniqid());
        $savePath = strtok($savePath, "/");
        $hashDir = $savePath."/".substr($hashFileName, 0, 1);
        $hashSubDir = $hashDir."/".substr($hashFileName, 1, 2);
        $webpath= "/".substr($hashFileName, 0, 1)."/".substr($hashFileName, 1, 2);


        $fileInfo = array(
            "fpath"      =>$hashSubDir,
            "fname"      =>$hashFileName,
            "webpath"      =>$webpath,
            "error"      =>0
        );

        if(is_dir($savePath)){
            if(!is_dir($hashSubDir)){
                $result = mkdir($hashSubDir, 0777, true);
                if(!$result){
                    $fileInfo["error"] = 2;
                }
            }
        }else{
            $fileInfo["error"] = 1;
        }
        return $fileInfo;
    }
}

$imageUploaderObj = new html5ImageUploader();
$imageUploaderObj->doUploadImages();
