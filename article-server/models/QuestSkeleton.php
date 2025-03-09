<?php

class QuestSkeleton {
    private $id;
    private $question;
    private $answer;

    private function __construct($question, $answer, $id = null) {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }

    public static function create($question, $answer, $id = null) {
        return new self($question, $answer, $id);
    }
}

?>

