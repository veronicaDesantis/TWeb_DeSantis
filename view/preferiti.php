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
    --PAGE DETAIL: Visualizzazione preferiti.
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
			"sAjaxSource": "../controller/dtPreferiti.php?id_utente=<?php echo (new User)->GetIdUtente(); ?>",
			"aoColumns":[
				{mData:"libro"}
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
                        <strong class="card-title">Preferiti</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<table id="example" class="table table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Libro</th>
												</tr>
											</thead>
										</table>
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
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/init-scripts/data-table/datatables-init.js"></script>

</body>

</html>