<?php
require_once '../phpFiles/conn.php';
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
    <title>Edytuj profil</title>
</head>
<body>
    <header>
        <ul>
            <li><a href="index.php">Strona główna</a></li>
        </ul>
    </header>
    <h1>Edytuj swój profil</h1>
    <form action="" method="post">
        <label for="name">Imie:</label>
        <input type="text" name="name" id="name" value="<?php echo $_SESSION['user']['name']; ?>">
        <label for="surname">Nazwisko: </label>
        <input type="text" name="surname" id="surname" value="<?php echo $_SESSION['user']['surname']; ?>">
        <fieldset>
            <legend>Numer telefonu: </legend>
            <input type="text" name="numFirst" id="numFirst" pattern="[0-9]{3}" maxlength="3" oninput = "isNumber(this)" value="<?php echo substr($_SESSION['user']['phone_number'], 0, 3); ?>">
            <input type="number" name="numSecond" id="numSecond" pattern="[0-9]{3}" maxlength="3" oninput = "isNumber(this)" value="<?php echo substr($_SESSION['user']['phone_number'], 4, 3); ?>">
            <input type="number" name="numThird" id="numThird" pattern="[0-9]{3}" maxlength="3" oninput = "isNumber(this)" value="<?php echo substr($_SESSION['user']['phone_number'], 8, 3); ?>">
        </fieldset>
        <label for="birthDate">Data urodzenia: </label>
        <input type="date" name="birthDate" id="birthDate" value="<?php echo $_SESSION['user']['birth_date']; ?>">

        <label for="weigth">Waga: </label>
        <input type="number" name="weight" id="weight" oninput = "isNumber(this)" value="<?php echo $_SESSION['user']['weight']; ?>">
        <label for="weigth">Wzrost: </label>
        <input type="number" name="height" id="height" oninput = "isNumber(this)" value="<?php echo $_SESSION['user']['height']; ?>">

        <input type="submit" value="Zapisz zmiany">
    </form>
    <script src="jsFiles/formValidator.js"></script>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newName = isset($_POST['name']) ? $_POST['name'] : $_SESSION['user']['name'];
        $newSurname = isset($_POST['surname']) ? $_POST['surname'] : $_SESSION['user']['surname'];
        $newPhoneNum = isset($_POST['numFirst']) && isset($_POST['numSecond']) && isset($_POST['numThird']) ? $_POST['numFirst'] . '-' . $_POST['numSecond'] . '-' . $_POST['numThird'] : $_SESSION['user']['phone_number'];
        $newBirthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : $_SESSION['user']['birth_date'];
        $newWeight = isset($_POST['weight']) ? $_POST['weight'] : $_SESSION['user']['weight'];
        $newHeight = isset($_POST['height']) ? $_POST['height'] : $_SESSION['user']['height'];

        $updateSql = "UPDATE users SET 
            name = :newName,
            surname = :newSurname,
            phone_number = :newPhoneNum,
            birth_date = :newBirthDate,
            weight = :newWeight,
            height = :newHeight
            WHERE numer_klienta = :userId";
    
        $stmt = $conn->prepare($updateSql);
        $stmt->bindParam(':newName', $newName);
        $stmt->bindParam(':newSurname', $newSurname);
        $stmt->bindParam(':newPhoneNum', $newPhoneNum);
        $stmt->bindParam(':newBirthDate', $newBirthDate);
        $stmt->bindParam(':newWeight', $newWeight);
        $stmt->bindParam(':newHeight', $newHeight);
        $stmt->bindParam(':userId', $_SESSION['user']['numer_klienta']);
    
        try {
            $stmt->execute();
            $selectUpdatedUserData = "SELECT * FROM users WHERE numer_klienta = :userId";
            $stmtSelect = $conn->prepare($selectUpdatedUserData);
            $stmtSelect->bindParam(':userId', $_SESSION['user']['numer_klienta']);
            $stmtSelect->execute();
            $updatedUserData = $stmtSelect->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $updatedUserData;
            header("Location: profile.php");
            exit();
        } catch (PDOException $e) {
            echo "Błąd podczas aktualizacji danych: " . $e->getMessage();
        }
    }

?>