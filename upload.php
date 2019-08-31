<?php
if (isset($_POST['submit'])){
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name']; //Tmp is the temporary location of the file
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];


    //This tell what kind of files we want to allow
    $fileExtension = explode('.', $fileName);
    $fileActualExtension = strtolower(end($fileExtension));
    //strtolower() is a string that changes all letters to lowercase. end() gets the last piece of data from array

    //This has the information inside as the kind of files we want them to upload.
    $allowed = array('pdf', 'doc', 'docx', 'rft');

    //This check if there are any of the $allowed in what was uploaded
    if(in_array($fileActualExtension, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNewName = uniqid('', true).".".$fileActualExtension;
                $fileDestination = 'CVs/'.$fileNewName;
                move_uploaded_file($fileTmpName, $fileDestination);//This function uploads the file
                header("Location: index.php?uploadsuccess");
            }else{
                echo "Your file is too large!";
            }
        }else{
            echo "There was an error uploading your file.";
        }
    }else{
        echo "This file is not accepted";
    }
}
