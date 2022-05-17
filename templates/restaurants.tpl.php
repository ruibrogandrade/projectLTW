<?php declare(strict_types = 1); ?>

<?php function drawRestaurant(int $id, string $name, string $address, int $id_owner, array $id_category) { ?>
  <h2><?=$name?></h2>
  <h3><a href="restaurant.php?id=<?=$id?>"><?=$name?></a></h3>      
  <h2>Restaurants</h2>
      <section id="restaurants">
        <div class="row">
          <div class="column">
            <img src="https://picsum.photos/200?<?=$id?>">
          <a href="dishes.php?id=1"><?=$name?></a>
          <p class="info"><?=$address?></p>
          <p class="info"><?=$id_category?></p>
        </div>
<?php } ?>

<?php function drawRestaurants(array $array_restaurant) {
    foreach($array_restaurant as $restaurant) {
    } 
}
 ?>