<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'todo') or die(mysqli_error($mysqli));

$update = false;
$Tasks = '';
$user_date = '';

if (isset($_POST['save'])){
    $Tasks = $_POST['Tasks'];
    $usr_date = $_POST['usr_date'];

    $mysqli->query("INSERT INTO tasks (tasks, date) VALUES('$Tasks', '$usr_date')") or
    die($mysqli->error);

    
    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "Success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM tasks WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "Danger";

    header("location: index.php");
}


if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tasks WHERE id=$id") or die($msqli->error());
    if(count($result)==1){
        $row = $result->fetch_array();
        $Tasks = $row['tasks'];
        $date = $row['date'];
    }
}

?>