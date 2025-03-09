<?php

require_once '../connection/connection.php';
require_once '../models/Question.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['question']) && isset($data['answer'])) {
        $question = $data['question'];
        $answer = $data['answer'];


        $newQuestion = new Question($question, $answer);
        if ($newQuestion->create()) {
            echo json_encode(['message' => 'Question added successfully']);
        } else {
            echo json_encode(['error' => 'Failed to add question']);
        }
    } else {
        echo json_encode(['error' => 'Missing question or answer']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
