<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AdminFaq</title>
</head>
<body>
<div id="Productlist">
    <?php
        session_start();
        if (!$_SESSION['logon']){  // Hvis log on er lik false gå til login side
            header("Location:Login.php");
            die();
        }

        include_once 'headerUser-Admin.php';

        include_once 'connection.php';

        $sql = 'SELECT * FROM faq';
        $result = $db->query($sql);

        if(isset ($_GET['Delete'])) {
            $delete_id = (int) $_GET['Delete']; 
            $deletesql = "DELETE FROM faq WHERE id = '$delete_id'"; 
            $deleteresult = $db->query($deletesql);

            header("Location: ./AdminFaq.php");
            exit();
        }
            
        echo "<table>
        <tr>
        <th>Question</th>
        <th>Answer</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>";

        foreach ($result as $row){
            echo "<tr>";
                echo "<td>".$row['Question']."</td>";
                echo "<td>".$row['Answer']."</td>";
                echo "<td><a href=\"editfaq.php?Edit={$row['id']}\"\>Edit</a></td>";
                echo "<td><a href=\"?Delete={$row['id']}\"\>Delete row</a></td>";
        }
    ?>
</body>
</html>