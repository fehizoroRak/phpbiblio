<?php

require_once('database.php');
include('header.php');
require_once('function.php');

$users= detailData('users','users_id',$_GET['id__user']);
?>


<h1>Détails des livres</h1>

<table border="1">

      

        <tr>
            <th>Nom</th>
        </tr>
        <tr>
            <td><?= $users['first_name'] ?></td>
        </tr>
        <tr>
            <th>Prénom</th>
        </tr>
        <tr> 
            <td><?=  $users['last_name'] ?></td>
        </tr>
        <tr>
            <th>Mot de passe</th>
        </tr>
        <tr> 
            <td><?=  $users['password_user'] ?></td>
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


    
  





