<?php

if(isset($_POST["submit"])) {
    if($_POST["submit"] == "add"){
        add();
    }
    else if($_POST["submit"] == "edit"){
        edit();
    }
    else {
        delete();
    }
}

function add(){
    global $conn;

    $name = $_POST["name"];
    $filename = $_FILES["file"]["name"];
    $tmpname = $_FILES["file"]["tmp_name"];

    $newfilename = uniqid() . "-" . $filename;

    move_uploaded_file($tmpname, 'img/' . $newfilename);
    $query = "INSERT INTO files VALUES('', '$name', '$newfilename')";
    mysqli_query($conn, $query);

    echo "<script> alert('Image Added Successfully') </script>";
}

function edit(){
    global $conn;

    $id = $_GET["id"];
    $name = $_POST["name"];

    if($_FILES["file"]["error"] != 4){
        $filename = $_FILES["file"]["name"];
        $tmpname = $_FILES["file"]["tmp_name"];

        $newfilename = uniqid() . "-" . $filename;

        move_uploaded_file($tmpname, 'img/' . $newfilename);
        $query = "UPDATE files SET image = '$newfilename' WHERE id = $id";
        mysqli_query($conn, $query);
    }

    $query = "UPDATE files SET name = '$name' WHERE id = $id";
    mysqli_query($conn, $query);

    echo " <script> alert('Image Edited Successfully'); </script> ";
}

function delete(){
    global $conn;

    $id = $_POST["submit"];

    $query = "DELETE FROM files WHERE id = $id";
    mysqli_query($conn, $query);

    echo "<script> alert('Image Deleted Succesfully'); </script>";
}