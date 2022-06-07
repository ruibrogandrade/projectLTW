<?php
    declare(strict_types = 1);

    require_once('debug.php');

class Review {

  public int $id;
  public int $classification;
  public string $comment;
  public string $answer;
  public int $id_writer;
  public int $id_restaurant;




    public function __construct(int $id,int $classification, string $comment, string $answer, int $id_writer, int $id_restaurant)
    { 
      $this->id = $id;
      $this->classification= $classification;
      $this->comment = $comment;
      $this->answer = $answer;
      $this->id_writer = $id_writer;
      $this->id_restaurant = $id_restaurant;
    }

    public static function insertReview($pdo,int $classification, string $comment, int $id_writer, int $id_restaurant) {
        $sql = 'INSERT INTO Review VALUES(NULL,:classification,:comment,NULL,:id_writer,:id_restaurant)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':classification', $classification);
        $stmt->bindValue(':comment', $comment);
        $stmt->bindValue(':id_writer', $id_writer);
        $stmt->bindValue(':id_restaurant', $id_restaurant);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

}
?>