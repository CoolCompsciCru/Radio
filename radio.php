<?php
session_start();
if($_SESSION['name'] == '') {
  echo "<a href='login.html'> Please login </a>";
  die();

} else {
  echo "Hello $_SESSION[name] <br>";
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Radio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT COUNT(*) FROM songs";
$result = $conn->query($query);
$SONGS_IN_DATABASE = $result->fetch_assoc()["COUNT(*)"];
$random = mt_rand(1,$SONGS_IN_DATABASE);
$sql = "SELECT * FROM songs WHERE id = $random";
$result = $conn->query($sql);
$src = $result->fetch_assoc()["src"];
$result = $conn->query($sql);
$title = $result->fetch_assoc()["title"];
$result = $conn->query($sql);
$artist= $result->fetch_assoc()["artist"];
$result = $conn->query($sql);
$conn->close();
?>
<p id='info'>
  <?php
  echo $title." by ".$artist."<br>";
  ?>
</p>
<audio controls autoplay id='audio'>
  <?php
  echo "  <source src='$src' type='audio/mpeg' id='mpegSource'> ";
  ?>
</audio>
<br>
<button onclick="nextSong()" id=>Next Song</button>
<script>
var audio = document.getElementById('audio');
var source = document.getElementById('mpegSource');
audio.addEventListener('ended', hasEnded);
function hasEnded() {
  var info = document.getElementById('info').innerHTML = 'song ended';
  nextSong();
}
function nextSong() {
  location.reload(true);
}
</script>
