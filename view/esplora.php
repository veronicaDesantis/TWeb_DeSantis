<?php
	include '../controller/Utility.php';
	include '../controller/Libri.php';
	is_logged();
	$search = false;
	
	//Prende 6 numeri random tra i libri esistenti
	$libro = new Libri;
	$minMax = $libro->GetRandomNumbers();
	$row = $libro->GetBookList();
	$cicle = true;
	$array_id = array();
	$array_id_original = array();
	foreach($row as $r)
	{
		array_push($array_id_original, $r["id_libro"]);
	}
	while($cicle == true)
	{
		$r = rand($minMax["min"], $minMax["max"]);
		if (in_array($r, $array_id_original)){
			if (!in_array($r, $array_id))
			{
				array_push($array_id, $r);
			}
		}
		if (count($array_id) == 6)
		{
			$cicle = false;
		}
	}

	function SearchInDb()
	{
		return $_POST["search_text"];
	}

	if(isset($_POST["Search"]))
	{
		$search = SearchInDb();
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
	--PAGE DETAIL: Visualizzazione randomica di 6 libri. Ricerca per contains su titolo, autore, casa editrice, tag e lista
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
	<link rel="stylesheet" href="../vendors/css/bookAnimation.css">

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
                <div class="col-sm-10">
					<a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-chevron-left"></i></a>
					<div class="header-left">
                        <div>
                            <form action="esplora.php" method="POST">
								<div class="row">
									<div class="input-group">
										<input class="form-control" name="search_text" id="search_text" type="text" placeholder="Search ..." value="<?php echo $search ?>">
										<button type="submit" name="Search" class="input-group-addon"><i class="fa fa-search"></i></button>
										<?php
											if ($search != false)
											{
												echo '<a class="input-group-addon" href="http://localhost/TecnologieWeb_sample1_edit/view/esplora.php"><i class="fa fa-times"></i></a>';
											}
										?>
									</div>
								</div>
                            </form>
						</div>
					</div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

		
		<div class="content mt-3">
            <div class="col-lg-12" id="info_form">
				<?php
					if($search == false)
					{
				?>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Esplora</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<?php
												foreach($array_id as $id)
												{
													//Eseguo la query
													$book = $libro->GetBook($id);
													?>
													<div class="component" style="margin-right:200px">
														<ul class="align">
															<li>
																<figure class='book'>

																	<!-- Front -->

																	<ul class='hardcover_front'>
																		<li>
																			<div class="coverDesign">
																				<img width="160px" height="220px" src="<?php echo $book["path_copertina"]; ?>" alt="Card image cap"/>
																			</div>
																		</li>
																		<li></li>
																	</ul>

																	<!-- Pages -->

																	<ul class='page'>
																		<li></li>
																		<li>
																			<a class="btnA" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $id?>">Dettaglio</a>
																		</li>
																		<li></li>
																		<li></li>
																		<li></li>
																	</ul>

																	<!-- Back -->

																	<ul class='hardcover_back'>
																		<li></li>
																		<li></li>
																	</ul>
																	<ul class='book_spine'>
																		<li></li>
																		<li></li>
																	</ul>
																	<figcaption>
																		<h3><?php echo $book["titolo"]; ?></h1>
																		<span>By <?php echo $book["autore"]; ?></span>
																		<p><?php echo $book["casaeditrice"]; ?></p>
																		<?php
																			//Stampo i tag del libro
																			$listTag = new Tag;
																			$tag = $listTag->GetTagByBook($book["id_libro"]);
																			foreach($tag as $t)
																			{
																				?>
																				<span class='badge badge-<?php echo $t["colore"] ?>'><?php echo $t["nome"]?></span>&nbsp;&nbsp;
																				<?php
																			}
																		?>
																	</figcaption>
																</figure>
															</li>
														</ul>
													</div>
													<?php
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- .card -->
				<?php
					}
					else {
				?>
				<!-- Libri per titolo -->
				<?php
					$tit = $libro->SearchByTitle($search);
				?>
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Ricerca per titolo</strong>
					</div>
					<div class="card-body">
						<div id="pay-invoice">
							<div class="card-body">
								<?php
									if (count($tit) == 0)
									{
								?>
								<div class="col-md-12">
									- Nessun risultato trovato -
								</div>
								<?php
									}
									else {
										foreach($tit as $t)
										{
											?>
											<div class="col-md-3">
												<center>
													<div class="flip-box">
														<div class="flip-box-inner">
															<div class="flip-box-front">
																<img src="<?php echo $t["path_copertina"]?>" style="width:300px;height:440px">
															</div>
															<div class="flip-box-back">
															<a class="btnD" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $t["id_libro"] ?>">Dettaglio</a>
																<span style="position:absolute; top: 80%; margin-right:10px; margin-left:10px">
																<?php
																	$pos = strpos($t["titolo"], $search);
																	$len = strlen($search);
																	$toReplace = substr($t["titolo"], $pos, $len);
																	echo str_ireplace($search, "<mark>". $toReplace."</mark>", $t["titolo"]);
																?>
																</span>
															</div>
														</div>
													</div>
												</center>
											</div>
											<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- Libri per autore -->
				<?php
					$autor = $libro->SearchByAuthor($search);
				?>
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Ricerca per autore</strong>
					</div>
					<div class="card-body">
						<div id="pay-invoice">
							<div class="card-body">
								<?php
									if (count($autor) == 0)
									{
								?>
								<div class="col-md-12">
									- Nessun risultato trovato -
								</div>
								<?php
									}
									else {
										foreach($autor as $a)
										{
											?>
											<div class="col-md-3">
												<center>
													<div class="flip-box">
														<div class="flip-box-inner">
															<div class="flip-box-front">
																<img src="<?php echo $a["path_copertina"]?>" style="width:300px;height:440px">
															</div>
															<div class="flip-box-back">
															<a class="btnD" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $a["id_libro"] ?>">Dettaglio</a>
																<span style="position:absolute; top: 80%; margin-right:10px; margin-left:10px">
																<?php
																	$pos = strpos($a["nome"] . " " . $a["cognome"], $search);
																	$len = strlen($search);
																	$toReplace = substr($a["nome"] . " " . $a["cognome"], $pos, $len);
																	echo str_ireplace($search, "<mark>". $toReplace."</mark>", $a["nome"] . " " . $a["cognome"]);
																?>
																</span>
															</div>
														</div>
													</div>
												</center>
											</div>
											<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- Libri per casa editrice -->
				<?php
					$casa = $libro->SearchByEditor($search);
				?>
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Ricerca per casa editrice</strong>
					</div>
					<div class="card-body">
						<div id="pay-invoice">
							<div class="card-body">
								<?php
									if (count($casa) == 0)
									{
								?>
								<div class="col-md-12">
									- Nessun risultato trovato -
								</div>
								<?php
									}
									else {
										foreach($casa as $c)
										{
											?>
											<div class="col-md-3">
												<center>
													<div class="flip-box">
														<div class="flip-box-inner">
															<div class="flip-box-front">
																<img src="<?php echo $c["path_copertina"]?>" style="width:300px;height:440px">
															</div>
															<div class="flip-box-back">
															<a class="btnD" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $c["id_libro"] ?>">Dettaglio</a>
																<span style="position:absolute; top: 80%; margin-right:10px; margin-left:10px">
																<?php
																	$pos = strpos($c["nome"], $search);
																	$len = strlen($search);
																	$toReplace = substr($c["nome"], $pos, $len);
																	echo str_ireplace($search, "<mark>". $toReplace."</mark>", $c["nome"]);
																?>
																</span>
															</div>
														</div>
													</div>
												</center>
											</div>
											<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- Libri per tag -->
				<?php
				$tag = $libro->SearchByTag($search);
				?>
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Ricerca per tag</strong>
					</div>
					<div class="card-body">
						<div id="pay-invoice">
							<div class="card-body">
								<?php
									if (count($tag) == 0)
									{
								?>
								<div class="col-md-12">
									- Nessun risultato trovato -
								</div>
								<?php
									}
									else {
										foreach($tag as $t)
										{
											?>
											<div class="col-md-3">
												<center>
													<div class="flip-box">
														<div class="flip-box-inner">
															<div class="flip-box-front">
																<img src="<?php echo $t["path_copertina"]?>" style="width:300px;height:440px">
															</div>
															<div class="flip-box-back">
																<a class="btnD" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $t["id_libro"] ?>">Dettaglio</a>
																<span style="position:absolute; top: 80%; margin-right:10px; margin-left:10px">
																<?php
																	//Stampo i tag del libro
																	$tagobj = new Tag;
																	$t1 = $tagobj->GetTagByBook($t["id_libro"]);
																	foreach($t1 as $t2)
																	{
																		?>
																		<?php if (stripos($t2["nome"], $search) !== false) 
																		{
																		?>
																			<span class='badge badge-<?php echo $t2["colore"] ?>'><?php echo $t2["nome"]; ?></span>&nbsp;&nbsp;
																		<?php
																		}
																	}
																?>
																</span>
															</div>
														</div>
													</div>
												</center>
											</div>
											<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- Libri per lista -->
				<?php
					$lista = $libro->SearchByList($search);
				?>
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Ricerca per lista</strong>
					</div>
					<div class="card-body">
						<div id="pay-invoice">
							<div class="card-body">
								<?php
									if (count($lista) == 0)
									{
								?>
								<div class="col-md-12">
									- Nessun risultato trovato -
								</div>
								<?php
									}
									else {
										foreach($lista as $l)
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
																<a class="btnD" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $t["id_libro"] ?>">Dettaglio</a>
																<span style="position:absolute; top: 80%; margin-right:10px; margin-left:10px">
																<?php
																	//Stampo le liste del libro
																	$list = new Liste;

																	$listaList = $list->GetListByBook($l["id_libro"]);
																	foreach($listaList as $ll)
																	{
																		?>
																		<?php if (stripos($ll["nome"], $search) !== false) 
																		{
																			echo " ". $ll["nome"]. " ";
																		}
																	}
																?>
																</span>
															</div>
														</div>
													</div>
												</center>
											</div>
											<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				?>				
			</div>
		</div>
    </div><!-- /#right-panel -->

</body>

</html>