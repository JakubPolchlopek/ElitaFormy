<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elita formy</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .hidden {
        display: none;
    }

    .trainingBox {
        text-align: center;
        margin-top: 20px;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        margin: 5px;
        border-radius: 20px;
        border: none;
        -webkit-box-shadow: 8px 8px 24px 0px rgba(0, 0, 0, 1);
        -moz-box-shadow: 8px 8px 24px 0px rgba(0, 0, 0, 1);
        box-shadow: 8px 8px 24px 0px rgba(0, 0, 0, 1);
    }

    input {
        padding: 8px;
        margin: 5px;
    }

    .exerciseList {
        margin-top: 10px;
    }

    .trainingPreview {
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <main>
        <button class="startTraining">Rozpocznij trening</button>

        <div class="trainingBox hidden">
            <button class="addExerciseBtn">Dodaj ćwiczenie</button>
            <button class="resetBtn"><i class="fa-solid fa-arrows-rotate"></i></button>
            <div class="exerciseList"></div>
            <div class="trainingPreview"></div>
            <button class="saveTrainingBtn"><i class="fa-solid fa-bookmark"></i></button>
        </div>
    </main>
    <script src="./../jsFiles/setWorkout.js"></script>
</body>
</html>