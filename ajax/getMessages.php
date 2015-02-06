<?php
    require_once("../connectdb.php");
    
    if($pdo = connect_to_database()) {
        try {
            $query = '';
            if ($_POST['idSalon'] == 0) {
                $query = $pdo->prepare('SELECT result.id, result.texte, result.date, result.user
                                        FROM (
                                        SELECT messages.id, messages.texte, messages.date, auteurs.user
                                        FROM messages
                                        JOIN auteurs ON messages.idAuteur = auteurs.id
                                        ORDER BY messages.date DESC
                                        LIMIT 500) result
                                        ORDER BY result.date ASC');
                $query->execute();
            }
            else {
                $query = $pdo->prepare('SELECT result.id, result.texte, result.date, result.user
                                        FROM (
                                        SELECT messages.id, messages.texte, messages.date, auteurs.user
                                        FROM messages
                                        JOIN auteurs ON messages.idAuteur = auteurs.id
                                        WHERE idSalon = :idSalon
                                        ORDER BY messages.date DESC
                                        LIMIT 500) result
                                        ORDER BY result.date ASC');
                $query->execute(Array('idSalon' => $_POST['idSalon'])); // on seclectionne une valeur 
            }
            
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Si on a réussi à sélectionner les salons
            if($query->rowCount() > 0) {
                echo json_encode($result);
            }
            else {
                return false;
            }
        }
        catch (PDOException $e) {
            echo 0;
        }
    }  
    else {
        echo 0;
    }
?>
