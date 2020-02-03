<?php
    include '../controller/Utility.php';
    is_logged();
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
    --PAGE DETAIL: FAQ
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
<!-- Left Panel -->

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
		
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>FAQ</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Cerchi qualche nuovo libro?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <b>Book</b> Manager è qui per aiutarti. Vai nella pagina "<i class="fa fa-search"></i> Esplora", ti sarà possibile ricercare i libri per titolo, autore, casa editrice, tag e liste create da altri utenti.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Vuoi gestire meglio la tua libreria?
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Inserisci la lista di case editrici e autori che più ti piacciono. Inserisci poi i libri, usando tag, liste e preferiti per gestirli al meglio. Ricorda di mettere le copertine, in modo da riconoscere subito il libro.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Vuoi gestire il tuo account?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Usando la pagina "<i class="fa fa-sliders"></i> Impostazioni" puoi modificare il tuo username, password, foto profilo e informazioni personali. Non dimenticare quale avatar scegli, ti servirà per ripristinare la password nel caso la dimenticassi.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Gli altri utenti possono visualizzare le mie liste e i miei preferiti?
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        Gli altri utenti non possono visualizzare i tuoi preferiti ma possono, se lo desideri, visualizzare le tue liste. In fase di creazione usa i flag "Privata" o "Pubblica" per rendere la lista visibile od invisibile agli altri utenti della piattaforma.
      </div>
    </div>
  
  
  </div>        
  </div>
  </div> <!-- .content -->        
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
</body>
</html>