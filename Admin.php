<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add admin</title>
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
        
    <div class="Input">
        <h1>Add Admin-user:</h1>
        <br>
        <form action="" method="post" autocomplete="off">
            <input class="Inputtext" placeholder="AdminID" type="text" name="AdminID" id="">
            <input class="Inputtext" placeholder="Password" type="password" name="password" id="">
            <input class="Inputtext" placeholder="Email" type="email" name="Email" id="">
            <input class="Inputtext" placeholder="Navn" type="text" name="Navn" id="">
            <input class="Inputtext" placeholder="AdminValue" type="number" name="Value" id="">
            
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

    $_AdminID = ''; // variabler 
    $_password = '';
    $_email = '';
    $_Navn = '';

    if(isset($_POST['save'])) { // Hvis button med navnet "save" har blitt trukket skal variablen "ok" bli satt til true.
        $ok = true;

        if(!isset($_POST['AdminID']) || $_POST['AdminID'] == '') { // Deretter kjører vi if-statements som sjekker om inputfeltene AdminID, password, email og navn ikke er satt eller tom, hvis det er det skal variablen "ok" settes til false ellers skal de ulike elementene bli satt i variablene de tilhører.
            $ok = false;
        } else {
            $_AdminID = $_POST['AdminID'];
        }

        if(!isset($_POST['password']) || $_POST['password'] == '') {
            $_password = false;
        } else {
            $_password = $_POST['password'];
        }

        if(!isset($_POST['Email']) || $_POST['Email'] == '') {
            $ok = false;
        } else {
            $_email = $_POST['Email'];
        }

        if(!isset($_POST['Navn']) || $_POST['Navn'] == '') {
            $ok = false;
        } else {
            $_Navn = $_POST['Navn'];
        }

        if(!isset($_POST['Value']) || $_POST['Value'] == '') {
            $ok = false;
        } else {
            $_Value = $_POST['Value'];
        }
        
        if($ok){ // Hvis variablen "ok" er true skal det lages en connection med databasen, der vi legger til nye elementene i mysql tabellen der AdminID, Password, email og Navn erstattes med de variablene som ble satt i koden ovenfor.
            $host = "100.11.10.2";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "kantine";

            $db = new mysqli($host, $dbusername, $dbpassword, $dbname);

            $Hashedpwd = password_hash($_password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO admin (AdminID, password , email, Navn, status ) VALUES ('$_AdminID', '$Hashedpwd', '$_email', '$_Navn', '$_Value');";
            
            $db->query($sql);

            $db->close();

            header("Location: ./ShowUsers.php");
            exit();
        } else { 
        ?>
        <div class="errormld"> <!--Hvis variablen "ok" er satt til false skal det komme følgende error melding.-->
            <p>Error, user has not been saved. Be sure that all inputfields are filled!</p>
        </div>

        <?php
        }

    }   
?>
</div>


</body>
</html>
</body>
</html>