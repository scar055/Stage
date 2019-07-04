<?php
include "function.php";
if(isset( $_SESSION["session_id"]) && $_SESSION["session_id"] == session_id()) {
}
else{
    header("location: inloggen.php");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>secrets</title>
</head>
<body>
<h3>welkom</h3>
</body>
</html>
