<?php

class UserSkeleton {
    private $id;
    private $fullName;
    private $email;
    private $password;

    private function __construct($fullName, $email, $password, $id = null) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create($fullName, $email, $password, $id = null) {
        return new self($fullName, $email, $password, $id);
    }
}

?>

