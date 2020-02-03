<?php
include '../controller/Utility.php';
?>
<?php

/*
    $need_to_display = 0 normal
    $need_to_display = 1 error_msg on info_form
    $need_to_display = 2 no form, avatar
    $need_to_display = 3 error_msg on avatar_form with 2
*/
$need_to_display = 0;
$change_to_avatar = false;
$id_utente = 0;
$username = "";

function ControlUser($result)
{
    if(!$result)
    {
        $need_to_display = 1;
        return $need_to_display;
    }
    else
    {
        //Nasconde il modale per inserimento dati e chiede di indicare l'immagine profilo
        $need_to_display = 2;
        return $need_to_display;
    }
}

function getDatiUtente()
{
    $username = $_POST['username'];
    $mail = $_POST["mail"];
    $user = new User;
    $result = $user->GetUserByNomeMail($username, $mail);
    $id_utente = $result[0]["id_utente"];
    $username = $result[0]["username"];
    $_SESSION["id_utente"] = $id_utente;
    $_SESSION["username"] = $username;
    return $result;
}
function getDatiUtenteById($id_utente)
{
    $user = new User;
    $result = $user->GetUserById($id_utente);
    return $result;
}

function resetPassword()
{
    $avatar = $_POST["hidden_avatar"];
    $id_utente = $_POST["id_utente"];
    $username = $_POST["username"];
    var_dump($username);
    $user = new User;
    $result = $user->GetUserByIdPath($id_utente, $avatar);
    if(!$result)
    {
        $need_to_display = 3;
        return $need_to_display;
    }
    else
    {
        $hashedPassword = hash('sha256', $username);
        var_dump($hashedPassword);
        $user->UpdatePassword($hashedPassword, $id_utente);
        //Setto flash msg
        $_SESSION["flash_msg"] = true;
        //cambio pagina
        header("Location: login.php");
    }
}

if(isset($_POST["verify"]))
{
    $result = getDatiUtente();
    $need_to_display = ControlUser($result);
    $id_utente = $_SESSION["id_utente"];
    $username = $_SESSION["username"];
}
else if(isset($_POST["conferma"]))
{
    $need_to_display = resetPassword();
    $id_utente = $_POST["id_utente"];
    $result = getDatiUtenteById($id_utente);
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <!-- 
    --AUTHOR: Veronica De Santis
    --DESCRIPTION: Book manager è un sito utile all’esplorazione del mondo dei libri. Permette all’utente iscritto di navigare le liste di altri utenti in base a dei tag, 
      di creare delle liste proprie, di impostare dei favoriti o di inserire in autonomia i suoi libri preferiti.
    --PAGE DETAIL: Pagina recupero PW
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
                <div class="login-form" id="info_form">
                    <center><label>Inserisci i tuoi dati, verificheremo!</label></center>
                    <form action="forget.php" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Indirizzo mail</label>
                            <input type="email" class="form-control" placeholder="Email" id="mail" name="mail" required>
                        </div>
                        <?php  
                            if($need_to_display == 1)
                            {
                                ?>
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="error_alert">
                                        <span class="badge badge-pill badge-danger">Attenzione</span>
                                        Account non trovato
                                    </div>
                                <?php
                            }
                        ?>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="verify">Recupera</button>                        
                    </form>
                </div>
                <div class="login-form" id="avatar_form" style="display:none">
                    <center><label>Aiutaci a capire che sei veramente tu!</label></center>
                    <center><label>Seleziona il tuo avatar</label></center>
                    <form action="forget.php" method="post">
                        <input type="hidden" name="hidden_avatar" id="hidden_avatar" value="">
                        <input type="hidden" name="prec_avatar" id="prec_avatar" value="0">
                        <input type="hidden" name="id_utente" id="id_utente" value="<?= $id_utente ?>">
                        <input type="hidden" name="username" id="username" value="<?= $username ?>">
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="1" src="../images/avatar/1.png" onclick="select_avatar('1.png', 1)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="2" src="../images/avatar/2.png" onclick="select_avatar('2.png', 2)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="3" src="../images/avatar/3.png" onclick="select_avatar('3.png', 3)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="4" src="../images/avatar/4.png" onclick="select_avatar('4.png', 4)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="5" src="../images/avatar/5.png" onclick="select_avatar('5.png', 5)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="6" src="../images/avatar/6.png" onclick="select_avatar('6.png', 6)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="7" src="../images/avatar/7.png" onclick="select_avatar('7.png', 7)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="8" src="../images/avatar/8.png" onclick="select_avatar('8.png', 8)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="9" src="../images/avatar/9.png" onclick="select_avatar('9.png', 9)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="10" src="../images/avatar/10.png" onclick="select_avatar('10.png', 10)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="11" src="../images/avatar/11.png" onclick="select_avatar('11.png', 11)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="12" src="../images/avatar/12.png" onclick="select_avatar('12.png'. 12)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="13" src="../images/avatar/13.png" onclick="select_avatar('13.png', 13)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="14" src="../images/avatar/14.png" onclick="select_avatar('14.png', 14)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="15" src="../images/avatar/15.png" onclick="select_avatar('15.png', 15)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="16" src="../images/avatar/16.png" onclick="select_avatar('16.png', 16)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="17" src="../images/avatar/17.png" onclick="select_avatar('17.png', 17)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="18" src="../images/avatar/18.png" onclick="select_avatar('18.png', 18)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="19" src="../images/avatar/19.png" onclick="select_avatar('19.png', 19)" alt="Avatar">
                        </div>
                        <div class="col-md-3">
                            <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" id="20" src="../images/avatar/20.png" onclick="select_avatar('20.png', 20)" alt="Avatar">
                        </div>
                        <?php  
                            if($need_to_display == 3)
                            {
                                ?>
                                    <div class="col-md-12 sufee-alert alert with-close alert-danger alert-dismissible fade show" id="error_alert">
                                        <span class="badge badge-pill badge-danger">Attenzione</span>
                                        Non è quello il tuo avatar
                                    </div>
                                <?php
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                            &nbsp;
                            </div>
                        </div>
                        <button type="button" class="no-visible btn btn-success col-md-4" name="conferma"></button>
                        <button type="button" class="btn btn-default col-md-4 pull-right" name="annulla" onclick="change_form_info()">Annulla</button>
                        <button type="submit" class="btn btn-primary col-md-4 pull-right" name="conferma">Seleziona</button>
						<br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        if($need_to_display == 2 || $need_to_display == 3)
        {
            ?>
            <script>change_form();</script>
            <?php
        }
    ?>
    
</body>

</html>