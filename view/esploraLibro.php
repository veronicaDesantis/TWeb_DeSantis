<?php
    include '../controller/Utility.php';
    include '../controller/Libri.php';
    is_logged();

    //Prendo i dati del libro
    function GetBook()
    {
        //Inserisce il libro nel carrello e restituisce i dati del libro
        $id_libro = $_POST["id_libro"];
        $cart = new Carrello;
        $cart->InsertNewCart($id_libro);
        $book = new Libri;
        $libro = $book->GetBook($id_libro);
        return $libro["titolo"]."$$$".$libro["autore"]."$$$".$libro["prezzo"]."$$$".$libro["path_copertina"];
    }

    //Setta il libro come non preferito
    function SetNotFav()
    {
        $id_libro = $_POST['id_libro'];
        $pref = new Preferiti;
        $pref->SetNotFavorite($id_libro);
    }

    //Setta il libro come preferito
    function SetFav()
    {
        $id_libro = $_POST['id_libro'];
        $pref = new Preferiti;
        $pref->SetFavorite($id_libro);
    }

    //Inserisce la lista
    function NewList()
    {
        $nome_lista = $_POST['nome_lista'];
        $public = $_POST['public'];
        $user = new User;
        $list = new Liste;
        $list->InsertNewList($nome_lista, $public, $user->GetIdUtente());
    }

    //Inserisce il libro nella lista
    function BookInList()
    {
        $id_lista = $_POST['id_lista'];
        $id_libro = $_POST['id_libro'];
        $is_read = $_POST['is_read'];
        $list = new ListaLibro;
        $list->InsertBookList($id_libro, $id_lista, $is_read);
    }

    if(isset($_POST["SetNotFav"]))
	{
		SetNotFav();
    }
    else if(isset($_POST["SetFav"]))
    {
        SetFav();
    }
    else if(isset($_POST["NewList"]))
    {
        NewList();
    }
    else if(isset($_POST["BookInList"]))
    {
        BookInList();
    }
    else if(isset($_POST["GetBook"]))
    {
        echo GetBook();
        return;
    }

    
    $id_libro = $_GET["id_libro"];
    $libro = new Libri;
    $row = $libro->GetBook($id_libro);
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
    --PAGE DETAIL: visualizzazione dettaglio libri. Visualizzazione libri dello stesso autore, con gli stessi tag. Inserimento libro in carrello
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
    <link rel="stylesheet" href="../vendors/css/bookAnimation.css">

    <link href='../vendors/css/font.css' rel='stylesheet' type='text/css'>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
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
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <div class="user-menu dropdown-menu" id="cartDropdown" style="width:500px !important; max-width: unset !important">
                            <span id="cart">
                                <?php
                                    $cart = new Carrello;
                                    $listCart = $cart->GetCart();
                                    foreach($listCart as $ls)
                                    {
                                        ?>
                                            <div class="nav-link">
                                                <div class="row">  
                                                    <div class="col-md-2">
                                                        <img src="<?php echo $ls["path_copertina"] ?>"></img>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <?php echo $ls["titolo"] ?>
                                                        </div>
                                                        <div class="row" style="color: #e74c3c">
                                                            by <?php echo $ls["autore"] ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="row">
                                                            <?php echo $ls["prezzo"] ?> €
                                                        </div>
                                                        <div class="row">
                                                            Qtà. <span id="qta_<?php echo $ls["id_libro"] ?>"><?php echo $ls["count"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </span>
                            <div class="dropdown-divider"></div>
                            <?php
                                $cart = (new Carrello)->GetTotalCart();
                                $totale = 0;
                                if($cart["totale"] != null)
                                {
                                    $totale = $cart["totale"];
                                }
                            ?>
                            <a class="nav-link pull-right" href="carrello.php"><i class="fa fa-money"></i> <b>Totale</b>: <span id="totalPrice"><?php echo $totale ?></span> €</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

		<div class="content mt-3">
            <div class="col-lg-12" id="info_form">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"><?php echo $row["titolo"] ?></strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-6">
                                                <img class="mx-auto d-block" height="300px" draggable="true" ondragstart="drag(event, <?php echo $row["id_libro"] ?>)"
                                                src="<?php echo $row["path_copertina"]; ?>" alt="Card image cap">
                                            </div>
                                            <div class="col-md-6">
                                                <b>Titolo:</b> <?php echo $row["titolo"]; ?><br>
                                                <b>Autore:</b> <?php echo $row["autore"]; ?><br>
                                                <b>Editore:</b> <?php echo $row["casaeditrice"]; ?><br>
                                                <b>Prezzo:</b> <?php echo $row["prezzo"]; ?> €<br>
                                                <?php
                                                    //Stampo i tag del libro
                                                    $listTag = new Tag;
                                                    $tag = $listTag->GetTagByBook($row["id_libro"]);
                                                    foreach($tag as $t)
                                                    {
                                                        ?>
                                                        <span class='badge badge-<?php echo $t["colore"] ?>'><?php echo $t["nome"]?></span>&nbsp;&nbsp;
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="text-align: justify; border-left: 1px solid rgba(0,0,0,.1)">
                                            <?php echo $row["descrizione"]; ?>
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
                                                <input type='radio' name='public' id='public' value="1" checked><i class="fa fa-unlock"></i> Pubblica
                                                <br>
                                                <input type='radio' name='public' id='public' value="0"><i class="fa fa-lock"></i> Privata
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="InsertList()" class="btn btn-primary">Conferma</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modale inserimento in lista -->
                                <div class="modal fade" id="modal_insert_in_list" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mediumModalLabel">Inserimento in lista</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="id_lista">
                                                <label class="control-label mb-1">Stato</label>
                                                <select class='form-control' name='statoLibro' id='statoLibro'>
                                                    <option value="1" selected>Letto</option>
                                                    <option value="0">Non letto</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="InsertBookInList()" class="btn btn-primary">Conferma</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 15px">
                                        <div class="sufee-alert alert alert-success invisible" id="alertCreateList">
                                            <center><span class="badge badge-pill badge-success">Elemento creato</span><center>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 15px">
                                        <div class="sufee-alert alert alert-success invisible" id="alertInsertInList">
                                            <center><span class="badge badge-pill badge-success">Elemento inserito in lista</span><center>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right footer">
                                    <!-- Inserimento nelle liste dell'utente -->
                                    <button class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown">&nbsp;<i class="fa fa-th-list"></i>&nbsp;Lista</button>
                                        <div class="dropdown-menu">
                                            <!-- Lista di liste collegate all'utente -->
                                            <!-- Lucchetto aperto se pubblica -->
                                            <!-- Lucchetto chiuso se privata -->
                                            <span id="listList">
                                            <?php

                                                $list = (new Liste)->GetListByUser();
                                                foreach($list as $l)
                                                {
                                                    if($l["public"] == 0)
                                                    {
                                                        //La lista è privata
                                                        ?>
                                                            <a class="dropdown-item cursor" onclick="OpenModalList(this.id)" id="<?php echo $l["id_lista"]?>">&nbsp;<i class="fa fa-lock"></i>&nbsp;<?php echo $l["nome"] ?></a>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        //La lista è pubblica
                                                        ?>
                                                            <a class="dropdown-item cursor" onclick="OpenModalList(this.id)" id="<?php echo $l["id_lista"]?>">&nbsp;<i class="fa fa-unlock"></i>&nbsp;<?php echo $l["nome"] ?></a>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                            </span>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item cursor" data-toggle='modal' data-target='#modal_new_list'>Nuova lista</a>
                                        </div>
                                    <input type="hidden" name="id_libro" id="id_libro" value="<?php echo $row["id_libro"] ?>">
                                    <!-- Verifico se il libro è tra i preferiti -->
                                    <?php
                                        $pref = (new Preferiti)->IsFavorite($row["id_libro"]);
                                        if ($pref)
                                        {
                                            ?>
                                            <!-- Il libro è tra i preferiti -->
                                            <button type='button' id="SetNoFav" name="SetNotFav" class='btn btn-danger' onclick="SetNoFav_classic()">&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;&nbsp;</button>
                                            <button class='btn btn-danger' type="button" name="SetFav" id="SetFav" style="display:none" onclick="SetFav_classic()">
                                                &nbsp;
                                                <img width="18px" src="../vendors/css/heart-regular.svg">
                                                &nbsp;
                                            </button>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <!-- Il libro non è tra i favoriti -->
                                            <button type='button' id="SetNoFav" style="display:none" name="SetNotFav" class='btn btn-danger' onclick="SetNoFav_classic()">&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;&nbsp;</button>
                                            <button class='btn btn-danger' type="button" name="SetFav" id="SetFav" onclick="SetFav_classic()">
                                                &nbsp;
                                                <img width="18px" src="../vendors/css/heart-regular.svg">
                                                &nbsp;
                                            </button>
                                            <?php
                                        }
                                    ?>
                                </div>
							</div>
						</div>
					</div>
				</div> <!-- .card -->
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Libri con gli stessi tag</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="col-md-12">
                                        <?php
                                            //Eseguo la query
                                            $book = $libro->SameTag($row["id_libro"]);
                                            echo '<div class="row">';
                                            foreach($book as $b)
                                            {
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="component" style="margin-right:200px">
                                                        <ul class="align">
                                                            <li>
                                                                <figure class='book'>

                                                                    <!-- Front -->

                                                                    <ul class='hardcover_front'>
                                                                        <li>
                                                                            <div class="coverDesign">
                                                                                <img width="160px" height="220px" src="<?php echo $b["path_copertina"]; ?>" alt="Card image cap"/>
                                                                            </div>
                                                                        </li>
                                                                        <li></li>
                                                                    </ul>

                                                                    <!-- Pages -->

                                                                    <ul class='page'>
                                                                        <li></li>
                                                                        <li>
                                                                            <a class="btnA" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $b["id_libro"]?>">Dettaglio</a>
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
                                                                        <h3><?php echo $b["titolo"]; ?></h1>
                                                                        <span>By <?php echo $b["autore"]; ?></span>
                                                                        <p><?php echo $b["casaeditrice"]; ?></p>
                                                                        <?php
                                                                            //Stampo i tag del libro
                                                                            $tag = (new Tag)->GetTagByBook($b["id_libro"]);
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
                                                </div>                                            
                                                <?php
                                            }
                                            echo "</div>";
                                        ?>
                                    </div>
                                </div>
						</div>
					</div>
				</div> <!-- .card -->
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Libri dello stesso autore</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="col-md-12">
                                        <?php
                                            //Eseguo la query
                                            $book = $libro->SameAutor($row["id_libro"]);
                                            echo '<div class="row">';
                                            foreach($book as $b)
                                            {
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="component" style="margin-right:200px">
                                                        <ul class="align">
                                                            <li>
                                                                <figure class='book'>

                                                                    <!-- Front -->

                                                                    <ul class='hardcover_front'>
                                                                        <li>
                                                                            <div class="coverDesign">
                                                                                <img width="160px" height="220px" src="<?php echo $b["path_copertina"]; ?>" alt="Card image cap"/>
                                                                            </div>
                                                                        </li>
                                                                        <li></li>
                                                                    </ul>

                                                                    <!-- Pages -->

                                                                    <ul class='page'>
                                                                        <li></li>
                                                                        <li>
                                                                            <a class="btnA" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $b["id_libro"]?>">Dettaglio</a>
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
                                                                        <h3><?php echo $b["titolo"]; ?></h1>
                                                                        <span>By <?php echo $b["autore"]; ?></span>
                                                                        <p><?php echo $b["casaeditrice"]; ?></p>
                                                                        <?php
                                                                            //Stampo i tag del libro
                                                                            $tag = (new Tag)->GetTagByBook($b["id_libro"]);
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
                                                </div>                                            
                                                <?php
                                            }
                                            echo "</div>";
                                        ?>
                                    </div>
                                </div>
						</div>
					</div>
				</div> <!-- .card -->
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Libri della stessa casa editrice</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="col-md-12">
                                        <?php
                                            //Eseguo la query
                                            $book = $libro->SameEditor($row["id_libro"]);
                                            echo '<div class="row">';
                                            foreach($book as $b)
                                            {
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="component" style="margin-right:200px">
                                                        <ul class="align">
                                                            <li>
                                                                <figure class='book'>

                                                                    <!-- Front -->

                                                                    <ul class='hardcover_front'>
                                                                        <li>
                                                                            <div class="coverDesign">
                                                                                <img width="160px" height="220px" src="<?php echo $b["path_copertina"]; ?>" alt="Card image cap"/>
                                                                            </div>
                                                                        </li>
                                                                        <li></li>
                                                                    </ul>

                                                                    <!-- Pages -->

                                                                    <ul class='page'>
                                                                        <li></li>
                                                                        <li>
                                                                            <a class="btnA" href="http://localhost/TecnologieWeb_sample1_edit/view/esploraLibro.php?id_libro=<?php echo $b["id_libro"]?>">Dettaglio</a>
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
                                                                        <h3><?php echo $b["titolo"]; ?></h1>
                                                                        <span>By <?php echo $b["autore"]; ?></span>
                                                                        <p><?php echo $b["casaeditrice"]; ?></p>
                                                                        <?php
                                                                            //Stampo i tag del libro
                                                                            $tag = (new Tag)->GetTagByBook($b["id_libro"]);
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
                                                </div>                                            
                                                <?php
                                            }
                                            echo "</div>";
                                        ?>
                                    </div>
                                </div>
						</div>
					</div>
				</div> <!-- .card -->
			</div>
		</div>
    </div><!-- /#right-panel -->

</body>

</html>