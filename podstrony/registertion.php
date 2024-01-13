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
    <title>Zarejestruj się</title>
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
                    <a href="./login.php">Zaloguj</a>
                    <a href="./registertion.php">Zarejestruj</a>
                </div>
            </div>
        </ul>
    </header>
    <main>
<section class="PulpitZarejestruj">
<div class="ZarejestrujLewa">
<h1>Zarejestruj się</h1><br>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <label for="firstname">Imię: </label>
            <input type="text" name="firstname" id="firstname"required>
        </div>

        <div class="input-group">
            <label for="lastname">Nazwisko: </label>
            <input type="text" name="lastname" id="lastname" required>
        </div>

        <div class="input-group">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="input-group">
            <label for="password">Hasło: </label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="input-group">
            <label for="weight">Waga: </label>
            <input type="number" name="weight" id="weight" oninput = "isNumber(this)">
        </div>
        
        <div class="input-group">
            <label for="height">Wzorst: </label>
            <input type="number" name="height" id="height" oninput = "isNumber(this)">
        </div>
        
        <div class="input-group">
            <label for="phone">Numer telefonu: </label>
            <input type="text" id="phone" name="phone"  required />
            <!-- pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" -->
        </div>

        <div class="input-group">
            <label for="birthYear">Rok urodzenia: </label>
            <input type="number" name="birthYear" id="birthYear" required oninput = "isNumber(this)">
        </div>

        <div class="input-group">
            <label for="birthMonth">Miesiąc urodzenia: </label>
            <input type="number" name="birthMonth" id="birthMonth" required oninput = "isNumber(this)">
        </div>

        <div class="input-group">
            <label for="birthDay">Dzień urodzenia: </label>
            <input type="number" name="birthDay" id="birthDay" required oninput = "isNumber(this)">
        </div>
        
        <div class="input-group">
            <label for="newsletter">Chcę zapisać się do newslettera: </label>
            <input type="checkbox" name="newsletter" id="newsletter">
        </div>
        <div class="input-group">
            <label for="photo">Zdjęcie profilowe: </label>
            <input type="file" name="photo" id="photo" accept="image/*">
        </div>
        

        <input type="submit" value="Zarejetruj">
    </form>
    </div>

<div class="ZarejestrujPrawa">
    <form>
<h1>Masz już swoje konto?</h1>
<p>Zaloguj się klikając przycisk poniżej ⬇</p><br>
<h4>Cieszymy się, ze jesteś z nami!!!</h4 > <br>
<button><a href="./login.php">Zaloguj się</a></button>
    </form>
</div>
</section >


    </main>
    <footer>&copy;Paweł Rola & Jakub Półchłopek 2023</footer>
    <script src="jsFiles/formValidator.js"></script>
</body>
</html>

<?php
require_once '../phpFiles/conn.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $userExist = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($userExist);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $isExist = $stmt->fetch(PDO::FETCH_ASSOC);
    if($isExist > 0){
        echo "Użytkownik o tym mailu już istenieje!";
        header("Location: registertion.php");
    }
    else {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
    
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        $weight = $_POST['weight'];
        $height = $_POST['height'];
    
        if($height > 3) $height = $height / 100;
    
        $phoneNum = $_POST['phone'];
    
        $birthDate = new DateTime("{$_POST['birthYear']}-{$_POST['birthMonth']}-{$_POST['birthDay']}");
        $formattedBirthDate = $birthDate->format("Y-m-d");
    
        $joinDate = date("Y-m-d");    
    
        $BMI = null;
        if (isset($height) && isset($weight)) {
            $BMI = $weight / ($height * $height);
        }
    
        $newsletter = isset($_POST['newsletter']) ? 1 : 0;
    
        

        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $image = $_FILES["photo"]["tmp_name"];
            $imgContent = file_get_contents($image);
        
            $registerSql = "INSERT INTO users (name, surname, email, password, weight, height, BMI, join_date, birth_date, phone_number, newsletter, profileImage) 
                VALUES (:firstname, :lastname, :email, :hashedPassword, :weight, :height, :BMI, :joinDate, :birthDate, :phoneNum, :newsletter, :imgContent)";
        }
        else {
            $registerSql = "INSERT INTO users (name, surname, email, password, weight, height, BMI, join_date, birth_date, phone_number, newsletter) 
                VALUES (:firstname, :lastname, :email, :hashedPassword, :weight, :height, :BMI, :joinDate, :birthDate, :phoneNum, :newsletter)";
        }
        
        $stmt = $conn->prepare($registerSql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindValue(':hashedPassword', $hashedPassword);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindValue(':BMI', $BMI);
        $stmt->bindParam(':phoneNum', $phoneNum);
        $stmt->bindParam(':birthDate', $formattedBirthDate);
        $stmt->bindParam(':joinDate', $joinDate);
        $stmt->bindParam(':newsletter', $newsletter);
        $stmt->bindParam(':imgContent', $imgContent);
        try {
            $stmt->execute();
        }
        catch(PDOException $e){
            echo "Błąd podczas rejestracji: " . $e->getMessage();
        }
    }    
}
?>