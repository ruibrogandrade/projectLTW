<?php
    declare(strict_types = 1);

class User {

    private $pdo;
    public int $id;
    public string $username;
    public string $password;
    public string $address;
    public string $phoneNumber;


    public function __construct($pdo,int $id, string $username, string $password, string $address, string $phoneNumber)
    { 
      $this->pdo = $pdo;
      $this->id = $id;
      $this->username = $username;
      $this->password = $password;
      $this->address = $address;
      $this->phoneNumber = $phoneNumber;
    }

    public function insertUser(int $id, string $username, string $password, string $address, string $phoneNumber) {
        $password = hash('sha256', $password);
        $sql = 'INSERT INTO User VALUES(:id,:username,:password,:address,:phoneNumber)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':phoneNumber', $id);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}