<?php
    include"function.php";
    $msg = null;
    if(isset($_POST["submit"])){
        $msg = check($db);
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inloggen</title>
</head>
<body>
    <h3>inloggen</h3>
    <form name="register" action="" method="post">
        <div><input type="text" required name="username" placeholder="username"></div>
        <div><input type="password" required name="password" placeholder="password"></div>
        <div><input type="submit" name="submit" value="log in"></div>
        <p>heb je nog geen acount <a href="registreren.php">registreren</a></p>
        <p><?= $msg?></p>
    </form>
</body>
</html>
