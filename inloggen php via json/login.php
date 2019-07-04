<?php
    // gebruik maken van sessions..
    if(!isset($_SESSION)) session_start();

    if(isset($_POST['submit'])) {
        $users = json_decode(file_get_contents("user/user.json"));
        $loggedin = false;

        foreach ($users as $user){
            if($user->username == $_POST['username'] && password_verify($_POST["password"] ,$user->password)) {
                // user bestaat en ww correct
                $_SESSION['sessionid'] = session_id();
                $_SESSION['username'] = htmlspecialchars($_POST['username']);
                $loggedin = true;
                break;
            }
        }
        if (!$loggedin){
            unset($_SESSION["sessionid"]);
            unset($_SESSION["username"]);
        }
        header("location: index.php");
   }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Inloggen</a></li>
        <li><a href="registreren.php">Aanmelden</a></li>
    </ul>
    <form class="inputs" method="post" action="login.php">
        <input  type="text" required name="username" placeholder="username">
        <input type="password" required name="password" placeholder="password">
        <input class="button" type="submit" name="submit" value="inloggen">
    </form>
</body>
</html>