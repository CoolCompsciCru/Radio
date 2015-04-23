<?php
session_start();
$servername = "localhost";
$SQLusername = "root";
$SQLpassword = "root";
$dbname = "Radio";

// Create connection
$conn = new mysqli($servername, $SQLusername, $SQLpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['name'];
$password = $_POST['key'];

if($_SESSION['loginfails'] < 3) {
  $sql = "SELECT hashkey FROM users WHERE name = '$username'";
  $result = $conn->query($sql);
  $hashkey = $result->fetch_assoc()["hashkey"];

  if ( hash_equals($hashkey, crypt($password, $hashkey)) ) {
    $_SESSION['name'] = $username;
    echo "Accepted";
    echo "<script>window.location.replace('radio.php'); </script>";
    die();
  } else {
    $_SESSION['loginfails'] = $_SESSION['loginfails'] + 1;
    echo "<a href='loginForm.php'>";
    echo "Incorrect username or password. Please try again";
    echo "</a>";
  }
} else {
  echo "You have made too many wrong attempts. Please try again later";
}

?>
