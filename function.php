<?php
function connect_db()
{
    require_once '_connec.php';
    $pdo = new \PDO( DSN, USER, PASS);
    return $pdo;
}

function get_data()
{
   /* $query = " SELECT * FROM book";
    $statement = $pdo->query($query);
    $books = $statement->fetchAll();
    return $books;*/
}
function detailData($table, $idOfTable, $nameGet)
{
    global $pdo;
    $query = 'SELECT * FROM '.$table.' WHERE '. $idOfTable.'=:idGet' ;
    //query prepare with PDO
    $statement = $pdo->prepare($query);
    //definie ':myid'
    $statement->bindParam(':idGet', $nameGet, \PDO::PARAM_INT);
    //execute the query
    $statement->execute();
    $array = $statement->fetch(PDO::FETCH_ASSOC);
    return $array;
}
function queryBook($nameTable)
{   // ou $pdo=connect_db();
    global $pdo;
    $query = "SELECT * FROM $nameTable";
    $statement = $pdo->query($query);
    $array = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $array;

}
function deleteData($tableDelete, $idOfTableDelete, $nameGetDelete) {
    global $pdo;
    $id = $nameGetDelete;
    $query = 'DELETE FROM ' . $tableDelete . ' WHERE ' . $idOfTableDelete . ' = :idGet';
    // Préparation de la requête avec PDO
    $statement = $pdo->prepare($query);
    // Définition de la valeur associée à ':idGet'
    $statement->bindValue(':idGet', $id, \PDO::PARAM_INT);
    // Exécution de la requête
    $statement->execute();
    $message= $statement->execute();
    return $message;
}

function addData($table,$text1,$text2, $titlebdd,$desc_bdd, $bindTitle, $bindDescription){
    global $pdo;
 
    $title = $_POST[$text1];
    $description = $_POST[$text2];
    
    $query = $pdo->prepare("INSERT INTO $table ($titlebdd, $desc_bdd) VALUES ($bindTitle,$bindDescription )");
    $query->bindParam($bindTitle, $title, PDO::PARAM_STR);
    $query->bindParam( $bindDescription, $description, PDO::PARAM_STR);
    $query_execute = $query->execute();
    return $query_execute;
}






?>

