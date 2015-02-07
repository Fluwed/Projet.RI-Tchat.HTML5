<?php
    require_once("../connectdb.php");
    
    if($pdo = connect_to_database()) {
        try {
            $query = $pdo->prepare('DELETE FROM messages WHERE id = :id;');
            $result = $query->execute(Array('id' => $_POST['msgId']));
            return $result;
        }
        catch (PDOException $e) {
            echo 0;
        }
    }  
    else {
        echo 0;
    }
?>
