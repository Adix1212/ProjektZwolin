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
    <div class="container-2">
        <?php
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
                $requset=$connect->query("SELECT name,number,info,status,date_admission,date_shipment FROM orders as o INNER join status as s on(o.id=s.orderid) where userid='".$_SESSION['id']."'");
                if(!$requset)
                {
                    throw new Exception($connect->errno);
                }
                $num_rows=$requset->num_rows;
                if($num_rows<0)
                {
                    echo "Nie posiadasz zamówień";
                }
                else{
                    $requset=$requset->fetch_all(MYSQLI_ASSOC);
                    echo"<table><tr><th>Nazwa</th><th>Numer zamówienia</th><th>Info</th><th>Status</th><th>Data przyjęcia</th><th>Data dostarczenia</th></tr>";
                    foreach($requset as $key => $value){
                        echo "<tr><td>".$value['name']."</td><td>".$value['number']."</td><td>".$value['info']."</td><td>".$value['status']."</td><td>".$value['date_admission']."</td><td>".$value['date_shipment']."</td></tr>";
                    }
                    echo "</table>";
                }

             }
             $connect->close();
            }
            catch(Exception $e)
                {
                    echo $e;
                }
        ?>
    </div>
</body>
</html>