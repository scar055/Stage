<?php
    //<?= ($method == "visa") ? "selected" : "" >
    $aantal = $_POST["aantal"];
   if (isset($_POST["student"])){
        $korting = $_POST["student"];
   }
   else{
       $korting = null;
   }
    if (isset($_POST["klant"])){
        $klant = $_POST["klant"];
    }
    else{
        $klant = null;
    }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>lab 10</title>
    <style>
        .a{
            font-size: 20px;
        }
        .album{
            clear:left;
            width: 100%;
        }
        .omslag{
            float: left;
        }
        .gegevens{
            float: left;
            padding-left: 20px;
        }
        .korting{
            clear: left;
        }
        .aantal{
            background-color: #f8ce6c;
        }
    </style>
</head>
<body style="font-family: Verdana; font-size: 9px;">
<h3>Mijn winkelmandje</h3>
<form name="albums" action="" method="post">
    <div class="album">
        <div class="omslag">
            <img src="img/evora.jpg" width="50px" alt="X">
        </div>
        <div class="gegevens">
            <p>'Cesario Evora "Em um Concerto" Prijs: $9'</p>
            <input type="hidden" name="albumcode[0]" value="001">
            <input type="hidden" name="artiest[0]" value="Cesaria Evora ">
            <input type="hidden" name="prijs[0]" value="9">
            <input type="hidden" name="genre[0]" value="World">
            <br>
            <p>Aantal:</p>
            <input type="text" size=2 maxlength=3 name="aantal" class="aantal" value="0">
        </div>
    </div>
    <div class="korting">
        <br><hr><p>Korting:</p><br>
        <input type="checkbox" name="student" value="15">
        <p>Student: 15%</p><br>
        <input type="checkbox" name="klant" value="10">
        <p>Klant: 10%</p><br>
        <input type="submit" width="300px" name="verzenden" value="Bestellen">
    </div>
    <div class="a">bestelde albums:<?=$aantal?></div>
    <div class="a">korting is: <?=$korting + $klant?></div>
</form>

</body>
</html>
