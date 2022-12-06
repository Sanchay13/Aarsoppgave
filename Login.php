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
            '10.2.2.183',
            'root',
            '',
            'kantine');

            if(isset($_POST['Login'])){ // Hvis login er trukket skal følgende kode kjøres: 
                $username = mysqli_real_escape_string($db, $_POST['username']); // Hindrer sql injections
                $password = mysqli_real_escape_string($db, $_POST['password']);

                $sql = "SELECT * FROM admin WHERE AdminID = '$username';";
                $result = mysqli_query($db, $sql);
                if($result -> num_rows > 0){ // Hvis det er flere enn null rader skal følgende skje: 
                    while($row = $result -> fetch_assoc()){
                        session_start(); // Starter session 
                        $Navn = $row['Navn'];
                        $dbPwd = $row['password'];
                        $_SESSION['Username'] = $Navn; // Lager session for brukernavn slik at jeg kan bruke dette senere.
                        $checkedPwd = password_verify($password, $dbPwd); // Verifiserer hashed passord i input value med det som er lagret i databasen.
                        if ($checkedPwd === true){ // Hvis passord er korrket skal følgende kode kjøres
                            $_SESSION['logon'] = true;
                            $admin = $row['status'];
                        if($admin == 1){ // Hvis admin value er 1 skal den gå til bruker-administrasjonsiden 
                            header('Location: BossPage.php');
                        } else if($admin == 0){ // Hvis den er 0 skal den til ansatte sin admin side.
                            header('Location: AdminForside.php');
                        }
                        } else if($checkedPwd === false){ // Hvis passordet er feil skal errormld dukke opp
                        ?>
                        <div class="errormld">
                        <p>Wrong username/password combination.</p>
                        </div>
                    <?php
                        }
                    }
                }
            }
            ?>
            
                    

