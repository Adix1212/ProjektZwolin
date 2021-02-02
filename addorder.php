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
        <div class="welcome"><p>Tutaj dodasz paczkę</p></div>
        <div class="profil" onclick="location.href='profil.php'"><p>Pokaż Profil</p></div>
        <div class=""></div>
        <div class="logout" onclick="location.href='logout.php'"><p>Wyloguj się</p></div>
    </header>
    <?php
    if(isset($_POST['nazwa']))
    {
        $form=true;
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
                        $form=true;
                        $name=$_POST['nazwa'];
                        if($name=="")
                        {
                            $form=false;
                            $_SESSION['e_name']="Podaj Nazwę!";
                        }
                        if(ctype_alnum($name)==false)
                        {
                            $fomr=false;
                            $_SESSION['e_name']="Nazwa może składac sie tylko z liter i cyfr (bez polskich znaków)!";
                        }
                            $info=$_POST['info'];
                            if($info=="")
                            {
                                $form=false;
                                $_SESSION['e_info']="Podaj informacje!";
                            }
                        if($form)
                        {
                            $requset=$connect->query("SELECT number FROM orders ORDER by number DESC LIMIT 1");
                            if(!$requset)
                            {
                                throw new Exception($connect->errno);
                            }
                            $number_max=mysqli_fetch_assoc($requset);
                            $number=$number_max['number']+1;
                            $userid=$_SESSION['id'];

                            $requset=$connect->query(("SELECT id FROM employees where position!='szef'"));
                            if(!$requset)
                            {
                                throw new Exception($connect->errno);
                            }
                            $i=0;
                            foreach($requset as $key => $value){
                                $employeesid_all[$i]=$value['id'];
                                $i++;
                            }
                            $num_employees=$requset->num_rows;
                            $employeesid=$employeesid_all[rand(0,$num_employees-1)];
                            echo $name." ".$number." ".$info." ".$userid." ".$employeesid;
                            if($connect->query("INSERT INTO orders VALUES (NULL,'$name','$number','$info','$userid','$employeesid')"))
                            {  
                                $requset=$connect->query("SELECT id FROM orders WHERE number='$number'");
                                if(!$requset)
                                {
                                    throw new Exception($connect->errno);
                                }
                                $addid=mysqli_fetch_assoc($requset);
                                $add_id=$addid['id'];
                                if($connect->query("INSERT INTO status VALUES (NULL,'Oczekiwanie na przyjęcie',NULL,NULL,'$add_id')"))
                                {
                                    $_SESSION['add_success']=true;
                                    header('Location: magpack.php');
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
                    //echo $e;
                }
    }
    ?>
    <div class="container-2">
        <form action="" method="post">
            <input type="text" placeholder="Nazwa" name="nazwa">
            <textarea name="info" cols="40" rows="5" placeholder="Informacja na temat paczki"></textarea>
            <input type="submit">
        </form>
        <?php
            if(isset($_SESSION['e_name']))
            {
                echo '<span style="color:red;">'.$_SESSION['e_name'].'</span>';
                unset($_SESSION['e_name']);
            }
            if(isset($_SESSION['e_info']))
            {
                echo '<span style="color:red;">'.$_SESSION['e_info'].'</span>';
                unset($_SESSION['e_info']);
            }
            ?>
    </div>
    
</body>
</html>