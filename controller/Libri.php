<?php
/**
 * Class Libri
 */
class Libri
{
    /**
     * Dettaglio di un libro
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function GetBook($id_libro)
    {
        $qry = new Query;
        $row = $qry->GetBook($id_libro);
        return $row;
    }
    
    /**
     * Inserimento libro
     * 
     * @param mixed $isbn
     * @param mixed $titolo
     * @param mixed $year
     * @param mixed $description
     * @param mixed $id_autore
     * @param mixed $id_casa_editrice
     * @param mixed $prezzo
     * 
     * @return void
     */
    public function InsertNewBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo)
    {
        $qry = new Query;
        return $qry->InsertNewBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo);
    }
    
    /**
     * Aggiornamento libro
     * 
     * @param mixed $isbn
     * @param mixed $titolo
     * @param mixed $year
     * @param mixed $description
     * @param mixed $id_autore
     * @param mixed $id_casa_editrice
     * @param mixed $prezzo
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function UpdateBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo, $id_libro)
    {
        $qry = new Query;
        $qry->UpdateBook($isbn, $titolo, $year, $description, $id_autore, $id_casa_editrice, $prezzo, $id_libro);
    }
    
    /**
     * Aggiorna il path della copertina
     * 
     * @param mixed $path
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function UpdateBookPath($path, $id_libro)
    {
        $qry = new Query;
        $qry->UpdateBookPath($path, $id_libro);
    }
    
    /**
     * Eliminazione logica libro
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function SetDisabledBook($id_libro)
    {
        $qry = new Query;
        $qry->SetDisabledBook($id_libro);
    }
    
    /**
     * Prende massimo e minimo di id_libro
     * 
     * @return void
     */
    public function GetRandomNumbers()
    {
        $qry = new Query;
        return $qry->GetRandomNumbers();
    }
    
    /**
     * Prende tutta la lista di libri
     * 
     * @return void
     */
    public function GetBookList()
    {
        $qry = new Query;
        return $qry->GetBookList();
    }

    #region SEARCH

        /**
         * Ricerca i libri dal titolo
         * 
         * @param mixed $search
         * 
         * @return void
         */
        public function SearchByTitle($search)
        {
            $qry = new Query;
            return $qry->SearchByTitle($search);
        }
        /**
         * Ricerca i libri dall'autore
         * 
         * @param mixed $search
         * 
         * @return void
         */
        public function SearchByAuthor($search)
        {
            $qry = new Query;
            return $qry->SearchByAuthor($search);
        }
        /**
         * Ricerca i libri dall'editore
         * 
         * @param mixed $search
         * 
         * @return void
         */
        public function SearchByEditor($search)
        {
            $qry = new Query;
            return $qry->SearchByEditor($search);
        }
        /**
         * Ricerca i libri dai tag
         * 
         * @param mixed $search
         * 
         * @return void
         */
        public function SearchByTag($search)
        {
            $qry = new Query;
            return $qry->SearchByTag($search);
        }
        /**
         * Ricerca i libri dalle liste
         * 
         * @param mixed $search
         * 
         * @return void
         */
        public function SearchByList($search)
        {
            $qry = new Query;
            return $qry->SearchByList($search);
        }

    #endregion

    #region SAME

        /**
         * Restiuisce i libri con gli stessi tag
         * 
         * @param mixed $id_libro
         * 
         * @return void
         */
        public function SameTag($id_libro)
        {
            $qry = new Query;
            return $qry->SameTag($id_libro);
        }
        /**
         * Restiuisce i libri con gli stessi autori
         * 
         * @param mixed $id_libro
         * 
         * @return void
         */
        public function SameAutor($id_libro)
        {
            $qry = new Query;
            return $qry->SameAutor($id_libro);
        }
        /**
         * Restiuisce i libri con lo stesso editore
         * 
         * @param mixed $id_libro
         * 
         * @return void
         */
        public function SameEditor($id_libro)
        {
            $qry = new Query;
            return $qry->SameEditor($id_libro);
        }

    #endregion
}

/**
 * Class Tag
 */
class Tag
{
    
    /**
     * Inserimento tag
     * 
     * @param mixed $nome
     * @param mixed $colore
     * 
     * @return void
     */
    public function InsertNewTag($nome, $colore)
    {
        $qry = new Query;
        return $qry->InsertNewTag($nome, $colore);
    }
    
    /**
     * Lista tag del libro
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function GetTagByBook($id_libro)
    {
        $qry = new Query;
        return $qry->GetTagByBook($id_libro);
    }
}

/**
 * Class LibroTag
 */
class LibroTag
{
    
    /**
     * Inserimento legame libro tag
     * 
     * @param mixed $id_tag
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function InsertNewBookTag($id_tag, $id_libro)
    {
        $qry = new Query;
        return $qry->InsertNewBookTag($id_tag, $id_libro);
    }

    /**
     * Elimina tutti i legami libro tag
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function DeleteBookTag($id_libro)
    {
        $qry = new Query;
        return $qry->DeleteBookTag($id_libro);
    }
}

/**
 * Class Liste
 */
class Liste
{

