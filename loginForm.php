<?php
session_start();
if($_SESSION['loginfails'] >= 3) {
  echo "You have made too many wrong login attempts <br>";
  echo "Please try again later";
} else {
  echo '<h2> Login </h2>';
  echo $_SESSION[loginfails];
  echo '<form action="login.php" method="post">
    Name: <input type="text" name="name"><br>
    Password: <input type="password" name="key"><br>
    <input type="submit">
  </form>';
  echo "<a href='registration.html'> Register </a>";
}
?>
