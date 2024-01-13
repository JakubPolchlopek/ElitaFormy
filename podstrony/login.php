<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="./Grafiki/favicon2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,700&family=Montserrat:ital,wght@0,400;1,300&family=Quicksand&family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <title>Zaloguj się</title>
</head>
<body>
    <header>
         <a href="../index.php" class="logo"><img src="../images/logo.png" alt="logo" class="logo"></a>
        <ul>
            <li><a href="indeksCwiczen.php">Indeks Ćwiczeń</a></li>
            <li><a href="suplementacja.php">Suplementy</a></li>
            <li><a href="onas.php">O nas</a></li>
            <div class="listaLogowania">
                <span>Logowanie</span>
                <div class="listaLogowania-zawartosc">
                    <a href="login.php">Zaloguj</a>
                    <a href="registertion.php">Zarejestruj</a>
                </div>
            </div>
        </ul>
    </header>
    <main>
<section class="PulpitZaloguj">
<div class="ZalogujLewa">
<h1>Zaloguj się</h1><br>

<form action="" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Zaloguj się">
  </form>
  <?php
        require_once('../phpFiles/conn.php');
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $loginSql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($loginSql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user && password_verify($password, $user['password'])){
                echo "Logowanie udane";
                session_start();
                $_SESSION['user'] = $user;
                header("Location: ../index.php");
            }
            else {
                echo "<p class='error'>Błędny email lub hasło</p>";
            }
        }
    ?>
</div>

<div class="ZalogujPrawa">
    <form>
<h1>Jesteś nowy?</h1><br>
<p>Zarejestruj się i ćwicz razem z nami, wspolnie zbudujmy elitarna formę!</p><br>
<button><a href="registertion.php">Zarejestruj się</a></button>
    </form>
</div>
</section >

    </main>
    <footer>&copy;Paweł Rola & Jakub Półchłopek 2023</footer>
    
</body>
</html>



