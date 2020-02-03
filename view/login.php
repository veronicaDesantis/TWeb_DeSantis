<?php
include '../controller/Utility.php';
$need_to_display = 0;

function goLogin(){

    $mail = $_POST["Email"];
    $password = $_POST["Password"];

    $hashedPassword = hash('sha256', $password);
    $user = new User;
    $row = $user->GetUserByLogin($mail, $hashedPassword);
    if($row!=null)
    {
        start_session($row);
        header("Location: dashboard.php");
    }
    else
    {
        $need_to_display = 1;  
        return $need_to_display;
    }
}

if(isset($_POST["login"]))
{
    $need_to_display = goLogin();
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- 
    --AUTHOR: Veronica De Santis
    --DESCRIPTION: Book manager è un sito utile all’esplorazione del mondo dei libri. Permette all’utente iscritto di navigare le liste di altri utenti in base a dei tag, 
      di creare delle liste proprie, di impostare dei favoriti o di inserire in autonomia i suoi libri preferiti.
    --PAGE DETAIL: Pagina di login
    -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Manager</title>
    <meta name="description" content="Gestione libri">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="../book.ico">
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="../vendors/css/style.css">
    <link rel="stylesheet" href="../vendors/css/personal.css">

    <link href='../vendors/css/font.css' rel='stylesheet' type='text/css'>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendors/main.js"></script>
    
</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo default-cursor">
                    <a href="login.php" class="default-cursor">
                        <b>Book</b>  Manager
                    </a>
                </div>
                <div class="login-form">
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label>Indirizzo mail</label>
                            <input type="email" class="form-control" placeholder="Email" required id="Email" name="Email">
                        </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" required id="Password" name="Password">
                            </div>
                            <div class="row pull-right col-md-12">
                                <div class="checkbox pull-right">
                                    <label class="pull-right">
                                        <a href="forget.php" class="pull-right">Password dimenticata?</a>
                                    </label>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="error_alert" style="display:none">
                                    <span class="badge badge-pill badge-danger">Attenzione</span>
                                    Nome utente o password errata
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <?php
                                if ($need_to_display == 1)
                                {
                                    ?>
                                    <script>error_login();</script>
                                    <?php
                                }
                            ?>
                            <?php
                                if (isset($_SESSION["flash_msg"]))
                                {
                                    unset($_SESSION["flash_msg"]);
                                    ?>
                                    <div class="row col-md-12">
                                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show" id="error_alert">
                                            La password adesso corrisponde al tuo nome utente
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="login">Login</button>
                            <div class="register-link m-t-15 text-center">
                                <br>
                                <p>Non hai un account ? <a href="register.php"> Registrati qui</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
