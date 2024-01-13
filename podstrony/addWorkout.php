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
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>
        <a href="../index.php" class="logo"><img src="../images/logo.png" alt="logo" class="logo"></a>
        <ul>
            <li><a href="indeksCwiczen.php">Indeks Ćwiczeń</a></li>
            <li><a href="suplementacja.php">Suplementy</a></li>
            <li><a href="oNas.php">O nas</a></li>
            <?php
                echo "<li><a href='addWorkout.php'>Dodaj trening</a></li>";
                echo "<li><a href='profile.php'>".$_SESSION['user']['name']."</a></li>";
            ?>
        </ul>
    </header>
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
    <footer>
        <p>&copy;Paweł Rola & Jakub Półchłopek 2023</p>
    </footer>
    <script src="./../jsFiles/setWorkout.js"></script>
</body>
</html>