<?php
    require_once("connectdb.php");
    
    function getSalons() {
        $adminOutput = '';
        if (isset($_SESSION) AND isset($_SESSION['isAdmin'])) {
            $adminOutput = '" data-is-admin="'.$_SESSION['isAdmin'].'"';
        }
        else {
            $adminOutput = '" data-is-admin="0"';
        }
        if ($pdo = connect_to_database()) {
            try {
                $query = $pdo->prepare('SELECT * FROM salons');
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                
                // Si on a réussi à sélectionner les salons
                if ($query->rowCount() > 0) {
                    $html = '';
                    $tabCouleurs = ['danger', 'success', 'warning', 'primary'];
                    $index = 0;
                    foreach ($result as $salon) {
                        if ($index > 3) {
                            $index = 0;
                        }
                        $html .= '<button type="button" id="salon_'.$salon["id"].'" data-id-salon="'.$salon["id"].'" data-titre="'.$salon["titre"].$adminOutput.' class="btn btn-'.$tabCouleurs[$index].' btn-xs btn-block">'.$salon["titre"].'</button>';
                        $index++;
                    }
                    return $html;
                }
                else {
                    return false;
                }
            }
            catch (PDOException $e) {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    function userLogin($user, $password) {
        if ($pdo = connect_to_database()) {
            try {
                $query = $pdo->prepare('SELECT * FROM auteurs WHERE user = :user');
                $query->execute(Array(':user' => $user));
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                // Si on a réussi à sélectionner un auteur avec le user fourni par l'utilisateur
                if ($query->rowCount() > 0) {
                    // Si le mdp est bon
                    if (password_verify($password, $result[0]['password'])) {
                        return Array("userId" => $result[0]['id'], "isAdmin" => $result[0]['isAdmin']);
                    }
                    else {
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
            catch (PDOException $e) {
                return false;
            }
        }  
        else {
            return false;
        }
    }
    
    function userTestExistence($user) {
        if ($pdo = connect_to_database()) {
            try {
                $query = $pdo->prepare('SELECT * FROM auteurs WHERE user = :user');
                $result = $query->execute(Array(':user' => $user));
                if ($query->rowCount() > 0) {
                    return true;
                }
                else {
                    return false;
                }
            }
            catch (PDOException $e) {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    function userSignup($user, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT) ;
        if ($pdo = connect_to_database()) {
            try {
                $query = $pdo->prepare('INSERT INTO auteurs (user, password) VALUES (:user, :password)');
                $result = $query->execute(Array(':user' => $user, ':password' => $hash));
                return $result;
            }
            catch (PDOException $e) {
                return false;
            }
        }  
        else {
            return false;
        }
    }
?>
