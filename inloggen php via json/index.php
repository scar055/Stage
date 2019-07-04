<?php
    // gebruik maken van sessions…
    if(!isset($_SESSION)) session_start();

    $loggedin = false;

    if(isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id())  {
        // gebruiker is ingelogd
        $loggedin = true;
    }
    $js_output = null;

    if($loggedin) {
        $js_output = <<< JSBLOK
           <script>
                document.getElementById("loggedin").style.display="block";
            </script>
JSBLOK;
    }
    else {
        $js_output = <<< JSBLOK
        <script>
            document.getElementById("notloggedin").style.display="block";
        </script>
JSBLOK;
    }
    //blog deel
    define("BLOGDB","forum.json");
    // stappenplan
    // 1: lees de blog items
    // 2: maak van blog items HTML onderdelen
    // lees user in
    // 3: tonen blog items in pagina
    $blogdata = []; // placeholder for the blog elementen
    if (file_exists(BLOGDB)) {
        $blogdata = json_decode(file_get_contents(BLOGDB));
    }
    function show_blogs($items) {
        $result = [];
        foreach ($items as $item) {
            array_push($result, createArticleHTML($item));
        }
        return join($result,"");
    }
    function createArticleHTML($info){
        $datum = null;
        $foto = $info->foto;
        if ($d = date_parse($info->date)) {
            $datum = sprintf("%02d - %02d - %s", $d["day"], $d["month"], $d["year"]);
        }
        $blogitem = <<< MARKER
            <article> 
                <div><img alt="plaatje" class="profile-pic" src="$foto"></div> 
                <div>waneer: $datum</div> 
                <div>gemaakt door: $info->user</div> 
                <div>$info->note</div> 
            </article>
MARKER;
        return $blogitem;
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <ul class="nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Inloggen</a></li>
        <li><a href="registreren.php">Aanmelden</a></li>
    </ul>
<div class="post">
    <div id="loggedin">
        welkom je bent ingelogd
    </div>
    <div id="notloggedin">
        helaas je bent niet ingelogd
    </div>
    <?=show_blogs($blogdata)?>
    <?=$js_output?>
</div>
</body>
</html>