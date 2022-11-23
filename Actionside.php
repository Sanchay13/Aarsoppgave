<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Searched Products</title>
</head>
<body>
<nav>
            <div class="container">
            <h1>Kuben kantine</h1>

            <div class="menu">
                <a href="AdminForside.html">Home</a>
                <a href="VisAlleProdukter.php">Show products</a>
                <a href="SearchProducts.php">Search products </a>
                <a href="LeggTilProdukt.php">Add products</a>
                <a href="index.html">Log out</a>
            </div>

            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            </div>
    </nav>

<?php
    $db = new mysqli( 
    'localhost',
    'root',
    '',
    'kantine');

    $sql = 'SELECT * FROM product';
    $result = $db->query($sql);

    if (isset($_POST['Sub'])) {
    $search = mysqli_real_escape_string($db, $_POST['search']); 
    $sql = "SELECT * FROM product WHERE Navn LIKE '%$search%'";
    $result = $db->query($sql);
    $queryResult = mysqli_num_rows($result);
    
    echo "<div class=\"txt\">";
    echo "<h1>There are ".$queryResult." results matching your search!</h1>";
    echo "</div>";
    }

    if ($queryResult > 0){
        echo "<div id=\"Productlist1\">";
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Price</th>";
        echo "<th>Details</th>";
        echo "</tr>";
        
        while($row = mysqli_fetch_assoc($result)){ 
            echo "<tr>";
            echo "<td>";
            echo $row['Navn'];
            echo "</td>";
            echo "<td>";
            echo $row['Pris'];
            echo "</td>";
            echo "<td>";
            echo $row['Detaljer'];
            echo "</td>";
            echo "</tr>";
        } 
        
        echo "</table>";
        echo "</div>";
    }
    ?>
</body>
</html>