<?php

$username = $_POST['name'];
$password = $_POST['key'];

// A higher "cost" is more secure but consumes more processing power
$cost = 10;

// Create a random salt
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

// Prefix information about the hash so PHP knows how to verify it later.
// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
$salt = sprintf("$2a$%02d$", $cost) . $salt;

// Value:
// $2a$10$eImiTXuWVxfM37uY4JANjQ==

// Hash the password with the salt
$hash = crypt($password, $salt);


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

$sql = "INSERT INTO users (id, name, hashkey)
VALUES ('', '$username', '$hash')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo "<a href='loginForm.php'> Click to login </a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
