<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>EditFAQ</title>
</head>
<body>
<?php
        session_start();
        if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
            header("Location:Login.php");
            die();
        }

        include_once 'headerUser-Admin.php';

        $question = ''; 
        $answer = ''; 

        include_once 'connection.php';

        if(isset ($_GET['Edit'])) { 
        $Edit = (int) $_GET['Edit']; 
        $sql = "SELECT * FROM faq WHERE id = '$Edit'"; 
        $result = $db->query($sql);

        foreach ($result as $row){
        $question = $row['Question'];
        $answer = $row['Answer'];

        echo $row['Question'];
        echo $row['Answer'];
        }
        }

    if(isset($_POST['display'])) {
        $ok = true;
            
        if(!isset($_POST['Question']) || $_POST['Question'] == '') {
        $ok = false;
        } else {
        $question = $_POST['Question'];
        }
        
        if(!isset($_POST['Answer']) || $_POST['Answer'] == '') {
        $ok = false;
        } else {
        $answer = $_POST['Answer'];
        }

        $sql = "UPDATE faq SET Question = '$question', Answer = '$answer'  WHERE id = '$Edit'";
        $result = $db->query($sql);

        header("Location: ./AdminFaq.php");
        exit();
        
    }
    ?>

    <div class="Input">
        <h1>Edit Question:</h1>
        <br>
        <form action="" method="post" autocomplete="off">
            <textarea class="Inputtext" type="text" id=""><?php echo $question; ?></textarea>
            <textarea class="Inputtext" placeholder="Answer..." type="text" id=""><?php echo $answer; ?></textarea>
            <br>
            <input type="submit" id="submit" name="display" value="Display">
        </form>
    </div>

</body>
</html>
</body>
</html>
