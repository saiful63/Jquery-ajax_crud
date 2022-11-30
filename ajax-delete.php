<?php
$id=$_POST["uid"];

$con=mysqli_connect("localhost","root","","crud") or die("Connection failed");
$sql="DELETE FROM `city` WHERE cid='$id'";
if(mysqli_query($con,$sql)){
    echo 1;
}
else{
    echo 0;
}