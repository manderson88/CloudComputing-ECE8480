<?php
 
session_start();
//if(!mysession_is_registered(myusername))
 if (!isset($_SESSION['myusername'])){
    header("location:login.php");
}

$host="localhost"; // Host name
$db_name="Store"; // Database name
$tbl_name="users"; // Table name


// Define $myusername and $mypassword
$username=$_SESSION['myusername'];
$password=$_SESSION['mypassword'];

// Connect to server and select databse.
$link=mysqli_connect("$host", $username, $password)or die("cannot connect");
mysqli_select_db($link,"$db_name")or die("cannot select DB");


$sql="select  products.name, product_type.description ,products.description, image from Products, product_type, web_data where Products.typeid=product_type.Id and Products.prod_imageid=web_data.id";

$result=mysqli_query($link,$sql);

if (!$result){die(mysqli_error($link));}

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
//this row needs to be in synch with the database defs.  I have changed them from the original sql files that were posted.  let me know if you want me to update the .sql ???  marka
// If result matched $myusername and $mypassword, table row must be 1 row
if($count>0){
    echo "<table border=\"5\" bordercolor= \"red\" align=\"center\"><tr><th>Type</th><th>name</th><th>description</th><th>Image</th></tr>";
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr><td>". $row["name"]. "</td><td>" . $row["descrip"]. "</td><td>" . $row["description"]. "</td><td> <img src=" . $row["image"]. " border=3 height=100 width=100></img></td></tr>";
    }
    echo("</table>");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login Pages</title>
    </head>
    <body>
        </br>
        <form name="logout form" method="post" action="login.php">
        <input type="submit" name="Submit" value="Logout">
    </body>
</html>

