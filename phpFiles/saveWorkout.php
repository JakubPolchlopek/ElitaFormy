<?php
    require_once './conn.php';
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $rawData = file_get_contents("php://input");
    $decodedData = json_decode($rawData, true);

    if($decodedData !== null){
        $jsonExerciseData = json_encode($decodedData);

        $saveWorkoutSql = "INSERT INTO wykonanetreningi (idUsera, daneTreningu) VALUES (?, ?)";
        $stmt = $conn->prepare($saveWorkoutSql);
        $stmt->execute([$_SESSION['user']['numer_klienta'], $jsonExerciseData]);

        if($stmt->rowCount() > 0){
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Dane odebrane i zapisane poprawnie.']);
        }
        else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Błąd zapisu danych do bazy.']);
        }
    }
    else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Błąd dekodowania danych JSON: ' . json_last_error_msg()]);
    }

    $conn = null;
?>
