<?php
session_start();
require_once('database.php');
include('header.php');


?>


    <h2>Modifier un auteur</h2>
<?php
if(isset($_GET['id_author']))
{

    $author = $_GET['id_author'];
    $query ="SELECT * FROM author WHERE author_id = :id_auth LIMIT 1";
    $stmt = $pdo->prepare($query);
    $data =[
        'id_auth' => $author
    ];
    $stmt -> execute($data);
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['btn_update_author']))
{
    $id_author = $_POST['author_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    try{
        $query ="UPDATE author SET first_name=:first_name, last_name=:last_name WHERE author_id=:author__id LIMIT 1";
        $stmt = $pdo->prepare($query);

        $data =[
            ':first_name' => $first_name,
            ':last_name'=>$last_name,
            ':author__id' => $id_author,
        ];


        $query_execute = $stmt->execute($data);

        if($query_execute){
        
            header("Location: index.php");
            exit();
        }else{
         
            header("Location: index.php");
            exit();
        }



    }catch(PDOException $e){
        echo $e->getMessage();
    }
}





?>
    <form action="" method="post">

        <input type="hidden" name="author_id" value="<?= $result['author_id']; ?>">
        <label for="first_name">Nom</label>
        <input type="text" name="first_name" id="first_name" value="<?= $result['first_name']; ?>" required>
        
        <br>
        
        <label for="last_name">Prénom</label>
    
        <textarea name="last_name" id="last_name" rows="4" value="<?= $result['last_name']; ?>" required><?= $result['last_name']; ?></textarea>
        
        <br>
        
        <input type="submit" name="btn_update_author" value="Modifier">
    </form>






    
  





