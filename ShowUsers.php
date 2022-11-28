<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Show all admin-users</title>
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
            <a href="Admin.php">Add-users</a>
            <a href="ShowUsers.php">All-users</a>
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

        $sql = 'SELECT * FROM admins'; // Vi sender sql-spørringer om å hente alt fra tabellen "admins" i databasen.
        $result = $db->query($sql);
            
        // Her er tabellen som skal vise alle produkter i databasen vår.
        echo "<table>
        <tr>
        <th>AdminID</th>
        <th>Email</th>
        <th>Navn</th>
        </tr>";
        
        // Vi lager en foreach loop som gjør om variabelen resultat om til row. For hver gang et produkt blir lagt til vil foreach loopen gjøre at tabellen oppdateres.
        foreach ($result as $row){
            echo "<tr>";
                echo "<td>".$row['AdminID']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['Navn']."</td>";
        }
    ?>
</div>
</body>
</html>