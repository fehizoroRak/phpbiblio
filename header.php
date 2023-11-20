
<?php
//include('function.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ma Bibliothèque</title>
   <style>

header {
    background-color: #333; 
    color: #fff; 
    padding: 10px 0; 
}

nav{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
nav ul {
    list-style: none; 
    padding: 0;
    margin-top: 20px;
    display: flex;
    justify-content: center;
    font-size:1em;
}


nav ul li {
    display: inline; 
    margin-right: 40px; 
}


nav ul li a {
    text-decoration: none; 
    color: #fff; 
}


nav ul li a:hover {
    text-decoration: underline; 
}

   </style>
</head>
<body>
    <header>
        <nav>
    
        <img src="book.png" alt="logo de la librairie" style="width:70px; height:70px;  ">
            
        <ul>
                
                <li><a href="index.php">Accueil</a></li>
                <li><a href="author.php">Auteurs</a></li>
                <li><a href="users.php">Utilisateurs</a></li>
                <li><a href="apropos.php">À propos</a></li>
                <li><a href="se_connecter.php">Se connecter</a></li>
            </ul>
        </nav>
    </header>
  

