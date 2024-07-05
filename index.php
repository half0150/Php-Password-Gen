<?php

function genererPassword($length, $charNumbers = 0, $charLowercase = 0, $charUppercase = 0, $charSpecial = 0 /* $charDanish = 0 */) {
    $numbersSet = "0123456789";
    $lowercaseSet = "abcdefghijklmnopqrstuvwxyz";
    $uppercaseSet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $specialSet = "!@#*%&_-+=(){}[]$";
    // $danishSet = "æøå";
    // beregner den totale længde af password

    $totalLength = $charNumbers + $charLowercase + $charUppercase + $charSpecial; // + $charDanish;
    // reducere længden, så passworden kun er den angivet længde 
    if ($totalLength > $length) {
        $reduceLength = $length / $totalLength;

        $charNumbers = floor($charNumbers * $reduceLength);
        $charLowercase = floor($charLowercase * $reduceLength);
        $charUppercase = floor($charUppercase * $reduceLength);
        $charSpecial = floor($charSpecial * $reduceLength);
        //$charDanish = floor($charDanish * $reduceLength);
    }

    $password = [];

    $charPool = str_repeat($numbersSet, $charNumbers)
            . str_repeat($lowercaseSet, $charLowercase)
            . str_repeat($uppercaseSet, $charUppercase)
            . str_repeat($specialSet, $charSpecial);
    //. str_repeat($danishSet, $charDanish);
    // shuffler gennem alle karaktererne af en string og generere et random password af den givet længde

    $charPool = str_shuffle($charPool);

    for ($i = 0; $i < $length; $i++) {
        $password[] = $charPool[rand(0, strlen($charPool) - 1)];
    }

    $password = implode('', $password);

    return $password;
}

// udskriver password

$password = genererPassword(35, 5, 5, 10, 5, 10); // Den første som i dette eksempel er 30 er længden.
// de næste af hvor mange der skal være af de forskellige slags tal, små bogstaver, store bogstaver og sidst specialtegn
echo "Dette er dit password: $password";
?>
