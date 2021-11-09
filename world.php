<?php
//$data= $conn->query
//("SELECT c.name, c.district, c.population FROM cities c join countries cs on c.country_code =
//s.code WHERE cs.name LIKE '%$country%'");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

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

$context = $_GET["context"];
$context = sanitize_input($context);

if($context == "cities"){
  $stmt =  $conn->query("SELECT c.name, c.district, c.population FROM cities c join countries cs on c.country_code =s.code WHERE cs.name LIKE '%$country%'");
} else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($context== ""): ?>
<table>
  <tr>
    <th>Name</th>
    <th>Continent</th> 
    <th>Independence</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']; ?></td>
      <td><?= $row['continent']; ?></td>
      <td><?= $row['independence_year']; ?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php else: ?>
<table>
  <tr>
    <th>Name</th>
    <th>District</th> 
    <th>Population</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row["name"]; ?></td>
      <td><?= $row["district"]; ?></td>
      <td><?= $row["population"]; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php endif; ?>