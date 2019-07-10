<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Empleados\Service;

/**
 * Description of ImageManager
 *
 * @author jorge
 */
class ImageManager {

    //put your code here
    // The directory where we save image files.
    private $saveToDirTemp = './data/imgtemp/';
    private $saveToDir = './data/upload/';

    // Returns path to the directory where we save the image files.
    public function getSaveToDir() {
        return $this->saveToDir;
    }

    //Método para guardar la imagen de forma temporal
    public function moverImgTemp($imgTemp) {
        //verificamos que este el directorio 
        //para imagenes temporales si no lo creamos. 
        if (is_file($this->saveToDirTemp)) {
            if (!mkdir($this->saveToDir)) {
                throw new \Exception('Could not create directory for uploads: ' .
                error_get_last());
            }
        }
        $imgTemp;
        $handle = opendir($this->saveToDirTemp);
        while (false !== ($entry = readdir($handle))) {

            if ($entry == '.' || $entry == '..')
                continue; // Skip current dir and parent dir.
            if ($nameImage == $entry) {
                $imgTemp = $entry;
            }
        }
         return $imgTemp;
    }

    // Returns the array of uploaded file names.
    public function getSavedFiles() {
        // The directory where we plan to save uploaded files.
        // Check whether the directory already exists, and if not,
        // create the directory.
        if (!is_dir($this->saveToDir)) {
            if (!mkdir($this->saveToDir)) {
                throw new \Exception('Could not create directory for uploads: ' .
                error_get_last());
            }
        }

        // Scan the directory and create the list of uploaded files.
        $files = [];
        $handle = opendir($this->saveToDir);
        while (false !== ($entry = readdir($handle))) {

            if ($entry == '.' || $entry == '..')
                continue; // Skip current dir and parent dir.

            $files[] = $entry;
        }

        // Return the list of uploaded files.
        return $files;
    }

    // Returns the array of uploaded file names.
    public function getSavedFile($nameImage) {

        // The directory where we plan to save uploaded files.
        // Check whether the directory already exists, and if not,
        // create the directory.
        if (!is_dir($this->saveToDir)) {
            if (!mkdir($this->saveToDir)) {
                throw new \Exception('Could not create directory for uploads: ' .
                error_get_last());
            }
        }

        // Scan the directory and create the list of uploaded files.
        $files = [];
        $handle = opendir($this->saveToDir);
        while (false !== ($entry = readdir($handle))) {

            if ($entry == '.' || $entry == '..')
                continue; // Skip current dir and parent dir.
            if ($nameImage == $entry) {
                $files = $entry;
            }
        }

        // Return the list of uploaded files.
        return $files; //$files;
    }

    // Returns the path to the saved image file.
    public function getImagePathByName($fileName) {
        // Take some precautions to make file name secure.
        $fileName = str_replace("/", "", $fileName);  // Remove slashes.
        $fileName = str_replace("\\", "", $fileName); // Remove back-slashes.
        // Return concatenated directory name and file name.
        return $this->saveToDir . $fileName;
    }

    // Returns the image file content. On error, returns boolean false.
    public function getImageFileContent($filePath) {
        return file_get_contents($filePath);
    }

    // Retrieves the file information (size, MIME type) by image path.
    public function getImageFileInfo($filePath) {
        // Try to open file
        if (!is_readable($filePath)) {
            return false;
        }

        // Get file size in bytes.
        $fileSize = filesize($filePath);

        // Get MIME type of the file.
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $filePath);
        if ($mimeType === false)
            $mimeType = 'application/octet-stream';

        return [
            'size' => $fileSize,
            'type' => $mimeType
        ];
    }

    // Resizes the image, keeping its aspect ratio.
    public function resizeImage($filePath, $desiredWidth = 240) {
        // Get original image dimensions.
        list($originalWidth, $originalHeight) = getimagesize($filePath);

        // Calculate aspect ratio
        $aspectRatio = $originalWidth / $originalHeight;
        // Calculate the resulting height
        $desiredHeight = $desiredWidth / $aspectRatio;

        // Get image info
        $fileInfo = $this->getImageFileInfo($filePath);

        // Resize the image
        $resultingImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
        if (substr($fileInfo['type'], 0, 9) == 'image/png')
            $originalImage = imagecreatefrompng($filePath);
        else
            $originalImage = imagecreatefromjpeg($filePath);
        imagecopyresampled($resultingImage, $originalImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);

        // Save the resized image to temporary location
        $tmpFileName = tempnam("/tmp", "FOO");
        imagejpeg($resultingImage, $tmpFileName, 80);

        // Return the path to resulting image.
        return $tmpFileName;
    }

}
