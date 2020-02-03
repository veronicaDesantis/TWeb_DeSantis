<?php
 include '../controller/db_connection.php';

/**
 * Class Query
 */
 class Query
 {
     #region DATATABLE
     /**
      * Ritorna Json con lista dei libri inseriti a sistema
      * @return $array
      */
     public function GetDataTableLibri()
     {
        $query = "SELECT path_copertina, titolo, id_libro, codeISBN, CONCAT(autore.nome, ' ', autore.cognome) as 'autore', casaeditrice.nome as 'casaeditrice'
        FROM libro
        INNER JOIN autore ON autore.id_autore = libro.id_autore
        INNER JOIN casaeditrice ON casaeditrice.id_casa_editrice = libro.id_casa_editrice
        WHERE libro.enabled = 1";
        $data = exec_query($query);
        $array = [];
        // Fetch one and one row
        foreach ($data as $row) {
            $id = $row["id_libro"];
            $row["azione"] = '<form action="listaLibri.php" method="POST"> <input type="hidden" name="id_libro" id="id_libro" value="' . $id . '"/>
            <center> <button type="submit" name="details" style="background-color: transparent; border-color: transparent;">
            <img class="cursor" src="../images/details.png" width="30px" /> </button></center> </form>';
            $row["img"] = "<img class='mx-auto d-block' src='". $row["path_copertina"] . "' width='30px'>";
            $array[] = $row;
        }
        return $array;
     }

     /**
      * Ritorna Json con lista degli autori inseriti a sistema - azione contiene redirect a dettaglio
      * @return $array
      */
     public function GetDataTableAutori()
     {
        $query = "SELECT nome, cognome, luogo_nascita, data_nascita, id_autore as azione FROM autore WHERE enabled = 1";

        $data = exec_query($query);
        $array = [];
        // Fetch one and one row
        foreach ($data as $row) {
            $id = $row["azione"];
            $row["azione"] = '<form action="listaAutori.php" method="POST"> <input type="hidden" name="id_autore" id="id_autore" value="' . $id . '"/>
            <center> <button type="submit" name="details" style="background-color: transparent; border-color: transparent;">
            <img class="cursor" src="../images/details.png" width="30px" /> </button></center> </form>';
            $array[] = $row;
        }
        return $array;
     }

     /**
      * Ritorna Json con lista degli autori inseriti a sistema - azione contiene radio button
      * @return $array
      */
     public function GetDataTableAutori_Book()
     {
      $query = "SELECT nome, cognome, luogo_nascita, data_nascita, id_autore as azione FROM autore WHERE enabled = 1";

      $data = exec_query($query);
      $array = [];
      // Fetch one and one row
      foreach ($data as $row) {
         $id = $row["azione"];
         $row["azione"] = '<input type="radio" required name="id_autore" id="id_autore' . $id . '" value="' . $id . '"/>';
         $array[] = $row;
      }
      return $array;
     }

     /**
      * Ritorna Json con lista delle case editrici inseriti a sistema - azione contiene redirect al dettaglio
      * @return $array
      */
     public function GetDataTableCaseEditrici()
     {
        $query = "SELECT nome, indirizzo_web, sede, id_casa_editrice, '' as azione FROM casaeditrice WHERE enabled = 1";
        $data = exec_query($query);
        $array = [];
        // Fetch one and one row
        foreach ($data as $row) {
            $id = $row["id_casa_editrice"];
            $row["azione"] = '<form action="listaCaseEditrici.php" method="POST"> <input type="hidden" name="id_casa_editrice" id="id_casa_editrice" value="' . $id . '"/>
            <center> <button type="submit" name="details" style="background-color: transparent; border-color: transparent;">
            <img class="cursor" src="../images/details.png" width="30px" /> </button></center> </form>';
        $array[] = $row;
        }
        return $array;
     }

     /**
      * Ritorna Json con lista delle case editrici inseriti a sistema - azione contiene radio button
      * @return $array
      */
     public function GetDataTableCaseEditrici_Book()
     {
        $query = "SELECT nome, indirizzo_web, sede, id_casa_editrice, '' as azione FROM casaeditrice WHERE enabled = 1";

         $data = exec_query($query);
         $array = [];
         // Fetch one and one row
         foreach ($data as $row) {
            $id = $row["id_casa_editrice"];
            $row["azione"] = '<input type="radio" name="id_casa_editrice" id="id_casa_editrice' . $id .'" value="' . $id . '" required/>';
            $array[] = $row;
         }
         return $array;
     }

     /**
      * @param mixed $id_utente
      * Ritorna Json con lista delle liste dell'utente
      * @return $array
      */
     public function GetDataTableListe($id_utente)
     {
      $query = "SELECT *, '' as azione FROM lista where enabled = 1 AND id_utente =  ". $id_utente;

      $data = exec_query($query);
      $array = [];
      // Fetch one and one row
      foreach ($data as $row) {
         $id = $row["id_lista"];
         $row["azione"] = '<form action="listaListe.php" method="POST"><input type="hidden" name="id_lista" id="id_lista" value="' . $id . '"/>
          <center> <button type="submit" name="details" style="background-color: transparent; border-color: transparent;">
          <img class="cursor" src="../images/details.png" width="30px" /> </button></center> </form>';
          if ($row["public"] == 0)
          {
              $row["public"] = "<i class='fa fa-lock'></i>";
          }
          else {
              $row["public"] = "<i class='fa fa-unlock'></i>";
          }
         $array[] = $row;
      }
      return $array;
     } 

     /**
      * @param mixed $id_utente
      * Ritorna Json con lista dei preferiti dell'utente
      * @return $array
      */
     public function GetDataTablePreferiti($id_utente)
     {
      $query = "SELECT '' as libro, path_copertina, titolo, descrizione, libro.id_libro, codeISBN, CONCAT(autore.nome, ' ', autore.cognome) as 'autore', casaeditrice.nome as 'casaeditrice'
      FROM libro
      INNER JOIN autore ON autore.id_autore = libro.id_autore
      INNER JOIN casaeditrice ON casaeditrice.id_casa_editrice = libro.id_casa_editrice
      INNER JOIN preferiti ON preferiti.id_libro = libro.id_libro
      WHERE preferiti.id_utente = ". $id_utente;
      
      $data = exec_query($query);
      $array = [];
      // Fetch one and one row
      foreach ($data as $row) {
          $row["libro"] = '<div class="card"><div class="card-header"><strong class="card-title">'. $row["titolo"] .'</strong></div>';
          $row["libro"] .= '<div class="card-body"><div id="pay-invoice"><div class="card-body"><div class="col-md-12"><div class="row"><div class="col-md-6"><div class="col-md-6"><img class="mx-auto d-block" height="300px" src="'. $row["path_copertina"] .'" alt="Card image cap">';
          $row["libro"] .= '</div><div class="col-md-6"><b>Titolo:</b>'. $row["titolo"] .'<br><b>Autore:</b>'. $row["autore"] .'<br><b>Editore:</b>'. $row["casaeditrice"] .'<br>';
          //Stampo i tag del libro
          $tag = "SELECT * FROM tag INNER JOIN librotag ON librotag.id_tag = tag.id_tag WHERE librotag.id_libro = " . $row["id_libro"];
          $tag = exec_query($tag);
          foreach($tag as $t)
          {
              $row["libro"] .= "<span class='badge badge-". $t["colore"] ."'>". $t["nome"] ."</span>&nbsp;&nbsp;";
          }
          $row["libro"] .= '</div></div><div class="col-md-6" style="text-align: justify; border-left: 1px solid rgba(0,0,0,.1)">'. $row["descrizione"] .'</div></div></div>';
          $row["libro"] .= '<br><div class="pull-right footer"><button type="button" id="SetNoFav" name="SetNotFav" class="btn btn-danger" onclick="SetNoFav('. $row["id_libro"]. ')">&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;&nbsp;</button><button class="btn btn-danger" type="button" name="SetFav" id="SetFav" style="display:none" onclick="SetFav('.$row["id_libro"].')">&nbsp;<img width="18px" src="../vendors/css/heart-regular.svg">&nbsp;</button></div></div></div></div></div> <!-- .card -->';
         $array[] = $row;
      }
      return $array;
     }

     /**
      * Ritorna Json con lista dei tag inseriti a sistema
      * @return $array
      */
     public function GetDataTableTag()
     {
      $query = "SELECT id_tag, nome, colore, '' as span, '' as azione FROM tag";

      $data = exec_query($query);
      $array = [];
      // Fetch one and one row
      foreach ($data as $row) {
          $id = $row["id_tag"];
          $row["span"] = '<span class="badge badge-'. $row["colore"] .'">'. $row["nome"] .'</span>';
         $row["azione"] = '<input type="checkbox" name="id_tag" id="id_tag' . $id .'" value="' . $id . '" onclick="add_span_badge_id(\''. $id .'\', \''.$row["nome"].'\', \''.$row["colore"].'\')"/>';
         $array[] = $row;
      }
      return $array;
     }

     #endregion

     #region AUTORI

     /**
      * @param mixed $id_autore
      * Ritorna dettaglio autore
      * @return $row
      */
     public function GetAuthor($id_autore)
     {
         $sql = "SELECT autore.* FROM autore	WHERE autore.id_autore = '$id_autore'";
         $row = exec_query_single($sql);
         return $row;
     }

     /**
      * @param mixed $nome
      * @param mixed $cognome
      * @param mixed $luogo_nascita
      * @param mixed $data_nascita
      * Inserisce nuovo autore
      * @return $row
      */
     public function InsertNewAuthor($nome, $cognome, $luogo_nascita, $data_nascita)
     {
        $connection = open_connection();
		$query = $connection->prepare('INSERT INTO autore(nome, cognome, luogo_nascita, data_nascita, enabled)
        VALUES (?,?,?,?,1)');
		$query->bindParam(1, $nome, PDO::PARAM_STR);
		$query->bindParam(2, $cognome, PDO::PARAM_STR);
		$query->bindParam(3, $luogo_nascita, PDO::PARAM_STR);
		$query->bindParam(4, $data_nascita, PDO::PARAM_STR);
        $query->execute();
        close_connection($connection);
     }

     /**
      * @param mixed $nome
      * @param mixed $cognome
      * @param mixed $luogo_nascita
      * @param mixed $data_nascita
      * @param mixed $id_autore
      * Aggiorna l'autore
      * @return $row
      */
     public function UpdateAuthor($nome, $cognome, $luogo_nascita, $data_nascita, $id_autore)
     {
        $sql = "UPDATE autore SET nome = '$nome', cognome = '$cognome', luogo_nascita = '$luogo_nascita', 
        data_nascita = '$data_nascita' WHERE id_autore = '$id_autore'";
        $row = exec_update($sql);
     }
     /**
      * @param mixed $id_autore
      * Eliminazione logica dell'autore
      * @return $row
      */
     public function SetDisabledAuthor($id_autore)
     {
        $sql = "UPDATE autore SET enabled = 0 WHERE id_autore = '$id_autore'";
        $row = exec_update($sql);
     }

     #endregion

     #region CASE EDITRICI

     /**
      * @param mixed $id_casa_editrice
      * Ritorna dettaglio casa editrice
      * @return $row
      */
     public function GetEditor($id_casa_editrice)
     {
        $sql = "SELECT * FROM casaeditrice WHERE id_casa_editrice = '$id_casa_editrice'";
        $row = exec_query_single($sql);
         return $row;
     }

     /**
      * @param mixed $nome
      * @param mixed $sede
      * @param mixed $indirizzo_web
      * Inserisce nuova casa editrice
      * @return void
      */
     public function InsertNewEditor($nome, $sede, $indirizzo_web)
     {
        $connection = open_connection();
		$query = $connection->prepare('INSERT INTO casaeditrice(nome, sede, indirizzo_web, enabled) VALUES (?,?,?,1)');
		$query->bindParam(1, $nome, PDO::PARAM_STR);
		$query->bindParam(2, $sede, PDO::PARAM_STR);
		$query->bindParam(3, $indirizzo_web, PDO::PARAM_STR);
        $query->execute();
        close_connection($connection);
     }

     /**
      * @param mixed $nome
      * @param mixed $sede
      * @param mixed $indirizzo_web
      * @param mixed $id_editor
      * Aggiorna casa editrice
      * @return void
      */
     public function UpdateEditor($nome, $sede, $indirizzo_web, $id_editor)
     {
        $sql = "UPDATE casaeditrice SET nome = '$nome', sede = '$sede', indirizzo_web = ' $indirizzo_web' WHERE id_casa_editrice = '$idCasaEditrice'";
        $row = exec_update($sql);
     }
     /**
      * @param mixed $id_editor
      * Eliminazione logica casa editrice
      * @return void
      */
     public function SetDisabledEditor($id_editor)
     {
        $sql = "UPDATE casaeditrice SET enabled = 0 WHERE id_casa_editrice = '$id_editor'";
        $row = exec_update($sql);
     }
     
     #endregion

     #region LIBRI

     /**
      * Ritorna lista di libri abilitati a sistema
      * @return $row
      */
     public function GetBookList()
     {
      $sql = "SELECT id_libro FROM libro WHERE enabled = 1";
      return $row = exec_query($sql);
     }

     /**
      * @param mixed $id_libro
      * Ritorna dettaglio libro
      * @return $row
      */
     public function GetBook($id_libro)
     {
        $sql = "SELECT libro.*, CONCAT(autore.nome,' ',autore.cognome) as autore, casaeditrice.nome as casaeditrice FROM libro 
		INNER JOIN autore ON libro.id_autore = autore.id_autore 
		INNER JOIN casaeditrice ON casaeditrice.id_casa_editrice = libro.id_casa_editrice WHERE id_libro = '$id_libro'";
        $row = exec_query_single($sql);
         return $row;
     }

     /**
      * @param mixed $isbn
      * @param mixed $titolo
      * @param mixed $year
      * @param mixed $description
      * @param mixed $id_autore
      * @param mixed $id_casa_editrice
      * @param mixed $prezzo
      * Inserisce un nuovo libro
      * @return int
      */
     public function InsertNewBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo)
     {
        $description = str_replace("'", "\'", $description);
         $connection = open_connection();
         $query = $connection->prepare('INSERT INTO libro(path_copertina, titolo, id_autore, id_casa_editrice, 
         anno, descrizione, enabled, codeISBN, prezzo)
         VALUES ("../book.ico",?,?,?,?,?,1,?,?)');
         $query->bindParam(1, $titolo, PDO::PARAM_STR);
         $query->bindParam(2, $id_autore, PDO::PARAM_INT);
         $query->bindParam(3, $id_casa_editrice, PDO::PARAM_INT);
         $query->bindParam(4, $year, PDO::PARAM_STR);
         $query->bindParam(5, $description, PDO::PARAM_STR);
         $query->bindParam(6, $isbn, PDO::PARAM_STR);
         $query->bindParam(7, $prezzo, PDO::PARAM_STR);
         $query->execute();
         return $this->GetLastIdInserted($connection);
     }

     /**
      * @param mixed $isbn
      * @param mixed $titolo
      * @param mixed $year
      * @param mixed $description
      * @param mixed $id_autore
      * @param mixed $id_casa_editrice
      * @param mixed $prezzo
      * @param mixed $id_libro
      * Aggiorna il libro
      * @return void
      */
     public function UpdateBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo, $id_libro)
     {
         $connection = open_connection();
         $query = $connection->prepare("UPDATE libro SET titolo = ?, anno = ?,descrizione = ?, 
         id_autore = ?, id_casa_editrice = ?, codeISBN = ?, prezzo = ? WHERE libro.id_libro = ?");
          $query->bindParam(1, $titolo, PDO::PARAM_STR);
          $query->bindParam(2, $year, PDO::PARAM_STR);
          $query->bindParam(3, $description, PDO::PARAM_STR);
          $query->bindParam(4, $id_autore, PDO::PARAM_INT);
          $query->bindParam(5, $id_casa_editrice, PDO::PARAM_INT);         
          $query->bindParam(6, $isbn, PDO::PARAM_STR);
          $query->bindParam(7, $prezzo, PDO::PARAM_STR);
          $query->bindParam(8, $id_libro, PDO::PARAM_STR);
          $query->execute();
          close_connection($connection);
     }

     /**
      * @param mixed $path
      * @param mixed $id_libro
      * Aggiorna la copertina del libro
      * @return $row
      */
     public function UpdateBookPath($path, $id_libro)
     {
        $sql = "UPDATE libro SET path_copertina = '$path' WHERE id_libro = '$id_libro'";
        $row = exec_update($sql);
     }
     
     /**
      * @param mixed $id_libro
      * Eliminazione logica del libro
      * @return $row
      */
     public function SetDisabledBook($id_libro)
     {
         $sql = "UPDATE libro SET enabled = 0 WHERE id_libro = '$id_libro'";
         $row = exec_update($sql);
     }

     /**
      * Restiuisce l'id minimo e massimo nella tabella libro
      * @return $minMax
      */
     public function GetRandomNumbers()
     {
      $sql = "SELECT MIN(id_libro) as min, MAX(id_libro) as max FROM libro WHERE enabled = 1";
      return $minMax = exec_query_single($sql);
     }

     #region SEARCH
         /**
          * @param mixed $search
          * Ritorna array libri simili per titolo
          * @return $tit
          */
         public function SearchByTitle($search)
         {
            $tit = "SELECT libro.*
            FROM libro
            WHERE enabled = 1
            AND titolo LIKE '%". $search ."%'";
            return $tit = exec_query($tit);
         }

         /**
          * @param mixed $search
          * Ritorna array libri simili per autore
          * @return $tit
          */
         public function SearchByAuthor($search)
         {
            $tit = "SELECT libro.path_copertina, autore.*
            FROM libro
            INNER JOIN autore ON autore.id_autore = libro.id_autore
            WHERE libro.enabled = 1
            AND autore.nome LIKE '%". $search ."%' OR autore.cognome LIKE '%". $search ."%'";
            return $tit = exec_query($tit);
         }

         /**
          * @param mixed $search
          * Ritorna array libri simili per casa editrice
          * @return $tit
          */
         public function SearchByEditor($search)
         {
            $tit = "SELECT libro.path_copertina, casaeditrice.*
            FROM libro
            INNER JOIN casaeditrice ON casaeditrice.id_casa_editrice = libro.id_casa_editrice
            WHERE libro.enabled = 1
            AND casaeditrice.nome LIKE '%". $search ."%'";
            return $tit = exec_query($tit);
         }

         /**
          * @param mixed $search
          * Ritorna array libri simili per tag
          * @return $tit
          */
         public function SearchByTag($search)
         {
            $tit = "SELECT DISTINCT libro.path_copertina, libro.id_libro
            FROM libro
            INNER JOIN librotag ON librotag.id_libro = libro.id_libro
            INNER JOIN tag ON tag.id_tag = librotag.id_tag
            WHERE libro.enabled = 1
            AND tag.nome LIKE '%". $search ."%'";
            return $tit = exec_query($tit);
         }

         /**
          * @param mixed $search
          * Ritorna array libri simili per lista
          * @return $tit
          */
         public function SearchByList($search)
         {
            $tit =  "SELECT libro.path_copertina, libro.id_libro
            FROM libro
            INNER JOIN listalibro ON listalibro.id_libro = libro.id_libro
            INNER JOIN lista ON lista.id_lista = listalibro.id_lista
            WHERE libro.enabled = 1 AND lista.public = 1
            AND lista.nome LIKE '%". $search ."%'";
            return $tit = exec_query($tit);
         }

      #endregion

     #region SAME

         /**
          * @param mixed $id_libro
          * Ritorna array libri con gli stessi tag
          * @return $query
          */
         public function SameTag($id_libro)
         {
            $query = "SELECT DISTINCT libro.id_libro, path_copertina, titolo, descrizione, codeISBN,
               CONCAT(autore.nome, ' ', autore.cognome) as 'autore', casaeditrice.nome as 'casaeditrice'
               FROM libro
               INNER JOIN autore ON autore.id_autore = libro.id_autore
               INNER JOIN casaeditrice ON casaeditrice.id_casa_editrice = libro.id_casa_editrice
               INNER JOIN librotag ON librotag.id_libro = libro.id_libro
               WHERE librotag.id_tag IN (SELECT librotag.id_tag FROM librotag WHERE librotag.id_libro = " . $id_libro. ")
               AND libro.id_libro <> ". $id_libro;
            return exec_query($query);
         }

         /**
          * @param mixed $id_libro
          * Ritorna array libri con lo stesso autore
          * @return $query
          */
         public function SameAutor($id_libro)
         {
            $query = "SELECT DISTINCT libro.id_libro, path_copertina, titolo, descrizione, codeISBN,
               CONCAT(autore.nome, ' ', autore.cognome) as 'autore', casaeditrice.nome as 'casaeditrice'
               FROM libro
               INNER JOIN autore ON autore.id_autore = libro.id_autore
               INNER JOIN casaeditrice ON casaeditrice.id_casa_editrice = libro.id_casa_editrice
               WHERE autore.id_autore = (SELECT libro.id_autore FROM libro WHERE libro.id_libro = " . $id_libro . ")
               AND libro.id_libro <> ". $id_libro;
            return exec_query($query);
         }

         /**
          * @param mixed $id_libro
          * Ritorna array libri con lo stesso editore
          * @return $query
          */
         public function SameEditor($id_libro)
         {
            $query = "SELECT DISTINCT libro.id_libro, path_copertina, titolo, descrizione, codeISBN,
            CONCAT(autore.nome, ' ', autore.cognome) as 'autore', casaeditrice.nome as 'casaeditrice'
            FROM libro
            INNER JOIN autore ON autore.id_autore = libro.id_autore
            INNER JOIN casaeditrice ON casaeditrice.id_casa_editrice = libro.id_casa_editrice
            WHERE casaeditrice.id_casa_editrice = (SELECT libro.id_casa_editrice FROM libro WHERE libro.id_libro = " . $id_libro . ")
            AND libro.id_libro <> ". $id_libro;
            return exec_query($query);
         }

     #endregion
     #endregion

     #region LIBRO-TAG

      /**
       * @param mixed $id_tag
       * @param mixed $id_libro
       * Inserisce legame libro-tag
       * @return void
       */
      public function InsertNewBookTag($id_tag, $id_libro)
      {
         $connection = open_connection();
         $query = $connection->prepare('INSERT INTO librotag(id_libro, id_tag) VALUES (?,?)');
			$query->bindParam(1, $id_libro, PDO::PARAM_INT);
			$query->bindParam(2, $id_tag, PDO::PARAM_INT);
         $query->execute();
         close_connection($connection);	
      }

      /**
       * @param mixed $id_libro
       * Elimina i tag del libro
       * @return void
       */
      public function DeleteBookTag($id_libro)
      {
         $sql = "DELETE FROM librotag WHERE id_libro = '$id_libro'";
         $row = exec_update($sql);
      }

     #endregion

     #region TAG

     /**
      * @param mixed $nome
      * @param mixed $colore
      * Inserisce il tag
      * @return int
      */
     public function InsertNewTag($nome, $colore)
     {
         $connection = open_connection();
         $query = $connection->prepare('INSERT INTO tag(nome, colore) VALUES (?,?)');
         $query->bindParam(1, $nome, PDO::PARAM_STR);
         $query->bindParam(2, $colore, PDO::PARAM_STR);
         $query->execute();
         return $this->GetLastIdInserted($connection);
     }

     /**
      * @param mixed $id_libro
      * Prende i tag associati al libro
      * @return $tag
      */
     public function GetTagByBook($id_libro)
     {
      $tag = "SELECT * FROM tag INNER JOIN librotag ON librotag.id_tag = tag.id_tag
         WHERE librotag.id_libro = " . $id_libro;
      return $tag = exec_query($tag);
     }

     #endregion

     #region LIBRO-LISTA

     /**
      * @param mixed $id_libro
      * @param mixed $id_lista
      * @param mixed $is_read
      * Inserisce il libro nella lista
      * @return void
      */
     public function InsertBookList($id_libro, $id_lista, $is_read)
     {
      $connection = open_connection();
        $query = $connection->prepare('INSERT INTO listalibro(id_lista, id_libro, is_read) VALUES (?,?,?)');
        $query->bindParam(1, $id_lista, PDO::PARAM_STR);
        $query->bindParam(2, $id_libro, PDO::PARAM_INT);
        $query->bindParam(3, $is_read, PDO::PARAM_INT);
        $query->execute();
        close_connection($connection);
     }
     /**
      * @param mixed $id_libro
      * @param mixed $id_lista
      * Elimina il libro dalla lista
      * @return void
      */
     public function DeleteBookList($id_libro, $id_lista)
     {
      $sql = "DELETE FROM listalibro WHERE id_lista = '$id_lista' AND id_libro = '$id_libro'";
		$row = exec_update($sql);
     }
     
     /**
      * @param mixed $id_libro
      * @param mixed $id_lista
      * @param mixed $is_read
      * Aggiorna il campo is_read nel legame lista-libro
      * @return void
      */
     public function UpdateIsRead($id_libro, $id_lista, $is_read)
     {
      $sql = "UPDATE listalibro SET is_read = $is_read WHERE id_lista = '$id_lista' AND id_libro = '$id_libro'";
		$row = exec_update($sql);
     }

     #endregion

     #region LISTE

     /**
      * @param mixed $id_lista
      * Dettaglio lista
      * @return $sql
      */
     public function GetList($id_lista)
     {
      $sql = "SELECT * FROM lista WHERE id_lista = '$id_lista'";
      return exec_query_single($sql);
     }

     /**
      * @param mixed $id_utente
      * Restituisce lista di liste in base all'utente
      * @return $list
      */
     public function GetListByUser($id_utente)
     {
      $list =  "SELECT * FROM lista WHERE enabled = 1 AND id_utente = ". $id_utente;
      return $list = exec_query($list);
     }
     /**
      * @param mixed $nome
      * @param mixed $public
      * @param mixed $id_utente
      * Inserisce una nuova lista
      * @return void
      */
     public function InsertNewList($nome, $public, $id_utente)
     {
         $connection = open_connection();
         $query = $connection->prepare('INSERT INTO lista(nome, public, id_utente) VALUES (?,?,?)');
         $query->bindParam(1, $nome, PDO::PARAM_STR);
         $query->bindParam(2, $public, PDO::PARAM_INT);
         $query->bindParam(3, $id_utente, PDO::PARAM_INT);
         $query->execute();
         close_connection($connection);
     }
     /**
      * @param mixed $nome
      * @param mixed $public
      * @param mixed $id_lista
      * Aggiorna la lista
      * @return $row
      */
     public function UpdateList($nome, $public, $id_lista)
     {
      $sql = "UPDATE lista SET nome = '$nome', public = $public WHERE id_lista = '$id_lista'";
      $row = exec_update($sql);
     }
     /**
      * @param mixed $id_lista
      * Eliminazione logica della lista
      * @return $row
      */
     public function SetDisabledList($id_lista)
    {
      $sql = "UPDATE lista SET enabled = 0 WHERE id_lista = '$id_lista'";
      $row = exec_update($sql);
    }

    /**
     * @param mixed $id_libro
     * In base al libro restituisce la lista di appartenenza
     * @return $listaList
     */
    public function GetListByBook($id_libro)
    {
      $listaList = "SELECT *
      FROM lista
      INNER JOIN listalibro ON listalibro.id_lista = lista.id_lista
      WHERE listalibro.id_libro = " . $id_libro;
      return $listaList = exec_query($listaList);
    }
     #endregion

     #region FAVORITI

     /**
      * @param mixed $id_libro
      * @param mixed $id_utente
      * Verifica se un libro è tra i favoriti
      * @return $pref
      */
     public function IsFavorite($id_libro, $id_utente)
     {
      $pref = "SELECT id_libro FROM preferiti WHERE id_libro = ". $id_libro." AND id_utente = ". $id_utente;
      return $pref = exec_query_single($pref);
     }

     /**
      * @param mixed $id_libro
      * @param mixed $id_utente
      * Inserisce un libro tra i favoriti
      * @return void
      */
     public function SetFavorite($id_libro, $id_utente)
     {
      $connection = open_connection();
      $query = $connection->prepare('INSERT INTO preferiti(id_libro, id_utente) VALUES (?,?)');
      $query->bindParam(1, $id_libro, PDO::PARAM_INT);
      $query->bindParam(2, $id_utente, PDO::PARAM_INT);
      $query->execute();
      close_connection($connection);
     }

     /**
      * @param mixed $id_libro
      * @param mixed $id_utente
      * Elinina un libro dai favoriti
      * @return void
      */
     public function SetNotFavorite($id_libro, $id_utente)
     {
      $sql = "DELETE FROM preferiti WHERE id_libro = '$id_libro' AND id_utente = '$id_utente'";
      $row = exec_update($sql);
     }

     #endregion

     #region CARRELLO

     /**
      * @param mixed $id_utente
      * Restituisce i libri inseriti nel carrello
      * @return $sql
      */
     public function GetCart($id_utente)
     {
         $sql = "SELECT DISTINCT libro.*, CONCAT(autore.nome, ' ', autore.cognome) as 'autore', COUNT(*) as 'count'
         FROM carrello
         INNER JOIN libro ON carrello.id_libro = libro.id_libro
         INNER JOIN autore ON libro.id_autore = autore.id_autore
         WHERE carrello.id_utente = " . $id_utente ." GROUP BY libro.id_libro";
         $sql = exec_query($sql);
         return $sql;
     }

      /**
       * @param mixed $id_utente
       * Restuituisce il totale prezzo del carrello
       * @return $sql
       */
      public function GetTotalCart($id_utente)
      {
         $sql = "SELECT SUM(libro.prezzo) as totale
         FROM carrello
         INNER JOIN libro ON carrello.id_libro = libro.id_libro
         WHERE carrello.id_utente = ". $id_utente;
         return exec_query_single($sql);
      }

      /**
       * @param mixed $id_libro
       * @param mixed $id_utente
       * Inserisce libro nel carrello
       * @return void
       */
      public function InsertNewCart($id_libro, $id_utente)
      {
         $connection = open_connection();
         $query = $connection->prepare('INSERT INTO carrello(id_libro, id_utente) VALUES (?,?)');
         $query->bindParam(1, $id_libro, PDO::PARAM_INT);
         $query->bindParam(2, $id_utente, PDO::PARAM_INT);
         $query->execute();
         close_connection($connection);
      }

      /**
       * @param mixed $id_libro
       * @param mixed $id_utente
       * Elimina libro dal carrello
       * @return void
       */
      public function RemoveSingleBook($id_libro, $id_utente)
      {
         $sql = "DELETE FROM carrello WHERE id = (SELECT MAX(id) FROM carrello
          WHERE id_utente = '$id_utente' AND id_libro = '$id_libro')";
         $row = exec_update($sql);
      }

     #endregion

     #region USER

     /**
      * Restuisce dettaglio user collegato
      * @return $row
      */
     public function GetUser()
     {
      $connection = open_connection();
      $sql = "SELECT id_utente, nome, cognome, username, path_foto, mail, bio FROM utente WHERE id_utente = " .$_SESSION['id_utente'];
      $row = exec_query_single($sql);
      close_connection($connection);
      return $row;
     }
     /**
      * @param mixed $id_utente
      * Restiuisce dettaglio user
      * @return $row
      */
     public function GetUserById($id_utente)
     {
      $connection = open_connection();
      $sql = "SELECT id_utente, nome, cognome, username, path_foto, mail, bio FROM utente WHERE id_utente = " .$id_utente;
      $row = exec_query_single($sql);
      close_connection($connection);
      return $row;
     }
     /**
      * @param mixed $id_utente
      * @param mixed $path
      * Restuituisce dettaglio  user in base all'id e all'avatar
      * @return $result
      */
     public function GetUserByIdPath($id_utente, $path)
     {
      $connection = open_connection();
      $query = "SELECT * FROM utente WHERE path_foto = '$path' AND id_utente = '$id_utente'";
      $result = exec_query($query);
      close_connection($connection);
      return $result;
     }  
     /**
      * @param mixed $mail
      * @param mixed $hashedPassword
      * Restuituisce dettaglio  user in base alla mail e alla pw (login)
      * @return $sql
      */
     public function GetUserByLogin($mail, $hashedPassword)
     {
         $connection = open_connection();
      
         $sql = "SELECT * FROM utente WHERE mail = '$mail' AND password = '$hashedPassword'";
         if(!$sql)
         {
            header("Location: error/page_server_error.php");       
         }
         return exec_query_single($sql);
     }
     /**
      * @param mixed $nome
      * @param mixed $mail
      * Restuituisce dettaglio  user in base allo username e alla mail
      * @return $result
      */
     public function GetUserByNomeMail($nome, $mail)
     {
      $query = "SELECT * FROM utente WHERE username = '$nome' AND mail = '$mail'";
      return $result = exec_query($query);
     }
     /**
      * @param mixed $nome
      * @param mixed $cognome
      * @param mixed $username
      * @param mixed $hashedPassword
      * @param mixed $mail
      * @param mixed $path_foto
      * Inserisce un nuovo utente
      * @return int
      */
     public function CreateNewUser($nome, $cognome, $username, $hashedPassword, $mail, $path_foto)
     {
      $connection = open_connection();
      $query = $connection->prepare('INSERT INTO utente(nome, cognome, username, password, mail, path_foto) VALUES (?,?,?,?,?,?)');
      $query->bindParam(1, $nome, PDO::PARAM_STR);
      $query->bindParam(2, $cognome, PDO::PARAM_STR);
      $query->bindParam(3, $username, PDO::PARAM_STR);
      $query->bindParam(4, $hashedPassword, PDO::PARAM_STR);
      $query->bindParam(5, $mail, PDO::PARAM_STR);
      $query->bindParam(6, $path_foto, PDO::PARAM_STR);
      $query->execute();
      return $this->GetLastIdInserted($connection);
     }
     /**
      * @param mixed $nome
      * @param mixed $cognome
      * @param mixed $username
      * @param mixed $path_foto
      * @param mixed $bio
      * @param mixed $id_utente
      * Aggiorna dati utente
      * @return void
      */
     public function UpdateUser($nome, $cognome, $username, $path_foto, $bio, $id_utente)
     {
      exec_update("UPDATE utente SET nome = '$nome', cognome = '$cognome', username = '$username', path_foto = '$path_foto', bio = '$bio' WHERE id_utente = '$id_utente'");
     }
     /**
      * @param mixed $hashedPassword
      * @param mixed $id_utente
      * Aggiorna pw utente
      * @return void
      */
     public function UpdatePassword($hashedPassword, $id_utente)
     {
        exec_update("UPDATE utente set password = '$hashedPassword' WHERE id_utente = '$id_utente'");
     }

     #endregion

     #region KPI

     /**
      * @param mixed $id_utente
      * Restituisce numero libri non letti
      * @return $not_read
      */
     public function GetBookNotReaded($id_utente)
     {
         $not_read = "SELECT COUNT(*) as 'value' FROM listalibro INNER JOIN lista ON listalibro.id_lista = lista.id_lista WHERE is_read = 0 AND lista.id_utente = ". $id_utente;
         $not_read = exec_query_single($not_read);
         return $not_read;
     }

     /**
      * @param mixed $id_utente
      * Restituisce numero libri letti
      * @return $read
      */
     public function GetBookReaded($id_utente)
     {
         $read = "SELECT COUNT(*) as 'value' FROM listalibro INNER JOIN lista ON listalibro.id_lista = lista.id_lista WHERE is_read = 1 AND lista.id_utente = ". $id_utente;
         $read = exec_query_single($read);
         return $read;
     }

     /**
      * @param mixed $id_utente
      * Restituisce numero liste
      * @return $list
      */
     public function GetListNumber($id_utente)
     {
        $list = "SELECT COUNT(*) as 'value' FROM lista WHERE lista.id_utente = ". $id_utente;
        $list = exec_query_single($list);
         return $list;
     }

     /**
      * @param mixed $id_utente
      * Restituisce numero preferiti
      * @return $preferiti
      */
     public function GetFavorite($id_utente)
     {
        $preferiti = "SELECT COUNT(*) as 'value' FROM preferiti WHERE id_utente = ". $id_utente;
        $preferiti = exec_query_single($preferiti);
         return $preferiti;
     }

     /**
      * Restituisce numero totale libri a sistema
      * @return $book
      */
     public function GetTotalBook()
     {
        $book = "SELECT COUNT(*) as 'value' FROM libro WHERE enabled = 1";
        $book = exec_query_single($book);
        return $book;
     }

     /**
      * Restituisce numero autori a sistema
      * @return int
      */
     public function GetTotalAuthor()
     {
        $author = "SELECT COUNT(*) as 'value' FROM autore WHERE enabled = 1";
        $author = exec_query_single($author);
        return $author;
     }

     /**
      * Restituisce numero case editrici a sistema
      * @return $editor
      */
     public function GetTotalEditor()
     {
        $editor = "SELECT COUNT(*) as 'value' FROM casaeditrice WHERE enabled = 1";
        $editor = exec_query_single($editor);
        return $editor;
     }

     #endregion
 
     #region GENERIC

     /**
      * @param mixed $connection
      * Restituisce ultimo id inserito
      * @return $last_id
      */
     public function GetLastIdInserted($connection)
     {
        $last_id = $connection->lastInsertId();
        close_connection($connection);
        return $last_id;
     }

     #endregion
   }
?>