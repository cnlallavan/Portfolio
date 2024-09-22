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

if ($stm = $conn->prepare('SELECT * FROM content')){
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows >0){

    }
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
      else if($fileSize > 10000000){
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
        $query = "INSERT INTO files VALUES('', '$name', '$newImageName')";
        mysqli_query($conn, $query);
        echo
        "
        <script>
          alert('Successfully Added');
        </script>
        ";
      }
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS Admin</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <a class="navbar-brand" href="dashboard.php">CMS Admin</a> 
        <div class="logout" style="padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
            <form action="" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
        </nav>   

        <!-- Header  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>  
                        <h5> Welcome Admin! </h5>
                    </div>
                </div>              
                 <!-- Content  -->
                  <hr />
            <div class="row">
                <?php while($record = mysqli_fetch_assoc($result)){  ?>
                <div class="col-md-10 col-sm-6 col-xs-6">        
			        <div class="panel panel-back noti-box">
                        <div class="text-box" >
                            <h3>About Me</h3>
                            <?php echo $record['content']; ?>
                        </div>
                    </div>
		        </div>
                <?php } ?>

                <div class="col-md-2 col-sm-6 col-xs-6">        
			        <div class="panel panel-back noti-box">
                        <a class="edit_button" href="edit.php?id=1">Edit</a>
                    </div>
		        </div>
			</div>      
            
            <div class="row">
                <div class="col-md-10 col-sm-6 col-xs-6">        
			        <div class="panel panel-back noti-box">
                        <div class="text-box" >
                            <form method="post" enctype="multipart/form-data">
                                <input type="text" name="name" required placeholder="Filename">
                                    <br><br>
                                <input type="file" name="image" accept=".jpg, .jpeg, .png">
                                    <br>
                                <button type="submit" name="upload">Upload Image</button>
                            </form>
                        </div>
                    </div>
		        </div>
                <div class="col-md-10 col-sm-6 col-xs-6">        
			        <div class="panel panel-back noti-box">
                        <div class="text-box" >
                            <table border = 1 cellspacing = 0 cellpadding = 10>
                                <tr>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>Image</td>
                                </tr>
                                <?php
                                    $image = mysqli_query($conn, "SELECT * FROM files ");
                                    $i = 1;
                                

                                 foreach ($image as $row) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td> <img src="img/<?php echo $row["image"]; ?>" width = 200 title="<?php echo $row['image']; ?>"> </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
		        </div>
			</div>  
    </div>
            </div>
        </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
