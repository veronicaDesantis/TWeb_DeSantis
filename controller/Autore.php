<?php include '../model/query.php';
/**
 * Class Autore
 */
class Autore
{
    
    /**
     * Dettaglio autore
     * 
     * @param mixed $id_autore
     * 
     * @return void
     */
    public function GetAuthor($id_autore)
    {
        $qry = new Query;
        $row = $qry->GetAuthor($id_autore);
        return $row;
    }
    /**
     * Inserimento nuovo autore
     * 
     * @param mixed $nome
     * @param mixed $cognome
     * @param mixed $luogo_nascita
     * @param mixed $data_nascita
     * 
     * @return void
     */
    public function InsertNewAuthor($nome, $cognome, $luogo_nascita, $data_nascita)
    {
        $qry = new Query;
        $qry->InsertNewAuthor($nome, $cognome, $luogo_nascita, $data_nascita);
    }
    /**
     * Aggiornamento autore
     * 
     * @param mixed $nome
     * @param mixed $cognome
     * @param mixed $luogo_nascita
     * @param mixed $data_nascita
     * @param mixed $id_autore
     * 
     * @return void
     */
    public function UpdateAuthor($nome, $cognome, $luogo_nascita, $data_nascita, $id_autore)
    {
        $qry = new Query;
        $qry->UpdateAuthor($nome, $cognome, $luogo_nascita, $data_nascita, $id_autore);
    }
    /**
     * Eliminazione logica autore
     * 
     * @param mixed $id_autore
     * 
     * @return void
     */
    public function SetDisabledAuthor($id_autore)
    {
        $qry = new Query;
        $qry->SetDisabledAuthor($id_autore);
    }
}
?>