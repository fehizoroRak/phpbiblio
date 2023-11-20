<?php
session_start();

require_once('database.php');
include('header.php');
include('function.php');

if (!empty($_POST)) {

    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $query = $pdo->prepare("INSERT INTO author (first_name, last_name) VALUES (:first_name, :last_name)");
    $query->bindParam(':first_name', $firstname, PDO::PARAM_STR);
    $query->bindParam(':last_name', $lastname, PDO::PARAM_STR);
    $query_execute = $query->execute();
    header("Location: index.php");
  

if($query_execute){
    $_SESSION['messageAdd'] ="Added successfully";
    header("Location: index.php");
    exit();
}else{
    $_SESSION['messageAdd'] ="Not added ";
    header("Location: index.php");
    exit();
}
    header('Location:index.php');
    die;
}



?>


    <h2>Ajouter de nouveaux auteurs</h2>

    <form action="" method="post">
        <label for="first_name">Firstname</label>
        <input type="text" name="first_name" id="first_name" required>
        
        <br>
        
        <label for="last_name">Lastname</label>
        <input name="last_name" id="last_name" rows="4" required>
        
        <br>
        
        <input type="submit" value="Ajouter">
    </form>






    
  





