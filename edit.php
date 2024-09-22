<?php
require 'function.php';
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

if (isset($_POST['content'])) {
    if ($stm = $conn->prepare('UPDATE content SET content = ? WHERE id = ?')) {
        $stm->bind_param('si', $_POST['content'], $_GET['id']);
        $stm->execute();
        $stm->close();
        header('Location: dashboard.php');
        die();
    }
}

if (isset($_GET['id'])) {
    if ($stm = $conn->prepare('SELECT * FROM content WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();
        $result = $stm->get_result();
        $post = $result->fetch_assoc();
        if ($post) {
            ?>
            <!DOCTYPE html>
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Edit Page</title>
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
                    <!-- Header -->
                    <div id="page-wrapper" >
                        <div id="page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Edit Page</h2>
                                    <h5> Edit your About Me here. </h5>
                                </div>
                            </div>
                            <!-- Content -->
                            <hr />
                            <div class="row">
                                <div class="col-md-12 col-sm-6 col-xs-6">
                                    <div class="panel panel-back noti-box">
                                        <div class="text-box" >
                                            <form method="post" action="">
                                                <textarea name="content"><?php echo $post['content']; ?></textarea>
                                                <button type="submit">Edit Post</button>
                                            </form>
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
                <style>
                    textarea {
                        width: 100%;
                        height: 100px;
                    }
                </style>
            </body>
            </html>
            <?php
        }
    }
}
?>
                </div>
		    </div>

			</div>         
    </div>
            </div>
        </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <style>
        textarea {
            width: 100%;
            height: 100px;
        }
    </style>
   
</body>
</html>
