<?php
/**
 * Created by PhpStorm.
 * User: aline
 * Date: 2016-11-05
 * Time: 6:04 PM
 */

require "../includes/databaseConnection.php";

if(isset($_POST['generateChart']))
{
    //generate the class layout: empty 2-dimensional array
    $classLayout = generateClassLayout();
    //1-dimensional array with all the students in the selected class
    $classroomNoGender = getStudents();

    //check if number of students and number of seats are compatible
    if(sizeof($classroomNoGender) > (sizeof($classLayout) * sizeof($classLayout[0]))){
        echo "Class ".$classroomNoGender[0]['Class']." has ".sizeof($classroomNoGender)." students and the chosen
        classroom only has ".(sizeof($classLayout)*sizeof($classLayout[0]))." seats. Please choose another layout.";

        //sleep(3); //stops execution for 3 seconds

        exit; //stops execution of the program
    }

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
                    $classroomByLastNameIndex = 0;
                    //Populate the empty $classLayout array with the students
                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout)-1; $row >= 0; $row--){
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

                /* ARRANGE BY ASCENDING ORDER OF THE STUDENT ID AND HORIZONTALLY*/
                else if ($order == "byidHorizontal") {
                    //sort students in a 1-dimensional array by ascending order of student ids
                    $classroomById = sortByStudentId($classroomNoGender);

                    $classroomByIdIndex = 0;
                    //Populate the empty $classLayout array with the students
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            $classLayout[$row][$col] = $classroomById[$classroomByIdIndex];
                            $classroomByIdIndex++;
                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["UserID"]." ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }

                }

                /* ARRANGE BY ASCENDING ORDER OF THE STUDENT ID AND VERTICALLY*/
                else if ($order == "byidVertical") {
                    //sort students in a 1-dimensional array by ascending order of student ids
                    $classroomById = sortByStudentId($classroomNoGender);

                    $classroomByIdIndex = 0;
                    //Populate the empty $classLayout array with the students
                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                            $classLayout[$row][$col] = $classroomById[$classroomByIdIndex];
                            $classroomByIdIndex++;
                        }
                    }

                    //show result
                    for($i = 0; $i < sizeof($classLayout); $i++){
                        for($j = 0; $j < sizeof($classLayout[0]); $j++){
                            $curStudent = $classLayout[$i][$j];
                            echo $curStudent["UserID"]." ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
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
                    $boysByLastName = sortAlphabetically($genderSorted[0]);
                    $girlsByLastName = sortAlphabetically($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout) - 1; $row >= 0; $row--){
                            if($col % 2 == 0){
                                $classLayout[$row][$col] = $girlsByLastName[$girlsArrayIndex];
                                $girlsArrayIndex++;
                            }
                            else {
                                $classLayout[$row][$col] = $boysByLastName[$boysArrayIndex];
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
                            echo $curStudent["UserID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "byidVertical"){
                    $boysById = sortByStudentId($genderSorted[0]);
                    $girlsById = sortByStudentId($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout) - 1; $row >= 0; $row--){
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
                            echo $curStudent["UserID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }

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
                    $boysByLastName = sortAlphabetically($genderSorted[0]);
                    $girlsByLastName = sortAlphabetically($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout) - 1; $row >= 0; $row--){
                            if($col % 2 == 0){
                                $classLayout[$row][$col] = $boysByLastName[$boysArrayIndex];
                                $boysArrayIndex++;
                            }
                            else {
                                $classLayout[$row][$col] = $girlsByLastName[$girlsArrayIndex];
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
                            echo $curStudent["UserID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "byidVertical"){
                    $classroomById = sortByStudentId($classroomNoGender);

                    $boysById = sortByStudentId($genderSorted[0]);
                    $girlsById = sortByStudentId($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    //Populate the empty $classLayout array with the students
                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout) - 1; $row >= 0; $row--){
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
                            echo $curStudent["UserID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
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
                    $boysAlphabetically = sortAlphabetically($genderSorted[0]);
                    $girlsAlphabetically = sortAlphabetically($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    $counter = 0;
                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout)-1; $row >= 0; $row--){
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
                else if($order == "byidHorizontal"){
                    $boysById = sortByStudentId($genderSorted[0]);
                    $girlsById = sortByStudentId($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    $counter = 0;
                    for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                        for($col = 0; $col < sizeof($classLayout[0]); $col++){
                            if($counter % 2 == 0){
                                $classLayout[$row][$col] = $boysById[$boysArrayIndex];
                                $boysArrayIndex++;
                                $counter++;
                            }
                            else {
                                $classLayout[$row][$col] = $girlsById[$girlsArrayIndex];
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
                            echo $curStudent["UserID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
                }
                else if($order == "byidVertical"){
                    $boysById = sortByStudentId($genderSorted[0]);
                    $girlsById = sortByStudentId($genderSorted[1]);

                    $girlsArrayIndex = 0;
                    $boysArrayIndex = 0;

                    $counter = 0;

                    for($col = 0; $col < sizeof($classLayout[0]); $col++){
                        for($row = sizeof($classLayout)-1; $row >= 0; $row--){
                            if($counter % 2 == 0){
                                $classLayout[$row][$col] = $boysById[$boysArrayIndex];
                                $boysArrayIndex++;
                                $counter++;
                            }
                            else {
                                $classLayout[$row][$col] = $girlsById[$girlsArrayIndex];
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
                            echo $curStudent["UserID"]."(".$curStudent["Gender"].") ";
                            if($j == sizeof($classLayout[0]) - 1)
                                echo "<br>";
                        }
                    }
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

    global $conn;

    $getClassroom = "SELECT RoomID FROM Class WHERE ClassID = '".$_POST['class']."'";

    $classroom = $conn->query($getClassroom);

    if($classroom->num_rows){
        while($row = $classroom->fetch_assoc()){
            $roomNumber = $row['RoomID'];
        }
    }

    $getRowsAndCols = "SELECT NumRows, NumCols FROM Room WHERE RoomID = '".$roomNumber."'";

    $rowsAndCols = $conn->query($getRowsAndCols);

    if($rowsAndCols->num_rows){
        while($row = $rowsAndCols->fetch_assoc()){
            $rows = $row["NumRows"];
            $cols = $row["NumCols"];
        }
    }

    //if statements to check which classroom layout was chosen
//    if($_POST['layout'] == "fivesix") {
//        $rows = 6;
//        $cols = 5;
//    }
//    elseif ($_POST['layout'] == "fiveseven")
//    {
//        $rows = 7;
//        $cols = 5;
//    }
//    elseif ($_POST['layout'] == "fiveeight")
//    {
//        $rows =  8;
//        $cols =  5;
//    }
//    elseif ($_POST['layout'] == "sixfive")
//    {
//        $rows =  5;
//        $cols =  6;
//    }
//    elseif ($_POST['layout'] == "sixsix")
//    {
//        $rows =  6;
//        $cols =  6;
//    }
//    elseif ($_POST['layout'] == "sixseven")
//    {
//        $rows =  7;
//        $cols =  6;
//    }
//    elseif ($_POST['layout'] == "threesix")
//    {
//        $rows =  6;
//        $cols =  2;
//    }
//    elseif ($_POST['layout'] == "fourfour")
//    {
//        $rows =  4;
//        $cols =  8;
//    }
//    elseif ($_POST['layout'] == "fourfive")
//    {
//        $rows =  5;
//        $cols =  8;
//    }
//    elseif ($_POST['layout'] == "single")
//    {
//        if (isset($_POST['selectedColumns']) && (isset($_POST['selectedRows'])))
//        {
//            $rows = $_POST['selectedRows'];
//            $cols = $_POST['selectedColumns'];
//        }
//    }
//    elseif ($_POST['layout'] == "double")
//    {
//        if (isset($_POST['selectedColumns']) && (isset($_POST['selectedRows'])))
//        {
//            $rows = $_POST['selectedRows'];
//            $cols = $_POST['selectedColumns'];
//        }
//    }
    //create a two dimensional array ($rows rows and $columns columns)
    for($i = 0; $i < $rows; $i ++){
            //all the elements of this array are empty strings ""
            $classroomLayout[] = array_fill(0, $cols, "");
    }

    return $classroomLayout;
}

function getStudents(){
    global $conn; //access outer variable
    $selectedClass = $_POST['class'];
    //query to get all rows of the selectedClass
    $classQuery = "SELECT IS_User.UserID, IS_User.FirstName, IS_User.LastName, IS_User.Gender, IS_User_Class.ClassID, IS_User_Class.Separate, IS_User_Class.Together 
            FROM IS_User_Class 
            INNER JOIN IS_User ON IS_User_Class.UserID = IS_User.UserID WHERE ClassID = '".$selectedClass."';";
    //run query

    //echo $classQuery;
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
    return strcmp($a[UserID], $b[UserID]);
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