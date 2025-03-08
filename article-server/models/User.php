<?php
require_once '../connection/connection.php';

class User {
    private $fullName;
    private $email;
    private $password;

    public function __construct($fullName, $email, $password) {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
    }

    public function create() {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->fullName, $this->email, $this->password);
        return $stmt->execute();
    }
}

?>
