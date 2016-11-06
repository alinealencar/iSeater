<?php
/**
 * Created by PhpStorm.
 * User: aline
 * Date: 2016-11-05
 * Time: 6:04 PM
 */
require "databaseConnection.php";

if(isset($_POST['generateChart']))
{
    //generate the class layout: 2-dimensional array
    $classLayout = generateClassLayout();

    if(isset($_POST['gender'])){
        $genderPattern = $_POST['gender'];
        if($genderPattern == "nogender"){
            if(isset($_POST['order'])) {
                $order = $_POST['order'];
                if ($order == "alphabeticalHorizontal") {
                }
                else if ($order == "alphabeticalVertical") {
                }
                else if ($order == "byidHorizontal") {

                }
                else if ($order == "byidVertical") {

                }
                else if ($order == "random") {
                    //shuffleArray($classroom);
                }
            }
        }
        else if($genderPattern == "girlsboys"){
            $genderSorted = separateByGender();

            if(isset($_POST['order'])){
                $order = $_POST['order'];
                if($order == "alphabeticalHorizontal"){
                }
                else if($order == "alphabeticalVertical"){
                }
                else if($order == "byidHorizontal"){

                }
                else if($order == "byidVertical"){

                }
                else if($order == "random"){
                    //shuffle the students around the array to make sure the result is going to be truly random
                    shuffle($classLayout);
                    //girls are going to be on the even columns and boys on the odd ones
                    $boysArrayIndex = 0;
                    $girlsArrayIndex = 0;
                    for($rows = 0; $rows < sizeof($classLayout); $rows++){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($col % 2 == 0){
                                $classLayout[$rows][$col] = $genderSorted[1][$girlsArrayIndex];
                                $girlsArrayIndex++;
                            }
                            else {
                                $classLayout[$rows][$col] = $genderSorted[0][$boysArrayIndex];
                                $boysArrayIndex++;
                            }
                        }
                    }

                    //$classLayout is an array rowsxcolumns ordered randomly with the girls-boys pattern

                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["Gender"];
                            //onde quebrar?
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
            }


        }
        else if($genderPattern == "boysgirls"){

        }
        else if($genderPattern == "alternated"){

        }
    }
}


function shuffleArray($array)
{
    $studentsList = [];
    for ($row = 0; $row < sizeof($array); $row++) {
        for ($column = 0; $column < sizeof($array[0]); $column++) {
            $studentsList[] = $array[$row][$column];
        }
    }

    shuffle($studentsList);
    $i = 0;
    for ($row = 0; $row < sizeof($array); $row++) {
        for ($column = 0; $column < sizeof($array[0]); $column++) {
            $array[$row][$column] = $studentsList[$k];
            $i++;
        }
    }
}

function separateByGender(){
    global $conn; //access outer variable
    $selectedClass = $_POST['class'];
    $classQuery = "SELECT Gender FROM Student WHERE Class = '$selectedClass'";
    $class = $conn->query($classQuery);

    $girls = [];
    $boys = [];

    if($class->num_rows > 0){
        while($row = $class->fetch_assoc()){
            if(strtoupper($row['Gender']) == "M"){
                $boys[] = $row;
            }
            else if(strtoupper($row['Gender']) == "F"){
                $girls[] = $row;
            }
        }
    }

    $genderSortedClass = [$boys, $girls];

    return $genderSortedClass;
}

//add the students from a class into the layout of the classroom
function generateClassLayout(){
    $classroomLayout = [];
    if($_POST['layout'] == "fivesix") {
        $rows = 6;
        $columns = 5;
    }

    //create a two dimensional array ($rows rows and $columns columns)
    for($i = 0; $i < $rows; $i ++){
            //all the elements of this array are empty strings ""
            $classroomLayout[] = array_fill(0, $columns, "1");
    }

    return $classroomLayout;
}
