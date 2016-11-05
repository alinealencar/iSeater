<?php

$title = "iSeater - Students";

require "head.php";
?>
    <body>
    <?php require "menu.php"; ?>
        <script>
            function showForm(elementId) {
                document.getElementById("addStudent").style.display = "none";
                document.getElementById("removeStudent").style.display = "none";
                document.getElementById("addRestriction").style.display = "none";
                document.getElementById("removeRestriction").style.display = "none";
                document.getElementById(elementId).style.display = "block";
            };
        </script>
        <br>
        <div class = "studentsListButtons">
            <button onclick = "showForm('addStudent')" type="button" class="btn btn-success">Add Student</button>
            <button onclick = "showForm('removeStudent')" type="button" class="btn btn-danger">Remove Student</button>
            <button onclick = "showForm('addRestriction')" type="button" class="btn btn-info">Add Restriction</button>
            <button onclick = "showForm('removeRestriction')" type="button" class="btn btn-warning">Remove Restriction</button>
        </div>
        <br>
        <div id = "addStudent" style = "display: none">
            <form method = "post">
                <p>Add Student</p>
                <label>Student ID: </label><input type = "text" name = "studentid" required>
                <br>
                <label>First Name: </label><input type = "text" name = "firstName" required>
                <br>
                <label>Last Name: </label><input type = "text" name = "lastName" required>
                <br>
                <label>Gender: </label><input type = "text" name = "gender" required>
                <br>
                <label>Class: </label><input type = "text" name = "class" required>
                <br>
                <input name = "addStudentSubmit" type = "submit" value = "Add Student">
            </form>
        </div>
        <div id = "removeStudent" style = "display: none">
            <form method = "post">
                <p>Remove Student</p>
                <label>Student ID: </label><input type = "text" name = "studentid">
                <br>
                <input name = "removeStudentSubmit" type = "submit" value = "Remove Student">
            </form>
        </div>
        <div id = "addRestriction" style = "display: none">
            <form method = "post">
                <p>Add Restriction</p>
                <input type = "radio" name = "restrictionType" value = "together">&nbsp;Together</input>
                <input type = "radio" name = "restrictionType" value = "separate">&nbsp;Separate</input>
                <br>
                <label>First Student ID: </label><input type = "text" name = "student1" required>
                <label>Second Student ID: </label><input type = "text" name = "student2" required>
                <br>
                <input name = "addRestrictionSubmit" type = "submit" value = "Add Restriction">
            </form>
        </div>
        <div id = "removeRestriction" style = "display: none">
            <form method = "post">
                <p>Remove Restriction</p>
                <label>First Student ID: </label><input type = "text" name = "student1" required>
                <label>Second Student ID: </label><input type = "text" name = "student2" required>
                <br>
                <input name = "removeRestrictionSubmit" type = "submit" value = "Remove Restriction">
            </form>
        </div>
<?php
$servername = "localhost";
$username = "f6team16_admin";
$password = "georgebrown";
$dbname = "f6team16_iseaterdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

$sql = "SELECT studentID, FirstName, LastName, Gender, Class FROM Student";
$result = $conn->query($sql);

$studentsTable = "";
if ($result->num_rows > 0) {
    //output data of each row
    $studentsTable .= "<table class=\"table table-striped studentsList sortable\">";
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
    </body>
<?php
require "footer.php";
?>