<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log in</title>
</head>
<body>
    <div class="Header">
        <h1>Log in</h1>
    </div>
    
    
    <div class="skrivInn">
        <form method="post" action="" autocomplete="off">
            <br>
            <h1>Log in Administrator :</h1>
            <br>
            <input class="Inputtext" type="text" placeholder="Admin-ID" name="username" id="Brukernavn" required>
            <input class="Inputtext" type="password" placeholder="Password" name="password" id="Passord" required>
            <br>
            <input type="submit" id="submit" name="Login" value="Log in">
        </div>
</body>
</html>

<?php
        $db = new mysqli(  // Lager connection med databasen
            'localhost',
            'root',
            '',
            'kantine');

            if (isset($_POST['Login'])) {
                $username = mysqli_real_escape_string($db, $_POST['username']); //Setter sql injections
                $password = mysqli_real_escape_string($db, $_POST['password']);

                // $Hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                // $db->query = ("INSERT INTO admin (AdminID, password) VALUES ('$username', $Hashedpwd'");

                    $query = "SELECT * FROM admin WHERE AdminID='$username' AND password='$password'"; //Henter alt fra tabellen "admin" der adminID = username variablen og password er password variablen.
                    $results = mysqli_query($db, $query);
                    
                    if (mysqli_num_rows($results) == 1) { // Hvis brukernavn og passord matcher det som er i databasen skal session starte og logon skal bli satt til true.
                        session_start();
                        $_SESSION['logon'] = true;
                        header('Location: AdminForside.php');
                        die();
                    }  else { // ellers skal følgende feilmelding dukke opp.
                        ?>
                        <div class="errormld">
                        <p>Wrong username/password combination. Forgotten password? Please contact the main administrator</p>
                    </div>
            
                    <?php
                    } 
                }
            
            ?>
