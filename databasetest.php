<?php
/**
 * Created by PhpStorm.
 * User: aline
 * Date: 2016-10-31
 * Time: 9:34 PM
 */
$servername = "localhost";
$username = "f6team16_aline";
$password = "senha";
$dbname = "f6team16_iseaterdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT studentID, FirstName, LastName FROM Student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["studentID"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
