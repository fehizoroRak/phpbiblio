<?php

require_once('database.php');
include('header.php');
require_once('function.php');

$books= detailData('book','id_book',$_GET['identifiant']);
//var_dump($books);

?>


<h1>Détails des livres</h1>

<table border="1">
        <tr>
            <th>Titre</th>
        </tr>
        <tr>
            <td><?php echo $books['title'] ?></td>
        </tr>
        <tr>
            <th>Description</th>
        </tr>
        <tr> 
            <td><?php echo $books['description'] ?></td>
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


    
  





