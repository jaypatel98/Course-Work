<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <?php
  /*

  IMPORTANT VARIABLES
  -----------------------
  $first_names
  $last_names
  $city_names
  $street_names
  $street_types
  $state_names
  $domains - For email addresses. Includes the @ symbol, the domain name, and the TLD in one.
  $product_names
  */
  $file = fopen("first_names.txt","r");
  $first_names = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));
    $first_names[] = $line;
  }
  $first_names = array_filter($first_names);
  fclose($file);
  // print("<pre>");
  // print_r($first_names);
  // print("</pre>");



  $file = fopen("last_names.txt","r");
  $last_names = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));
    $last_names[] = $line;
  }
  $last_names = array_filter($last_names);
  fclose($file);
  // print("<pre>");
  // print_r($last_names);
  // print("</pre>");

  $file = fopen("cities.txt","r");
  $city_names = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));
    $city_names[] = $line;
  }
  $city_names = array_filter($city_names);
  fclose($file);
  // print("<pre>");
  // print_r($city_names);
  // print("</pre>");

  $file = fopen("street_names.txt","r");
  $street_names = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));
    $street_names[] = $line;
  }
  $street_names = array_filter($street_names);
  fclose($file);
  // print("<pre>");
  // print_r($street_names);
  // print("</pre>");

  $file = fopen("street_types.txt","r");
  $street_types = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));
    $street_types[] = $line;
  }
  $street_types = array_filter($street_types);
  fclose($file);
  // print("<pre>");
  // print_r($street_types);
  // print("</pre>");

  $file = fopen("states.txt","r");
  $state_names = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));
    $state_names[] = $line;
  }
  $state_names = array_filter($state_names);
  fclose($file);
  // print("<pre>");
  // print_r($state_names);
  // print("</pre>");

  $file = fopen("domains.txt","r");
  $domains = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));

    $domains[] = $line;
  }
  $domains = array_filter($domains);
  fclose($file);
  // print("<pre>");
  // print_r($domains);
  // print("</pre>");

  $file = fopen("products.txt","r");
  $product_names = [];
  while (!feof($file)) {
    $line = rtrim(fgets($file));
    $product_names[] = $line;
  }
  $product_names = array_filter($product_names);
  fclose($file);
  // print("<pre>");
  // print_r($product_names);
  // print("</pre>");


  $sqlFile = fopen("data.sql","w");
  fwrite($sqlFile, "use SuperStore;\nSET AUTOCOMMIT=0;\n\n");
  fclose($sqlFile);
  function write_address_entries($street_names, $city_names, $state_names) {
    $returnArray = [];
    for ($i=0; $i < 150; $i++) {
      $houseNumber = rand(1,99999);
      $streetRand = rand(0, sizeof($street_names)-1);
      $cityRand = rand(0,sizeof($city_names)-1);
      $stateRand = rand(0, sizeof($state_names)-1);
      $zip = rand(11111,99999);

      if ($i !== 149) {
        $newAddress = "('$houseNumber $street_names[$streetRand]', '$city_names[$cityRand]' ,'$state_names[$stateRand]' , '$zip'),\n";
      }
      else {
        $newAddress = "('$houseNumber $street_names[$streetRand]', '$city_names[$cityRand]' ,'$state_names[$stateRand]' , '$zip');\n";
      }
      // print("<br>$newAddress<br />");
      array_push($returnArray, $newAddress);

    }
    return $returnArray;
  }
  function write_customer_entries($first_names,$last_names,$domains,$addressEntries) {
    $customerArray = [];
    $sizeofAdress = range(1,sizeof($addressEntries));
    shuffle($sizeofAdress);
    for ($i=0; $i < 100; $i++) {
      $firstNameRand = rand(0, sizeof($first_names)-1);
      $lastNameRand = rand(0,sizeof($last_names)-1);
      $domainRand = rand(0,sizeof($domains)-1);

      $firstRand = rand(100,999);
      $secondRand = rand(100,999);
      $thirdRand = rand(1000,9999);
      $phoneRand = "$firstRand-$secondRand-$thirdRand";

      $newEmail = "$first_names[$firstNameRand].$last_names[$lastNameRand]$domains[$domainRand]";
      $randIndex = rand(1,sizeof($sizeofAdress)-1);

      if ($i !== 99) {
        $newCustomer = "('$first_names[$firstNameRand]','$last_names[$lastNameRand]','$newEmail','$phoneRand',$sizeofAdress[$randIndex]),\n";
      }
      else {
        $newCustomer = "('$first_names[$firstNameRand]','$last_names[$lastNameRand]','$newEmail','$phoneRand',$sizeofAdress[$randIndex]);\n";
      }
      // print("<br>$newCustomer<br />");
      array_push($customerArray, $newCustomer);
    }
    return $customerArray;
  }
  function write_order_entries($sizeOfCustomer, $sizeOfAddress) {

    $customerOrder = [];

    for ($i=0; $i < 350; $i++) {
      $randomCustomer = rand(1,$sizeOfCustomer);
      $randomAddress = rand(1,$sizeOfAddress);

      if ($i !== 349) {
        $myInfo = "($randomCustomer,$randomAddress),\n";
      }
      else {
        $myInfo = "($randomCustomer,$randomAddress);\n";
      }
      // print("<br>$myInfo<br />");
      array_push($customerOrder, $myInfo);
    }
    return $customerOrder;
  }
  //   product(product_id, product_name, description, weight, base_cost)
  function write_product_entries($product_names) {
    $productInfo = [];
    for ($i=0; $i < 750; $i++) {
      $productRand = rand(0, sizeof($product_names)-1);
      $weightRand = rand(0, 10);
      $baseCost = number_format(rand(2,30), 2)-.01;
      $product = explode(' -', $product_names[$productRand]);
      $description = strval("The best $product[0] on the market.");

      if ($i !== 749) {
        $tempProductInfo = "('$product_names[$productRand]', '$description', $weightRand, $baseCost),\n";
      }
      else {
        $tempProductInfo = "('$product_names[$productRand]', '$description', $weightRand, $baseCost);\n";
      }
      // print("<br />$tempProductInfo");
      array_push($productInfo, $tempProductInfo);
    }
      return $productInfo;
  }
  function write_warehouse_entries($addressEntries) {
   $warehouseEntries = [];
   $sizeOfEntries = sizeof($addressEntries)-1;
   $randomNumber = range(1,$sizeOfEntries);
   shuffle($randomNumber);

   for ($i=0; $i < 25; $i++) {
     if ($i !== 24) {
       $wareHouseInfo = "('Warehouse$i', $randomNumber[$i]),\n";
     }
     else {
       $wareHouseInfo = "('Warehouse$i', $randomNumber[$i]);\n";
     }
     array_push($warehouseEntries, $wareHouseInfo);
   }
   return $warehouseEntries;

  }
  function write_order_item_entries($productEntries,$sizeOfOrderEntries) {
    shuffle($productEntries);  // shuffles entry
    $sizeOfProductEntries = sizeof($productEntries)-1;
    $returnArray = [];
    for ($i=0; $i < 550; $i++) {
      $randQty = rand(1,20);  // random qty
      $price = substr($productEntries[$i], -8,-3);
      $ranProdNum = rand(1,$sizeOfProductEntries);
      $ranOrdNum = rand(1,$sizeOfOrderEntries);
      if ($i !== 549) {
        $finalString = "($ranOrdNum,$ranProdNum,$randQty,$price),\n";
      }
      else {
        $finalString = "($ranOrdNum,$ranProdNum,$randQty,$price);\n";
      }
      array_push($returnArray, $finalString);
    }
    return $returnArray;
  }
  function write_product_warehouse_entries($warehouseEntries,$productEntries) {
    $productWarehouseEntries = [];
    $sizeOfWEntries = sizeof($warehouseEntries)-1;
    $randomWNumber = range(1,$sizeOfWEntries);
    shuffle($randomWNumber);
    $sizeOfPEntries = sizeof($productEntries)-1;
    $randomPNumber = range(1,$sizeOfPEntries);
    shuffle($randomPNumber);

    for ($i=0; $i < 1250; $i++) {
      if ($i !== 1249) {
        $ranProdNum = rand(1,sizeof($randomPNumber)-1);
        $ranWareNum = rand(1,sizeof($randomWNumber)-1);
        $productWarehouse = "('$randomPNumber[$ranProdNum]', '$randomWNumber[$ranWareNum]'),\n";
      }
      else {
        $ranProdNum = rand(1,sizeof($randomPNumber)-1);
        $ranWareNum = rand(1,sizeof($randomWNumber)-1);
        $productWarehouse = "('$randomPNumber[$ranProdNum]', '$randomWNumber[$ranWareNum]');\n";
      }
      array_push($productWarehouseEntries, $productWarehouse);
    }
    return $productWarehouseEntries;
  }

  $addressEntries =  write_address_entries($street_names, $city_names, $state_names);
  $sizeOfAddress = sizeof($addressEntries);
  $sqlFile = fopen("data.sql","a");
  fwrite($sqlFile, "INSERT INTO SuperStore.address (street,city,state,zip)\nVALUES\n");
  foreach ($addressEntries as $entry) {
    fwrite($sqlFile,"$entry");
  }
  fwrite($sqlFile,"COMMIT;\n");
  fclose($sqlFile);

  $customerInfo   =  write_customer_entries($first_names,$last_names,$domains,$addressEntries);
  $sizeOfCustomer = sizeof($customerInfo);
  $sqlFile = fopen("data.sql","a");
  fwrite($sqlFile, "INSERT INTO SuperStore.customer (first_name,last_name,email,phone,address_id)\nVALUES\n");
  foreach ($customerInfo as $entry) {
    fwrite($sqlFile,"$entry");
  }
  fwrite($sqlFile,"COMMIT;\n");
  fclose($sqlFile);

  $orderEntries   =  write_order_entries($sizeOfCustomer,$sizeOfAddress);
  $sizeOfOrderEntries = sizeof($orderEntries)-1;
  $sqlFile = fopen("data.sql","a");
  fwrite($sqlFile, "INSERT INTO SuperStore.order (customer_id,address_id)\nVALUES\n");
  foreach ($orderEntries as $entry) {
    fwrite($sqlFile,"$entry");
  }
  fwrite($sqlFile,"COMMIT;\n");
  fclose($sqlFile);

  $productEntries   =  write_product_entries($product_names);
  $sqlFile = fopen("data.sql","a");
  fwrite($sqlFile, "INSERT INTO SuperStore.product (product_name, description, weight, base_cost)\nVALUES\n");
  foreach ($productEntries as $entry) {
    fwrite($sqlFile,"$entry");
  }
  fclose($sqlFile);

  $warehouseEntries   =  write_warehouse_entries($addressEntries);
  $sqlFile = fopen("data.sql","a");
  fwrite($sqlFile, "INSERT INTO SuperStore.warehouse (name, address_id)\nVALUES\n");
  foreach ($warehouseEntries as $entry) {
    fwrite($sqlFile,"$entry");
  }
  fclose($sqlFile);

  $orderItemEntries   =  write_order_item_entries($productEntries,$sizeOfOrderEntries);
  $sqlFile = fopen("data.sql","a");
  fwrite($sqlFile, "INSERT INTO SuperStore.order_item (order_id,product_id,quantity,price)\nVALUES\n");
  foreach ($orderItemEntries as $entry) {
    fwrite($sqlFile,"$entry");
  }
  fwrite($sqlFile,"COMMIT;\n");
  fclose($sqlFile);

  $productWarehouseEntries   =  write_product_warehouse_entries($warehouseEntries,$productEntries);
  $sqlFile = fopen("data.sql","a");
  fwrite($sqlFile, "INSERT INTO SuperStore.product_warehouse (product_id, warehouse_id)\nVALUES\n");
  foreach ($productWarehouseEntries as $entry) {
    fwrite($sqlFile,"$entry");
  }
  fwrite($sqlFile,"COMMIT;\n");
  fclose($sqlFile);



  // $sqlFile = fopen("data.sql","a");
  // fwrite($sqlFile, "\n\nCOMMIT;");
  // fclose($sqlFile);
  ?>
</body>
</html>
