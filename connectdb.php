<?php
    $link = mysqli_connect("pf.fridrick.ovh:3306", "lamp", "lamp", "tchat_tse");
    mysqli_set_charset($link , "utf8");
    
    if (mysqli_connect_errno()) {
        printf("Échec de la connexion SQL : %s\n", mysqli_connect_error());
        exit();
    }
?>
