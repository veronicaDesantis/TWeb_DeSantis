<?php

include '../controller/Utility.php';
is_logged();
$need_to_display = 0;

function changePassword(){

    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    if($newPassword != $confirmPassword)
    {
        $need_to_display = 1;
        return $need_to_display;
    }
    if($newPassword == '' || $confirmPassword == '')
    {
        $need_to_display = 1;
        return $need_to_display;
    }

    $hashedPassword = hash('sha256', $newPassword);
    $id_usente= $_SESSION["id_utente"];
    $user = new User;
    $user->UpdatePassword($hashedPassword, $id_usente);
    $_SESSION["flash_msg"] = "modify_password";
    header("Location: setting.php");
    return $need_to_display;
}

if(isset($_POST["change"]))
{
    $need_to_display = changePassword();
}
else if(isset($_POST["back"]))
{
    header("Location: setting.php");
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- 
    --AUTHOR: Veronica De Santis
    --DESCRIPTION: Book manager è un sito utile all’esplorazione del mondo dei libri. Permette all’utente iscritto di navigare le liste di altri utenti in base a dei tag, 
      di creare delle liste proprie, di impostare dei favoriti o di inserire in autonomia i suoi libri preferiti.
    --PAGE DETAIL: Pgina cambio pw
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
                    <a href="" class="default-cursor">
                        <b>Book</b>  Manager
                    </a>
                </div>
                <div class="login-form">
                    <center><label>Cambia passowrd</label></center>
                    <form action="changePw.php" method="POST">
                        <div class="form-group">
                            <label>Nuova password</label>
                            <input type="password" class="form-control" placeholder="Nuova password" id="newPassword" name="newPassword">
                        </div>
                        <div class="form-group">
                            <label>Conferma password</label>
                            <input type="password" class="form-control" placeholder="Conferma password" id="confirmPassword" name="confirmPassword">
                        </div>
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="error_alert" style="display:none">
                            <span class="badge badge-pill badge-danger">Attenzione</span>
                            Controlla i dati inseriti
                        </div>
                        <?php
                            if ($need_to_display == 1)
                            {
                                ?>
                                <script>error_login();</script>
                                <?php
                            }
                        ?>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default btn-flat" name="back">Annulla</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-flat" name="change">Modifica</button>
                            </div>
                        </div>
                        <span class="">&nbsp;</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
