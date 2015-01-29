<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <meta name="author" content="Kévin PERROTTA, Paul FRIDRICK, Léonard PERRIER et Arnaud DEWULF"/>
        <meta name="description" content="Découvrez le tchat de Télécom Siant-Étienne."/>
        <meta name="keywords" content="Télécom Saint-Étienne, TSE, tchat, chat, recrutement"/>

        <title>Tchat TSE</title>
        <link rel="shortcut icon" href="images/minilogo-TSE.png">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/customize.css" rel="stylesheet">
    </head>

    <body>
        <div>
            <?php
                $username=$_POST['username'];
                $passwd=$_POST['passwd'];
                $passwd2=$_POST['passwd2'];

                if ($passwd != $passwd2) {
                    
                }
                else {
                    require("connectdb.php");
                    $query = "INSERT INTO Auteurs (user, password) VALUES ('".$username."','".$passwd."')";
                    echo $query;
                    $result = mysqli_query($link, $query) or die(printf("Échec de la connexion SQL : %s\n", mysqli_connect_error()););
                    mysqli_free_result($result);
                    mysqli_close($link);
                }
            ?>
        </div>
    </body>
</html>
