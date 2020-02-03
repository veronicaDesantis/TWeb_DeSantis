<?php
    include '../controller/Utility.php';
    include '../controller/Libri.php';
    is_logged();
	$error = false;
	$update = false;
	if (isset($_SESSION["row"]))
	{
		$row = $_SESSION["row"];
		$book = new Libri;
        $row = $book->GetBook($row);
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
	
    function InsertNewBook()
	{
		$isbn = $_POST['isbn'];
		$titolo = $_POST['title'];
		$year = $_POST['year'];
		$description = $_POST['description'];
		$prezzo = $_POST['prezzo'];
		$id_autore = $_POST['id_autore'];
		$id_casa_editrice = $_POST['id_casa_editrice'];
		$book = new Libri;
		$id_libro = $book->InsertNewBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo);
		//Con l'ultimo indice inserisco i tag del libro
		$tag = $_POST['list_badge'];
		$temp = explode('???', $tag);
		foreach($temp as $arr)
		{
			$text = explode('$$$', $arr)[0];
			$color = explode('$$$', $arr)[1];
			//Inserisce il tag
			$tag = new Tag;
			$id_tag = $tag->InsertNewTag($text, $color);
			//Inserisce il legame libro - tag
			$bookTag = new LibroTag;
			$bookTag->InsertNewBookTag($id_tag, $id_libro);			
		}
		//Con l'ultimo indice inserisco anche i tag già esistenti
		$tag = $_POST['list_id_badge'];
		$temp = explode('$$$', $tag);
		foreach($temp as $arr)
		{
			//Inserisce il legame libro - tag
			$bookTag = new LibroTag;
			$bookTag->InsertNewBookTag($arr, $id_libro);			
		}
		$_SESSION["row"] = $id_libro;
		$_SESSION["create"] = true;
		header("Location: listaLibri.php");
    }

    function UpdateBook()
    {
        $id_libro = $_POST['id_libro'];
		$isbn = $_POST['isbn'];
		$titolo = $_POST['title'];
		$year = $_POST['year'];
		$description = $_POST['description'];
		$prezzo = $_POST['prezzo'];
		var_dump($prezzo);
		$id_autore = $_POST['id_autore'];
		$id_casa_editrice = $_POST['id_casa_editrice'];
		$book = new Libri;
		//Update book
		$book->UpdateBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo, $id_libro);
		$bookTag = new LibroTag;
		//Delete tag
		$bookTag->DeleteBookTag($id_libro);
		//Insert tag
		$tag = $_POST['list_badge'];
		$temp = explode('???', $tag);
		foreach($temp as $arr)
		{
			if ($arr != "")
			{
				$text = explode('$$$', $arr)[0];
				$color = explode('$$$', $arr)[1];
				//Inserisce il tag
				$tag = new Tag;
				$id_tag = $tag->InsertNewTag($text, $color);
				//Inserisce il legame libro - tag
				$bookTag = new LibroTag;
				$bookTag->InsertNewBookTag($id_tag, $id_libro);	
			}
		}
		//Inserisce i tag già esistenti
		$tag1 = $_POST['list_id_badge'];
		$temp1 = explode('$$$', $tag1);
		foreach($temp1 as $arr)
		{
			if ($arr <> "")
			{
				//Inserisce il legame libro - tag
				$bookTag = new LibroTag;
				$bookTag->InsertNewBookTag($arr, $id_libro);
			}			
		}
		$_SESSION["row"] = $id_libro;
		$_SESSION["update"] = true;
		header("Location: dettaglioLibro.php");
    }

    function SetDisabledBook()
    {
        $id_libro = $_POST['id_libro'];
		$book = new Libri;
		$book->SetDisabledBook($id_libro);
		$_SESSION["delete"] = true;
		header("Location: listaLibri.php");
    }
	
	function DeleteBookTag()
	{
		$id_libro = $_POST['id_libro'];
		$bookTag = new LibroTag;
		//Delete tag
		$bookTag->DeleteBookTag($id_libro);
		$_SESSION["row"] = $id_libro;
		$_SESSION["modifiche"] = true;
		header("Location: dettaglioLibro.php");
	}
	
	function UpdateBookPath()
	{
		$id_libro = $_POST['id_libro'];
		if (!isset($_FILES['path']) || !is_uploaded_file($_FILES['path']['tmp_name'])) {
			return true;
		}
		$ext_ok = array('png', 'jpg', 'gif');
		$temp = explode('.', $_FILES['path']['name']);
		$ext = end($temp);
		if (!in_array($ext, $ext_ok)) {
			return true;
		}
		$uploaddir = '../attached/';
		//Recupero il percorso temporaneo del file
		$userfile_tmp = $_FILES['path']['tmp_name'];
		//recupero il nome originale del file caricato
		$userfile_name = $_FILES['path']['name'];
		//copio il file dalla sua posizione temporanea alla mia cartella upload
		if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
			//Se l'operazione è andata a buon fine...
			$file = $uploaddir . $userfile_name;
			$book = new Libri;
			$book->UpdateBookPath($file, $id_libro);
			$_SESSION["row"] = $id_libro;
			$_SESSION["modifiche"] = true;
			header("Location: dettaglioLibro.php");
		}
		else{
			return true;
		}
	}
	
	if(isset($_POST["crea"]))
	{
		$error = InsertNewBook();
    }
    else if(isset($_POST["modifica"]))
    {
        UpdateBook();
    }
    else if(isset($_POST["elimina"]))
    {
        SetDisabledBook();
    }
	else if(isset($_POST["deleteTag"]))
	{
		DeleteBookTag();
	}
	else if(isset($_POST["changePath"]))
	{
		$error = UpdateBookPath();
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
	--PAGE DETAIL: CRUD libri
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
	//Tabella autori
	jQuery(document).ready(function(){
		jQuery('#example').DataTable({
			"searching": true,
			"bPaginate": true,
			"bLengthChange": false,
			"ajax": "../controller/dtAutori_book.php",
			columns:[
				{data:"nome"},
				{data:"cognome"},
				{data:"azione"}
			],
			"initComplete": function( settings, json ) {
				<?php
					if ($row != null)
					{
						echo "select_autore_libro(". $row["id_autore"] .");";
					}
				?>
			}  
		});
		//Tabella case editrici
		jQuery('#caseeditrici').DataTable({
			"searching": true,
			"bPaginate": true,
			"bLengthChange": false,
			"ajax": "../controller/dtCaseEditrici_book.php",
			columns:[
				{data:"nome"},
				{data:"sede"},
				{data:"azione"}
			],
			"initComplete": function( settings, json ) {
				<?php
					if ($row != null)
					{
						echo "select_casaeditrice_libro(". $row["id_casa_editrice"] .");";
					}
				?>
			}  
		});
		//Tabella tag
		jQuery('#tag').DataTable({
			"searching": true,
			"bPaginate": true,
			"bLengthChange": false,
			"ajax": "../controller/dtTag_book.php",
			columns:[
				{data:"span"},
				{data:"azione"}
			]  
		});
	});
	</script>
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
                        <strong class="card-title">Libro</strong>
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
									//Modifiche effettuate
                                    echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <center><span class="badge badge-pill badge-success">Modifiche effettuate</span></center>
                                        </div>';
                                }
                                ?>
								<form enctype="multipart/form-data" action="dettaglioLibro.php" method="post">
									<!-- Modale modifica copertina -->
									<div class="modal fade" id="modal_change_copertina" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="mediumModalLabel">Modifica copertina</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<label class="control-label mb-1">File</label>
													<input type='file' class='form-control' name='path' id='path'>
													<br>ATTENZIONE: continuando perderai le modifiche non salvate!
												</div>
												<div class="modal-footer">
													<button type="submit" name="changePath" class="btn btn-primary">Conferma</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
												</div>
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="mx-auto d-block">
												<!-- Copertina -->
												<?php
												 if($row != null)
												 {
													 if ($row["path_copertina"] == "")
													 {
														echo '<img class="mx-auto d-block" src="../book.ico" alt="Card image cap">';
													 }
													 else
													 {
														echo '<img class="mx-auto d-block" src="'. $row["path_copertina"] .'" alt="Card image cap">';
													 }
													 
													 echo "<center><span class='badge badge-primary cursor' data-toggle='modal'  data-target='#modal_change_copertina'>Modifica copertina</span></center>";
													 if ($error)
													 {
														 echo "<br>";
														 echo '<div class="sufee-alert alert with-close alert-danger fade show"><center>Errore nel caricamento!</center></div>';
													 }
												 }
												 else echo '<img class="rounded-circle mx-auto d-block" src="../book.ico" alt="Card image cap">';
												?>
												</div>
                                            </div>
											<div class="col-md-10">
												<!-- Dati generali -->
												<div class="form-group col-md-6">
													<label class="control-label mb-1">Codice ISBN</label>
													<input type='text' class='form-control' name='isbn' id='isbn' required value="<?php if($row != null) echo $row["codeISBN"] ?>">
												</div>
												<div class="form-group col-md-6">
													<label class="control-label mb-1">Prezzo</label>
													<input type='number' step="0.01" class='form-control' name='prezzo' id='prezzo' required value="<?php if($row != null) echo $row["prezzo"] ?>">
												</div>
												<div class="form-group col-md-6">
													<label class="control-label mb-1">Titolo</label>
													<input type='text' class='form-control' name='title' id='title' required value="<?php if($row != null) echo $row["titolo"] ?>">
												</div>
												<div class="form-group col-md-6">
													<label class="control-label mb-1">Anno</label>
													<input type='number' class='form-control' name='year' id='year' required value="<?php if($row != null) echo $row["anno"] ?>">
												</div>
												<div class="form-group col-md-12">
													<label class="control-label mb-1">Descrizione</label>
													<textarea class='form-control' name='description' id='description' required rows="5"><?php if($row != null) echo $row["descrizione"] ?></textarea>
												</div>
												<div class="form-group col-md-12">
													<!-- Modale inserisci tag -->
													<div class="modal fade" id="modal_badge" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="mediumModalLabel">Scelta tag</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<div class="form-group col-md-12">Prima di inserire un tag nuovo verifica se ne è già stato creato uno simile:</div>
																	<div class="default-tab form-group col-md-12">
																		<nav>
																			<div class="nav nav-tabs" id="nav-tab" role="tablist">
																				<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-search">Cerca</a>
																				<a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-insert">Inserisci</a>
																			</div>
																		</nav>
																		<div class="tab-content pl-3 pt-2" id="nav-tabContent">
																			<div class="tab-pane fade" id="nav-search" role="tabpanel">
																				<table id="tag" class="table table-striped table-bordered" style="width:100%">
																					<thead>
																						<tr>
																							<th>Tag</th>
																							<th>Azione</th>
																						</tr>
																					</thead>
																				</table>
																			</div>
																			<div class="tab-pane fade show active" id="nav-insert">
																				<div class="form-group col-md-6">
																					<label class="control-label mb-1">Testo</label>
																					<input type='text' class='form-control' name='text' id='text'>
																				</div>
																				<div class="form-group col-md-6">
																					<label class="control-label mb-1">Colore</label>
																					<br>
																					<table class="col-md-6">
																						<tr>
																							<td><input type="radio" name="color" value="primary"><span class="badge badge-primary">Primary</span><br></td>
																							<td><input type="radio" name="color" value="secondary"><span class="badge badge-secondary">Secondary</span><br></td>
																						</tr>
																						<tr>
																							<td><input type="radio" name="color" value="success"><span class="badge badge-success">Success</span><br></td>
																							<td><input type="radio" name="color" value="danger"><span class="badge badge-danger">Danger</span><br></td>
																						</tr>
																						<tr>
																							<td><input type="radio" name="color" value="warning"><span class="badge badge-warning">Warning</span><br></td>
																							<td><input type="radio" name="color" value="info"><span class="badge badge-info">Info</span><br></td>
																						</tr>
																						<tr>
																							<td><input type="radio" name="color" value="light"><span class="badge badge-light">Light</span><br></td>
																							<td><input type="radio" name="color" value="dark"><span class="badge badge-dark">Dark</span></td>
																						</tr>
																					</table>
																				</div>		
																			</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="add_span_badge_hide()">Conferma</button>
																	<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
																</div>
															</div>
														</div>
													</div>
													<!-- Modale rimuovi tag -->
													<div class="modal fade" id="modal_badge_delete" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
														<div class="modal-dialog modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="mediumModalLabel">Elimina tag</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	Sei sicuro di voler eliminare tutti i tag associati al libro?
																	<br>ATTENZIONE: continuando perderai le modifiche non salvate!
																</div>
																<div class="modal-footer">
																	<button type="submit" name="deleteTag" class="btn btn-primary">Conferma</button>
																	<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
																</div>
															</div>
														</div>
													</div>
													<!-- Lista tag -->
													<label class="control-label mb-1">Tag</label>
													<span class="badge badge-primary cursor" data-toggle="modal" data-target="#modal_badge">Aggiungi</span>
													<?php
														if($row != null)
														{
															echo "<span class='badge badge-danger cursor' data-toggle='modal' data-target='#modal_badge_delete'>Elimina</span>";
														}
													?>
													<br>
													<input type="hidden" id="list_badge" name="list_badge">
													<input type="hidden" id="list_id_badge" name="list_id_badge">
													<input type="hidden" id="list_badge_text" name="list_badge_text">
													<div id="span_badge"></div>
													<?php
														if($row != null)
														{
															$sql = "SELECT tag.* FROM tag INNER JOIN librotag ON librotag.id_tag = tag.id_tag WHERE librotag.id_libro = " . $row['id_libro'];
															$listTag = exec_query($sql);
															foreach($listTag as $tag)
															{
																echo "<script>add_span_badge('". $tag["nome"] ."', '". $tag["colore"] ."')</script>";
															}
														}
													?>
												</div>
											</div>
										</div>
										<hr>
										<!-- Tabella autori -->
										<div class="col-md-12">
											<table id="example" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr>
														<th>Nome</th>
														<th>Cognome</th>
														<th>Azione</th>
													</tr>
												</thead>
											</table>
										</div>
										<!-- Tabella case editrici -->
										<div class="col-md-12">
											<table id="caseeditrici" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr>
														<th>Nome</th>
														<th>Sede</th>
														<th>Azione</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
									<br>
									<div class="pull-right">
									<?php
										if ($row != null)
										{
									?>
									<!-- Modale elimina libro -->
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
													Sei sicuro di voler eliminare il libro?
												</div>
												<div class="modal-footer">
													<button type='submit' class='btn btn-danger' name='elimina'>Conferma</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
												</div>
											</div>
										</div>
									</div>
									<button type='submit' class='btn btn-success' name='modifica'>Salva</button> 
									<button type='button' class='btn btn-danger' data-toggle="modal" data-target=".elimina-libro">Elimina</button>
									<?php }
										else echo "<button type='submit' class='btn btn-primary' name='crea'>Crea</button>";
										if ($row != null) echo "<input type='hidden' name='id_libro' id='id_libro' value='". $row['id_libro']."'>"
                                    ?>	
										<button type="button" class="btn btn-default" onclick="window.location.href='listaLibri.php'">Annulla</button>
									</div>
                                </form>
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