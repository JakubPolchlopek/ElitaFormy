<?php
    require_once './conn.php';
    session_start();

    $rawData = file_get_contents("php://input");
    $decodeData = json_decode($rawData, true);

    if($decodeData !== null){
        $jsonExerciseData = json_encode($decodeData);

        $saveWorkoutSql = "INSERT INTO wykonanetreningi (idUsera, daneTreningu) VALUES ('$_SESSION['user']['numer_klienta]', '$jsonExerciseData')";

        if($conn->query($saveWorkoutSql) === TRUE){
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
        echo json_encode(['status' => 'error', 'message' => 'Błąd dekodowania danych JSON.']);
    }
    $conn->close();
?>