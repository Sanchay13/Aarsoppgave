<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Product</title>
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
        
    <div class="Input">
        <h1>Add product:</h1>
        <br>
        <form action="" method="post" autocomplete="off">
            <!-- <input class="Inputtext" name="textfield" type="file" placeholder="upload file" name="filefield"> -->
            <input class="Inputtext" placeholder="Name" type="text" name="navn" id="">
            <input class="Inputtext" placeholder="Price" type="number" name="pris" id="">
            <textarea class="Inputtext" placeholder="Productdetails" type="text" name="details" id=""></textarea>
            <br>
            <input type="submit" id="submit" name="save" value="Save">
        </form>
    </div>


<div class="AddProduct">
<?php
    $_name = '';
    $_price = '';
    $_productdetails = '';
    $_Picture = '';

    if(isset($_POST['save'])) {
        $ok = true;

        if(!isset($_POST['navn']) || $_POST['navn'] == '') {
            $ok = false;
        } else {
            $_name = $_POST['navn'];
        }

        if(!isset($_POST['pris']) || $_POST['pris'] == '') {
            $ok = false;
        } else {
            $_price = $_POST['pris'];
        }

        if(!isset($_POST['details']) || $_POST['details'] == '') {
            $ok = false;
        } else {
            $_productdetails = $_POST['details'];
        }
        
        if($ok){
            $host = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "kantine";

            $db = new mysqli($host, $dbusername, $dbpassword, $dbname);

            $sql = "INSERT INTO product (Navn, Pris, Detaljer) VALUES ('$_name', '$_price', '$_productdetails');";
            
            $db->query($sql);

            $db->close();
        } else { 
        ?>
        <div class="errormld">
            <p>Error, your product has not been saved. Be sure that all inputfields are filled!</p>
        </div>

        <?php
        }

    }   
?>
</div>


</body>
</html>

