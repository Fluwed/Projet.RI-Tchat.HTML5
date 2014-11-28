<?php/*
    $link = mysqli_connect("localhost", "paul", "paul", "tchat_recrutement");
    mysqli_set_charset($link , "utf8");
    
    if (mysqli_connect_errno()) {
        printf("Échec de la connexion SQL : %s\n", mysqli_connect_error());
        exit();
    }
*/?>

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
    
        <div id="wrap">

            <header class="page-header">
                <div class="container">
                    <div class="logo"></div>
                    <h2 class="wideScreen">Tchat Télécom Saint-Étienne</h2>
                </div>
            </header>

            <h2 class="smallScreen" id="smallTitle">Tchat Télécom Saint-Étienne</h2>

            <div class="row" id="padding">
                <div class="col-sm-2" id="center">
                    <div class="list-group">
                        <h3 class="list-group-item">Menu</h3>
                        <a href="index.php" class="list-group-item active">Accueil</a>
                        <a href="connexion.php" class="list-group-item">Connexion</a>
                        <a href="" class="list-group-item">Admin</a>
                    </div>
                </div>

                <div class="col-sm-10"><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Salons de discussion</h2>
                        </div>
                        <div class="panel-body" id="">
                            <p>coucou</p>

                            <?php/*
                                $query = "SELECT * FROM salons";
                                if ($result = mysqli_query($link, $query)) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        printf ("%s (%s)\n", $row["id"], $row["nom"]);
                                    }
                                    mysqli_free_result($result);
                                }
                            */?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="page-footer">
            <div class="container">
                © 2014 Télécom Saint-Etienne
            </div>
        </footer>
    </body>
</html>
