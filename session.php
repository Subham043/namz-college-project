<?php
include("includes/database.php");
session_start();
if (!isset($_SESSION['id'])){
header('location:index.php');
}

if(!empty($_GET['user'])){
    $id = $_GET['user'];
}else{
    $id = $_SESSION['id'];
    $user_session_id = $_SESSION['id'];
}

$query=mysqli_query ($con,"SELECT * FROM user WHERE user_id ='$id'");
$row=mysqli_fetch_array($query);
$cover_picture=$row['cover_picture'];
$profile_picture=$row['profile_picture'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$username=$row['username'];
?>