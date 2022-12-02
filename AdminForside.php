<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Front page</title>
</head>

<?php

session_start();
if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
    header("Location:Login.php");
    die();
}

?>
<body>
    <nav>
        <div class="container">
        <h1>Kuben kantine</h1>

        <div class="menu">
            <a href="AdminForside.php">Home</a>
            <a href="VisAlleProdukter.php">Show products</a>
            <a href="SearchProducts.php">Search products</a>
            <a href="LeggTilProdukt.php">Add products</a>
            <a href="logut.php">Log out</a>
        </div>
    </nav>

    <div class="con">
        <div class="innhold">
        <?php
        if (isset($_SESSION["Username"])){ // Hvis session username er satt, skal følgende setning vises på siden.
            echo "<h1>Welcome " . $_SESSION["Username"] ."! </h1>";
        }
        ?>
        </div>
    </div>
</body>
</html>