<?php
include '../controller/Utility.php';
$error = false;

function CreateNewUtente()
{
$username = $_POST['username'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$mail = $_POST["mail"];
$password = $_POST["password"];
$password_confirm = $_POST['password_confirm'];
$path_foto = $_POST["avatar"];

if ($password != $password_confirm)
{
    return true;
}
$hashedPassword = hash('sha256', $password);
$user = new User;
$id_utente = $user->CreateNewUser($nome, $cognome, $username, $hashedPassword, $mail, $path_foto);
$_SESSION['username'] = $username;
$_SESSION['id_utente'] = $id_utente;
$_SESSION['session_id'] = session_id();
header('location: dashboard.php');
}

if(isset($_POST["registrati"]))
{
    $error = CreateNewUtente();
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <!-- 
    --AUTHOR: Veronica De Santis
    --DESCRIPTION: Book manager è un sito utile all’esplorazione del mondo dei libri. Permette all’utente iscritto di navigare le liste di altri utenti in base a dei tag, 
      di creare delle liste proprie, di impostare dei favoriti o di inserire in autonomia i suoi libri preferiti.
    --PAGE DETAIL: Pagina di registrazione
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
                    <form action="register.php" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" id="avatar" name="avatar" value="1.png">
                                <img class="mx-auto d-block rounded-circle" id="img_value" src="../images/avatar/1.png" alt="Avatar">
                                <center><span class="badge badge-primary pointer-cursor" onclick="change_form()">Cambia avatar</span></center>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cognome</label>
                            <input type="text" class="form-control" placeholder="Cognome" id="cognome" name="cognome" required>
                        </div>
                        <div class="form-group">
                            <label>Indirizzo mail</label>
                            <input type="email" class="form-control" placeholder="Email" id="mail" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Conferma password</label>
                            <input type="password" class="form-control" placeholder="Conferma password" id="password_confirm" name="password_confirm" required>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required>  Accetto i termini e la politica del sito
                            </label>
                        </div>
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="error_alert" style="display:none">
                            <span class="badge badge-pill badge-danger">Attenzione</span>
                            Controlla i campi
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-flat" name="registrati">Registrati</button>
                        <div class="register-link m-t-15 text-center">
                            <br>
                            <p>Hai già un account ?<a href="login.php"> Accedi</a></p>
                        </div>
                        
                    </form>
                </div>
                <div class="login-form" id="avatar_form" style="display:none">
					<table>
						<tr>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/1.png" onclick="change_avatar_photo('1.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/2.png" onclick="change_avatar_photo('2.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/3.png" onclick="change_avatar_photo('3.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/4.png" onclick="change_avatar_photo('4.png')" alt="Avatar"></td>
						</tr>
						<tr>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/5.png" onclick="change_avatar_photo('5.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/6.png" onclick="change_avatar_photo('6.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/7.png" onclick="change_avatar_photo('7.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/8.png" onclick="change_avatar_photo('8.png')" alt="Avatar"></td>
						</tr>
						<tr>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/9.png" onclick="change_avatar_photo('9.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/10.png" onclick="change_avatar_photo('10.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/11.png" onclick="change_avatar_photo('11.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/12.png" onclick="change_avatar_photo('12.png')" alt="Avatar"></td>
						</tr>
						<tr>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/12.png" onclick="change_avatar_photo('13.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/14.png" onclick="change_avatar_photo('14.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/15.png" onclick="change_avatar_photo('15.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/16.png" onclick="change_avatar_photo('16.png')" alt="Avatar"></td>
						</tr>
						<tr>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/17.png" onclick="change_avatar_photo('17.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/18.png" onclick="change_avatar_photo('18.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/19.png" onclick="change_avatar_photo('19.png')" alt="Avatar"></td>
							<td><img class="mx-auto d-block rounded-circle pointer-cursor black-white-img" src="../images/avatar/20.png" onclick="change_avatar_photo('20.png')" alt="Avatar"></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td colspan="2"><button type="button" class="btn btn-default" name="annulla" onclick="change_form_info()">Annulla</button></td>
						</tr>
					</table>
                </div>
            </div>
        </div>
    </div>
    
</body>
<?php
if ($error)
{
    ?>
    <script>error_create_user();</script>
    <?php
}
?>
</html>