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
            <a href="BossPage.php">Home</a>
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

        include_once 'connection.php';

        $sql = 'SELECT * FROM admin'; // Vi sender sql-spørringer om å hente alt fra tabellen "admin" i databasen.
        $result = $db->query($sql);

        if (isset ($_GET['delete_id'])) { // En if-statement som sjekker om lenken delete_id er satt om det er det skal følgende kode kjøres:
            $delete_id = (int) $_GET['delete_id']; // variabel som sender id til samme side i URL med parameter "delete id"
            $deletesql = "DELETE FROM admin WHERE id = '$delete_id'"; // Variabel som sletter id fra tabellen "product" i databasen hvor id er det sammen som den id i URL-en.
            $deleteresult = $db->query($deletesql);

            header("Location: ./ShowUsers.php"); // Når delete-lenken blir trukket skal nett-siden refreshe, slik at den produkten som blir slettet skal bli borte fra siden. 
            exit();
        }
            
        // Her er tabellen som skal vise alle feltene i databasen vår.
        echo "<table>
        <tr>
        <th>Id</th>
        <th>AdminID</th>
        <th>Email</th>
        <th>Password</th>
        <th>Navn</th>
        <th>Status</th>
        <th>Delete</th>
        <th>Last login</th>
        </tr>";
        
        // Vi lager en foreach loop som gjør om variabelen resultat om til row. For hver gang et bruker blir lagt til vil foreach loopen gjøre at tabellen oppdateres.
        foreach ($result as $row){
            echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['AdminID']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['password']."</td>";
                echo "<td>".$row['Navn']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "<td><a href=\"?delete_id={$row['id']}\"\>Delete row</a></td>";
                echo "<td>".$row['LastLogin']."</td>";
        }
    ?>
</div>
</body>
</html>