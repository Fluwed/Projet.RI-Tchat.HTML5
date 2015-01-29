<?php
    $username=$_POST['username'];
    $password=$_POST['password'];
    $remember=$_POST['remember'];
    
    require("connectdb.php");
    $query = "SELECT * FROM Auteurs WHERE user='".$username."'";
    $result = mysqli_query($link, $query) or die(printf("Échec de la connexion SQL : %s\n", mysqli_connect_error()););
?>
