<?php
    include '../controller/Utility.php';
    is_logged();
    unset($_SESSION["row"]);
    $delete = false;
    $create = false;
    function OpenDetailBook()
    {
        $row = $_POST['id_libro'];
		$_SESSION["row"] = $row;
		header("Location: dettaglioLibro.php");  
    }

    if(isset($_POST["details"]))
    {
        $row = OpenDetailBook();
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
    if (isset($_SESSION["create"]))
    {
        $create = $_SESSION["create"];
        unset($_SESSION["create"]);
    }
    else
    {
        $create = false;
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
    --PAGE DETAIL: Lista libri attivi
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
            "sAjaxSource": "../controller/dtLibri.php",
			"aoColumns":[
				{mData:"img"},
				{mData:"codeISBN"},
				{mData:"titolo"},
				{mData:"autore"},
				{mData:"casaeditrice"},
				{mData:"azione"}
			]
		} );
	} );
	</script>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <div class="content mt-3">
            <div class="col-lg-12" id="info_form">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Lista libri</strong>
                    </div>
                    <div class="card-body">
                        <?php if($delete == true)
                        {
                            echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <center><span class="badge badge-pill badge-success">Elemento eliminato</span></center>
                                </div>';
                        }
                        if($create == true)
                        {
                            echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                <center><span class="badge badge-pill badge-success">Elemento creato</span></center>
                            </div>';
                        }
                        ?>
                        <div id="pay-invoice">
                            <div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Copertina</th>
													<th>ISBN</th>
													<th>Titolo</th>
													<th>Autore</th>
													<th>Casa editrice</th>
													<th>Azione</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<center>
									<button type="button" class="btn btn-primary" onclick="window.location.href='dettaglioLibro.php'">Nuovo</button>
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