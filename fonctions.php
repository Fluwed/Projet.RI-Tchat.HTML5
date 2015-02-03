<?php
    require_once("connectdb.php");
    
    function getSalons(){
        if($pdo = connect_to_database()){
            try{
                $query = $pdo->prepare('SELECT * FROM salons');
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                
                // Si on a réussi à sélectionner les salons
                if($query->rowCount() > 0){
                    $html = '';
                    $tabCouleurs = ['danger', 'success', 'warning', 'primary'];
                    $index = 0;
                    foreach($result as $salon){
                        if($index > 3){
                            $index = 0;
                        }
                        $html .= '<button type="button" id="salon_'.$salon["id"].'" data-id-salon="'.$salon["id"].'" data-titre="'.$salon["titre"].'" class="btn btn-'.$tabCouleurs[$index].' btn-xs btn-block">'.$salon["titre"].'</button>';
                        $index++;
                    }
                    return $html;
                }
                else{
                    return false;
                }
            }
            catch (PDOException $e) {
                echo $e;
                return false;
            }
        }  
        else {
            echo 'Problème de connexion à la base !';
        }
    }
    
    function userLogin($user, $password){
        if($pdo = connect_to_database()){
            try{
                $query = $pdo->prepare('SELECT * FROM auteurs WHERE user = :user AND password = :password');
                $query->execute(Array(':user' => $user, ':password' => $password));
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                
                // Si on a réussi à sélectionner un auteur avec les user/mdp fournis par l'utilisateur
                if($query->rowCount() > 0){
                    return Array("userId" => $result[0]['id'], "isAdmin" => $result[0]['isAdmin']);
                }
                else{
                    return false;
                }
            }
            catch (PDOException $e) {
                echo $e;
                return false;
            }
        }  
        else {
            echo 'Problème de connexion à la base !';
        }
    }
    
    function userSignup($user, $password){
        if($pdo = connect_to_database()){
            try{
                $query = $pdo->prepare('INSERT INTO auteurs (user, password) VALUES (:user, :password)');
                $result = $query->execute(Array(':user' => $user, ':password' => $password));
                return $result;
            }
            catch (PDOException $e) {
                echo $e;
                return false;
            }
        }  
        else {
            echo 'Problème de connexion à la base !';
        }
    }    
?>