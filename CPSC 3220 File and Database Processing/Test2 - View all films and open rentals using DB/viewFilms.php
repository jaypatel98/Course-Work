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


$customQuery = mysqli_query($conn, "SELECT f.title,
       f.description,
       f.rental_duration,
       f.rental_rate,
       f.LENGTH,
       c.name,
       count(i.inventory_id)

FROM film f
         INNER JOIN film_category fc ON f.film_id = fc.film_id
         INNER JOIN category c ON fc.category_id = c.category_id
         LEFT OUTER JOIN inventory i ON f.film_id = i.film_id
GROUP BY title, description, rental_duration, rental_rate, LENGTH
ORDER BY title ASC;");

print("<h1>View Films</h1><form id='1' action='tasks.html'><button type='submit' name='return' form='1'>Return to Selection Menu</button></form>");

print("<table border='2' border-spacing=3px><tr><th>title</th><th>description</th><th>rental_duration</th><th>rental_rate</th><th>length</th><th>category</th><th>film_count</th></tr>");
    while ($row = mysqli_fetch_assoc($customQuery)) {
        print("<tr><td>".$row["title"]."</td><td>".$row["description"]."</td><td>".$row["rental_duration"]."</td><td>".$row["rental_rate"]."</td><td>".$row["LENGTH"]."</
          td><td>".$row["name"]."</td>
          <td>".$row["count(i.inventory_id)"]."</td></tr>") ;
    }
    print("</table><form id='1' action='tasks.html'><button type='submit' name='return' form='1'>Return to Selection Menu</button></form>");

           ?>
  </body>
