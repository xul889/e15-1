<!doctype html>
<html lang='en'>

<head>
    <title>Project 1</title>
    <meta charset='utf-8'>
    <link href=data: , rel=icon>
</head>

<body>
    <h1>Project 1</h1>

    <form method='POST' action='process.php'>

        <label for='inputString'>Enter a string:</label>
        <input type='text' name='inputString' id='inputString'>

        <button type='submit'>Process String</button>
    </form>

    <?php if (isset($inputString)) { ?>
    <ul>
        <li>String: <?php echo $inputString; ?>
        </li>
        <li>Is big word?
            <?php if ($isBigWord) { ?>
            Yes
            <?php } else { ?>
            No
            <?php } ?>
        </li>
        <li>Is palindrome?
            <?php if ($isPalindrome) { ?>
            Yes
            <?php } else { ?>
            No
            <?php } ?>
        </li>
    </ul>
    <?php } ?>
</body>

</html>