<?php

$con=mysqli_connect("localhost","root","","crud") or die("Connection failed");
$sql="select * from city where cid = {$_POST['edit_id']}";

$result=mysqli_query($con,$sql);
$output="";

if(mysqli_num_rows($result) > 0 ){

  while($row= mysqli_fetch_assoc( $result )){
    $output.="<tr>
  
    <td>First Name:</td>
    <td><input type='text'name='fname' class='frn' value='$row[fname]'></td>
    
    </tr>
    
    <tr>
  
    <td>Last Name</td>
    <td><input type='text' name='lname' class='lrn' value='$row[lname]'></td>
    
    </tr>

    <tr>
  
    <td></td>
    <td><input type='submit' name='sub' id='sub_btn' ></td>
    
    </tr>
    
    ";
  }
  

  mysqli_close($con);
  echo $output;
}
else{
  echo"<h2>No record found.</h2>";
}