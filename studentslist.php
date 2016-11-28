<?php

$title = "iSeater - Students";
require "includes".DIRECTORY_SEPARATOR."databaseConnection.php";
require "includes".DIRECTORY_SEPARATOR."head.php";
?>
    <body>
    <?php require "includes".DIRECTORY_SEPARATOR."menu.php"; ?>
        <script>
            function showForm() {
                $(".addRemoveForm").toggle();
            };

            function removeStudent() {
                //show and hide the column to remove students
                //when the user clicks on the remove student button, the column appears
                //when they click it again, the column is hidden
                $(".checkboxColumn").toggle();
            };

            $(function () {
                $('[data-toggle="popover"]').popover()
            });

            $(document).ready(function () {
                $('.ddlFilterTableRow').bind('change', function () {
                    console.log("entrou na funcao");

                    $('.ddlFilterTableRow').attr('disabled', 'disabled');
                    $('#studentsTable').find('.studentRow').hide();

                    var criteriaAttribute = '';

                    $('.ddlFilterTableRow').each(function () {
                        if ($(this).val() != '0') {
                            criteriaAttribute += '[data-classId="' + $(this).val() + '"]';
                        }
                    });

                    $('#studentsTable').find('.studentRow' + criteriaAttribute).show();

                    $('.ddlFilterTableRow').removeAttr('disabled');

                    //console.log(criteriaAttribute);
                });
            });
        </script>
        <br>
        <div class = "studentsListButtons" style="text-align: center;">
            <button onclick = "showForm('addStudent')" type="button" class="btn btn-success">Add Student</button>
            <button onclick = "removeStudent()" type="button" class="btn btn-danger">Remove Student</button>
        </div>
        <br>

        <div class = "addRemoveForm" style = "display: none;">
            <form action = "studentslist.php" method = "post">
                <p>Add Student</p>
                <table>
                    <tr>
                        <td>Student ID: </td>
                        <td><input type = "text" name = "studentid" required></td>
                    </tr>
                    <tr>
                        <td>First Name: </td>
                        <td><input type = "text" name = "firstName" required></td>
                    </tr>
                    <tr>
                        <td>Last Name: </td>
                        <td><input type = "text" name = "lastName" required></td>
                    </tr>
                    <tr>
                        <td>Gender: </td>
                        <td>
                            <input type = "radio" name = "gender" value = "M" required> M
                            <input type = "radio" name = "gender" value = "F"> F
                        </td>
                    </tr>
                    <tr>
                        <td>Class: </td>
                        <td>
                            <select name = "class" required>
                                <option disabled selected value> - </option>
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
                        </td>
                    </tr>
                </table>
                <br>
                <input name = "addStudentSubmit" type = "submit" value = "Add Student">
            </form>
        </div>
        <br><br>
        <select name = "class" class= "ddlFilterTableRow" required data-attribute = "classId">
            <option selected value = "0"> Select All </option>
            <?php
            //populate this drop down with the existing classes
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
<?php
$selectData = "SELECT IS_User.UserID, IS_User.FirstName, IS_User.LastName, IS_User.Gender, IS_User_Class.ClassID FROM IS_User_Class INNER JOIN IS_User ON IS_User_Class.UserID = IS_User.UserID";
$result = $conn->query($selectData);

$studentsTable = "";
if ($result->num_rows) {
    //output data of each row
    $studentsTable .= "<form id = 'deleteStudent' action = 'phpProcessing/deleteStudent.php' method = 'post'><table class = 'table table-striped studentsList sortable' id = 'studentsTable'>";
    $studentsTable .= "<tr>
                <th style = 'display: none;' class = 'checkboxColumn'>
                    <span onclick = \"document.getElementById('deleteStudent').submit();\" class = 'glyphicon glyphicon-trash'></span>
                </th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Class</th> 
                </tr>";
    while($row = $result->fetch_assoc()) {
        $studentsTable .= "<tr class = 'studentRow' data-classId = '".$row["ClassID"]."'>";
        $studentsTable .= "<td style = 'display: none;' class = 'checkboxColumn'><input type = 'checkbox' name = 'checkbox[]' value = '".$row["UserID"]."'</td>";
        $studentsTable .= "<td>".$row["UserID"]."</td>";
        $studentsTable .= "<td>".$row["FirstName"]."</td>";
        $studentsTable .= "<td>".$row["LastName"]."</td>";
        $studentsTable .= "<td>".$row["Gender"]."</td>";
        $studentsTable .= "<td>".$row["ClassID"]."</td>";
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
require "includes".DIRECTORY_SEPARATOR."footer.php";


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
<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>
