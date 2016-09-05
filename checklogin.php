<?php

ob_start();

$host="localhost"; // Host name
$username=""; // Mysql username
$password=""; // Mysql password
$db_name="test"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
$link=mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($link,"$db_name")or die("cannot select DB");

// Define $myusername and $mypassword
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($link,$myusername);
$mypassword = mysqli_real_escape_string($link,$mypassword);

$sql="SELECT * FROM $tbl_name WHERE name='$myusername' and password='$mypassword'";

$result=mysqli_query($link,$sql);

if (!$result){die(mysqli_error($link));}

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register used to start the session now you need to explicitly do this for the next page to work correctly.
//session_register("myusername");
//session_register("mypassword");
session_start();
$_SESSION['myusername']="$myusername";
$_SESSION['mypassword']="$mypassword";
echo ($_SESSION['myusername']);
echo ($_SESSION['mypassword']);

header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login Page</title>
    </head>
    <body>
        Page for the login.
    </body>
</html>
