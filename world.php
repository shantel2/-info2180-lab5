<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

//sanitize data funtion
function sanitize_input($data){
    $data = trim($data);
    $data =ucwords($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    return $data;
}

$country = $_GET["country"]; 
$country = sanitize_input($country);

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

/*SELECT * FROM countries WHERE name LIKE '%$country%'; */

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <tr>
    <th>Name</th>
    <th>Continent</th> 
    <th>Independence</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['continent'] ?></td>
      <td><?= $row['independence_year'] ?></td>
      <td><?= $row['head_of_state'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
