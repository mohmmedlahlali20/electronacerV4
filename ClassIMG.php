<?php 
class ImageUploader
{
    public static function uploadImage()
    {
        $targetDirectory = "../img"; // Change this to your desired directory
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            return false; // Not an image
        }

        // Check file size (adjust as needed)
        if ($_FILES["image"]["size"] > 500000) {
            return false; // File size too large
        }

        // Allow certain file formats (adjust as needed)
        if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif") {
            return false; // Unsupported file format
        }

        // Move the file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            return $targetFile; // Return the path to the uploaded image
        } else {
            return false; // Failed to move the file
        }
    }
}