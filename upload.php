<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'portfolio');

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('location: login.php');
    exit();
}

if(isset($_POST["upload"])){
    $name = $_POST["name"];
    if($_FILES["image"]["error"] == 4){
      echo
      "<script> alert('Image Does Not Exist'); </script>"
      ;
    }
    else{
      $fileName = $_FILES["image"]["name"];
      $fileSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];
  
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $fileName);
      $imageExtension = strtolower(end($imageExtension));
      if ( !in_array($imageExtension, $validImageExtension) ){
        echo
        "
        <script>
          alert('Invalid Image Extension');
        </script>
        ";
      }
      else if($fileSize > 1000000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
        </script>
        ";
      }
      else{
        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;
  
        move_uploaded_file($tmpName, 'img/' . $newImageName);
        $sql = "INSERT INTO files VALUES('', '$name', '$newImageName')";
        mysqli_query($conn, $sql);
        echo
        "
        <script>
          alert('Successfully Added');
          document.location.href = 'data.php';
        </script>
        ";
      }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
                                <input type="text" name="name" required placeholder="Filename">
                                    <br><br>
                                <input type="file" name="image" accept=".jpg, .jpeg, .png">
                                    <br>
                                <button type="submit" name="upload">Upload Image</button>
                            </form>
</body>
</html>