<?php

require_once '../connection/connection.php';
require_once '../models/User.php';
require_once '../models/UserSkeleton.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = isset($_POST['fullName']) ? $_POST['fullName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($fullName) || empty($email) || empty($password)) {
        echo json_encode(['error' => 'All fields are required']);
        exit();
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['error' => 'Email is already registered']);
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $user = new User($conn);
    $user->create($fullName, $email, $hashedPassword);

    echo json_encode(['message' => 'User registered successfully']);
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
