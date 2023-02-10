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
            <textarea class="Inputtext" placeholder="Question" type="text" name="Question" id=""></textarea>
            <br>
            <input type="submit" id="submit" name="send" value="Send">
        </form>
    </div>

    <br><br><br>

</body>
<script src="script.js"></script>
</html>