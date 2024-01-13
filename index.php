<?php
    session_start();
?>  

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="./Grafiki/favicon2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,700&family=Montserrat:ital,wght@0,400;1,300&family=Quicksand&family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <title>ElitaFormy - z nami zbudujesz elitarna formę</title>
</head>
<body>
    <div class="page-loader"></div>
    <header>
        <a href="index.php" class="logo"><img src="./images/logo.png" alt="logo" class="logo"></a>
        <ul>
            <li><a href="./podstrony/indeksCwiczen.php">Indeks Ćwiczeń</a></li>
            <li><a href="./podstrony/suplementacja.php">Suplementy</a></li>
            <li><a href="./podstrony/oNas.php">O nas</a></li>
            <?php
                if (!isset($_SESSION['user'])){
                    echo '<div class="listaLogowania">';
                    echo '<span>Logowanie</span>';
                    echo '<div class="listaLogowania-zawartosc">';
                    echo '<a href="./podstrony/login.php">Zaloguj</a>';
                    echo '<a href="./podstrony/registertion.php">Zarejestruj</a>';
                    echo '</div>';
                    echo '</div>';
                }
                else {
                    echo "<li><a href='podstrony/addWorkout.php'>Dodaj trening</a></li>";
                    echo "<li><a href='podstrony/profile.php'>".$_SESSION['user']['name']."</a></li>";
                }
            ?>
        </ul>
    </header>
    <main>
        <section class="pulpitGlowna">
        <div class="glownaLewo">
        <h1 class="random-text"></h1>
        <h4>Jesteśmy nową platformą online skoncentrowaną na dostarczaniu wsparcia dla fanatyków siłowni. Nasza inicjatywa opiera się na doświadczeniu, które aktywnie staramy sie wykorzystywać. Działamy z myślą o wszystkich - zarówno tych rozpoczynających swoją przygodę z siłownią, jak i tych, którzy już tak jak my posiadają pewne doświadczenie na siłowni.</h4>
        </div>

        </div>
        </section>
    </main>
    <footer>
        <p>&copy;Paweł Rola & Jakub Półchłopek 2023</p>
    </footer>
    <script src="jsFiles/main.js"></script>
</body>
</html>