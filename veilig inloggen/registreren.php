<?php
    include"function.php";
    if(isset($_POST["submit"])){
        make($db);
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registreren</title>
</head>
<body>
    <h3>registreren</h3>
    <form name="register" action="" method="post">
        <div><input type="text" required name="username" placeholder="username"></div>
        <div><input type="password" required name="password" placeholder="password"></div>
        <div><input type="submit" name="submit" value="register"></div>
        <p>heb je al een acount <a href="inloggen.php">login</a></p>
    </form>
</body>
</html>
