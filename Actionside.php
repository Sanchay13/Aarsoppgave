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
                <a href="AdminForside.php">Home</a>
                <a href="VisAlleProdukter.php">Show products</a>
                <a href="SearchProducts.php">Search products </a>
                <a href="LeggTilProdukt.php">Add products</a>
                <a href="logut.php">Log out</a>
            </div>
    </nav>

<?php
session_start();
if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
    header("Location:Login.php");
    die();
}

    include_once 'connection.php';

    $sql = 'SELECT * FROM product'; // Sql spørring som henter alt fra tabellen "product" i databasen
    $result = $db->query($sql);

    if (isset($_POST['Sub'])) { // Hvis "button" med name "Sub" blir trykket skal følgende kode kjøres:
    $search = mysqli_real_escape_string($db, $_POST['search']); // Dette er en variabel som passer på at det jeg søker på i Sql ikke er farlig kode (Det hindrer SQL injections)
    $sql = "SELECT * FROM product WHERE Navn LIKE '%$search%'"; // Sql-spørring som henter alt fra tabellen "product" i databasen og sjekker om feltet Navn er lik søke resultatet mitt i input-feltet.
    $result = $db->query($sql); // Dette sender inn resultat i SQl.
    $queryResult = mysqli_num_rows($result); // msqli_num_rows returnerer nummeren av raden i et resultat set. (Antall rows)
    
    echo "<div class=\"txt\">";
    echo "<h1>There are ".$queryResult." results matching your search!</h1>";
    echo "</div>";
    }

            if (isset ($_GET['delete_id'])) { // En if-statement som sjekker om lenken delete_id er satt om det er det skal følgende kode kjøres:
            $delete_id = (int) $_GET['delete_id']; // variabel som sender id til samme side i URL med parameter "delete id"
            $deletesql = "DELETE FROM product WHERE id = '$delete_id'"; // Variabel som sletter id fra tabellen "product" i databasen hvor id er det sammen som den id i URL-en.
            $deleteresult = $db->query($deletesql);

            header("Location: ./VisAlleProdukter.php"); // Når delete-lenken blir trukket skal nett-siden refreshe, slik at den produkten som blir slettet skal bli borte fra siden. 
            exit();
        }

    if ($queryResult > 0){ // if-statement som sier at hvis det er fler enn 0 rader, så skal følgende kode kjøres: 
        echo "<div id=\"Productlist1\">";
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Price</th>";
        echo "<th>Details</th>";
        echo "<th>Edit</th>";
        echo "<th>Delete</th>";
        echo "</tr>";
        
        while($row = mysqli_fetch_assoc($result)){ // en loop som vil fortsette til det er ingen flere rader i resultatet som er returnert fra Mysql databasen.
            echo "<tr>";
            echo "<td>";
            echo $row['Navn'];
            echo "</td>";
            echo "<td>";
            echo $row['Pris'];
            echo "</td>";
            echo "<td>";
            echo $row['Detaljer'];
            echo "<td><a href=\"edit.php?Edit={$row['ID']}\"\>Edit</a></td>";
            echo "<td><a href=\"?delete_id={$row['ID']}\"\>Delete row</a></td>";
            echo "</td>";
            echo "</tr>";
        } 
        
        echo "</table>";
        echo "</div>";
    }
    ?>
</body>
</html>