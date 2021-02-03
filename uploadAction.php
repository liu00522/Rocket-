<?php
include ('db.php');

if (isset($_POST['submit'])) {
  $newFileName = $_POST['pkmName'];
  $newFileName = strtolower(str_replace(" ", "-", $newFileName));

  $imgTitle = $_POST['pkmName'];
  $imgType = $_POST['pkmType'];
  $imgMSRP = $_POST['pkmMSRP'];
  $imgPrice = $_POST['pkmPrice'];
  $imgRate = $_POST['pkmRating'];
  $imgDesc = $_POST['pkmDesc'];

  // create file variables
  $file = $_FILES['imgFile'];
  
  // Extract info of image file
  $fileName = $file['name'];
  $fileType = $file['type'];
  $fileTmpName = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  // File extension validation
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  // Allowed extensions and file size (10MB)
  $allowed = array('jpg', 'jpeg', 'png');
  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 10000000) {
        $imgFullName = $newFileName . "." . $fileActualExt;
        $fileDestination = "products/" . $imgFullName;

        $sql = "SELECT * FROM products;";
        $stmt = mysqli_stmt_init($conn);
        // Retrieving the contents of the table
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "SQL statement failed.";
        } else {
          // Executing the statement
          mysqli_stmt_execute($stmt); 
          // Grab the data from database
          $result = mysqli_stmt_get_result($stmt);
          $rowCount = mysqli_num_rows($result);
          // Insert new row (as default will be 0)
          $setImgOrder = $rowCount + 1;

          // Insert new image into the database
          $sql = "INSERT INTO products (title, type, MSRP, price, imgAddr, rating, pkmDesc) VALUES (?, ?, ?, ?, ?, ?, ?);";
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed.";
          } else {
            mysqli_stmt_bind_param($stmt, "ssddsss", $imgTitle, $imgType, $imgMSRP, $imgPrice, $imgFullName, $imgRate, $imgDesc);
            mysqli_stmt_execute($stmt);

            // Upload image to destination folder
            move_uploaded_file($fileTmpName, $fileDestination);
            header("Location: upload.php?upload=success");
          }
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