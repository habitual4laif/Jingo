
<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/Habitual/core/dbh.php';


// To upload filled form to database
// if (isset($_POST['add_product'])) {
//
// $title = $_POST['title'];
// $price = $_POST['price'];
// $list_price = $_POST['list_price'];
// $brand = $_POST['brand'];
// $parentC = $_POST['parent'];
// $categories = $parentC['id'];
// $image = $_POST['image'];
// $description = $_POST['description'];
// $featured = $_POST['featured'];


// $sizes = $_POST['sizes'];
//
// if (empty($title)){
//     header("Location: product.php?error=empty");
//     exit();



  // }
  // if (empty($price)){
  //     header("Location: product.php?error=empty");
  //     exit();
  //   }
  //   if (empty($list_price)){
  //       header("Location: product.php?error=empty");
  //       exit();
  //     }
  //     if (empty($brand)){
  //         header("Location: product.php?error=empty");
  //         exit();
  //       }
  //       if (empty($categories)){
  //           header("Location: product.php?error=empty");
  //           exit();
  //         }
  //         if (empty($image)){
  //             header("Location: product.php?error=empty");
  //             exit();
  //           }
  //           if (empty($description)){
  //               header("Location: product.php?error=empty");
  //               exit();
  //               }
  //               if (empty($sizes)){
  //                   header("Location: product.php?error=empty");
  //                   exit();



//     }else{
//         $sql = "INSERT INTO product1 (title, price, list_price, brand, categories, image, description, sizes)
//         VALUES ('$title', '$price', '$list_price', '$brand', '$categories', '$image', '$description', '$sizes')";
//         $result = $dbh->query($sql);
//           header('Location: product.php?success');
//     }
// }




// To Upload product image
if (isset($_POST['add_product'])){
    $file = $_FILES['image'];
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
    $allowed = array('jpg', 'jpeg', 'png');

    //This check if there are any of the $allowed in what was uploaded
    if(in_array($fileActualExtension, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNewName = uniqid('', true).".".$fileActualExtension;

// These two lines upload the image first while the other two (some lines down) makes the image accessible for display
                $fileDestination = '../assets/'.$fileNewName;
                move_uploaded_file($fileTmpName, $fileDestination);//This function uploads the file

                $sql = "INSERT INTO product1 (image) VALUES ('$fileDestination')";
                $result = $dbh->query($sql);
                header("Location: products.php?uploadsuccess");

          // To upload filled form to database
          $title = $_POST['title'];
          $price = $_POST['price'];
          $list_price = $_POST['list_price'];
          $brand = $_POST['brand'];
          $parentC = $_POST['parent'];
          $categories = $parentC['id'];
          $image = $_POST['image'];
          $description = $_POST['description'];
          $sizes = $_POST['sizes'];

// This two lines makes the image available together with other properties of the product
                $fileDe = '../Habitual/assets/'.$fileNewName;
                move_uploaded_file($fileTmpName, $fileDe);

                  $sql1 = "INSERT INTO product1 (title, price, list_price, brand, categories, image, description, sizes)
                  VALUES ('$title', '$price', '$list_price', '$brand', '$categories', '$fileDe', '$description', '$sizes')";
                  $result = $dbh->query($sql1);
                    header('Location: ../admin/products.php');
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
