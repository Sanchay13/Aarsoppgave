<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Product</title>
</head>
<body>
    <nav>
            <div class="container">
            <h1>Kuben kantine</h1>

            <div class="menu">
                <a href="AdminForside.html">Home</a>
                <a href="VisAlleProdukter.php">Show products</a>
                <a href="SearchProducts.php">Search products </a>
                <a href="LeggTilProdukt.php">Add products</a>
                <a href="index.html">Log out</a>
            </div>

            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            </div>
    </nav>

    <div class="Input">
            <h1>Search after products:</h1>
            <br>
            <form action="Actionside.php" method="post" autocomplete="off">
                <input class="Inputtext" placeholder="Search..." type="text" name="search" required>
                <br>
                <input type="submit" id="submit" name="Sub" value="Submit">
            </form>
    </div>
    

</body>
</html>