<?php
/**
 * Created by PhpStorm.
 * User: aline
 * Date: 2016-11-02
 * Time: 12:27 PM
 */
$title = "iSeater - Students";
require "head.php";
require "menu.php";


$servername = "localhost";
$username = "f6team16_admin";
$password = "georgebrown";
$dbname = "f6team16_iseaterdb";

    // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT studentID, FirstName, LastName, Gender, Class FROM Student";
$result = $conn->query($sql);

$studentsTable = "";
if ($result->num_rows > 0) {
    //output data of each row
    $studentsTable .= "<table class=\"table table-striped studentsList\">";
    $studentsTable .= "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Class</th><th>Together</th><th>Separate</th></tr>";
    while($row = $result->fetch_assoc()) {
        $studentsTable .= "<tr>";
        $studentsTable .= "<td>".$row["studentID"]."</td>";
        $studentsTable .= "<td>".$row["FirstName"]."</td>";
        $studentsTable .= "<td>".$row["LastName"]."</td>";
        $studentsTable .= "<td>".$row["Gender"]."</td>";
        $studentsTable .= "<td>".$row["Class"]."</td>";
        $studentsTable .= "<td>".$row["Together"]."</td>";
        $studentsTable .= "<td>".$row["Separate"]."</td>";
        $studentsTable .= "</tr>";
    }
    $studentsTable .= "</table>";
    echo $studentsTable;
}
else {
    echo "0 results";
}
$conn->close();
?>

<?php
require "footer.php";
?>