<?php include_once 'connection.php';?>

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
<?php include_once 'headerUser-Admin.php'; ?>
        
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
        <div>simen</div>
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
            $adminDB = $_POST['AdminID'];
            $sqlAdminID = "SELECT * FROM admin WHERE AdminID = '$adminDB';";
            $resultAdminID = mysqli_query($db, $sqlAdminID);
            if($resultAdminID->num_rows > 0){
                $ok = false;
            }else {
                $_AdminID = $_POST['AdminID'];
            }
        }

        if(!isset($_POST['password']) || $_POST['password'] == '') {
            $_password = false;
        } else {
            $_password = $_POST['password'];
        }

        if(!isset($_POST['Email']) || $_POST['Email'] == '') {
            $ok = false;
        } else {
            $emailDB = $_POST['Email'];
            $sqlEmail = "SELECT * FROM admin WHERE email = '$emailDB';";
            $resultEmail = mysqli_query($db, $sqlEmail);
            if($resultEmail->num_rows > 0){
                $ok = false;
            }else {
                $_email = $_POST['Email'];
            }
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

            $Hashedpwd = password_hash($_password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO admin (AdminID, password , email, Navn, status ) VALUES ('$_AdminID', '$Hashedpwd', '$_email', '$_Navn', '$_Value');";
            
            $db->query($sql);

            $db->close();

            header("Location: ./ShowUsers.php");
            exit();
        } else { 
        ?>
        <div class="errormld"> <!--Hvis variablen "ok" er satt til false skal det komme følgende error melding.-->
            <p>Error, user has not been saved!</p>
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