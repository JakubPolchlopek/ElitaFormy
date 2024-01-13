<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <section class="profile">
            <div class="foto">
                <?php
                    if ($_SESSION['user']['profileImage']) {
                        $imageData = base64_encode($_SESSION['user']['profileImage']);
                        echo "<img src='data:image/jpeg;base64,{$imageData}' alt='Profilowe'>";
                    } else {
                        echo "<p>Brak zdjęcia profilowego</p>";
                    }
                ?>
                <a href="./editProfile.php"><button class="edycja">Edytuj Profil</button></a>
                <a href="../phpFiles/logout.php"><button class="wyloguj">Wyloguj</button></a>
            </div>
            <div class="biometria">
                <?php
                    if($_SESSION['user']['weight'] != NULL && $_SESSION['user']['height'] != NULL && $_SESSION['user']['BMI'] != NULL){
                        echo "<p>Waga:" . $_SESSION['user']['weight'] . "</p>";
                        echo "<p>Wzrost: " . $_SESSION['user']['height'] . "</p>";
                        echo "<p>BMI: " . $_SESSION['user']['BMI'] . "</p>";
                    }
                    else {
                        echo "<p>Waga: brak danych</p>";
                        echo "<p>Wzrost: brak danych</p>";
                        echo "<p>BMI: brak danych</p>";
                    }
                ?>
            </div>
            <div class="personalne">
                <p>Imię: <?php echo $_SESSION['user']['name']; ?></p>
                <p>Nazwisko: <?php echo $_SESSION['user']['surname']; ?></p>
                <p>Email: <?php echo $_SESSION['user']['email']; ?></p>
                <p>Numer telefonu: <?php echo $_SESSION['user']['phone_number']?></p>
                <p>Data urodzenia: <?php echo $_SESSION['user']['birth_date']; ?></p>
                <p>Data dołączenia: <?php echo $_SESSION['user']['join_date']; ?></p>
            </div>
        

    <!-- <p>Czy wyraziłeś zgodę na newsletter: 
        <?php
            /*if($_SESSION['user']['newsletter'] == 1){
                echo " tak.";
            }
            else if($_SESSION['user']['newsletter'] == 0){
                echo " nie.";
            }*/
        ?>
    </p> -->
    <div class="historia">histroia trenigow</div>
    </section>
    </main>
    <footer>&copy;Paweł Rola & Jakub Półchłopek 2023</footer>
</body>
</html>