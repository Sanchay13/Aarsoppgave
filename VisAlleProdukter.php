<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Show products</title>
</head>
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

<div id="Productlist">
    <?php
        session_start();
        if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
            header("Location:Login.php");
            die();
        }

        $db = new mysqli(  // Lager connection med databasen
            'localhost',
            'root',
            '',
            'kantine');

        $sql = 'SELECT * FROM product'; // Vi sender sql-spørringer om å hente alt fra tabellen "product" i databasen.
        $result = $db->query($sql);

        if (isset ($_GET['delete_id'])) { // En if-statement som sjekker om lenken delete_id er satt om det er det skal følgende kode kjøres:
            $delete_id = (int) $_GET['delete_id']; // variabel som sender id til samme side i URL med parameter "delete id"
            $deletesql = "DELETE FROM product WHERE id = '$delete_id'"; // Variabel som sletter id fra tabellen "product" i databasen hvor id er det sammen som den id i URL-en.
            $deleteresult = $db->query($deletesql);

            header("Location: ./VisAlleProdukter.php"); // Når delete-lenken blir trukket skal nett-siden refreshe, slik at den produkten som blir slettet skal bli borte fra siden. 
            exit();
        }
            
        // Her er tabellen som skal vise alle produkter i databasen vår.
        echo "<table>
        <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Details</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>";
        // Vi lager en foreach loop som gjør om variabelen resultat om til row. For hver gang et produkt blir lagt til vil foreach loopen gjøre at tabellen oppdateres.
        foreach ($result as $row){
            echo "<tr>";
                echo "<td>".$row['Navn']."</td>";
                echo "<td>".$row['Pris']."</td>";
                echo "<td>".$row['Detaljer']."</td>";
                echo "<td><a href=\"edit.php?Edit={$row['ID']}\"\>Edit</a></td>";
                echo "<td><a href=\"?delete_id={$row['ID']}\"\>Delete row</a></td>";
        }
    ?>
</div>

</body>
</html>