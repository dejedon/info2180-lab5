<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$count = $_GET['country'];
$country = filter_var($count, FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET,"context", FILTER_SANITIZE_STRING);

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

if ($context == "cities") {
	$stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");
}
else 
{
	$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