    /**
     * Dettaglio lista
     * 
     * @param mixed $id_lista
     * 
     * @return void
     */
    public function GetList($id_lista)
    {
        $qry = new Query;
        $row = $qry->GetList($id_lista);
        return $row;
    }
    /**
     * Inserimento lista
     * 
     * @param mixed $nome
     * @param mixed $public
     * @param mixed $id_utente
     * 
     * @return int
     */
    public function InsertNewList($nome, $public, $id_utente)
    {
        $qry = new Query;
        return $qry->InsertNewList($nome, $public, $id_utente);
    }
    /**
     * Aggiornamento lista
     * 
     * @param mixed $nome
     * @param mixed $public
     * @param mixed $id_lista
     * 
     * @return void
     */
    public function UpdateList($nome, $public, $id_lista)
    {
        $qry = new Query;
        $qry->UpdateList($nome, $public, $id_lista);
    }
    /**
     * Eliminazione logica lista
     * 
     * @param mixed $id_lista
     * 
     * @return void
     */
    public function SetDisabledList($id_lista)
    {
        $qry = new Query;
        $qry->SetDisabledList($id_lista);
    }
    
    /**
     * Prendo le liste di un libro
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function GetListByBook($id_libro)
    {
        $qry = new Query;
        return $qry->GetListByBook($id_libro);
    }
    
    /**
     * Prendo le liste di un utente
     * 
     * @return void
     */
    public function GetListByUser()
    {
        $user = new User;
        $qry = new Query;
        $id_utente = $user->GetIdUtente();
        return $qry->GetListByUser($id_utente);
    }
}

/**
 * Class ListaLibro
 */
class ListaLibro
{
    
    /**
     * Inserisce il libro nella lista
     * 
     * @param mixed $id_libro
     * @param mixed $id_lista
     * @param mixed $is_read
     * 
     * @return void
     */
    public function InsertBookList($id_libro, $id_lista, $is_read)
    {
        $qry = new Query;
        $qry->InsertBookList($id_libro, $id_lista, $is_read);
    }
    /**
     * Elimino legame lista-libro
     * 
     * @param mixed $id_libro
     * @param mixed $id_lista
     * 
     * @return void
     */
    public function DeleteBookList($id_libro, $id_lista)
    {
        $qry = new Query;
        $qry->DeleteBookList($id_libro, $id_lista);
    }
    /**
     * Aggiorno lo stato - letto/non letto
     * 
     * @param mixed $id_libro
     * @param mixed $id_lista
     * @param mixed $is_read
     * 
     * @return void
     */
    public function UpdateIsRead($id_libro, $id_lista, $is_read)
    {
        $qry = new Query;
        $qry->UpdateIsRead($id_libro, $id_lista, $is_read);
    }
}

/**
 * Class Preferiti
 */
class Preferiti
{
    
    /**
     * Verifico se il libro è tra i preferiti
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function IsFavorite($id_libro)
    {
        $qry = new Query;
        $user = new User;
        return $qry->IsFavorite($id_libro, ($user->GetIdUtente()));
    }
    /**
     * Imposto il libro come preferito
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function SetFavorite($id_libro)
    {
        $qry = new Query;
        $user = new User;
        return $qry->SetFavorite($id_libro, ($user->GetIdUtente()));
    }
    /**
     * Imposto il libro come non preferito
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function SetNotFavorite($id_libro)
    {
        $qry = new Query;
        $user = new User;
        return $qry->SetNotFavorite($id_libro, ($user->GetIdUtente()));
    }
}

/**
 * Class Carrello
 */
class Carrello
{
    /**
     * Totale nel carrello
     * 
     * @return void
     */
    public function GetTotalCart()
    {
        $qry = new Query;
        $user = new User;
        $row = $qry->GetTotalCart($user->GetIdUtente());
        return $row;
    }

    /**
     * Inserisce il libro nel carrello
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function InsertNewCart($id_libro)
    {
        $qry = new Query;
        $user = new User;
        $row = $qry->InsertNewCart($id_libro, $user->GetIdUtente());
        return $row;
    }

    /**
     * Elimina un singolo libro dal carrello
     * 
     * @param mixed $id_libro
     * 
     * @return void
     */
    public function RemoveSingleBook($id_libro)
    {
        $qry = new Query;
        $user = new User;
        $row = $qry->RemoveSingleBook($id_libro, $user->GetIdUtente());
    }

    /**
     * Lista libri nel carrello
     * 
     * @return void
     */
    public function GetCart()
    {
        $qry = new Query;
        $user = new User;
        $row = $qry->GetCart($user->GetIdUtente());
        return $row;
    }
}
?>