<?php
    include '../controller/Utility.php';
    include '../controller/Libri.php';
    is_logged();

   /**
    * Richiama eliminazione libro dal carrello
    * @return string
    */
    function RemoveSingleBook()
    {
        $id_libro = $_POST["id_libro"];
        $cart = new Carrello;
        $cart->RemoveSingleBook($id_libro);
        $book = new Libri;
        $libro = $book->GetBook($id_libro);
        return $libro["titolo"]."$$$".$libro["autore"]."$$$".$libro["prezzo"]."$$$".$libro["path_copertina"];
    }

   /**
    * Richiama aggiunta libro in carrello
    * @return string
    */
    function AddSingleBook()
    {
        $id_libro = $_POST["id_libro"];
        $cart = new Carrello;
        $cart->InsertNewCart($id_libro);
        $book = new Libri;
        $libro = $book->GetBook($id_libro);
        return $libro["titolo"]."$$$".$libro["autore"]."$$$".$libro["prezzo"]."$$$".$libro["path_copertina"];
    }

    if(isset($_POST["RemoveSingleBook"]))
    {
        echo RemoveSingleBook();
        return;
    }
    else if(isset($_POST["AddSingleBook"]))
    {
        echo AddSingleBook();
        return;
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
    --PAGE DETAIL: Gestione carrello. Visualizzazione totale. +1 e -1 sui libri
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
            </div>

        </header><!-- /header -->
        <!-- Header-->

		<div class="content mt-3">
            <div class="col-lg-12" id="info_form">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Gestione carrello</strong>
                    </div>
                    <div class="card-body">
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div id="cartDropdown">
                                            <?php
                                                $cart = new Carrello;
                                                $listCart = $cart->GetCart();
                                                foreach($listCart as $ls)
                                                {
                                                    ?>
                                                        <div class="col-md-6" id="book_<?php echo $ls["id_libro"] ?>">
                                                            <div class="row">  
                                                                <div class="col-md-2">
                                                                    <img src="<?php echo $ls["path_copertina"] ?>" width="400px"></img>
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
                                                                        <span id="prz_<?php echo $ls["id_libro"] ?>"><?php echo $ls["prezzo"] ?></span> €
                                                                    </div>
                                                                    <div class="row">
                                                                        <i class="fa fa-minus" style="padding-top: 5px;" onclick="RemoveQuantity('<?php echo $ls["id_libro"] ?>')"></i>
                                                                        &nbsp;&nbsp;<span id="qta_<?php echo $ls["id_libro"] ?>"><?php echo $ls["count"] ?></span>&nbsp;&nbsp;
                                                                        <i class="fa fa-plus" style="padding-top: 5px;"  onclick="AddQuantity('<?php echo $ls["id_libro"] ?>')"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <hr>
                                        <?php
                                            $cart = $cart->GetTotalCart();
                                            $totale = 0;
                                            if($cart["totale"] != null)
                                            {
                                                $totale = $cart["totale"];
                                            }
                                        ?>
                                    </div>
                                    <hr>
                                    <a class="nav-link pull-right" href="carrello.php"><i class="fa fa-money"></i> <b>Totale</b>: <span id="totalPrice"><?php echo $totale ?></span> €</a>
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
							</div>
						</div>
					</div>
				</div> <!-- .card -->
			</div>
		</div>
    </div><!-- /#right-panel -->

</body>

</html>