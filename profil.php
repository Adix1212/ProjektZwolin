<?php
    session_start();
    if(!isset($_SESSION['log_in']))
    {
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="PL=pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekt Magazyny</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
</head>
<body>
<header>   
        <div class="logo" onclick="location.href='magpack.php'"><p>MagPack</p></div> 
        <div class="welcome"><p>Witaj <?php echo $_SESSION['name']?></p></div>
        <div class="profil" onclick="location.href='profil.php'"><p>Pokaż Profil</p></div>
        <div class=""></div>
        <div class="logout" onclick="location.href='logout.php'"><p>Wyloguj się</p></div>
</header>
<div class="container-3">
    <div class="name-1"><p>Imię:</p></div>
    <div class="name-2"><p><?php echo $_SESSION['name']?></p></div>
    
    <div class="last-name-1"><p>Nazwisko:</p></div>
    <div class="last-name-2"><p><?php echo $_SESSION['last_name']?></p></div>

    <div class="phone-1"><p>Telefon:</p></div>
    <div class="phone-2"><p><?php echo "+48 ".$_SESSION['phone']?></p></div>

    <div class="email-1"><p>Email:</p></div>
    <div class="email-2"><p><?php echo $_SESSION['email']?></p></div>

    <div class="position-1"><p>Rola:</p></div>
    <div class="position-2"><p><?php echo $_SESSION['position'];
    if(isset($_SESSION['reward']))
    {
        echo " ".$_SESSION['reward']."zł";
    }
    ?></p></div>
</div>
</body>
</html>