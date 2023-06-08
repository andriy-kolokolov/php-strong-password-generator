<?php
/**
 * @throws Exception
 */
function generatePassword($length, $repetitive, $includeLetters, $includeNumbers, $includeSymbols): string
{
    // Define character sets
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()';

    // Create character pool based on selected options
    $pool = '';
    if ($includeLetters) {
        $pool .= $letters;
    }
    if ($includeNumbers) {
        $pool .= $numbers;
    }
    if ($includeSymbols) {
        $pool .= $symbols;
    }

    // Check if any input is null or empty
    if ($length === null || $length === '' || $pool === '') {
        return 'Invalid input';
    }

    // Generate the password
    $password = '';
    $poolLength = strlen($pool);
    for ($i = 0; $i < $length; $i++) {
        if ($repetitive) {
            // Allow repetitive characters
            $password .= $pool[random_int(0, $poolLength - 1)];
        } else {
            // Ensure unique characters
            $password .= $pool[$i % $poolLength];
        }
    }

    return $password;
}

function inputIsValid() {

}
