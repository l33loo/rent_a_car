<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HELLO WORLD 2</h1>
    <?php
        phpinfo();
        $dbh = new PDO('mysql:host=mysql;dbname=carrentals', 'root', 'secret');
        print_r($dbh);
    ?>
</body>
</html>