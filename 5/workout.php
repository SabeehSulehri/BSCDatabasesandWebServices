<?php
$server = 'localhost';
$username = 'ssulehri';
$mysql_password = 'gHiyGj';
$database = 'Group-29';


$mysqli = new mysqli($server, $username, $mysql_password, $database);

if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve workout information from the form
    $ExerciseCategory = isset($_POST["ExerciseCategory"]) ? $_POST["ExerciseCategory"] : null;
    $ExercisePlan = isset($_POST["ExercisePlan"]) ? $_POST["ExercisePlan"] : null;
    $ExerciseLevel = isset($_POST["ExerciseLevel"]) ? $_POST["ExerciseLevel"] : null;
    $OnlineTutorial = isset($_POST["OnlineTutorial"]) ? $_POST["OnlineTutorial"] : null;

    // Check if required fields are not empty
    if (!empty($ExerciseCategory) && !empty($ExercisePlan) && !empty($ExerciseLevel) && !empty($OnlineTutorial)) {
        // Construct the SQL query to insert workout information
        $workoutQuery = "INSERT INTO Workout (ExerciseCategory, ExercisePlan, ExerciseLevel, OnlineTutorial) VALUES (?, ?, ?, ?)";

        $workoutStmt = $mysqli->prepare($workoutQuery);

        if ($workoutStmt === false) {
            echo "Workout Preparation Error: " . $mysqli->error;
        } else {
            $workoutStmt->bind_param("ssss", $ExerciseCategory, $ExercisePlan, $ExerciseLevel, $OnlineTutorial);

            if ($workoutStmt->execute()) {
                echo "Successful Insertion!";
            } else {
                echo "Workout Insertion Error: " . $workoutStmt->error;
            }

            $workoutStmt->close();
        }
    } else {
        echo "Workout Insertion Error: Required fields cannot be empty.";
    }
}

$mysqli->close();
?>


<!DOCTYPE html>
<html>
    <body>
        <a href="maintenance.html"> Go Back to Maintenance Page </a>
    </body>
</html>
