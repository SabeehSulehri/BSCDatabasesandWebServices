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
    // Retrieve beginner workout information from the form
    $SafetyTips = isset($_POST["SafetyTips"]) ? $_POST["SafetyTips"] : null;
    $CoachSupervision = isset($_POST["CoachSupervision"]) ? $_POST["CoachSupervision"] : null;
    $Instructions = isset($_POST["Instructions"]) ? $_POST["Instructions"] : null;
    $WorkoutID = isset($_POST["WorkoutID"]) ? $_POST["WorkoutID"] : null;

    // Check if required fields are not empty
    if (!empty($SafetyTips) && !empty($CoachSupervision) && !empty($Instructions) && !empty($WorkoutID)) {
        // Construct the SQL query to insert beginner workout information
        $beginnerQuery = "INSERT INTO Beginner (SafetyTips, CoachSupervision, Instructions, WorkoutID) VALUES (?, ?, ?, ?)";

        $beginnerStmt = $mysqli->prepare($beginnerQuery);

        if ($beginnerStmt === false) {
            echo "Beginner Workout Preparation Error: " . $mysqli->error;
        } else {
            $beginnerStmt->bind_param("sssi", $SafetyTips, $CoachSupervision, $Instructions, $WorkoutID);

            if ($beginnerStmt->execute()) {
                echo "Successful Insertion!";
            } else {
                echo "Beginner Workout Insertion Error: " . $beginnerStmt->error;
            }

            $beginnerStmt->close();
        }
    } else {
        echo "Beginner Workout Insertion Error: Required fields cannot be empty.";
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
