<?php

require_once '../connection/connection.php';

class Migration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUsersTable() {
        $createUsersTable = "
        CREATE TABLE IF NOT EXISTS users (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";

        if ($this->conn->query($createUsersTable) === TRUE) {
            echo "Users table created successfully.\n";
        } else {
            echo "Error creating users table: " . $this->conn->error . "\n";
        }
    }

    public function createQuestionsTable() {
        $createQuestionsTable = "
        CREATE TABLE IF NOT EXISTS questions (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            question VARCHAR(255) NOT NULL,
            answer TEXT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";

        if ($this->conn->query($createQuestionsTable) === TRUE) {
            echo "Questions table created successfully.\n";
        } else {
            echo "Error creating questions table: " . $this->conn->error . "\n";
        }
    }

    public function run() {
        $this->createUsersTable();
        $this->createQuestionsTable();
    }
}

$migration = new Migration($conn);

$migration->run();
?>
