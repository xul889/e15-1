<?php
session_start();

require 'StringProcessor.php';

# Extract our form data
$inputString = $_POST['inputString'];

# Instantiate new StringProcessor object
$stringProcessor = new StringProcessor($inputString);

# Process the word, storing the results in the session
$_SESSION['results'] = [
    'inputString' => $inputString,
    'isBigWord' => $stringProcessor->isBigWord($inputString),
    'isPalindrome' => $stringProcessor->isPalindrome($inputString),
    'vowelCount' => $stringProcessor->getVowelCount($inputString),
];

# Redirect back to the index page to show the form and results
header('Location: index.php');