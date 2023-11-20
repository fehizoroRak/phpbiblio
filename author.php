<?php
session_start();
require_once('database.php');
include('header.php');
include('function.php');
?>


<form action="" method="GET" style="margin: 20px 0;">
    <label for="search">Rechercher un LIVRE ou un AUTEUR :</label>
    <input type="text" id="search" name="search" placeholder="Rechercher...">
    <button type="submit" style="border-radius:5px;">Rechercher</button>
    <button type="button" style="border-radius:5px;" onclick="clearSearch()">Effacer</button>
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





<style>
     
        .addNewBook {
            display: inline-block;
            padding: 10px 20px;
            margin: 40px 0;
            border-radius: 5px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

       
        a:hover {
            background-color: darkblue;
        }

        .edit {
            width:50px;
            height: 10px;
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 10px;
            border-radius: 5px;
            background-color: #8686eb;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

       
        a:hover {
            background-color: #4a4aa7;
        }

        .delete {
            width:70px;
            height: 20px;
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 10px;
            border-radius: 5px;
            background-color: #f17d7d;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

       
        a:hover {
            background-color: #b25d5d;
        }
        .details {
            width:50px;
            height: 10px;
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 10px;
            border-radius: 5px;
            background-color: #74c644;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

       
        a:hover {
            background-color: #588f37;
        }


    </style>


<a class="addNewBook" href="add_author.php">Ajouter de nouveaux auteurs</a>

<h3>Liste des auteurs </h3>

<?php $authors= queryBook('author'); ?>

 <!-- AUTHOR -->
<table border="1">

        <tr>
            <th style="width: 100px;">Firstname</th>
            <th style="width: 500px;">Lastname</th>
            <th>Actions</th>
        </tr>
<?php 
foreach ($authors as $author) {
?>

        <tr>
            <td><?= $author['first_name'] ?></td>
            <td style="width: 500px;"><?=  $author['last_name'] ?></td>
            <td style="display: flex;">
            <a class="edit" href="edit_author.php?id_author=<?= $author['author_id'];?>">Modifier</a><br/>
            <a class="delete" href="delete_author.php?id_author=<?=$author['author_id'];?>" 
            onclick="return confirm('Etes vous sûr de supprimer l\'auteur?')">Supprimer</a><br/>
            
<script>
function customConfirm(message) {
  var response = window.confirm(message + " Réponse OUI ou NON");
  if (response) {
    window.location = "delete.php?identifiant=<?=$book['author_id'];?>";
  }
  return false; 
}
</script>

            <a class="details" href="detail_author.php?id_author=<?= $author['author_id'];?>">Détails</a><br/>
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
            width: 100%;
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
        .delete {
            background-color: red;
            color: white;
            border: none;
            margin-top: 5px;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
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




