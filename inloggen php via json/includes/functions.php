<?php
    define("UPLOADSMAP","images/");
    define("MAXUPLOAD","500000"); // 500kb
    /**
     * Upload an image
     * @param $item
     * @param $message
     * @return bool
     */

    function upload($item,&$message) {
        $tmpName = $_FILES[$item]["tmp_name"];
        $fotoName = $_FILES[$item]["name"];
        $size = $_FILES[$item]["size"];
        $destination = UPLOADSMAP . basename($fotoName);
        $type = strtolower(pathinfo($destination,PATHINFO_EXTENSION));
        // destination folder exist?
        if(!is_dir(UPLOADSMAP)) {
            if (!mkdir( UPLOADSMAP)) {
                $message = "destination folder does not exist and could not be created.";
                return false;
            }
        }
        // check if photo exist
        if(file_exists($destination)) {
            $message = "photo exists";
            return false;
        }
        // check for MAX filesize
        if($size > MAXUPLOAD) {
            $message = "photo to large";
            return false;
        }
        // check the format of the image
        if ($type != "jpg" &&
            $type != "png" &&
            $type != "jpeg" &&
            $type != "jpg" &&
            $type != "gif") {
            $message = "photo type not correct";
            return false;
        }
        // move the file to correct destination
        if (move_uploaded_file($tmpName,$destination)) {
            $message = "photo uploaded";
            return true;
        }
        return false;
}