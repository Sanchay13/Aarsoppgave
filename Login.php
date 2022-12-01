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

            if(isset($_POST['Login'])){
                $username = mysqli_real_escape_string($db, $_POST['username']);
                $password = mysqli_real_escape_string($db, $_POST['password']);

                $sql = "SELECT * FROM admin WHERE AdminID = '$username';";
                $result = mysqli_query($db, $sql);
                if($result -> num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                        session_start();
                        $Navn = $row['Navn'];
                        $dbPwd = $row['password'];
                        $_SESSION['Username'] = $Navn;
                        $checkedPwd = password_verify($password, $dbPwd);
                        if ($checkedPwd === true){
                            $_SESSION['logon'] = true;
                            $admin = $row['status'];
                        if($admin == 1){
                            header('Location: BossPage.php');
                        } else{
                            header('Location: AdminForside.php');
                        }
                        } else if($checkedPwd === false){
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
            

        <!-- //         $query = "SELECT * FROM admin WHERE AdminID='$username' AND password='$password'"; //Henter alt fra tabellen "admin" der adminID = username variablen og password er password variablen.
        //         $results = mysqli_query($db, $query);

        //         if (mysqli_num_rows($results) == 1) { // Hvis brukernavn og passord matcher det som er i databasen skal session starte og logon skal bli satt til true.
        //             session_start();
        //             $_SESSION['logon'] = true;
        //             header('Location: AdminForside.php');
        //             die();
        //         }  else { // ellers skal følgende feilmelding dukke opp.
        //             ?>
        //             <div class="errormld">
        //             <p>Wrong username/password combination. Forgotten password? Please contact the main administrator</p>
        //         </div>
        
        //
        //         } 
        //     } -->
                    

