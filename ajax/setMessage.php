<?php
    require_once("../connectdb.php");
    
    if($pdo = connect_to_database()){
        try{
            $query = $pdo->prepare('INSERT INTO messages(texte, idSalon, idAuteur) VALUES(:texte, :idSalon, :idAuteur)');
            $result = $query->execute(Array('texte' => $_POST['texte'], 'idSalon' => $_POST['idSalon'], 'idAuteur' => $_SESSION['userId']));
            return $result;
        }
        catch (PDOException $e) {
            return false;
        }
    }  
    else {
        return false;
    }
?>
