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
        <?php
            if(isset($_POST['signup'])) {
                $username=$_POST['username'];
                $passwd=$_POST['passwd'];
                $passwd2=$_POST['passwd2'];

                if ($passwd != $passwd2) {
                    
                }
                else {
                    require("connectdb.php");
                    $query = "INSERT INTO Auteurs (user, password) VALUES ('".$username."','".$passwd."')";
                    echo $query;
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    mysqli_free_result($result) or die(mysqli_error($link));
                    mysqli_close($link) or die(mysqli_error($link));
                }
            }
            else {
                echo "An error occured.";
            }
        ?>

        <meta http-equiv="refresh" content="1;url=index.php" />
    </body>
</html>
