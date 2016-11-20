<?php

$title = "iSeater - Students";
require "includes/databaseConnection.php";
require "includes/head.php";
?>
    <body>
    <?php require "includes/menu.php"; ?>
        <script>
            function showForm() {
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
                <label>Gender:&nbsp;</label><input type = "radio" name = "gender" value = "M">&nbsp;<input type = "radio" name = "gender" value = "F">
                <br>
                <label>Class:&nbsp;</label>
                    <select name = "class" required>

                        <?php
                        //populate this dropdown with the existing classes
                        $selectClasses = "SELECT ClassID FROM Class;";
                        $result = $conn->query($selectClasses);

                        if ($result->num_rows){
                            $optionsStr = "";
                            while($row = $result->fetch_assoc()) {
                                $optionsStr.= "<option value = '".$row["ClassID"]."'>".$row["ClassID"]."</option>";
                            }
                            echo $optionsStr;
                        }
                        ?>

                    </select>
                <br><br>
                <input name = "addStudentSubmit" type = "submit" value = "Add Student">
            </form>
        </div>
        <br><br>

<?php
$selectData = "SELECT IS_User.UserID, IS_User.FirstName, IS_User.LastName, IS_User.Gender, IS_User_Class.ClassID, IS_User_Class.Separate, IS_User_Class.Together FROM IS_User_Class INNER JOIN IS_User ON IS_User_Class.UserID = IS_User.UserID";
$result = $conn->query($selectData);

$studentsTable = "";
if ($result->num_rows) {
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

    //reload the page after adding a student
    header('Location: studentslist.php');

}

//close connection
$conn->close();
?>