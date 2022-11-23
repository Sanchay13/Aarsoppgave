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
        $navn = '';
        $pris = '';
        $detaljer = '';
        $Edit = '';

            $db = new mysqli(
                'localhost',
                'root',
                '',
                'kantine');

                if (isset ($_GET['Edit'])) {
                    $Edit = (int) $_GET['Edit'];
                    $sql = "SELECT * FROM product WHERE id = '$Edit'";
                    $result = $db->query($sql);

                    foreach ($result as $row){
                            
                            $navn = $row['Navn'];
                            $pris = $row['Pris'];
                            $detaljer = $row['Detaljer'];
                            
                            echo $row['Navn'];
                            echo $row['Pris'];
                            echo $row['Detaljer'];
                    }
                }

                if(isset($_POST['save'])) {
                    $ok = true;
            
                    if(!isset($_POST['navn']) || $_POST['navn'] == '') {
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

                    $sql = "UPDATE product SET Navn = '$navn', Pris = '$pris', Detaljer = '$detaljer'  WHERE id = '$Edit'";
                    $result = $db->query($sql);

                    header("Location: ./VisAlleProdukter.php");
                    exit();
                    
                }

                    
    ?>
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