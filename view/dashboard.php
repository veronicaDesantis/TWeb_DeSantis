<?php
    include '../controller/Utility.php';
    is_logged();

    $qry = new Query;
    $user = new User;
    $user = $user->GetIdUtente();
    $not_read = $qry->GetBookNotReaded($user);
    $read = $qry->GetBookReaded($user);
    $list = $qry->GetListNumber($user);
    $preferiti = $qry->GetFavorite($user);
    $book = $qry->GetTotalBook();
    $author = $qry->GetTotalAuthor();
    $editor = $qry->GetTotalEditor();
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
    --PAGE DETAIL: Visualizzazione KPI, Regolamento e rimando alle FAQ
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
                <!--Immagine del profilo-->
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right default-cursor">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown-menu" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle default-cursor" src="../images/avatar/<?= (new User)->GetPathPhoto() ?>" alt="Avatar">
                        </a>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
		
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Home page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-user text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"><?= (new User)->GetUsername() ?></div>
                                <div class="stat-digit"><?= (new User)->GetNomeCompleto() ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-check text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Libri letti</div>
                                <div class="stat-digit"><?php echo $read["value"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-times text-danger border-danger"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Libri da leggere</div>
                                <div class="stat-digit"><?php echo $not_read["value"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-list text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Liste</div>
                                <div class="stat-digit"><?php echo $list["value"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-heart text-danger border-danger"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Preferiti</div>
                                <div class="stat-digit"><?php echo $preferiti["value"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-book text-dark border-dark"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Libri</div>
                                <div class="stat-digit"><?php echo $book["value"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-users text-info border-info"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Autori</div>
                                <div class="stat-digit"><?php echo $author["value"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-home text-secondary border-secondary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Case editrici</div>
                                <div class="stat-digit"><?php echo $editor["value"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
            <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Regolamento</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<ul>
                                            <b>Book</b> Manager è stato pensato per aiutarti a gestire digitalmente la tua personale biblioteca. Sei autonomo nell'inserire e modificare autori, case editrici e libri. Ti forniamo la possibilità di inserire dei tag ad ogni libro, e di inserirli in liste pubbliche o private. Hai inoltre una sezione preferiti, dove puoi gestire i libri che più ti sono piaciuti.
                                            <br>
                                            Ti chiediamo di adottare alcune regole nell'utilizzo della piattaforma, in modo da rendere piacevole e semplice a tutti la navigazione sul nostro sito:
                                            <li>Prima di inserire un nuovo elemento verifica che non esista usando le ricerche in tabella e la pagina "Esplora".</li>
                                            <li>Inserisci informazioni veritiere e il più complete possibile.</li>
                                            <li>Carica immagini di copertina reali e non foto di autori o film collegati al libro.</li>
                                            Se hai bisogno di aiuto nell'utilizzo della piattaforma consulta i nostri <a href="FAQ.php" class="link">FAQ</a>. 
                                        </ul>
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