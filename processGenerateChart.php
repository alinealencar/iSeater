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
    //generate the class layout: empty 2-dimensional array
    $classLayout = generateClassLayout();
    //1-dimensional array with all the students in the selected class
    $classroomNoGender = getStudents();


    if(isset($_POST['gender'])){
        $genderPattern = $_POST['gender'];

        /* NO GENDER PATTERN */
        if($genderPattern == "nogender"){
            if(isset($_POST['order'])) {
                $order = $_POST['order'];

                /* ARRANGE ALPHABETICALLY AND HORIZONTALLY*/
                if ($order == "alphabeticalHorizontal") {
                    $classroomByLastName = sortAlphabetically($classroomNoGender);
                    $classroomByLastNameIndex = 0;
                    //Populate the empty $classLayout array with the students
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            $classLayout[$row][$col] = $classroomByLastName[$classroomByLastNameIndex];
                            //echo $classroomByLastName[$classroomByLastNameIndex]['LastName']."<br><hr>";
                            $classroomByLastNameIndex++;

                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["LastName"]." ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }

                /* ARRANGE ALPHABETICALLY AND VERTICALLY*/
                else if ($order == "alphabeticalVertical") {
                    $classroomByLastName = sortAlphabetically($classroomNoGender);
                }

                /* ARRANGE BY ASCENDING ORDER OF THE STUDENT ID AND HORIZONTALLY*/
                else if ($order == "byidHorizontal") {
                    //sort students in a 1-dimensional array by ascending order of student ids
                    $classroomById = sortByStudentId($classroomNoGender);

                    $classroomByIdIndex = 0;
                    //Populate the empty $classLayout array with the students
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            $classLayout[$row][$col] = $classroomById[$classroomByIdIndex];
                            echo $classroomById[$classroomByIdIndex]['StudentID']."<br><hr>";
                            $classroomByIdIndex++;
                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["StudentID"]." ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }

                }

                /* ARRANGE BY ASCENDING ORDER OF THE STUDENT ID AND VERTICALLY*/
                else if ($order == "byidVertical") {
                    $classroomById = sortByStudentId($classroomNoGender);

                }

                /* ARRANGE RANDOMLY */
                else if ($order == "random") {
                    //shuffle all the students
                    shuffle($classroomNoGender);

                    $classroomNoGenderIndex = 0;
                    //add the students to the $classLayout array
                    for($rows = 0; $rows < sizeof($classLayout); $rows++){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                                $classLayout[$rows][$col] = $classroomNoGender[$classroomNoGenderIndex];
                                $classroomNoGenderIndex++;
                        }
                    }
                }
            }
        }

        /* ARRANGE VERTICALLY WITH GIRLS ON THE LEFTMOST COLUMN */
        else if($genderPattern == "girlsboys"){
            //$genderSorted holds 2 arrays: one with girls only and another one with boys only
            $genderSorted = separateByGender($classroomNoGender);

            if(isset($_POST['order'])){
                $order = $_POST['order'];
                /* ALPHABETICALLY AND HORIZONTALLY ARRANGED */
                if($order == "alphabeticalHorizontal"){
                    $boysAlphabetically = sortAlphabetically($genderSorted[0]);
                    $girlsAlphabetically = sortAlphabetically($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($col % 2 == 0){
                                $classLayout[$row][$col] = $girlsAlphabetically[$girlsArrayIndex];
                                $girlsArrayIndex++;
                            }
                            else {
                                $classLayout[$row][$col] = $boysAlphabetically[$boysArrayIndex];
                                $boysArrayIndex++;
                            }
                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["LastName"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "alphabeticalVertical"){

                }
                else if($order == "byidHorizontal"){
                    $boysById = sortByStudentId($genderSorted[0]);
                    $girlsById = sortByStudentId($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($col % 2 == 0){
                                $classLayout[$row][$col] = $girlsById[$girlsArrayIndex];
                                $girlsArrayIndex++;
                            }
                            else {
                                $classLayout[$row][$col] = $boysById[$boysArrayIndex];
                                $boysArrayIndex++;
                            }
                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["StudentID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "byidVertical"){

                }
                else if($order == "random"){
                    //shuffle the students around the array to make sure the result is going to be truly random
                    shuffleArray($genderSorted);
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
                            //echo $curStudent["Gender"];
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
            }
        }

        /* ARRANGE VERTICALLY WITH BOYS ON THE LEFTMOST COLUMN */
        else if($genderPattern == "boysgirls"){
            //$genderSorted holds 2 arrays: one with girls only and another one with boys only
            $genderSorted = separateByGender($classroomNoGender);

            if(isset($_POST['order'])){
                $order = $_POST['order'];
                if($order == "alphabeticalHorizontal"){
                    $boysAlphabetically = sortAlphabetically($genderSorted[0]);
                    $girlsAlphabetically = sortAlphabetically($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($col % 2 == 0){
                                $classLayout[$row][$col] = $boysAlphabetically[$boysArrayIndex];
                                $boysArrayIndex++;
                            }
                            else {
                                $classLayout[$row][$col] = $girlsAlphabetically[$girlsArrayIndex];
                                $girlsArrayIndex++;
                            }
                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["LastName"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "alphabeticalVertical"){
                }
                else if($order == "byidHorizontal"){
                    $boysById = sortByStudentId($genderSorted[0]);
                    $girlsById = sortByStudentId($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($col % 2 == 0){
                                $classLayout[$row][$col] = $boysById[$boysArrayIndex];
                                $boysArrayIndex++;
                            }
                            else {
                                $classLayout[$row][$col] = $girlsById[$girlsArrayIndex];
                                $girlsArrayIndex++;
                            }
                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["StudentID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "byidVertical"){

                }
                else if($order == "random"){
                    //shuffle the students around the array to make sure the result is going to be truly random
                    shuffleArray($genderSorted);
                    //girls are going to be on the odd columns and boys on the even ones
                    $boysArrayIndex = 0;
                    $girlsArrayIndex = 0;
                    for($rows = 0; $rows < sizeof($classLayout); $rows++){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($col % 2 == 0){
                                $classLayout[$rows][$col] = $genderSorted[0][$boysArrayIndex];
                                $boysArrayIndex++;
                            }
                            else {
                                $classLayout[$rows][$col] = $genderSorted[1][$girlsArrayIndex];
                                $girlsArrayIndex++;
                            }
                        }
                    }

                    //$classLayout is an array rowsxcolumns ordered randomly with the boys-girls pattern
                    //show classLayout result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["Gender"];
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
            }

        }

        /* ARRANGE WITH BOYS AND GIRLS IN ALTERNATED ORDER */
        else if($genderPattern == "alternated"){
            $genderSorted = separateByGender($classroomNoGender);

            if(isset($_POST['order'])){
                $order = $_POST['order'];
                if($order == "alphabeticalHorizontal"){
                    $boysAlphabetically = sortAlphabetically($genderSorted[0]);
                    $girlsAlphabetically = sortAlphabetically($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    $counter = 0;
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($counter % 2 == 0){
                                $classLayout[$row][$col] = $boysAlphabetically[$boysArrayIndex];
                                $boysArrayIndex++;
                                $counter++;
                            }
                            else {
                                $classLayout[$row][$col] = $girlsAlphabetically[$girlsArrayIndex];
                                $girlsArrayIndex++;
                                $counter++;
                            }
                        }
                    }

                    //$classLayout is an array rowsxcolumns ordered randomly with the alternated pattern
                    //show classLayout result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["LastName"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "alphabeticalVertical"){
                }
                else if($order == "byidHorizontal"){

                }
                else if($order == "byidVertical"){

                }
                else if($order == "random"){
                    //shuffle the students around the array to make sure the result is going to be truly random
                    shuffleArray($genderSorted);

                    $boysArrayIndex = 0;
                    $girlsArrayIndex = 0;
                    //$counter controls if we're getting a girl or a boy (odd for boys, even for girls)
                    $counter = 0;
                    for($rows = 0; $rows < sizeof($classLayout); $rows++){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($counter % 2 == 0){
                                $classLayout[$rows][$col] = $genderSorted[0][$boysArrayIndex];
                                $girlsArrayIndex++;
                                $counter++;
                            }
                            else {
                                $classLayout[$rows][$col] = $genderSorted[1][$girlsArrayIndex];
                                $boysArrayIndex++;
                                $counter++;
                            }
                        }
                    }

                    //$classLayout is an array rowsxcolumns ordered randomly with the alternated pattern
                    //show classLayout result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["Gender"];
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
            }
        }
    }
}

//function to shuffle 2-dimensional arrays
function shuffleArray($inputArray)
{
    //add all the elements in the 2-dim array into a 1-dim array (a list)
    $studentsList = [];
    for ($row = 0; $row < sizeof($inputArray); $row++) {
        for ($column = 0; $column < sizeof($inputArray[0]); $column++) {
            $studentsList[] = $inputArray[$row][$column];
        }
    }

    //shuffle the list using the built-in shuffle() function
    shuffle($studentsList);

    //add the elements on the list back into a 2-dimensional array format
    $i = 0;
    for ($row = 0; $row < sizeof($inputArray); $row++) {
        for ($column = 0; $column < sizeof($inputArray[0]); $column++) {
            $inputArray[$row][$column] = $studentsList[$i];
            $i++;
        }
    }
}

function separateByGender($inputArray){
    $girls = [];
    $boys = [];

    for($i = 0; $i < sizeof($inputArray); $i++){
        //access the gender column of each object (each row in the student table)
        if(strtoupper($inputArray[$i]['Gender']) == "M"){
            $boys[] = $inputArray[$i];
        }
        else {
            $girls[] = $inputArray[$i];
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
            $classroomLayout[] = array_fill(0, $columns, "");
    }

    return $classroomLayout;
}

function getStudents(){
    global $conn; //access outer variable
    $selectedClass = $_POST['class'];
    $classQuery = "SELECT * FROM Student WHERE Class = '$selectedClass'";
    $class = $conn->query($classQuery);

    $classroom = [];

    if($class->num_rows > 0){
        while($row = $class->fetch_assoc()){
            //add all the students in the selected class into the $classroom array
            $classroom[] = $row;
        }
    }

    return $classroom;
}

//functions to sort an array alphabetically by the Last Name
function compareLastName($a, $b)
{
    return strcmp($a[LastName], $b[LastName]);
}

function compareStudentId($a, $b)
{
    return strcmp($a[StudentID], $b[StudentID]);
}

function sortAlphabetically($inputArray){
    usort($inputArray, "compareLastName");
    return $inputArray;
}

//function to sort an array by the studentid
function sortByStudentId($inputArray){
    usort($inputArray, "compareStudentID");
    return $inputArray;
}