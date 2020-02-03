<?php
    include '../controller/Utility.php';
    include '../controller/Libri.php';
    is_logged();
	$error = false;
	$update = false;
	if (isset($_SESSION["row"]))
	{
		$row = $_SESSION["row"];
		$list = new Liste;
		$row = $list->GetList($row);
	}
	else
	{
		$row = null;
	}

    function UpdateList()
    {
        $id_lista = $_POST['id_lista'];
        $nome = $_POST['nome'];
		$public = $_POST['public'];
		$list = new Liste;
		$list->UpdateList($nome, $public, $id_lista);
        $_SESSION["update"] = true;
		$_SESSION["row"] = $id_lista;
		header("Location: dettaglioLista.php"); 
    }

    function SetDisabledList()
    {
		$id_lista = $_POST['id_lista'];
		$list = new Liste;
		$list->SetDisabledList($id_lista);
        $_SESSION["delete"] = true;
		header("Location: listaListe.php");
	}
	
	function DeleteBookList()
	{
		$id_lista = $_POST["id_lista"];
		$id_libro = $_POST["id_libro"];
		$bookList = new ListaLibro;
		$bookList->DeleteBookList($id_libro, $id_lista);
		$_SESSION["row"] = $id_lista;
		header("Location: dettaglioLista.php"); 
	}

	function UpdateIsRead()
	{
		$id_lista = $_POST["id_lista"];
		$id_libro = $_POST["id_libro"];
		$is_read = $_POST["is_read"];
		var_dump($is_read);
		$bookList = new ListaLibro;
		$bookList->UpdateIsRead($id_libro, $id_lista, $is_read);
	}


    if(isset($_POST["modifica"]))
    {
        $error = UpdateList();
    }
    else if(isset($_POST["elimina"]))
    {
        SetDisabledList();
	}
	else if(isset($_POST["eliminaLibro"]))
	{
		DeleteBookList();
	}
	else if(isset($_POST["updateStatus"]))
	{
		UpdateIsRead();
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
    --PAGE DETAIL: CRUD lista
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
                        <strong class="card-title">Lista</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Informazioni</h3>
                                </div>
                                <hr>
								<div class="row">
									<div class="col-md-12">
										<form action="dettaglioLista.php" method="post">
											<!-- Dati generali -->
											<div class="form-group col-md-12">
												<label class="control-label mb-1">Nome</label>
												<input type='text' class='form-control' name='nome' id='nome' required value="<?php echo $row["nome"] ?>">
												<br>
												<div class="row">
													<?php
														if($row["public"] == 0)
														{
													?>
													<div class="col-md-6"><input type='radio' name='public' id='public' value="1"><i class="fa fa-unlock"></i> Pubblica</div>
													<div class="col-md-6"><input type='radio' name='public' id='public' value="0" checked><i class="fa fa-lock"></i> Privata</div>
													<?php
														}
														else {
															?>
															<div class="col-md-6"><input type='radio' name='public' id='public' value="1" checked><i class="fa fa-unlock"></i> Pubblica</div>
															<div class="col-md-6"><input type='radio' name='public' id='public' value="0"><i class="fa fa-lock"></i> Privata</div>
															<?php
														}
													?>
												</div>
												<div class="pull-right">
												<div class="modal fade elimina-lista" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLongTitle">Elimina lista</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																Sei sicuro di voler eliminare la lista?
															</div>
															<div class="modal-footer">
																<button type='submit' class='btn btn-danger' name='elimina'>Conferma</button>
																<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
															</div>
														</div>
													</div>
												</div>
												<button type='submit' class='btn btn-success' name='modifica'>Salva</button> 
												<button type='button' class='btn btn-danger' data-toggle="modal" data-target=".elimina-lista">Elimina</button>
												<input type='hidden' name='id_lista' id='id_lista' value='<?php echo $row['id_lista'] ?>'>
												<button type="button" class="btn btn-default" onclick="window.location.href='listaListe.php'">Annulla</button>
												</div>
											</div>
										</form>
									</div>
								</div>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->
				<form action="dettaglioLista.php" method="post">
					<!-- Modale per eliminazione libro da lista -->
					<div class="modal fade elimina-libro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Elimina libro</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Sei sicuro di voler eliminare il libro dalla lista?
									<input type="hidden" name="id_libro" id="id_libro">
									<input type='hidden' name='id_lista' id='id_lista' value='<?php echo $row['id_lista'] ?>'>
								</div>
								<div class="modal-footer">
									<button type='submit' class='btn btn-danger' name='eliminaLibro'>Conferma</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="card">
                    <div class="card-header">
                        <strong class="card-title">Libri</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="col-md-12">
									<!-- Stampo la lista di libri -->
									<div class="row">
										<?php
											$list = "SELECT libro.*, listalibro.is_read
											FROM lista
											INNER JOIN listalibro on listalibro.id_lista = lista.id_lista
											INNER JOIN libro on listalibro.id_libro = libro.id_libro
											WHERE lista.id_lista = ". $row["id_lista"];
											$list = exec_query($list);
											foreach($list as $l)
											{
												?>
												<div class="col-md-3">
														<center>
														<div class="flip-box">
															<div class="flip-box-inner">
																<div class="flip-box-front">
																	<img src="<?php echo $l["path_copertina"]?>" style="width:300px;height:440px">
																</div>
																<div class="flip-box-back">
																	<span style="position:absolute; top: 80%;">
																	<?php
																		 //Stampo i tag del libro
																		 $tag = "SELECT *
																		 FROM tag
																		 INNER JOIN librotag ON librotag.id_tag = tag.id_tag
																		 WHERE librotag.id_libro = " . $l["id_libro"];
																		 $tag = exec_query($tag);
																		 foreach($tag as $t)
																		 {
																			 ?>
																			 <span class='badge badge-<?php echo $t["colore"] ?>'><?php echo $t["nome"]?></span>&nbsp;&nbsp;
																			 <?php
																		 }
																	?>
																	</span>
																</div>
															</div>
														</div>
														<br>
														<?php
															echo "<input type='hidden' id='". $l["id_libro"]."_status' value='". $l["is_read"]."'>";
															if($l["is_read"] == 0)
															{
																echo '<button type="button" class="btn btn-primary" id="btn_'. $l["id_libro"] .'" onclick="ChangeStatus(\'' . $l["id_libro"] . '\', \'' . $row["id_lista"] . '\')"> <i class="fa fa-times"></i> Non letto</button>';
															}
															else {
																echo '<button type="button" class="btn btn-primary" id="btn_'. $l["id_libro"] .'" onclick="ChangeStatus(\'' . $l["id_libro"] . '\',\'' . $row["id_lista"] . '\')"> <i class="fa fa-check"></i> Letto</button>';
															}
														?>
														
														<button type='button' class='btn btn-danger' onclick="DeleteBookFromList(<?php echo $l["id_libro"] ?>)")>Elimina</button>
													</center>
												</div>
												<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- .card -->
            </div>
        </div>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/init-scripts/data-table/datatables-init.js"></script>

</body>

</html>