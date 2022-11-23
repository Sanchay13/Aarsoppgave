<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Vis Alle Produkter</title>
</head>
<body>

<nav>
        <div class="container">
        <h1>Kuben kantine</h1>

        <div class="menu">
            <a href="AdminForside.html">Home</a>
            <a href="VisAlleProdukter.php">Show products</a>
            <a href="SearchProducts.php">Search products</a>
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

<div id="Productlist">
    <?php
        $db = new mysqli( 
            'localhost',
            'root',
            '',
            'kantine');

        $sql = 'SELECT * FROM product';
        $result = $db->query($sql);

        if (isset ($_GET['delete_id'])) {
            $delete_id = (int) $_GET['delete_id']; //sender id til samme side i URL med parameter "delete id"
            $deletesql = "DELETE FROM product WHERE id = '$delete_id'";
            $deleteresult = $db->query($deletesql);

            header("Location: ./VisAlleProdukter.php");
            exit();
        }
            
        
        echo "<table>
        <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Details</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>";
        
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