<?php
require_once '../connection/connection.php';

class Quest {
    private $question;
    private $answer;

    public function __construct($question = null, $answer = null) {
        $this->question = $question;
        $this->answer = $answer;
    }

    public function create() {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->question, $this->answer);
        return $stmt->execute();
    }
}

?>
