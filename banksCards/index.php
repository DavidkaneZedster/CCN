<?php
    // input card number, 14 81 99 - Daron(14s), 4 / 51-55 - VISA / MasterCard(16s), 50 56 57 58 63 67 - Maestro(18s)
    $cardNumber = ''; // your card number
    $cardNumberReplace = strrev(str_replace(' ', '', "$cardNumber")); // removing spaces and reversing the card number
    $cardNumberCharactersAccess = array('1' => 14, 16, 18); // possible length of the card number
    $access = 0; // access for verification
    $firstCardNumbers = str_replace(' ', '', substr($cardNumber, 0, 2)); // the first two symbols of the card number

        echo 'Your card number => ' . $cardNumber . "<br><br>";

    function validationCreditCard($cardNumberReplace): bool { // function for checking the correctness of the card number
        $sum = 0;
        for ($i = 0, $j = strlen($cardNumberReplace); $i < $j; $i++) {
            if (($i % 2) == 0) {
                $value = $cardNumberReplace[$i];
            } else {
                $value = $cardNumberReplace[$i] * 2;
                if ($value > 9) {
                    $value -= 9;
                }
            }
            $sum += $value;
        }
        return (($sum % 10) == 0);
    }

    // checking card number
    $cardNumberCharacters = strlen($cardNumberReplace);

    foreach ($cardNumberCharactersAccess as $key => $elem) {
        echo "Checking with the $key card... =>  ";
        if ($cardNumberCharacters != $cardNumberCharactersAccess[intval($key)]) {
            echo "$key access denied, <br>";
        } else {
            echo "access is allowed, ok, go next. <br>";
            $access = 1;
            break;
        }
    }

    // access to show
    if ($access < 1) {
        exit("<br>Access denied!");
    }

    // validation card
    if (!validationCreditCard($cardNumberReplace)) {
        echo "<br>" . "Your card number ($cardNumber) is incorrect." . "<br>" ;
    } else {
        echo "<br>" . "Your card number ($cardNumber) is correct." . "<br>";
    }

    // checking the card (spaces for readability)
    if ($cardNumberCharacters > 13 && $cardNumberCharacters < 15) {
        if ($firstCardNumbers == 14 || $firstCardNumbers == 81 || $firstCardNumbers == 99) {

            echo "<br>" . $cardNumber . ' => is Daron Credit Card';

        } else {

            echo "<br>" . 'Undefined card.';

        }
    }

    if ($cardNumberCharacters > 15 && $cardNumberCharacters < 17) {
        if ($firstCardNumbers > 50 && $firstCardNumbers < 56) {

            echo "<br>" . $cardNumber . ' => is MasterCard';

        } else if ($firstCardNumbers > 39 && $firstCardNumbers < 50) {

            echo "<br>" . $cardNumber . ' => is Visa Card';

        } else {

            echo "<br>" . 'Undefined card.';

        }
    }

    if ($cardNumberCharacters > 17 && $cardNumberCharacters < 19) {
        if ($firstCardNumbers > 55 && $firstCardNumbers < 59) {

            echo "<br>" . $cardNumber . ' => is Maestro Card ';

        } else if ($firstCardNumbers == 50) {

            echo "<br>" . $cardNumber . ' => is Maestro Card ';

        } else if ($firstCardNumbers == 63 || $firstCardNumbers == 67) {

            echo "<br>" . $cardNumber . ' => is Maestro Card ';

        } else {

            echo "<br>" . 'Undefined card.';

        }
    }