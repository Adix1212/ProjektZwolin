<?php
    session_start();
    if(isset($_POST['login']))
    {
        $form=true;
        $position=$_POST['position'];
        if(!isset($_POST['position']))
        {
            $form=true;
            $_SESSION['e_position']="Wybierz opcje!";
        }       
                $login=$_POST['login'];
                if(ctype_alnum($login)==false)
                {
                    $form=false;
                    $_SESSION['e_login']="Login moze składac sie tylko z liter i cyfr (bez polskich znaków)!";
                }
                if((strlen($login)<3)||(strlen($login)>45))
                {
                    $form=false;
                    $_SESSION['e_login']="Login musi mieć od 3 do 45 znaków!";
                }
        $name=$_POST['name'];
        if(ctype_alnum($name)==false)
        {
            $form=false;
            $_SESSION['e_name']="Imię moze składac sie tylko z liter i cyfr (bez polskich znaków)!";
        }
        if((strlen($name)<3) || (strlen($name)>45))
        {
            $form=false;
            $_SESSION['e_name']="Imię musi mieć od 3 do 45 znaków!";
        }       
                $last_name=$_POST['last_name'];
                if(ctype_alnum($last_name)==false)
                {
                    $form=false;
                    $_SESSION['e_last_name']="Nazwisko moze składac sie tylko z liter i cyfr (bez polskich znaków)!";
                }                
                if((strlen($last_name)<3)||(strlen($last_name)>45))
                {
                    $form=false;
                    $_SESSION['e_last_name']="Nazwisko musi mieć od 3 do 45 znaków!";
                }
        $email=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if($email!=$_POST['email'])
        {
            $form=false;
            $_SESSION['e_email']="Podaj prawidłowy email!";
        }
        if($_POST['email']=="")
        {
            $form=false;
            $_SESSION['e_email']="Podaj email!";
        }
                if(ctype_alnum($_POST['password'])==true)
                {
                    $form=false;
                    $_SESSION['e_password']="Hasło musi zawierac przynajmnije 1 znak specjalny!";
                } 
                if((strlen($_POST['password'])<8) || (strlen($_POST['password'])>20))
                {
                    $form=false;
                    $_SESSION['e_password']="Hasło musi mieć od 8 do 20 znaków!";
                }
                $password_hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $phone=$_POST['phone'];
        if(strlen($phone)!=9)
        {
            $form=false;
            $_SESSION['e_phone']="Numer musi składać sie z 9 cyfr!";
        }          
                require_once "dbconnect.php";
                mysqli_report(MYSQLI_REPORT_STRICT);
                try{
                    $connect=new mysqli($host,$db_user,$db_pass,$db_name);
                    if($connect->connect_errno!=0)
                    {
                        throw new Exception(mysqli_connect_errno());
                    }
                    else
                    {
                        $requset=$connect->query("SELECT id FROM login WHERE email='$email'");
                        if(!$requset)
                        {
                            throw new Exception($connect->errno);
                        }
                        $num_rows=$requset->num_rows;
                        if($num_rows>0)
                        {
                            $form=false;
                            $_SESSION['e_email']="Podany e-mail juz istnieje!";
                        }

                        $requset=$connect->query("SELECT id FROM login WHERE login='$login'");
                        if(!$requset)
                        {
                            throw new Exception($connect->errno);
                        }
                        $num_rows=$requset->num_rows;
                        if($num_rows>0)
                        {
                            $form=false;
                            $_SESSION['e_login']="Podany login juz istnieje!";
                        }
                        if($form==true)
                        {
                            if($connect->query("INSERT INTO login VALUES (NULL,'$login','$password_hash','$email')"))
                            {  
                                $requset=$connect->query("SELECT id FROM login WHERE login='$login'");
                                if(!$requset)
                                {
                                    throw new Exception($connect->errno);
                                }
                                $loginid=mysqli_fetch_assoc($requset);
                                $login_id=$loginid['id'];
                                if($connect->query("INSERT INTO users VALUES (NULL,'$name','$last_name','$phone','$position','$login_id')"))
                                {
                                    $_SESSION['register_success']="true";
                                    header('Location: index.php');
                                }
                                else
                                {
                                    throw new Exception($connect->errno);
                                }

                            }
                            else
                            {
                                throw new Exception($connect->errno);
                            }
                        }
                        $connect->close();                   
                    }
                }
                catch(Exception $e)
                {
                    echo '<div class="e_create">Błąd serwera! Przepraszamy za niedogodnosci i prosimy o rejestracje w innym terminie!<br>
                    <span style="color:white;">'.$e.'</span>
                    </div>';
                }
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
<form method="post" action="">
<div class="container-register">
    <div class="name-logo">
    <a>MagPack</a>
</div>
    <?php
        if(isset($_SESSION['e_login']))
        {
            echo '<div class="register-login register-error">'.$_SESSION['e_login'].'</div>';
            unset($_SESSION['e_login']);
        }
        if(isset($_SESSION['e_name']))
        {
            echo '<div class="register-name register-error">'.$_SESSION['e_name'].'</div>';
            unset($_SESSION['e_name']);
        }
        if(isset($_SESSION['e_last_name']))
        {
            echo '<div class="register-last-name register-error">'.$_SESSION['e_last_name'].'</div>';
            unset($_SESSION['e_last_name']);
        }
        if(isset($_SESSION['e_password']))
        {
            echo '<div class="register-password register-error">'.$_SESSION['e_password'].'</div>';
            unset($_SESSION['e_password']);
        }
        if(isset($_SESSION['e_email']))
        {
            echo '<div class="register-email register-error">'.$_SESSION['e_email'].'</div>';
            unset($_SESSION['e_email']);
        }
        if(isset($_SESSION['e_phone']))
        {
            echo '<div class="register-phone register-error">'.$_SESSION['e_phone'].'</div>';
            unset($_SESSION['e_phone']);
        }
        if(isset($_SESSION['e_position']))
        {
            echo '<div class="register-position register-error">'.$_SESSION['e_position'].'</div>';
            unset($_SESSION['e_position']);
        }
    ?>
    <input type="text" placeholder="Imię" name="name" class="register-name register-place" >
    <input type="text" placeholder="Nazwisko" name="last_name" maxlength="45" class="register-last-name register-place">
    <input type="text" placeholder="Login" name="login" maxlength="45" minlength="3" class="register-login register-place" >
    <input type="passwprd" placeholder="Hasło" name="password" maxlength="45" class="register-password register-place" >
    <input type="email" placeholder="E-mail" name="email" maxlength="45" class="register-email register-place" >
    <input type="tel" pattern="[0-9]{9}" placeholder="Numer teleofou" name="phone" class="register-phone register-place" >
    <select name="position" class="register-position register-place" >
        <option disabled selected>Wybierz Role!</option>
        <option>Kupujący</option>
        <option>Sprzedawca</option>
    </select>
    <input type="submit" class="register-create register-place" value="Stwórz">
</form>
</div>
</body>
</html>