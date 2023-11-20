<?php
session_start();
require_once('database.php');

$id = $_GET['id__user'];
$query = 'DELETE FROM users WHERE users_id = :idGet' ;
    //query prepare with PDO
    $statement = $pdo->prepare($query);
    //definie ':myid'
    $statement->bindValue(':idGet', $id, \PDO::PARAM_INT);
    //execute the query
    $statement->execute();

//$result = $pdo->query("DELETE FROM users WHERE users_id = " . $_GET['id__user']);

header('Location: index.php');
die;

?>