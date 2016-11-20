<?php

$title = "iSeater - Students";
require "includes/databaseConnection.php";
require "includes/head.php";
?>
    <body>
    <?php require "includes/menu.php"; ?>
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
                //show and hide the column to remove students
                //when the user clicks on the remove student button, the column appears
                //when they click it again, the column is hidden
                $(".checkboxColumn").toggle();
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
$selectData = "SELECT IS_User.UserID, IS_User.FirstName, IS_User.LastName, IS_User.Gender, IS_User_Class.ClassID, IS_User_Class.Separate, IS_User_Class.Together FROM IS_User_Class INNER JOIN IS_User ON IS_User_Class.UserID = IS_User.UserID";
$result = $conn->query($selectData);

$studentsTable = "";
if ($result->num_rows > 0) {
    //output data of each row
    $studentsTable .= "<form id = 'deleteStudent' action = 'phpProcessing/deleteStudent.php' method = 'post'><table class = 'table table-striped studentsList sortable'>";
    $studentsTable .= "<tr>
                <th style = 'display: none;' class = 'checkboxColumn'>
                    <span onclick = \"document.getElementById('deleteStudent').submit();\" class = 'glyphicon glyphicon-trash'></span>
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
        $studentsTable .= "<td style = 'display: none;' class = 'checkboxColumn'><input type = 'checkbox' name = 'checkbox[]' value = '".$row["UserID"]."'</td>";
        $studentsTable .= "<td>".$row["UserID"]."</td>";
        $studentsTable .= "<td>".$row["FirstName"]."</td>";
        $studentsTable .= "<td>".$row["LastName"]."</td>";
        $studentsTable .= "<td>".$row["Gender"]."</td>";
        $studentsTable .= "<td>".$row["ClassID"]."</td>";
        //if you have any existing conditions, show them
        //otherwise, show the add button
        if(isset($row["Together"]))
            $studentsTable .= "<td>".$row["Together"]."</td>";
        else
            $studentsTable .= "<td class = 'addRestriction'><span class = \"glyphicon glyphicon-plus-sign\"></span></td>";
        if(isset($row["Separate"]))
            $studentsTable .= "<td>".$row["Separate"]."</td>";
        else
            $studentsTable .= "<td class = 'addRestriction'><span class = \"glyphicon glyphicon-plus-sign\"></span></td>";
        $studentsTable .= "</tr>";
    }
    $studentsTable .= "</table></form>";
    echo $studentsTable;
}
else {
    echo "0 results";
}
?>
    </body>
<?php
require "includes/footer.php";


//form processing
if(isset($_POST['addStudentSubmit']))
{
    //query to add values into the Student table
    $addStudent = "INSERT INTO IS_User (UserID, FirstName, LastName, Gender, Role) VALUES (".$_POST['studentid'].",'".$_POST['firstName']."','".$_POST['lastName']."','".$_POST['gender']."','Student');";
    $addStudentClass = "INSERT INTO IS_User_Class(UserID, ClassID) VALUES (".$_POST['studentid'].", '".$_POST['class']."');";

    echo $addStudentClass;
    echo $addStudent;
    //run query
    $conn->query($addStudent);
    $conn->query($addStudentClass);

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