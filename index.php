<?php
session_start();
require_once('database.php');
include('header.php');
include('function.php');



//SELECT book.id_book, book.title, book.description, author.first_name, author.last_name FROM book LEFT JOIN author ON book.id_author = author.author_id

/*SELECT book.id_book, book.title, book.description, author.first_name, author.last_name, category.name
FROM book
INNER JOIN book_category ON book.id_book = book_category.id_book_cat_book
INNER JOIN category ON book_category.id_book_cat_cat = category.category_id
INNER JOIN author ON book.id_author = author.author_id;*/

/* SELECT book.id_book, book.title, book.description, author.first_name, author.last_name FROM book LEFT JOIN author ON book.id_author = author.author_id  */





$query = " 
SELECT
    b.id_book,
    bc.idbook_category,
    b.title,
    b.description,
    a.first_name,
    a.last_name,
    c.name AS category_name
FROM
    book_category bc
JOIN
    book b ON bc.id_book_cat_book = b.id_book
JOIN
    category c ON bc.id_book_cat_cat = c.category_id
JOIN
    author a ON b.id_author = a.author_id; 
    ";
$statement = $pdo->query($query);
$books = $statement->fetchAll(PDO::FETCH_ASSOC);
//var_dump($books);

//var_dump(queryBook('book'));

?>


<?php if(isset($_SESSION['message'])){
?>
    <div class="alert-box">
            <p><?php echo $_SESSION['message'];  ?></p>
    </div>
    <script>
        setTimeout(function () {
            var alertBox = document.querySelector(".alert-box");
            if (alertBox) {
                alertBox.parentNode.removeChild(alertBox);
            }
        }, 3000); 
    </script>
<?php
unset($_SESSION['message']);
} ?>



<?php if(isset($_SESSION['messageAdd'])){
?>
    <div class="alert-box">
            <p><?php echo $_SESSION['messageAdd'];  ?></p>
    </div>
    <script>
        setTimeout(function () {
            var alertBox = document.querySelector(".alert-box");
            if (alertBox) {
                alertBox.parentNode.removeChild(alertBox);
            }
        }, 3000); 
    </script>
<?php
unset($_SESSION['messageAdd']);
} ?>



<?php if(isset($_SESSION['messageDelete'])){
?>
    <div class="alert-box-delete">
            <p><?php echo $_SESSION['messageDelete'];  ?></p>
    </div>
    <script>
        setTimeout(function () {
            var alertBox = document.querySelector(".alert-box-delete");
            if (alertBox) {
                alertBox.parentNode.removeChild(alertBox);
            }
        }, 3000); 
    </script>
<?php
unset($_SESSION['messageDelete']);
} ?>



<style>
    .alert-box {
    background-color:#79e5a8; 
    color: #045d2b; 
    padding: 5px; 
    margin: 20px auto;
    border-radius: 5px; 
    width: 400px; 
    height: 40px;
    text-align: center; 
    }

    .alert-box-delete {
    background-color:#ec8484; 
    color: #ffffff; 
    padding: 5px; 
    margin: 20px auto;
    border-radius: 5px; 
    width: 400px; 
    height: 40px;
    text-align: center; 
    }
    form{
        margin-top: 50px;
    }
</style>

<form action="" method="GET" style="margin: 20px 0;">
    <label for="search">Rechercher un LIVRE ou un AUTEUR :</label>
    <input type="text" id="search" name="search" placeholder="Entrez le titre du livre">
    <button type="submit" style="border-radius:5px; background-color:#0B4114;">Rechercher</button>
    <button type="button" style="border-radius:5px; background-color:#0B4114;" onclick="clearSearch()">Effacer</button>
</form>

<?php

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

$query = "SELECT book.id_book, book.title, book.description, author.first_name, author.last_name 
          FROM book 
          LEFT JOIN author ON book.id_author = author.author_id
          WHERE book.title LIKE '%$searchTerm%' OR author.first_name LIKE '%$searchTerm%' OR author.last_name LIKE '%$searchTerm%'";
