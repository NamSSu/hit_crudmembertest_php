<?php
header('Content-Type: text/html; charset=utf-8');

$conn = mysqli_connect("localhost","cip13a", "", "cip13adb");

$id=$_GET['id'];

$query = "delete from 00member where id='$id'";

if (!$id) {
    echo "no id";
} else {
    if(mysqli_query($conn, $query)) {
        echo "success";
        
    } else {
        echo mysqli_error($conn);
    }
}

mysqli_close($conn);

?>