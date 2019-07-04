<?php
    include ("includes/globals_constants.php");
    include("includes/functions.php");

    $message = null;
    $error_melding = null;
    $gebruikers = [];
    $username = null;
    $password = null;

    if(isset($_POST['submit'])) {
        upload("fotobestand",$message);
        $message = sprintf("<div>%s</div>",$message);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $foto = $_FILES["fotobestand"]["name"];
        // ga eerst de bestaande gebruikers inlezen
        if(file_exists(DBUSERS)) {
            $user_exist = false;
            $gebruikers = json_decode(file_get_contents(DBUSERS),true);
            // controle of gebruiker bestaat
            foreach($gebruikers as $value) {
                // controle hier...
                if($username === $value['username']) {
                    // user is found
                    $user_exist = true;
                    $error_melding = sprintf("<div>User %s bestaat reeds</div>",$username);
                    break;
                }
            }
            if(!$user_exist) {
                // user toevoegen aan bestaanden users
                if(addUser($gebruikers,$username,$password,$foto)) {
                    $error_melding = sprintf("User j%s added",$username);
                    header("location: login.php?lastuser=$username");
                }
                else {
                    $error_melding = sprintf("User %s NOT added",$username);
                }
            }
        }
        else {
            // bestand bestaat niet, nieuwe user aanmaken dus
            if(addUser($gebruikers,$username,$password,$foto)) {
                $error_melding = sprintf("User %s added",$username);
            } else {
                $error_melding = sprintf("User %s NOT added",$username);
            }
        }
    }

    function addUser($gebruikers,$newusername,$newpassword,$foto) {
        $user = [
            "username"=>$newusername,
            "password"=>password_hash($newpassword,PASSWORD_DEFAULT),
            "foto" => $foto
        ];
        array_push($gebruikers,$user);
        if (file_put_contents(DBUSERS,json_encode($gebruikers,JSON_PRETTY_PRINT))) {
            return true;
        }
        return false;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog - User aanmelden</title>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Inloggen</a></li>
        <li><a href="registreren.php">Aanmelden</a></li>
    </ul>
<div id="container">
    <form class="inputs" name="frm_aanmelden" enctype="multipart/form-data" method="post" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return checkform(this)">
        <input type="text" required name="username" placeholder="username">
        <input type="password" id="p1" required name="password" placeholder="password">
        <input type="password" id="p2" required name="password_repeat" placeholder="repeat password">
        <input class="inputfile" type="file" name="fotobestand">
        <input class="button" type="submit"  name="submit" value="registreren">
    </form>
</div>
<?=$error_melding?>
<?=$message?>
</body>
</html>