<?php
    include '../controller/Utility.php';
    include '../controller/Libri.php';
    is_logged();
    unset($_SESSION["row"]);
    $delete = false;

    //Inserisce la lista
    function NewList()
    {
        $nome_lista = $_POST['nome_lista'];
        $public = $_POST['public'];
        $user = new User;
        $id_utente = $user->GetIdUtente();
        $list = new Liste;
        $list->InsertNewList($nome_lista, $public, $id_utente);
    }
    function OpenDetail()
    {
        $row = $_POST['id_lista'];
		$_SESSION["row"] = $row;
		header("Location: dettaglioLista.php");  
    }

    if(isset($_POST["NewList"]))
    {
        NewList();
    }
    if(isset($_POST["details"]))
    {
        $row = OpenDetail();
    }
    if (isset($_SESSION["delete"]))
    {
        $delete = $_SESSION["delete"];
        unset($_SESSION["delete"]);
    }
    else
    {
        $delete = false;
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
    --PAGE DETAIL: Lista liste attive
    -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Manager</title>
    <meta name="description" content="Gestione libri">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="../book.ico">
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <!--Datatables-->
    <link rel="stylesheet" href="../vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="../vendors/css/style.css">
    <link rel="stylesheet" href="../vendors/css/personal.css">

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
    jQuery(function(){ jQuery("#includedContent").load("lateral.php"); });
	jQuery(document).ready(function() {
		jQuery('#example').DataTable( {
			"searching": true,
			"bPaginate": true,
			"bLengthChange": false,
			"sAjaxSource": "../controller/dtListe.php?id_utente=<?php echo (new User)->GetIdUtente(); ?>",
			"aoColumns":[
				{mData:"nome"},
				{mData:"public"},
				{mData:"azione"}
			]
		} );
	} );
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
                        <strong class="card-title">Liste</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                             <?php if($delete == true)
                             {
                                 echo '<div class="col-md-12" style="margin-top: 15px">
                                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <center><span class="badge badge-pill badge-success">Elemento eliminato</span></center>
                                        </div>
                                     </div>';
                             }
                             ?>
                            <div class="col-md-12" style="margin-top: 15px">
                                <div class="sufee-alert alert alert-success invisible" id="alertInsertInList">
                                    <center><span class="badge badge-pill badge-success">Elemento creato</span><center>
                                </div>
                            </div>
                        </div>
                        <!-- Modale creazione nuova lista -->
                        <div class="modal fade" id="modal_new_list" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mediumModalLabel">Creazione nuova lista</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="control-label mb-1">Nome</label>
                                        <input type='text' class='form-control' name='nomeLista' id='nomeLista'>
                                        <br>
                                        <input type='radio' name='public' id='public' value="1" checked> Pubblica
                                        <br>
                                        <input type='radio' name='public' id='public' value="0"> Privata
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="InsertListRefresh()" class="btn btn-primary">Conferma</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pay-invoice">
                            <div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Nome</th>
													<th>Stato</th>
													<th>Azione</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<center>
									<button type="button" class="btn btn-primary" data-toggle='modal' data-target='#modal_new_list'>Nuova</button>
								</center>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/init-scripts/data-table/datatables-init.js"></script>

</body>

</html>