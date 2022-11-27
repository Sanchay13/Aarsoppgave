<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign up</title>
</head>
<body>
    <div class="Header">
        <h1>Sign up</h1>
    </div>
    
    <div class="skrivInn">
        <form method="post" action="connect.php" autocomplete="off">
            <br>
            <h1>Sign up :</h1>
            <br>
            <input class="Inputtext" type="text" placeholder="Username" name="username" required>
            <input class="Inputtext" type="number" placeholder="Tlf" name="Tlf" required>
            <input class="Inputtext" type="email" placeholder="Email" name="Email" required>
            <input class="Inputtext" type="password" placeholder="Password" name="password" required>
            <input class="Inputtext" type="password" placeholder="RepeatPwd" name="RepeatPassword" required>
            <br>
            <input type="submit" id="submit" value="Register">
            <br>
            <br>
            <a href="Login.html">Already have an existing account?</a>
    </div>
</body>
</html>