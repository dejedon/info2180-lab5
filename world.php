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

<style>
body{
    padding: 0;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
}

header{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    width: 100%;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: grey;
}

header img{
    width: 80px;
    height: 80px;
    float: left;
}

header h1{
    color: white;
    margin-left: 100px;
}

table {
    width: 70%;
    border-collapse: collapse;
    margin-bottom: 20px;
	margin: 20px auto;
	box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: white;
}

tr:nth-child(odd){
	background-color: lightcyan;
}

tr:hover {
    background-color: #f5f5f5;
}
</style>

<?php if ($context == "cities"): ?>
	<table>
		<tr>
			<th>Name</th>
			<th>District</th>
			<th>Population</th>
		</tr>
	<?php foreach ($results as $row): ?>
		<tr>
	  		<td><?= $row['name'];?></td>
	  		<td><?= $row['district'];?></td>
	  		<td><?= $row['population'];?></td>
	  	</tr>
	<?php endforeach; ?>
	</table>
<?php endif;?>

<?php if ($context != "cities"): ?>
	<table>
		<tr>
			<th>Country Name</th>
			<th>Continent</th>
			<th>Year of Independence</th>
			<th>Head of State</th>
		</tr>
	<?php foreach ($results as $row): ?>
			<tr>
				<td><?= $row['name'];?></td>
				<td><?= $row['continent'];?></td>
				<td><?= $row['independence_year'];?></td>
				<td><?= $row['head_of_state']; ?></td>
			</tr>
	<?php endforeach; ?>
	</table>
<?php endif;?>