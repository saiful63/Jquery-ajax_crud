<?php

$con=mysqli_connect("localhost","root","","crud") or die("Connection failed");
$sql="select * from city";

$result=mysqli_query($con,$sql);
$output="";

if(mysqli_num_rows($result) > 0 ){
  $output='<table border="1" width="100%" collspacing="0" cellpadding="10px">
          <tr>
          <th>Id</th>
          <th>Place</th>
          <th>First name</th>
          <th>Last name</th>
          <th>Edit</th>
          <th>Delete</th>
          </tr>
  ';
  while($row= mysqli_fetch_assoc( $result )){
    $output.="<tr>
    <td> $row[cid] </td>
    <td> $row[name] </td>
    <td> $row[fname] </td>
    <td> $row[lname] </td>
    <td> <button class='edt-btn' data-id='$row[cid]'>Edit</button> </td>
    <td> <button class='del-btn' data-id='$row[cid]'>Delete</button> </td>
    </tr>";
  }
  $output .="</table>";

  mysqli_close($con);
  echo $output;
}
else{
  echo"<h2>No record found.</h2>";
}