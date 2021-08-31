<!DOCTYPE html>
<html>

<head>
  <title>Inserting Data</title>
</head>

<body>
<?php

$title = $_POST['title'];
$description = $_POST['description'];
$release_year = $_POST['release_year'];
$language_id = $_POST['language_id'];
$rental_duration = $_POST['rental_duration'];
$rental_rate = $_POST['rental_rate'];
$length = $_POST['length'];
$replacement_cost = $_POST['replacement_cost'];
$rating = $_POST['rating'];
$special_features = $_POST['special_features'];

// print("<p>Title: $title </p>");
// print("<p>Description: $description</p>");
// print("<p>Title: $release_year</p>");
// print("<p>Language ID: $language_id</p>");
// print("<p>Rental Duration: $rental_duration</p>");
// print("<p>Rental Rate: $rental_rate</p>");
// print("<p>Length $length</p>");
// print("<p>Replace Cost: $replacement_cost</p>");
// print("<p>Rating: $rating</p>");
// print("<p>Special Feature: $special_features</p>");


$conn = mysqli_connect("localhost", "root", "", "sakila");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$statement = $conn->prepare("INSERT INTO sakila.film (title,description,release_year,language_id,rental_duration,rental_rate,length,replacement_cost,rating,special_features) VALUES (?,?, ?,?,?,?,?,?,?,?) ");


$statement->bind_param
("ssiiididss", $title,$description,$release_year,$language_id,$rental_duration,$rental_rate,$length,$replacement_cost,$rating,$special_features);

$result = $statement->execute();

if($result == false) {

print("<font size = 4> <a href='manager.html'>Return to Manger</a> </font> ");
    exit("<p>
    <font size = 5>Insertion was UNSUCCESSFUL!</font>
    </p>");

} else {
  print("<font size = 4> <a href='manager.html'>Return to Manger</a> </font> ");
  exit("<p>
  <font size = 5>Insertion was Successful!</font>
  </p>");
}
$statement->close();
$conn->close();

 ?>

</body>

<a href="manager.html">
  <input type="button" value="Cancel" />
</a> </center>

</html>
