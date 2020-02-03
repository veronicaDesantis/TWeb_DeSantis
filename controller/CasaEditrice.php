<?php
/**
 * Class CasaEditrice
 */
class CasaEditrice
{
    /**
     * Dettaglio casa editrice
     * 
     * @param mixed $id_casa_editrice
     * 
     * @return void
     */
    public function GetEditor($id_casa_editrice)
    {
        $qry = new Query;
        $row = $qry->GetEditor($id_casa_editrice);
        return $row;
    }
    /**
     * Inserimento casa editrice
     * 
     * @param mixed $nome
     * @param mixed $sede
     * @param mixed $indirizzo_web
     * 
     * @return void
     */
    public function InsertNewEditor($nome, $sede, $indirizzo_web)
    {
        $qry = new Query;
        $qry->InsertNewEditor($nome, $sede, $indirizzo_web);
    }
    /**
     * Aggiornamento casa editrice
     * 
     * @param mixed $nome
     * @param mixed $sede
     * @param mixed $indirizzo_web
     * @param mixed $id_editor
     * 
     * @return void
     */
    public function UpdateEditor($nome, $sede, $indirizzo_web, $id_editor)
    {
        $qry = new Query;
        $qry->UpdateEditor($nome, $sede, $indirizzo_web, $id_editor);
    }
    /**
     * Eliminazione logica casa editrice
     * 
     * @param mixed $id_editor
     * 
     * @return void
     */
    public function SetDisabledEditor($id_editor)
    {
        $qry = new Query;
        $qry->SetDisabledEditor($id_editor);
    }
}
?>