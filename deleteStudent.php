<?php
/**
 * Created by PhpStorm.
 * User: aline
 * Date: 2016-11-16
 * Time: 10:50 PM
 */
require 'databaseConnection.php';

if(isset($_POST['checkbox'])){
    $studentsToDelete = $_POST['checkbox'];
    for($i = 0; $i < sizeof($studentsToDelete); $i++){
        $deleteData = "DELETE FROM IS_User WHERE UserID = '".$studentsToDelete[$i]."'";
        $result = $conn->query($deleteData);
        header("Location: studentslist.php");
    }
}