<!DOCTYPE html>
<html lang="\" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Films</title>
  </head>
  <body>
          <?php
    $conn = mysqli_connect("localhost", "root", "", "sakila");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // else print('Successful connection.'."\n");

$customQuery = mysqli_query($conn, "SELECT
        c.first_name,
       c.last_name,
       title,
       r.inventory_id,
      r.rental_date,
      r.return_date
FROM
     customer c

         INNER JOIN rental r ON r.customer_id = c.customer_id
         INNER JOIN inventory i ON r.inventory_id = i.inventory_id
         INNER JOIN film f2 ON i.film_id = f2.film_id

ORDER BY last_name ASC;");
print("<h1>All Rentals</h1><form id='1' action='tasks.html'><button type='submit' name='return' form='1'>Return to Selection Menu</button></form>");

print("<table border='2' border-spacing=3px><tr><th>First Name</th><th>Last Name</th><th>title</th><th>Inventory ID</th><th>Rental Date</th><th>Return Date</th></tr>");


while ($row = mysqli_fetch_assoc($customQuery)) {
    print("<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["title"]."</td><td>".$row["inventory_id"]."</td><td>".$row["rental_date"]."</
      td><td>".$row["return_date"]."</td></tr>") ;
}

    print("</table><form id='1' action='tasks.html'><button type='submit' name='return' form='1'>Return to Selection Menu</button></form>");

    ?>
</body>
