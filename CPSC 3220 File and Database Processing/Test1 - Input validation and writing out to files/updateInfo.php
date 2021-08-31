<!DOCTYPE html>
<html>
<head>
  <title>Inserting Data</title>
</head>
<body>

   <?php

  $firstName = ucwords($_POST['firstName']);
  $lastName =  ucwords($_POST['lastName']);
  $phoneNumber = $_POST['phoneNumber'];
  $emailAddress = $_POST['emailAddress'];


if (checkFirstAndLast($firstName, $lastName) == 11) {
    if (isValidPhoneNumber($phoneNumber) == 11) {
        if (isValidEmail($emailAddress) == 11) {
            if (!file_exists("userInfo.txt")) {
                $userInfo =fopen("userInfo.txt", "w");

                $inputString=strval("$lastName:$firstName:$phoneNumber:$emailAddress\n");
                $newUser = explode(":", $inputString);

                fwrite($userInfo, $inputString);
                fclose($userInfo);

                $titleLable = ['Last Name', 'First Name', 'PhoenNumber', 'Email'];


                $importedUserList = [];
                array_push($importedUserList, $newUser);
                printTable($titleLable, $importedUserList);

                print(" <p><a  href = \"userInfo.html\"text_align:center>Return to Form</a></p> ");
            } else {
                $userInfo =fopen("userInfo.txt", "r");

                $inputString=strval("$lastName:$firstName:$phoneNumber:$emailAddress");
                $newUser = explode(":", $inputString);

                $importedUserList = [];

                array_push($importedUserList, $newUser);

                while (!feof($userInfo)) {
                    $singleLineInput = fgets($userInfo); //read a line

                    $singleLineInputFinal = str_replace(array("\n", "\r"), '', $singleLineInput);


                    $testCase = explode(":", $singleLineInputFinal);

                    if (!feof($userInfo)) {
                        array_push($importedUserList, $testCase);
                    }
                }
                fclose($userInfo);

                array_multisort($importedUserList);

                $userInfo =fopen("userInfo.txt", "w");
                $sizeOfArray = sizeof($importedUserList);

                $titleLable = ['Last Name', 'First Name', 'Phone Number', 'Email'];
                printTable($titleLable, $importedUserList);
                for ($i=0; $i < $sizeOfArray ; $i++) {
                    $customerInfo = $importedUserList[$i][0].":".$importedUserList[$i][1].":".$importedUserList[$i][2].":".$importedUserList[$i][3]."\n";
                    fwrite($userInfo, $customerInfo);
                }
                fclose($userInfo);
                print(" <p><a  href = \"userInfo.html\"text_align:center>Return to Main Screen form</a></p> ");
            }
        } else {
            print(" <p><a  href = \"userInfo.html\"text_align:center>Return to Main Form Screen form</a></p> ");
        }
    } else {
        print(" <p><a  href = \"userInfo.html\"text_align:center>Return to Main Form Screen form</a></p> ");
    }
} else {
    print(" <p><a  href = \"userInfo.html\"text_align:center>Return to Main Form Screen form</a></p> ");
}


function printTable($titleLable, $tableInfo)
{
    print("<table border = '10' align = 'center'><tr>");
    for ($i = 0; $i < sizeof($titleLable, 1); $i++) {
        print("<th>$titleLable[$i]</th>");
    }
    print("</tr>");

    for ($i=0; $i < sizeof($tableInfo); $i++) {
        print("<tr>");

        print("<td align='center'>".$tableInfo[$i][0]."</td>");
        print("<td align='center'>".$tableInfo[$i][1]."</td>");
        print("<td align='center'>".$tableInfo[$i][2]."</td>");
        print("<td align='center'>".$tableInfo[$i][3]."</td>");

        print("</tr>");
    }
    print("</table>");
}


function isValidEmail(string $testEmailAddress)
{
    $length = strlen($testEmailAddress);
    if ($length < 31) {
        if (preg_match_all("/(^[a-zA-Z\d]+)@([a-zA-Z]+)(\.[edu|com]{3})/", $testEmailAddress)) {
            return 11;
        } else {
            print("Invalid Email Format!");
        }
    } else {
        print("Email given contains more than 30 characters!");
    }
}

function isValidPhoneNumber(string $testPhoneNumber)
{
    if (preg_match("/^[\d]{3}-[\d]{3}-[\d]{4}/", $testPhoneNumber)) {
        return 11;
    } else {
        print("Invalid Phone Number!");
    }
}

function checkFirstAndLast(string $testFirstName, string $testLastName)
{
    $lenOfString = strlen($testFirstName) + strlen($testLastName);

    if ($lenOfString > 21) {
        return print("First and Last name can only be 20 Characters Long please submit valid name!");
    } elseif (empty($testFirstName) || empty($testLastName)) {
        return   print("First and Last name cannot be left empty please submit valid name!");
    } elseif ((preg_match("/[^a-zA-Z]/", $testFirstName) || preg_match("/[^a-zA-Z]/", $testLastName)) == true) {
        return print("Unkonwn input type for First & Last name please enter valid inputs!");
    } else {
        return 11;
    }
}

   ?>
 </body>
</html>
