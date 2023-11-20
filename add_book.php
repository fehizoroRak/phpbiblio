<?php
session_start();

require_once('database.php');
include('header.php');
include('function.php');

if (!empty($_POST)) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author = $_POST['book_author'];

    
    $query = $pdo->prepare("INSERT INTO book (title, description, id_author) VALUES (:title, :description, :id_author)");
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':id_author', $author, PDO::PARAM_STR);
    $query_execute = $query->execute();


$lastInsertedBookId = $pdo->lastInsertId();

if (isset($_POST['categories']) && is_array($_POST['categories'])) {
 
    $sqlInsertCategory = "INSERT INTO book_category (id_book_cat_book, id_book_cat_cat) VALUES (?, ?)";
    $stmtInsertCategory = $pdo->prepare($sqlInsertCategory);

  
    foreach ($_POST['categories'] as $selectedCategoryId) {
        $stmtInsertCategory->execute([$lastInsertedBookId, $selectedCategoryId]);
    }
}


    
if($stmtInsertCategory){
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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $title = $_POST['title'];
    $description = $_POST['description'];
    $authorId = $_POST['author'];
   


}

$authors = queryBook('author');
$categories = queryBook('category');


?>

    <h2>Ajouter de nouveaux livres</h2>

    <form action="" method="post">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" required>
        
        <br>
        
        <label for="description">Description :</label>
        <textarea name="description" id="description" rows="4" required></textarea>
        
        <br><br>

        <label for="book_author">Choisir un auteur</label>

        <select name="book_author" id="book_author">
            <option value="">--Choisissez un auteur--</option>
            <?php 
            $authors= queryBook('author');
            foreach ($authors as $author) {
            ?>
                
                <option value="<?= $author['author_id']?>"><?= $author['first_name'].' '.$author['last_name']?></option>
            <?php
            }
            ?>
       </select>
        <br><br>
        <label>Catégories :</label>
    <?php foreach ($categories as $category) : ?>
        <label>
            <input type="checkbox" name="categories[]" value="<?= $category['category_id']; ?>">
            <?= $category['name']; ?>
        </label>
    <?php endforeach; ?>
    <br><br>
        <input type="submit" value="Ajouter">
    </form>






    
  





