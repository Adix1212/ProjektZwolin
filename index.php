<?php
    session_start();
    if((isset($_SESSION['log_in'])) && ($_SESSION['log_in']==true))
    {
        header('Location: magpack.php');
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
<form action="login.php" method="post">
<div class="container">
<div class="name">
    <a>MagPack</a>
</div>
<label class="login">Login :</label>
<input class="username" name="login" type="text" value="" placeholder="Login/E-mail">

<label class="password">Hasło :</label>
<input class="userpassword" name="password" type="password" placeholder="Hasło">

<input class="register" type="button" onclick="location.href='register.php'" value="Utwórz konto" >
<input class="log-in" type="submit" value="Zaloguj" >
</form>
<?php
    if(isset($_SESSION['log_error']))
    {
    echo $_SESSION['log_error'];
    }
    if(isset($_SESSION['register_success']))
    {
        echo '<div class="error register-success">Rejestracja przeszła pomyślnie</div>';
        unset($_SESSION['register_success']);
    }
?>
</div>
</body>
</html>
<?php
require_once "dbconnect.php";
?>
