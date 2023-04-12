<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FAQ</title>
</head>
<body>
<?php include_once 'headerAnsatt.php'; ?>

<?php
    include_once 'connection.php';

    $sql = "SELECT * FROM faq;";
    $result1 = mysqli_query($db, $sql);
    if($result1 -> num_rows > 0){
    while($row = $result1->fetch_assoc()){
        $Question = $row['Question'];
        echo $Question;

        $Answer = $row['Answer'];
        echo $Answer;
    }
    }
?>
<section>
    <h1 class="title">FAQ's</h1>

    <div class="quest-con">
        
        <button class="question">
                <span>How to add users?</span>
        </button>

        <div class="question-content">
            <p>heisan</p>
        </div>

        <button class="question">
            <span>How to edit an existing product?</span>
        </button>
        
        <div class="question-content">
            <p>heisan</p>
        </div>
    </div>
</section>

<div class="arrowIMG">
    <a href="#Input">
    <img src="Årsoppgave_Bilde/arrow.png" alt="">
    </a>
</div>


    <div id="Input">
        <h1>Send questions:</h1>
        <br>
        <form action="" method="post" autocomplete="off">
            <textarea class="Inputtext" name="text" placeholder="Question" type="text" name="Question" id=""></textarea>
            <br>
            <input type="submit" id="submit" name="send" value="Send">
        </form>
    </div>

    <br><br><br>

    <?php
        session_start();
        if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
            header("Location:Login.php");
            die();
        }

        $_Quest = '';

        if(isset($_POST['send'])){
            $ok = true;
        
            if(!isset($_POST['text']) || $_POST['text'] == '') { 
                $ok = false;
            } else {
                $_Quest = $_POST['text'];
            }

        if($ok){
            if($ok){ 

                include_once 'connection.php';
    
                $sql = "INSERT INTO faq (Question) VALUES ('$_Quest');";
                
                $db->query($sql);
    
                $db->close();
        }

    }

    }

        ?>

</body>
<script src="script.js"></script>
</html>