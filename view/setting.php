<?php
    //include 'db_connection.php';
    include '../controller/Utility.php';
    is_logged();

    $display_notify = false;
    $msg;
    $type;
    $user = new User;

    function SalvaModifiche()
    {
        $username = $_POST['username'];
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $path_foto = $_POST["avatar"];
        $bio = $_POST["bio"];
        $connection = open_connection();
        $id_utente = $_SESSION["id_utente"];
        //UPDATE
        $user = new User;
        $user->UpdateUser($nome, $cognome, $username, $path_foto, $bio, $id_utente);
        $_SESSION["flash_msg"] = "edit";
    }

    if(isset($_POST["save"]))
    {
        SalvaModifiche();
    }
    else if(isset($_POST["changePw"]))
    {
        header('location: changePw.php');
    }
    if(isset($_SESSION["flash_msg"]))
    {
        $flash_msg = $_SESSION["flash_msg"];
        /*
            $type = 1: successo
            $type = 2: errore
        */
        switch($flash_msg)
        {
            case "edit":
            {
                $display_notify = true;
                $type = 1;
                $msg = "Modifiche avvenute correttamente";
            }
            break;
            case "modify_password":
            {
                $display_notify = true;
                $type = 1;
                $msg = "Password modificata correttamente";
            }
            break;
        }
        unset($_SESSION["flash_msg"]);
    }
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <!-- 
    --AUTHOR: Veronica De Santis
    --DESCRIPTION: Book manager è un sito utile all’esplorazione del mondo dei libri. Permette all’utente iscritto di navigare le liste di altri utenti in base a dei tag, 
      di creare delle liste proprie, di impostare dei favoriti o di inserire in autonomia i suoi libri preferiti.
    --PAGE DETAIL: Gestione account personale
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

    <link href='../vendors/css/font.css' rel='stylesheet' type='text/css'>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendors/main.js"></script>

</head>

<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default" id="includedContent">
		</nav>
    </aside>
	<script>
    jQuery(function(){
      jQuery("#includedContent").load("lateral.php"); 
    });
	</script>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <!--Cerca-->
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-chevron-left"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Ricerca ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="content mt-3">
            <div class="col-lg-12" id="info_form">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Impostazioni</strong>
                    </div>
                    <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Impostazioni personali</h3>
                                </div>
                                <hr>
                                <form action="setting.php" method="post">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="hidden" id="avatar" name="avatar" value="<?= $user->GetPathPhoto(); ?>">
                                            <img class="mx-auto d-block rounded-circle" id="img_value" src="../images/avatar/<?= $user->GetPathPhoto(); ?> " alt="Avatar">
                                            <center><span class="badge badge-primary pointer-cursor" onclick="change_size_form()">Cambia avatar</span></center>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-1">Username</label>
                                                <input type="text" class="form-control" name="username" id="username" required value="<?= $user->GetUsername(); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-1">Nome</label>
                                                <input type="text" class="form-control" name="nome" id="nome" required value="<?= $user->GetNome(); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-1">Cognome</label>
                                                <input type="text" class="form-control" name="cognome" id="cognome" required value="<?= $user->GetCognome(); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cc-number" class="control-label mb-1">Indirizzo mail</label>
                                                <input type="mail" class="form-control" name="mail" id="mail" disabled value="<?= $user->GetMail(); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-1">Biografia</label>
                                                <input type="text" class="form-control" name="bio" id="bio" placeholder="Dicci qualcosa di te!" maxlength="100" required value="<?= $user->GetBio(); ?>">
                                            </div>
											<div class="form-group col-md-6">&nbsp;</div>
                                            <div class="form-group col-md-12">
                                                <label class="control-label mb-1">&nbsp;</label>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" name="save" class="btn btn-primary" style="float:right">Salva</button>
                                                    <button type="submit" name="changePw" class="btn btn-default" style="float:right">Modifica password</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="float:right">
                                                <?php
                                                    if($display_notify)
                                                    {
                                                        ?>
                                                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show" id="error_alert">
                                                            <span class="badge badge-pill badge-success">Attenzione</span>
                                                            <?= $msg ?>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->
            </div>
            <div class="col-lg-6" id="avatar_form" style="display:none">
            <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Impostazioni</strong>
                    </div>
                    <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Scelta avatar</h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/1.png" onclick="change_avatar_setting('1.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/2.png" onclick="change_avatar_setting('2.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/3.png" onclick="change_avatar_setting('3.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/4.png" onclick="change_avatar_setting('4.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/5.png" onclick="change_avatar_setting('5.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/6.png" onclick="change_avatar_setting('6.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/7.png" onclick="change_avatar_setting('7.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/8.png" onclick="change_avatar_setting('8.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/9.png" onclick="change_avatar_setting('9.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/10.png" onclick="change_avatar_setting('10.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/11.png" onclick="change_avatar_setting('11.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/12.png" onclick="change_avatar_setting('12.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/13.png" onclick="change_avatar_setting('13.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/14.png" onclick="change_avatar_setting('14.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/15.png" onclick="change_avatar_setting('15.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/16.png" onclick="change_avatar_setting('16.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/17.png" onclick="change_avatar_setting('17.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/18.png" onclick="change_avatar_setting('18.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/19.png" onclick="change_avatar_setting('19.png')" alt="Avatar">
                                    </div>
                                    <div class="col-md-2">
                                        <img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/20.png" onclick="change_avatar_setting('20.png')" alt="Avatar">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-default pull-right" name="annulla" onclick="reset_size_form()">Annulla</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->
                
            </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

</body>

</html>