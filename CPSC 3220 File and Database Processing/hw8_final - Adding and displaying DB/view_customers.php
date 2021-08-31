<!DOCTYPE html>
<html lang="\" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Customers Page</title>
  </head>
  <body>
    <?php
    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "sakila");
    // Check connection
    if (!$conn) die("Connection failed: " . mysqli_connect_error());
    // else print('Successful connection.'."\n");

    //This query for all customer information sans rental titles. Customer id included for comparison but not viewing.
    $customerQuery = mysqli_query($conn,"select customer.first_name, customer.last_name, customer.customer_id, address.address, city.city, address.district, address.postal_code
from customer, address, city
where
	customer.address_id = address.address_id
	and address.city_id = city.city_id
order by customer.last_name asc;");
    //This query grabs all distinct rentals and the associated customer id.
    $rentalQuery = mysqli_query($conn, "select distinct film.title, customer.customer_id
from film, customer, rental, inventory
where
	customer.customer_id = rental.customer_id
	and rental.inventory_id = inventory.inventory_id
	and inventory.film_id = film.film_id;");
  // print("<pre>");
  // print_r(var_dump($rentalQuery));
  // print("</pre>");

    $custArray = [];
    while ($rentRow = mysqli_fetch_assoc($rentalQuery)) {
      // print("<p>");
      // print($rentRow['customer_id'].": ".$rentRow['title']);
      // print("</p>");
      if (!array_key_exists($rentRow['customer_id'],$custArray)) {
        $custArray[$rentRow['customer_id']] = $rentRow['title'];
      }
      else {
        $custArray[$rentRow['customer_id']] = $custArray[$rentRow['customer_id']].", ".$rentRow['title'];
      }
    }
    // foreach ($custArray as $key => $value) {
    //   print("<p>Customer $key: $value</p>");
    // }

    print("<h1>Customer Information Page</h1><form id='1' action='manager.html'><button type='submit' name='return' form='1'>Return to Manager Controls</button></form>");
    print("<table border='2' border-spacing=3px><tr><th>Last Name</th><th>First Name</th><th>Address</th><th>City</th><th>District</th><th>Postal Code</th><th>Rentals</th></tr>");
    while ($row = mysqli_fetch_assoc($customerQuery)) {
      print("<tr><td>".$row["last_name"]."</td><td>".$row["first_name"]."</td><td>".$row["address"]."</td><td>".$row["city"]."</td><td>".$row["district"]."</td><td>".$row["postal_code"]."</td><td>".$custArray[$row['customer_id']]."</td></tr>");
    }
    print("</table><form id='1' action='manager.html'><button type='submit' name='return' form='1'>Return to Manager Controls</button></form>");
    ?>
  </body>
</html>
