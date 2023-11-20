<?php
session_start();
require_once('database.php');
include('header.php');


?>

    <h2>Modifier un livre</h2>
<?php
if(isset($_GET['identifiant']))
{

    $identifiant = $_GET['identifiant'];
    $query ="SELECT * FROM book WHERE id_book = :id LIMIT 1";
    $stmt = $pdo->prepare($query);
    $data =[
        'id' => $identifiant
    ];
    $stmt -> execute($data);
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['btn_update_book']))
{
    $id_book = $_POST['book_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    try{
        $query ="UPDATE book SET title=:title, description=:description WHERE id_book=:books_id LIMIT 1";
        $stmt = $pdo->prepare($query);

        $data =[
            ':title' => $title,
            ':description'=>$description,
            ':books_id' => $id_book,
        ];
        $query_execute = $stmt->execute($data);

        if($query_execute){
            $_SESSION['message'] ="Updated successfully";
            header("Location: index.php");
            exit();
        }else{
            $_SESSION['message'] ="Not Updated ";
            header("Location: index.php");
            exit();
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}





?>
    <form action="" method="post">

        <input type="hidden" name="book_id" value="<?= $result['id_book']; ?>">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" value="<?= $result['title']; ?>" required>
        
        <br>
        
        <label for="description">Description :</label>
    
        <textarea name="description" id="description" rows="4" value="<?= $result['description']; ?>" required><?= $result['description']; ?></textarea>
        
        <br>
        
        <input type="submit" name="btn_update_book" value="Modifier">
    </form>






    
  