$statement = $pdo->query($query);
$searchResults = $statement->fetchAll(PDO::FETCH_ASSOC);


if (!empty($searchTerm) && !empty($searchResults)) {
    if (count($searchResults) > 0) {
        echo "<h3 id=searchResultsHeader>Résultats de la recherche pour '$searchTerm' :</h3>";
       
echo '<table id="searchResultsTable" border="1">';
echo '<tr>';
echo '<th style="width: 100px;">Titre</th>';
echo '<th style="width: 300px;">Description</th>';
echo '<th colspan="2" style="text-align: center;" >Auteur</th>';
echo '</tr>';

foreach ($searchResults as $result) {
    echo '<tr>';
    echo '<td>' . $result['title'] . '</td>';
    echo '<td style="width: 300px;">' . $result['description'] . '</td>';
    echo '<td style="width: 100px;">' . $result['first_name'] . '</td>';
    echo '<td style="width: 100px;">' . $result['last_name'] . '</td>';
    
    echo '</td>';

    echo '</tr>';
}

echo '</table>';

    } else {
        echo "<p>Aucun résultat trouvé pour '$searchTerm'.</p>";
    }
}
}
?>

<script>
    function clearSearch() {
        var searchResultsTable = document.getElementById('searchResultsTable');
        if (searchResultsTable) {
            searchResultsTable.style.display = 'none';
        }
        var searchResultsHeader = document.getElementById('searchResultsHeader');
        if (searchResultsHeader) {
            searchResultsHeader.style.display = 'none';
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
       
        .addNewBook {
            display: inline-block;
            padding: 10px 20px;
            margin: 40px 0;
            border-radius: 5px;
            background-color: #0b3941;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }


        .edited {
            font-size: 1.5em;
            color: #0c0e56;
            margin: 20px 20px;
        }


        .delete {
            font-size: 1.5em;
            color: #560c0c;
            margin: 20px 20px;
        }


        .details {
            font-size: 1.5em;
            color: #0c560d;
            margin: 20px 20px;
        }

       
 

    </style>


<a class="addNewBook" href="add_book.php">Ajouter de nouveaux livres</a>

<h3 style="margin: 40px 0;">Liste des livres </h3>

<!-- BOOKS -->
<table  style="margin: 60px 0;">

        <tr>
            <th style="width: 100px;">Titre</th>
            <th style="width: 300px;">Description</th>
            <th colspan="2" style="text-align: center;" >Auteur</th>
            <th style="width: 100px;">Catégories</th>      
            <th>Actions</th>
        </tr>
        
<?php 
foreach ($books as $book) {
?>

        <tr>
            <td><?= $book['title'] ?></td>
            <td style="width: 300px;"><?=  $book['description'] ?></td>
            <td style="width: 100px;"><?=  $book['first_name'] ?></td>
            <td style="width: 100px;"><?=  $book['last_name'] ?></td>
            <td style="width: 100px;"><?=  $book['category_name'] ?></td>
       


            <td style="display: flex;">
            <a class="" href="edit_book.php?identifiant=<?= $book['id_book'];?>"><i class="fa-solid fa-pen-to-square edited"></i></a><br/>
            <a class="" href="delete_book.php?identifiant=<?=$book['id_book'];?>" 
            onclick="return confirm('Etes vous sûr de supprimer le livre?')">
            <i class="fa-solid fa-trash delete"></i>
            </a><br/>
            
<script>
function customConfirm(message) {
  var response = window.confirm(message + " Réponse OUI ou NON");
  if (response) {
    window.location = "delete.php?identifiant=<?=$book['id_book'];?>";
  }
  return false; 
}
</script>

            <a class="" href="detail_book.php?identifiant=<?= $book['id_book'];?>"><i class="fa-solid fa-circle-info details"></i></a><br/>
            </td>
        
        </tr>
<?php
}
?>   
       
    </table>

   <?php
    include('footer.php');
    ?>

    <style>
        table {
            border-collapse: collapse;
            width: 90%;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }


        th, td {
            border: 1px solid #dddddd;
        }
    
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>




