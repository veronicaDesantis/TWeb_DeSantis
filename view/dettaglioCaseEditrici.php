<?php
    include '../controller/Utility.php';
    include '../controller/CasaEditrice.php';
    is_logged();
    $update = false;
	if (isset($_SESSION["row"]))
	{
		$row = $_SESSION["row"];
	}
	else
	{
		$row = null;
    }
    if (isset($_SESSION["update"]))
    {
        $update = $_SESSION["update"];
        unset($_SESSION["update"]);
    }
    else
    {
        $update = false;
    }
    
    function InsertNewEditor()
	{
		$nome = $_POST['nome'];
		$sede = $_POST['sede'];
        $indirizzo_web = $_POST['indirizzo_web'];
        $editor = new CasaEditrice;
        $editor->InsertNewEditor($nome, $sede, $indirizzo_web);
        $_SESSION["create"] = true;
		header("Location: listaCaseEditrici.php");
    }

    function UpdateEditor()
    {
        $idCasaEditrice = $_POST['id_casa_editrice'];
        $nome = $_POST['nome'];
		$sede = $_POST['sede'];
        $indirizzo_web = $_POST['indirizzo_web'];
        $editor = new CasaEditrice;
        $editor->UpdateEditor($nome, $sede, $indirizzo_web, $idCasaEditrice);
        $_SESSION["update"] = true;
		$_SESSION["row"] = $editor->GetEditor($idCasaEditrice);;
		header("Location: dettaglioCaseEditrici.php"); 
    }

    function SetDisabledEditor()
    {
        $idCasaEditrice = $_POST['id_casa_editrice'];
		$editor = new CasaEditrice;
        $editor->SetDisabledEditor($idCasaEditrice);
        $_SESSION["delete"] = true;
		header("Location: listaCaseEditrici.php");
    }
	
	if(isset($_POST["crea"]))
	{
		InsertNewEditor();
    }
    else if(isset($_POST["modifica"]))
    {
        UpdateEditor();
    }
    else if(isset($_POST["elimina"]))
    {
        SetDisabledEditor();
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
    --PAGE DETAIL: CRUD casa editrice
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
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

		<div class="content mt-3">
            <div class="col-lg-12" id="info_form">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Casa Editrice</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Informazioni</h3>
                                </div>
                                <hr>
                                <?php if($update == true)
                                {
                                    echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <center><span class="badge badge-pill badge-success">Modifiche effettuate</span></center>
                                        </div>';
                                }
                                ?>
                                <form action="dettaglioCaseEditrici.php" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <label class="control-label mb-1">Nome</label>
                                                <?php
                                                 if ($row != null) echo "<input type='text' class='form-control' name='nome' id='nome' value='".$row["nome"]."' required>";
                                                 else echo "<input type='text' class='form-control' name='nome' id='nome' required>";
                                                ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label mb-1">Sede</label>
                                                <?php
                                                 if ($row != null) echo "<input type='text' class='form-control' name='sede' id='sede' value='".$row["sede"]."' required>";
                                                 else echo "<input type='text' class='form-control' name='sede' id='sede' required>";
                                                ?>
                                            </div>
											<div class="form-group col-md-6">
                                                <label class="control-label mb-1">Indirizzo web</label>
                                                <?php
                                                 if ($row != null) echo "<input type='text' class='form-control' name='indirizzo_web' id='indirizzo_web' value='".$row["indirizzo_web"]."' required>";
                                                 else echo "<input type='text' class='form-control' name='indirizzo_web' id='indirizzo_web' required>";
                                                ?>
                                            </div>
										</div>
									</div>
									<div class="pull-right">
                                    <?php
                                        if ($row != null)
                                        {
                                            ?>
                                            <div class="modal fade elimina-casa-editrice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Elimina casa editrice</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Sei sicuro di voler eliminare la casa editrice?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type='submit' class='btn btn-danger' name='elimina'>Conferma</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type='submit' class='btn btn-success' name='modifica'>Salva</button> 
                                            <button type='button' class='btn btn-danger' data-toggle="modal" data-target=".elimina-casa-editrice">Elimina</button>
                                        <?php }
                                        else echo "<button type='submit' class='btn btn-primary' name='crea'>Crea</button>";
                                        if ($row != null) echo "<input type='hidden' name='id_casa_editrice' id='id_casa_editrice' value='".$row["id_casa_editrice"]."'>"
                                     ?>	
										<button type="button" class="btn btn-default" onclick="window.location.href='listaCaseEditrici.php'">Annulla</button>
									</div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->
            </div>
        </div>
    </div><!-- /#right-panel -->
</body>
</html>