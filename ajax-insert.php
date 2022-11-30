<?php
$place=$_POST["place"];
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];

$con=mysqli_connect("localhost","root","","crud") or die("Connection failed");
$sql="insert into city (cid, name, fname, lname) values (null, '{$place}', '{$first_name}', '{$last_name}');";

if(mysqli_query($con,$sql)){
    echo 1;
}
else{
    echo 0;
}