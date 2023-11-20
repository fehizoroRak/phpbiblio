<?php


require_once('database.php');
include('header.php');
require_once('function.php');

/*$query = 'SELECT * FROM author WHERE author_id=' .$_GET['id_author'] ;
$statement = $pdo->query($query);
$authors = $statement->fetchAll();
*/
//var_dump($_GET['identifiant']);




$authors= detailData('author','author_id',$_GET['id_author']);
//var_dump($authors);
?>


<h1>Détails des livres</h1>

<table border="1">

      

        <tr>
            <th>Nom</th>
        </tr>
        <tr>
            <td><?php echo $authors['first_name'] ?></td>
        </tr>
        <tr>
            <th>Prénom</th>
        </tr>
        <tr> 
            <td><?php echo  $authors['last_name'] ?></td>
        </tr>
  
       
    </table>
    
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
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
 
     
    </style>


    
  





