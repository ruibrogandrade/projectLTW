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
          SELECT  Restaurant.id as id, Restaurant.name as name, address, id_Owner, Category.id as id_Category, Category.name as category_name
          FROM Restaurant 
          Inner Join Category
          On Restaurant.id_Category = Category.id
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

    public static function getRestaurantWithId(PDO $db, int $id) {
      $stmt = $db->prepare('
      SELECT  Restaurant.id as id, Restaurant.name as name, address, id_Owner, Category.id as id_Category, Category.name as category_name
      FROM Restaurant 
      Inner Join Category
      On Restaurant.id_Category = Category.id
      WHERE Restaurant.id = ?
      ');

      $stmt->execute(array($id));
  
      if ($restaurant = $stmt->fetch()) {
        return $restaurant;
      } else return null;

      exit(0); 
    }

    public static function getRestaurantWithOwner(PDO $db, int $id_owner){
      $stmt = $db->prepare('
        SELECT  Restaurant.id as id, Restaurant.name as name, address, id_Owner, Category.id as id_Category, Category.name as category_name
        FROM Restaurant 
        Inner Join Category
        On Restaurant.id_Category = Category.id
        WHERE id_Owner = ?
      ');

      $stmt->execute(array($id_owner));
  
      if ($restaurants = $stmt->fetchAll()) {
        $result = array();
        foreach($restaurants as $restaurant) {
          array_push($result, $restaurant);
        }
      } else return null;
      return $result;
    }

    public static function getReviewsWithRestaurant(PDO $db, int $id){
      $stmt = $db->prepare('
        SELECT  Review.id as id, classification, comment, answer, id_writer, username
        FROM Review 
        Inner Join User
        On id_writer = User.id
        WHERE  id_restaurant = ?
      ');

      $stmt->execute(array($id));

      $reviews = $stmt->fetchAll();
      $result = array();
      foreach($reviews as $review) {
        array_push($result, $review);
      }
      
      return $result;


    }


}
?>