<?php

$title = "iSeater - Students";
require "databaseConnection.php";
require "head.php";
?>
    <body>
    <?php require "menu.php"; ?>
        <script>
            function showForm(elementId) {
                //hide all the forms
                //document.getElementById("addStudent").style.display = "none";
                //document.getElementById("removeStudent").style.display = "none";
                //document.getElementById("addRestriction").style.display = "none";
                //document.getElementById("removeRestriction").style.display = "none";
                //show the selected form
                //document.getElementById(elementId).style.display = "block";
                $(".addRemoveForm").toggle();
            };

            function removeStudent() {
                $(".glyphicon-trash").toggle();

            }
        </script>
        <br>
        <div class = "studentsListButtons">
            <button onclick = "showForm('addStudent')" type="button" class="btn btn-success">Add Student</button>
            <button onclick = "removeStudent()" type="button" class="btn btn-danger">Remove Student</button>
            <!--button onclick = "" type="button" class="btn btn-info">Add Restriction</button-->
            <!--button onclick = "" type="button" class="btn btn-warning">Remove Restriction</button-->
        </div>
        <br>
        <div class = "addRemoveForm" id = "addStudent" style = "display: none">
            <form action = "studentslist.php" method = "post">
                <p>Add Student</p>
                <label>Student ID:&nbsp;</label><input type = "text" name = "studentid" required>
                <br>
                <label>First Name:&nbsp;</label><input type = "text" name = "firstName" required>
                <br>
                <label>Last Name:&nbsp;</label><input type = "text" name = "lastName" required>
                <br>
                <label>Gender:&nbsp;</label><input type = "text" name = "gender" required>
                <br>
                <label>Class:&nbsp;</label><input type = "text" name = "class" required>
                <br><br>
                <input name = "addStudentSubmit" type = "submit" value = "Add Student">
            </form>
        </div>
        <!--div class = "addRemoveForm" id = "removeStudent" style = "display: none">
            <form method = "post">
                <p>Remove Student</p>
                <label>Student ID:&nbsp;</label><input type = "text" name = "studentid">
                <br><br>
                <input name = "removeStudentSubmit" type = "submit" value = "Remove Student">
            </form>
        </div>
        <div class = "addRemoveForm" id = "addRestriction" style = "display: none">
            <form method = "post">
                <p>Add Restriction</p>
                <input type = "radio" name = "restrictionType" value = "together">&nbsp;Together</input>
                &nbsp;
                <input type = "radio" name = "restrictionType" value = "separate">&nbsp;Separate</input>
                <br><br>
                <label>First Student ID:&nbsp;</label><input type = "text" name = "student1" required>
                <br>
                <label>Second Student ID:&nbsp;</label><input type = "text" name = "student2" required>
                <br><br>
                <input name = "addRestrictionSubmit" type = "submit" value = "Add Restriction">
            </form>
        </div>
        <div class = "addRemoveForm" id = "removeRestriction" style = "display: none">
            <form method = "post">
                <p>Remove Restriction</p>
                <input type = "radio" name = "restrictionType" value = "together">&nbsp;Together</input>
                &nbsp;
                <input type = "radio" name = "restrictionType" value = "separate">&nbsp;Separate</input>
                <br><br>
                <label>Student ID:&nbsp;</label><input type = "text" name = "studentid" required>
                <br><br>
                <input name = "removeRestrictionSubmit" type = "submit" value = "Remove Restriction">
            </form>
        </div-->
        <br><br>

<?php
$selectData = "SELECT UserID, FirstName, LastName, Gender, Class, Together, Separate FROM IS_User";
$result = $conn->query($selectData);
var_dump($selectData);
$studentsTable = "";
if ($result->num_rows > 0) {
    //output data of each row
    $studentsTable .= "<table class=\"table table-striped studentsList sortable\">";
    $studentsTable .= "<tr>
                <th class = \"checkboxColumn\">
                    <span style = \"display: none; color: red;\" class = \"glyphicon glyphicon-trash\"></span>
                </th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Together</th>
                <th>Separate</th>
                </tr>";
    while($row = $result->fetch_assoc()) {
        $studentsTable .= "<tr>";
        $studentsTable .= "<td class = \"checkboxColumn\"><input type = \"checkbox\" name = \"checkbox\"</td>";
        $studentsTable .= "<td>".$row["UserID"]."</td>";
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
?>
    </body>
<?php
require "footer.php";


//form processing
if(isset($_POST['addStudentSubmit']))
{
    //query to add values into the Student table
    $addStudent = "INSERT INTO IS_USER (UserID, FirstName, LastName, Gender, Class) VALUES ('".$_POST['studentid']."','".$_POST['firstName']."','".$_POST['lastName']."','".$_POST['gender']."','".$_POST['class']."')";
    //run query
    $conn->query($addStudent);
}
/*if(isset($_POST['removeStudentSubmit']))
{
    //remove student from the Student table by using the student id
    $removeStudent = "DELETE FROM Student WHERE studentID = '".$_POST['studentid']."'";
    //run query
    $conn->query($removeStudent);
}
if(isset($_POST['addRestrictionSubmit']))
{
    //get a string with the restriction type from the radio button
    $restrictionType = $_POST['restrictionType'];
    //add first restriction
    $addRestriction1 = "UPDATE Student SET ".$restrictionType." = '".$_POST['student1']."' WHERE studentid = '".$_POST['student2']."'";
    //add second restriction
    $addRestriction2 = "UPDATE Student SET ".$restrictionType." = '".$_POST['student2']."' WHERE studentid = '".$_POST['student1']."'";
    //run queries
    $conn->query($addRestriction1);
    $conn->query($addRestriction2);
}
if(isset($_POST['removeRestrictionSubmit']))
{
    //get the restriction type (together or separate)
    $restrictionType = $_POST['restrictionType'];
    //select the studentid column of the student with the [restriction type] equal to the input of the user
    $otherStudentQuery = "SELECT studentid FROM Student WHERE ".$restrictionType." = '".$_POST['studentid']."'";
    //run query and save object into the variable $otherStudent
    $otherStudent = $conn->query($otherStudentQuery);
    //read the object and save it into $student2
    $student2 = $otherStudent->fetch_assoc();
    //query to set the Together column of the entered student to null
    $removeRestriction1 = "UPDATE Student SET ".$restrictionType." = null WHERE studentid = '".$_POST['studentid']."'";
    //query to set the Together column of the student that is on the [restriction type] column of the student entered to null
    //$student2['studentid'] will hold a student id
    $removeRestriction2 = "UPDATE Student SET ".$restrictionType." = null WHERE studentid = '".$student2['studentid']."'";

    //run queries
    $conn->query($removeRestriction1);
    $conn->query($removeRestriction2);
}*/
//close connection
$conn->close();
?>