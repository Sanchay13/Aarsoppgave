<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit</title>
</head>
<body>
    <?php
        session_start();
        if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
            header("Location:Login.php");
            die();
        }

        $navn = ''; // Variabler 
        $pris = '';
        $detaljer = '';
        $Edit = '';

            $db = new mysqli( // Database connection
                'localhost',
                'root',
                '',
                'kantine');

                if (isset ($_GET['Edit'])) { // En if-statement som sjekker om lenken edit.php er satt om det er det skal følgende kode kjøres:
                    $Edit = (int) $_GET['Edit']; // variabel som sender id til ny side i URL med parameter "Edit"
                    $sql = "SELECT * FROM product WHERE id = '$Edit'"; // Variabel som henter id fra tabellen "product" i databasen hvor id er det sammen som den id i URL-en.
                    $result = $db->query($sql);

                    foreach ($result as $row){ // For each loop som gjør om resultat som row 
                            
                            $navn = $row['Navn'];
                            $pris = $row['Pris'];
                            $detaljer = $row['Detaljer'];
                            
                            echo $row['Navn'];
                            echo $row['Pris'];
                            echo $row['Detaljer'];
                    }
                }

                if(isset($_POST['save'])) { // Hvis button med navnet "save" har blitt trukket skal variablen "ok" bli satt til true.
                    $ok = true;
            
                    if(!isset($_POST['navn']) || $_POST['navn'] == '') { // Deretter kjører vi if-statements som sjekker om inputfeltene navn, pris og detaljer ikke er satt eller tom, hvis det er det skal variablen "ok" settes til false ellers skal de ulike elementene bli satt i variablene de tilhører.
                        $ok = false;
                    } else {
                        $navn = $_POST['navn'];
                    }
            
                    if(!isset($_POST['pris']) || $_POST['pris'] == '') {
                        $ok = false;
                    } else {
                        $pris = $_POST['pris'];
                    }
            
                    if(!isset($_POST['details']) || $_POST['details'] == '') {
                        $ok = false;
                    } else {
                        $detaljer = $_POST['details'];
                    }

                    $sql = "UPDATE product SET Navn = '$navn', Pris = '$pris', Detaljer = '$detaljer'  WHERE id = '$Edit'"; // Denne koden oppdaterer de eksisterende innholdet i database tabellen.
                    $result = $db->query($sql);

                    header("Location: ./VisAlleProdukter.php"); // Sender deg til VisAlleProdukter filen, for at endringene skal vises.
                    exit();
                    
                }

                    
    ?>
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
        
    <div class="Input">
        <h1>Edit product:</h1>
        <br>
        <form action="" method="post" autocomplete="off">
            <input class="Inputtext" placeholder="Name" type="text" name="navn" id="" value="<?php echo $navn; ?>">
            <input class="Inputtext" placeholder="Price" type="number" name="pris" id="" value="<?php echo $pris; ?>">
            <textarea class="Inputtext" placeholder="Productdetails" type="text" name="details" id=""><?php echo $detaljer; ?></textarea>
            <br>
            <input type="submit" id="submit" name="save" value="Save">
        </form>
    </div>

</body>
</html>