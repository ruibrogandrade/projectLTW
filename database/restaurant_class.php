<?php 
declare(strict_types = 1);

class Restaurant {
    public int $id;
    public string $name;
    public string $address;
    public int $id_Owner;
    public int $id_Category;



    public function __construct(int $id, string $name, string $address, int $id_Owner, int $id_Category)
    { 
      $this->id = $id;
      $this->name = $name;
      $this->address = $address;
      $this->id_Owner = $id_Owner;
      $this->id_Category = $id_Category;
    }

    public static function getRestaurants(PDO $db) {
        $stmt = $db->prepare('
          SELECT id, name, address, id_Owner, id_Category
          FROM Restaurant 
        ');
        $stmt->execute();
        if ($restaurants = $stmt->fetchAll()) {
            $result = array();
          foreach($restaurants as $restaurant) {
            array_push($result, $restaurant);
          }
        } else return null;
        return $result;
    }
}
?>