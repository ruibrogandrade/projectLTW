<?php
    declare(strict_types = 1);

    require_once('debug.php');

class User {

    //private $pdo;
    public int $id;
    public bool $isOwner;
    public string $username;
    public string $password;
    public string $address;
    public string $phoneNumber;


    public function __construct(int $id, bool $isOwner, string $username, string $password, string $address, string $phoneNumber)
    { 
      //$this->pdo = $pdo;
      $this->id = $id;
      $this->isOwner = $isOwner;
      $this->username = $username;
      $this->password = $password;
      $this->address = $address;
      $this->phoneNumber = $phoneNumber;
    }

    public function insertUser($pdo,int $id,bool $isOwner, string $username, string $password, string $address, string $phoneNumber) {
        $password = hash('sha256', $password);
        $sql = 'INSERT INTO User VALUES(:id,:isOwner,:username,:password,:address,:phoneNumber)';
        debug_to_console($id);
        debug_to_console($isOwner);
        debug_to_console($username);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':isOwner', $isOwner);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':phoneNumber', $id);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
?>