<?php
session_start();
require_once('database.php');

$id = $_GET['id_author'];
$query = 'DELETE FROM author WHERE author_id = :idGet' ;
    //query prepare with PDO
    $statement = $pdo->prepare($query);
    //definie ':myid'
    $statement->bindValue(':idGet', $id, \PDO::PARAM_INT);
    //execute the query
    $statement->execute();




//$result = $pdo->query("DELETE FROM author WHERE author_id = " . $_GET['id_author']);

header('Location: index.php');

?>