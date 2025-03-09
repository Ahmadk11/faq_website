<?php

require_once '../connection/connection.php';
require_once '../models/Quest.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM questions";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $questions = [];

        while ($row = $result->fetch_assoc()) {
            $questions[] = [
                'id' => $row['id'],
                'question' => $row['question'],
                'answer' => $row['answer']
            ];
        }

        echo json_encode(['questions' => $questions]);
    } else {
        echo json_encode(['message' => 'No questions found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
