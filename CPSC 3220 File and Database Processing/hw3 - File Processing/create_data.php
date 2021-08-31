<!DOCTYPE html>
<!--	Author: Mike O'Kane
		Date:	August 15, 2007
		File:	average-score.php
		Purpose:Example of Reading data from a file
-->
<html>

<head>
	<title>Generated List</title>
</head>
<h1 align = center> Table of Names and Addresses</h1>
<body>

	<?php


	$firstName =fopen("first_names.csv", "r");
	$Firstname = fgets($firstName);

$FirstNames = explode(",",$Firstname);
$finalFirstName = [];
/*
Remove empty entries in Array
*/
foreach ($FirstNames as $name) {
	$name = str_replace(array("\n", "\r"), '', $name);
	array_push($finalFirstName, $name);
}

fclose($firstName);


$finalLastNames = [];
$lastNames =fopen("last_names.txt", "r");
while(!feof($lastNames)) {

$tempLastName = fgets($lastNames);

$tempLastName = str_replace(array("\n", "\r"), '', $tempLastName);

if(!feof($lastNames)) {
		array_push($finalLastNames, $tempLastName);
}
}
fclose($lastNames);


$finalStreetNames = [];
$streetNames =fopen("street_names.txt", "r");

while(!feof($streetNames)) {
$tempStreetName = fgets($streetNames);
$tempStreetName = str_replace(array("\n", "\r"), '', $tempStreetName);

$tempStreetName = explode(":" ,$tempStreetName);

foreach ($tempStreetName as $value) {
	if(!feof($streetNames)) {
			array_push($finalStreetNames, $value);
	}
}
}
fclose($streetNames);


$domainName =fopen("domains.txt", "r");
$domainNames = fgets($domainName);
$domainNames = array_chunk(explode(".",$domainNames),2);
$editDomainName = [];
$finalDomainName = [];
for ($i=0; $i < sizeof($domainNames); $i++) {

	   $tempDomainNames  = implode(".", $domainNames[$i]);
		 array_push($editDomainName, $tempDomainNames);
}

foreach ($editDomainName as $name) {
$name = str_replace(array("\n", "\r"), '', $name);
array_push($finalDomainName, $name);
}

fclose($domainName);


$streetTypes =fopen("street_types.txt", "r");
$streetType = fgets($streetTypes);

$tempStreetType = explode("..;",$streetType);
$finalStreetType = [];

/*
Remove empty entries in Array
*/
foreach ($tempStreetType as $name) {
$name = str_replace(array("\n", "\r"), '', $name);
array_push($finalStreetType, $name);
}

fclose($streetTypes);



function generateRandomFirstNames (array $firstName) {
$listOfFirstNames = [];
	for ($i=0; $i < 25; $i++) {

			$randomNumber1 = random_int (0 , sizeof($firstName) - 1);

			$randomFirst = $firstName[$randomNumber1];

			array_push($listOfFirstNames, $randomFirst);

	}
return $listOfFirstNames;
}




function generateRandomNames (array $lastName) {
	$listOfLastNames = [];
$max = sizeof($lastName) - 1;
	for ($i=0; $i < 25; $i++) {
			$randomNumber1 = random_int (  0 , $max);

			$randomFirst = $lastName[$randomNumber1];

			array_push($listOfFirstNames, $randomFirst);
	}
return $listOfLastNames;
}




$randomListOfFirstNames = generateRandomFirstNames($finalFirstName);
$randomListOfLastNames = generateRandomFirstNames($finalLastNames);


function generateRandomStreet (array $streetNames, array $streetTypes) {
	$fullAddress = [];
	for ($i=0; $i < 25; $i++) {
		$randomStreetNumber= random_int(1, 100);
		$rand1 = random_int(0, sizeof($streetNames) -1);
		$rand2 = random_int(0, sizeof($streetTypes) -1);

		$stName = $streetNames[$rand1];
		$stType = $streetTypes[$rand2];
		$address = $randomStreetNumber .' '.	$stName ;
		$address = $address. ' ' . $stType;
		array_push($fullAddress, $address);
	}
	return $fullAddress;
}
$randomListOfAddresses = generateRandomStreet($finalStreetNames, $finalStreetType);

//Generate Ramdom email given first and last name with domain
function generate_Email (array $listOfFirstNames,array $listOfLastNames, array $finalDomainName) {

	$listOfEmail = [];
for ($i=0; $i < 25; $i++) {
		$rand1 = random_int(0, sizeof($finalDomainName) - 1);
		$fullName = "$listOfFirstNames[$i].$listOfLastNames[$i]@";
		$fulldomain = "$fullName$finalDomainName[$rand1]";
		array_push($listOfEmail, $fulldomain);
}
return $listOfEmail;
}



$randomListOfEmailAddresses = generate_Email($randomListOfFirstNames, $randomListOfLastNames, $finalDomainName);

$titleLable = ['First Name', 'Last Name', 'Addresses', 'Email'];
// print("<pre>");
// print_r($listOfEmailAddresses);
// print("</pre>");

print("<table border = '10' align = 'center'><tr>");
for($i = 0; $i < sizeof($titleLable, 1); $i++) {
    print("<th>$titleLable[$i]</th>");
}
print("</tr>");

for ($i=0; $i < 25; $i++) {
print("<tr>");

print("<td align='center'>".$randomListOfFirstNames[$i]."</td>");
print("<td align='center'>".$randomListOfLastNames[$i]."</td>");
print("<td align='center'>".$randomListOfAddresses[$i]."</td>");
print("<td align='center'>".$randomListOfEmailAddresses[$i]."</td>");

print("</tr>");


}
print("</table>");

$myfile = fopen("customers.txt", "w");

for ($i=0; $i < sizeof($randomListOfFirstNames); $i++) {
	$customerInfo = "$randomListOfFirstNames[$i]:$randomListOfLastNames[$i]:$randomListOfAddresses[$i]:$randomListOfEmailAddresses[$i]\n";
	fwrite($myfile, $customerInfo);
}
fclose($myfile);


		print (" <p><a  href = \"create_data.html\"text_align:center>Return to Main Screen form</a></p> ");

	?>

</body>
</html>
