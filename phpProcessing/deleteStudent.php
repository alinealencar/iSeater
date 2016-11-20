<?php
/**
 * Created by PhpStorm.
 * User: aline
 * Date: 2016-11-16
 * Time: 10:50 PM
 */
require '../includes/databaseConnection.php';

if(isset($_POST['checkbox'])){
    $studentsToDelete = $_POST['checkbox'];
    for($i = 0; $i < sizeof($studentsToDelete); $i++){
        $deleteFromUser_Class = "DELETE FROM IS_User_Class WHERE UserID = ".$studentsToDelete[$i].";";
        $result = $conn->query($deleteFromUser_Class);

        $deleteFromIs_User = "DELETE FROM IS_User WHERE UserID = ".$studentsToDelete[$i].";";
        $result = $conn->query($deleteFromIs_User);

    }
}
header("Location: ../studentslist.php");