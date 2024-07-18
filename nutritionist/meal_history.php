<?php
echo "<span>Breakfast Meals</span>";
echo "<table class='table table-striped mt-3'>";
echo "<tr><th>Foodname</th><th colspan='2'>Amount of Serving Item</th></tr>";

class BreakfastRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td>" . parent::current(). "</td>";
  } 

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutrition_system_2024";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $id=$_GET['view'];
  $stmt = $conn->prepare("SELECT foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
  INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
  INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
  WHERE client_no='$id' AND meal='Breakfast'");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

  foreach(new BreakfastRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";



echo "<span>MidMorning Meals</span>";
echo "<table class='table table-striped mt-3'>";
echo "<tr><th>Foodname</th><th>Amount</th><th>Serving Item</th></tr>";

class MidmorningRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td>" . parent::current(). "</td>";
  } 

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $id=$_GET['view'];
  $stmt = $conn->prepare("SELECT foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
  INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
  INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
  WHERE client_no='$id' AND meal='mid-morning'");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

  foreach(new MidmorningRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>



