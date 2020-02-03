<?php
if(!isset($_SESSION)) {session_start();}

/**
 * db_connection.php
 * 
 * Apre la connessione al db
 * 
 * @return void
 */
function open_connection()
{
    try
    {
        $connection = new PDO('mysql:host=localhost;dbname=bookManager;charset=utf8', 'sa', 'p4$$w0rd');
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
    return $connection;
}
/**
 * Chiude la connessione al db
 * 
 * @return void
 */
function close_connection($conn)
{
    $conn = null;
}
/**
 * Esegue una select
 * 
 * @param mixed $sql
 * 
 * @return void
 */
function exec_query($sql)
{
    $connection = open_connection();
    $return = $connection->query($sql);
    if(!$return)
    {
        close_connection($connection);
        return false;
    }
    else
    {
        close_connection($connection);
        return $return->fetchAll(PDO::FETCH_ASSOC); // null se la query è vuota
    }
}

/**
 * Esegue una select, prende il primo risultato
 * 
 * @param mixed $sql
 * 
 * @return $return->fetch(PDO::FETCH_ASSOC)
 */
function exec_query_single($sql)
{
    $connection = open_connection();
    $return = $connection->query($sql);
    if(!$return)
    {
        close_connection($connection);
        return false;
    }
    else
    {
        close_connection($connection);
        return $return->fetch(PDO::FETCH_ASSOC); // null se la query è vuota
    }
}
/**
 * Esegue un update
 * 
 * @param mixed $sql 
 *  
 * @return bool
 */
function exec_update($sql)
{
    $connection = open_connection();
    $query = $connection->prepare($sql);
    if ($query == false) {
        header("location: ../error/page_server_error.html");
    }
    $result = $query->execute();
    if($result == false)
    {
        header("location: ../error/page_server_error.html");
    }
    close_connection($connection);
    return true;
}
/**
 * Verifica  se l'utente è loggato
 *  
 *  
 * @return void
 */
function is_logged() {
    if (!isset($_SESSION["username"])) {
        header("Location: ../error/page_unauthorized.html");
    }
}
/**
 * Fa partire la sessione
 *  
 * @return void
 */
function start_session($user_info)
{
    session_start();
    $_SESSION['username'] = $user_info['username'];
    $_SESSION['id_utente'] = $user_info['id_utente'];
    $_SESSION['session_id'] = session_id();
}

/**
 * Re-inizializza tutte le sessioni instanziate
 * 
 * @return void
 */
function unset_session()
{
    session_unset();
    session_destroy();
    session_start();
    header("Location: login.php");
}
?>