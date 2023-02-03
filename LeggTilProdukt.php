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
<?php
    include_once 'headerAnsatt.php';
?>
        
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
    session_start();
    if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
        header("Location:Login.php");
        die();
    }

    $_name = ''; // variabler 
    $_price = '';
    $_productdetails = '';
    $_Picture = '';

    if(isset($_POST['save'])) { // Hvis button med navnet "save" har blitt trukket skal variablen "ok" bli satt til true.
        $ok = true;

        if(!isset($_POST['navn']) || $_POST['navn'] == '') { // Deretter kjører vi if-statements som sjekker om inputfeltene navn, pris og detaljer ikke er satt eller tom, hvis det er det skal variablen "ok" settes til false ellers skal de ulike elementene bli satt i variablene de tilhører.
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
        
        if($ok){ // Hvis variablen "ok" er true skal det lages en connection med databasen, der vi legger til nye elementene i mysql tabellen der Navn, Pris og Detaljer erstattes med de variablene som ble satt i koden ovenfor.

            include_once 'connection.php';

            $sql = "INSERT INTO product (Navn, Pris, Detaljer) VALUES ('$_name', '$_price', '$_productdetails');";
            
            $db->query($sql);

            $db->close();
        } else { 
        ?>
        <div class="errormld"> <!--Hvis variablen "ok" er satt til false skal det komme følgende error melding.-->
            <p>Error, your product has not been saved. Be sure that all inputfields are filled!</p>
        </div>

        <?php
        }

    }   
?>
</div>


</body>
</html>

