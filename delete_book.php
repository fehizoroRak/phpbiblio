<?php
session_start();
require_once('database.php');
require_once('function.php');

/*$id = $_GET['identifiant'];
$query = 'DELETE FROM book WHERE id_book = :idGet' ;
    //query prepare with PDO
    $statement = $pdo->prepare($query);
    //definie ':myid'
    $statement->bindValue(':idGet', $id, \PDO::PARAM_INT);
    //execute the query
    $statement->execute();*/

    $message = deleteData('book','id_book',$_GET['identifiant']);

// ici, la requete non préparée
//$result = $pdo->query("DELETE FROM book WHERE id_book = " . $_GET['identifiant']);

if($message){
    $_SESSION['messageDelete'] ="Deleted successfully";
    header("Location: index.php");
    exit();
}else{
    $_SESSION['messageDelete'] ="Not deleted ";
    header("Location: index.php");
    exit();
}


header('Location: index.php');
die;

?>