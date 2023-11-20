<?php
session_start();
require_once('database.php');
include('header.php');


?>


    <h2>Modifier un utilisateure</h2>
<?php
if(isset($_GET['id__user']))
{

    $idusers = $_GET['id__user'];
    $query ="SELECT * FROM users WHERE users_id = :id LIMIT 1";
    $stmt = $pdo->prepare($query);
    $data =[
        'id' => $idusers
    ];
    $stmt -> execute($data);
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['btn_update_user']))
{
    $id_user = $_POST['users_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password_user = $_POST['password_user'];

    try{
        $query ="UPDATE users SET first_name=:first_name, last_name=:last_name, password_user=:password_user WHERE users_id=:user_id LIMIT 1";
        $stmt = $pdo->prepare($query);

        $data =[
            ':first_name' => $first_name,
            ':last_name'=>$last_name,
            ':password_user'=>$password_user,
            ':user_id' => $id_user,
        ];
        $query_execute = $stmt->execute($data);

        if($query_execute){
          
            header("Location: index.php#users");
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

        <input type="hidden" name="users_id" value="<?= $result['users_id']; ?>">
        <label for="first_name">Nom </label>
        <input type="text" name="first_name" id="first_name" value="<?= $result['first_name']; ?>" required>
        
        <br>

        <label for="last_name">Prénom </label>
        <input type="text" name="last_name" id="last_name" value="<?= $result['last_name']; ?>" required>
        
        <br>
        <label for="password_user">Mot de passe </label>
        <input type="text" name="password_user" id="password_user" value="<?= $result['password_user']; ?>" required>
        
        <br>
        
        
        <input type="submit" name="btn_update_user" value="Modifier">
    </form>






    
  





