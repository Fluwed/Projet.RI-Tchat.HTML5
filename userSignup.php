<?php
    $username=$_POST['username'];
    $passwd=$_POST['passwd'];
    $passwd2=$_POST['passwd2'];
    
    if ($passwd != $passwd2) {
        
    }
    else {
        //require("connectdb.php");
        $query = "INSERT INTO Auteurs (user, password) VALUES ('".$username."','".$passwd."')";
        echo $query;
        //$result = mysqli_query($link, $query) or die(printf("Échec de la connexion SQL : %s\n", mysqli_connect_error()););
    }
?>
