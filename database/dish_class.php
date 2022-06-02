<?php 
declare(strict_types = 1);

class Dish {
    public int $id;
    public string $name;
    public float $price;
    public int $id_category;
    public int $id_restaurant;

    public function __construct(int $id, string $name, float $price, int $id_category, int $id_restaurant)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->id_category = $id_category;  
        $this->id_restaurant;
    }

    static function getDishesRestaurant(PDO $db, int $id) : array {
        $stmt = $db->prepare('
          SELECT id, Dish.name, price, Dish.id_category 
          FROM Dish JOIN Restaurant USING (id)
          WHERE id_restaurant = ?;
        ');
        $stmt->execute(array($id));

        $dishes = array();

        if ($dishes = $stmt->fetchAll()) {
            $result = array();
          foreach($dishes as $dish) {
            array_push($result, $dish);
          }
        } else return array();
        return $result;
    }

    static function getDish(PDO $db, int $id) : Dish {
        $stmt = $db-> prepare('SELECT id, name, price, id_category
         FROM Dish WHERE id = ?
        ');
        $stmt->execute(array($id));

        $dish = $stmt->fetch();

        return new Dish(
            $dish['id'],
            $dish['name'],
            $dish['price'],
            $dish['id_category'],
            $dish['id_restaurant'],
        );
    }

    static function getDishNextId(PDO $db){
        $stmt = $db-> prepare('SELECT max(id)
        FROM Dish 
      ');
      $stmt->execute();

      $dish = $stmt->fetch();

      return $dish['max(id)'] + 1;
    }

}
?>