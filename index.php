<?php

class PasswordGenerator {
    private $numbersSet = "0123456789";
    private $lowercaseSet = "abcdefghijklmnopqrstuvwxyz";
    private $uppercaseSet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    private $specialSet = "!@#*%&_-+=(){}[]$";
    // private $danishSet = "æøå";

    private $length;
    private $charNumbers;
    private $charLowercase;
    private $charUppercase;
    private $charSpecial;
    // private $charDanish;

    public function __construct($length, $charNumbers = 0, $charLowercase = 0, $charUppercase = 0, $charSpecial = 0 /* $charDanish = 0 */) {
        $this->length = $length;
        $this->charNumbers = $charNumbers;
        $this->charLowercase = $charLowercase;
        $this->charUppercase = $charUppercase;
        $this->charSpecial = $charSpecial;
        // $this->charDanish = $charDanish;
    }

    public function generate() {
        // beregner den totale længde af password
        $totalLength = $this->charNumbers + $this->charLowercase + $this->charUppercase + $this->charSpecial; // + $this->charDanish;
        
        // reducere længden, så passworden kun er den angivet længde
        if ($totalLength > $this->length) {
            $reduceLength = $this->length / $totalLength;

            $this->charNumbers = floor($this->charNumbers * $reduceLength);
            $this->charLowercase = floor($this->charLowercase * $reduceLength);
            $this->charUppercase = floor($this->charUppercase * $reduceLength);
            $this->charSpecial = floor($this->charSpecial * $reduceLength);
            // $this->charDanish = floor($this->charDanish * $reduceLength);
        }

        $password = [];
        
        // shuffler gennem alle karaktererne af en string og generere et random password af den givet længde
        $charPool = str_repeat($this->numbersSet, $this->charNumbers)
                . str_repeat($this->lowercaseSet, $this->charLowercase)
                . str_repeat($this->uppercaseSet, $this->charUppercase)
                . str_repeat($this->specialSet, $this->charSpecial);
                // . str_repeat($this->danishSet, $this->charDanish);

        $charPool = str_shuffle($charPool);

        for ($i = 0; $i < $this->length; $i++) {
            $password[] = $charPool[rand(0, strlen($charPool) - 1)];
        }

        $password = implode('', $password);

        return $password;
    }
}

// udskriver password
$generator = new PasswordGenerator(20, 5, 5, 5, 5);
$password = $generator->generate();

echo "Dette er dit password: $password";

?>
