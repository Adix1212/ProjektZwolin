<?php
    session_start();
    if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit;
    }
    require_once "dbconnect.php";
    $connect=@new mysqli($host,$db_user,$db_pass,$db_name);

    if($connect->connect_errno!=0)
    {
        echo "Error: ".$connect->connect_errno;
    }
    else
    {
        $login=$_POST['login'];
        $password=$_POST['password'];
        $login=htmlentities($login, ENT_QUOTES, "UTF-8");
        
        if($result1=@$connect->query(sprintf("SELECT login, password, email FROM login where login='%s' OR email='%s'",
        mysqli_real_escape_string($connect,$login),
        mysqli_real_escape_string($connect,$login))))
        {
            $user=$result1->num_rows;
            if($user>0)
            {
                $line=$result1->fetch_assoc();
                if(password_verify($password,$line['password']))
                {
                    $_SESSION['email']=$line['email'];
                    unset($_SESSION['log_error']);
                    $result1->close();
                    if($result2=$connect->query(sprintf("SELECT * FROM users as u INNER JOIN login as l on(u.loginid=l.id) WHERE l.login='%s' OR l.email='%s'",
                    mysqli_real_escape_string($connect,$login),
                    mysqli_real_escape_string($connect,$login))))
                    {
                        $user2=$result2->num_rows;
                            if($user2>0)
                            {
                                $_SESSION['log_in']=true;
                                $line2=$result2->fetch_array();
                                $_SESSION['name']=$line2['name'];
                                $_SESSION['id']=$line2[0];
                                $_SESSION['last_name']=$line2['last_name'];
                                $_SESSION['phone']=$line2['phone'];
                                $_SESSION['position']=$line2['position'];
                                $result2->close();
                                $_SESSION['user']=true;
                                header('Location: magpack.php');
                            }
                            elseif($result3=$connect->query(sprintf("SELECT * FROM employees e INNER JOIN login l on(e.loginid=l.id) WHERE l.login='%s' OR l.email='%s'",
                            mysqli_real_escape_string($connect,$login),
                            mysqli_real_escape_string($connect,$login))))
                            {
                                $user3=$result3->num_rows;
                                if($user3>0)
                                {
                                    $_SESSION['log_in']=true;
                                    $line3=$result3->fetch_array();
                                    $_SESSION['id']=$line3[0];
                                    $_SESSION['name']=$line3['name'];
                                    $_SESSION['last_name']=$line3['last_name'];
                                    $_SESSION['phone']=$line3['phone'];
                                    $_SESSION['position']=$line3['position'];
                                    $_SESSION['reward']=$line3['reward'];
                                    $result3->close();
                                    $_SESSION['employees']=true;
                                    header('Location: magpack.php');
                                }
                                else
                                {
                                    $_SESSION['log_error']='<div class="error">Brak Wszystkich danych Skontaktuj sie z Adminstrajca</div>';
                                    header('Location: index.php');
                                }
                            }
                    }
                }
                else
                {
                    $_SESSION['log_error']='<div class="error">Nieprawidłowy Login lub Hasło spróbuj ponownie</div>';
                    header('Location: index.php');
                }
                
            }
            else
            {
                $_SESSION['log_error']='<div class="error">Nieprawidłowy Login lub Hasło spróbuj ponownie</div>';
                header('Location: index.php');
            }
        }
        $connect->close();
    }

?>