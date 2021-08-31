<!DOCTYPE html>
<html>
<head>
  <title>Table Calculator Results </title>
</head>
<body>

<?php


function sumVal (int $rows, int $cols, array $a){
  $sumArray = [];
  $sum = 0;
  for ($i=0; $i < $rows; $i++) {
    for ($j=0; $j < $cols; $j++) {
      $sum += $a[$i][$j];
    }
    array_push($sumArray, $sum);
    $sum = 0;
  }
  return $sumArray;
}


function avgVal (int $rows, int $cols, array $a) {
  $avgVal = [];
  $avg = 0;

    $sumVal = sumVal($rows, $cols, $a);

    for ($i=0; $i < $rows; $i++) {
        $avgValSave = ($sumVal[$i]/$cols);
        $avgVal[$i] = $avgValSave;
        $sum = 0;
    }
    return $avgVal;
}

function avgValSqrt (int $rows, int $cols, array $a) {
  $avgVal = [];
  $avg = 0;

    $sumVal = sumVal($rows, $cols, $a);

    for ($i=0; $i < $rows; $i++) {
        $avgValSave = ($sumVal[$i]/$cols);
        $avgVal[$i] = round(sqrt($avgValSave),3 );
        $sum = 0;
    }
    return $avgVal;
}


#inputArray =
function stdDev (int $rows, int $cols, array $inputArray) {
  $avg = avgVal($rows, $cols, $inputArray);


  $orgMinusMeanFinal = [];

  for ($i=0; $i < $rows; $i++) {
    $orgMinusMeanTemp = [];

    for ($j=0; $j < $cols; $j++) {
      $tempVal = $inputArray[$i][$j] - $avg[$i];
      $tempVal = pow($tempVal, 2);
      array_push($orgMinusMeanTemp, $tempVal);
      unset($tempVal);
    }

    foreach($orgMinusMeanTemp as $n)
      {
        $orgMinusMeanFinal [$i][] = $n;
     }

     unset($orgMinusMeanTemp);
  }

  $orgFinal = avgValSqrt($rows,$cols, $orgMinusMeanFinal);



return $orgFinal;
}

$rows = $_POST['rows'];
$cols = $_POST['cols'];
$minRan = $_POST['minRan'];
$maxRan = $_POST['maxRan'];

print("<p> Requested array size = $rows x $cols</p>");





for ($i = 0; $i < $rows; $i++) {
  for ($j=0; $j < $cols; $j++) {
    $data [$i][] = rand($minRan,$maxRan);
    #Add lower rand limit as minRan and upper rand limit as maxRan.
  }
}

//now we need to print a table with our values:
//either of the next two lines will work for the table tag in html
//print("<table border = \"3\"><tr>");
print("<table border = '10'>");
// <tr>
// for($i = 0; $i < $cols; $i++) {
//     print("<th>$i</th>");
// }
// print("</tr>");

for($i = 0; $i < $rows; $i++) { //for rows
    print("<tr>");
    for($j = 0; $j < $cols; $j++) { //for columns
        print("<td align='center'>".$data[$i][$j]."</td>");
        //or
        //$temp = $data[$i][$j];
        //print("<td align='right'>$temp</td>");
    }
    print("</tr>");
}

$minVal = 9999;
$maxVal = -9999;

for ($i=0; $i < $rows; $i++) {
  for ($j=0; $j < $cols; $j++) {
      if ($data[$i][$j] < $minVal) {
        $minVal = $data[$i][$j];
      }
      if ($data[$i][$j] > $maxVal) {
        $maxVal = $data[$i][$j];
      }
  }
}


print("<p> my Min Value is: $minVal </p>");
print("<p> my Max Value is: $maxVal </p>");

print("<p>______________________________________ </p>");

$sum = sumVal($rows,$cols, $data);
$avgVal = avgVal($rows,$cols, $data);
$stdDev = stdDev($rows,$cols, $data);

$nameTags = ["Row", "Sum", "Avg", "Std Dev"];

print("<table border = '10'><tr>");
for($i = 0; $i < sizeof($nameTags, 1); $i++) {
    print("<th>$nameTags[$i]</th>");
}
print("</tr>");

print("<p>______________________________________ </p>");



for($i = 0; $i < $rows; $i++) { //for rows

    print("<tr>");
      print("<td align='center'>".$i."</td>");
        print("<td align='center'>".$sum[$i]."</td>");
        print("<td align='center'>".$avgVal[$i]."</td>");
        print("<td align='center'>".$stdDev[$i]."</td>");
    print("</tr>");
}

print("</table>");

print("<p>______________________________________ </p>");


print("<table border = '10'>");


for($i = 0; $i < $rows; $i++) { //for rows
    print("<tr align = 'center'>");
    $verify = [];

    for($j = 0; $j < $cols; $j++) { //for columns

        $temp = $data[$i][$j];

        print("<td align='center'>$temp</td>");

        array_push($verify, $temp);

        $temp = 0;

    }
    print("</tr>");


print("<tr align = 'center'> ");


foreach($verify as $key) {
print("<td align='center +'>");
      if($key > 0) {
        print("Positive");
      }
      elseif($key < 0) {
        print("Negative");
      }
      elseif($key == 0) {
        print("Zero");
      }
      else{
        print("Invalid");
      }
print("</td>");

    }
    print("</tr>");


}

print("</table>");

?>
</body>

<p>
<input type="submit" value="Return to previous screen" onclick=window.history.back()>
</p>


</html>
