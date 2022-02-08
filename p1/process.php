<?php

session_start();

$inputString = $_POST['inputString'];

# Palindrome processor
$isPalindrome = true;

# Big word processor
$length = strlen($inputString);
$isBigWord = $length > 10;

$_SESSION['results'] = [
    'inputString' => $inputString,
    'isBigWord' => $isBigWord,
    'isPalindrome' => $isPalindrome
];

# Redirect back to the form
header('Location: index.php');
