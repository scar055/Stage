<?php
session_start();

$db = new mysqli("localhost", "root", "", "veilig inloggen");

function make ($db){
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['username'], $password);
    $stmt->execute();
    $stmt->close();

}
function check ($db){
    //$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows == 1){
        //echo $stmt->num_rows;
        while ($row = $result->fetch_assoc()) {
           if(password_verify($_POST['password'],$row["password"])) {
               $_SESSION ['session_id'] = session_id();
               header("location: geheim.php");
               return 'welkom je bent ingelogd';

           }
           else{
               return"wachtwoord is verkeerd";
           }
        }
    }
    else{
        return "user bestaat niet";
    }
}