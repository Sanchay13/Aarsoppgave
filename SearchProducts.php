<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Search Products</title>
</head>
<body>
<?php
    include_once 'headerAnsatt.php';
?>

    <div class="Input">
            <h1>Search after products:</h1>
            <br>
            <form action="Actionside.php" method="post" autocomplete="off">
                <input class="Inputtext" placeholder="Search..." type="text" name="search" required>
                <br>
                <input type="submit" id="submit" name="Sub" value="Submit">
            </form>
    </div>
    
    <?php

    session_start();
    if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
        header("Location:Login.php");
        die();
    }

?>



</body>
</html>