<?php

namespace App\Helpers;

class FileUploader {

    public static function uploadImage ($file, $folder) {
        return $file->store($folder, 'public');
    }

    public static function deleteImage ($img) {
        return unlink(public_path().'/images/'. $img);
    }

}
