<?php

session_start();

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];

    $inputString = $results['inputString'];
    $isPalindrome = $results['isPalindrome'];
    $isBigWord = $results['isBigWord'];
    
    //extract($results);

    $_SESSION['results'] = null;
}

require 'index-view.php';