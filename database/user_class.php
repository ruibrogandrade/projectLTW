<?php
    declare(strict_types = 1);

    require_once('debug.php');

class User {

    public int $id;
    public bool $isOwner;
    public string $username;
    public string $password;
    public string $address;
    public int $phoneNumber;


    public function __construct(int $id, bool $isOwner, string $username, string $password, string $address, int $phoneNumber)
    { 
      $this->id = $id;
      $this->isOwner = $isOwner;
      $this->username = $username;
      $this->password = $password;
      $this->address = $address;
      $this->phoneNumber = $phoneNumber;
    }

    public static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
        $stmt = $db->prepare('
          SELECT id, isOwner, username, password, address, phoneNumber
          FROM User 
          WHERE lower(username) = ? AND password = ?
        ');
  
        $stmt->execute(array(strtolower($username), hash('sha256', $password)));
    
        if ($user = $stmt->fetch()) {
          return new User((int)$user['id'],(bool)$user['isOwner'],$user['username'],$user['password'],$user['address'],(int)$user['phoneNumber']);
        } else return null;
      }

    public static function insertUser($pdo,bool $isOwner, string $username, string $password, string $address, int $phoneNumber) {
        $password = hash('sha256', $password);
        $sql = 'INSERT INTO User VALUES(NULL,:isOwner,:username,:password,:address,:phoneNumber)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':isOwner', $isOwner);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':phoneNumber', $phoneNumber);
        $stmt->execute();

        return $pdo->lastInsertId();
    }


    public static function deleteUser(pdo $db, $id) {
      $stmt = $db->prepare('
          DELETE from User 
          where id = ?
        ');
  
      $stmt->execute(array($id));
  }

  public static function editUser($pdo,int $id, bool $isOwner, string $username, string $password, string $address, int $phoneNumber) {
        $password = hash('sha256', $password);
        $sql = 'UPDATE User SET isOwner = :isOwner, username = :username, password = :password, address = :address, phoneNumber = :phoneNumber WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':isOwner', $isOwner);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':phoneNumber', $phoneNumber);
        $stmt->execute(array($id));
}

}
?>