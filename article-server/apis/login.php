<?php

require_once '../connection/connection.php';
require_once '../models/User.php';
require_once '../models/UserSkeleton.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        echo json_encode(['error' => 'Email and password are required']);
        exit();
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();


        if (password_verify($password, $userData['password'])) {
            echo json_encode([
                'message' => 'Login successful',
                'user' => [
                    'id' => $userData['id'],
                    'fullName' => $userData['full_name'],
                    'email' => $userData['email']
                ]
            ]);
        } else {
            echo json_encode(['error' => 'Invalid password']);
        }
    } else {
        echo json_encode(['error' => 'User not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
