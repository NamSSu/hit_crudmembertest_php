<?php
header('Content-Type: text/html; charset=utf-8');

function convert($str) {
     if ($str) {
          return iconv("UTF-8", "EUC-KR", $str); 
     }
}

$conn = mysqli_connect("localhost","cip13a", "", "cip13adb");

$id=convert($_GET['id']);
$pswd=convert($_GET['pswd']);
$name=convert($_GET['name']);
$itqid=convert($_GET['itqid']);
$sex=convert($_GET['sex']);
$hobby=convert($_GET['hobby']);
$phone=convert($_GET['phone']);
$hphone=convert($_GET['hphone']);
$zipcode1=convert($_GET['zipcode1']);
$zipcode2=convert($_GET['zipcode2']);
$address=convert($_GET['address']);
$address_etc=convert($_GET['address_etc']);

$ymd=date("Y-m-d");

$query = "update 00member set name='$name', pswd='$pswd', sex='$sex', phone='$phone', hphone='$hphone', zipcode1='$zipcode1', zipcode2='$zipcode2', address='$address', address_etc='$address_etc', hobby='$hobby', modymd='$ymd' where id='$id'";

if (!$id) {
     echo "no id";

} else {
     if(mysqli_query($conn, $query)) {
          echo "success";

     } else {
          echo "failed update " + $id;
     }
}

mysqli_close($conn);

?>