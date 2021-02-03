<?php
include ('db.php');

if (isset($_POST['upload'])) {

  // Creating variables of user inputs
  $imgTitle = $_POST['pkmName'];
  $imgType = $_POST['pkmType'];
  $imgMSRP = $_POST['pkmMSRP'];
  $imgPrice = $_POST['pkmPrice'];
  $imgRate = $_POST['pkmRating'];
  $imgDesc = $_POST['pkmDesc'];

  // Extract info of image file
  $file = $_FILES['imgFile'];
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  // Extract file extension
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  // File validation: allowed file extensions and size (1MB)
  $allowed = array('jpg', 'jpeg', 'png');
  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $imgFileName = $imgTitle . "." . $fileActualExt;
        $fileDestination = "products/" . $imgFileName;

        // Insert new image infomation into the database
        $sql = "INSERT INTO products (title, type, MSRP, price, imgAddr, rating, pkmDesc) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "SQL statement has failed.";
        } else {
          mysqli_stmt_bind_param($stmt, "ssddsss", $imgTitle, $imgType, $imgMSRP, $imgPrice, $imgFileName, $imgRate, $imgDesc);
          mysqli_stmt_execute($stmt);

          // Upload image file to destination folder
          move_uploaded_file($fileTmpName, $fileDestination);
          header("Location: upload.php?upload=success");
        }
      } else {
        echo "Your file is too big.";
        exit();
      }
    } else {
      echo "There was an error uploading your file.";
      exit();
    }
  } else {
    echo "You cannot upload files of this type.";
    exit();
  }
}
?>