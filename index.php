<?php
    include('fonctions.php');
    $message="";
    
    // Selon si on est connecté ou pas, le label du menu et la page change
    if(isset($_SESSION) AND isset($_SESSION['username'])){
        $listeSalons = getSalons();
        $label_connexion = 'Déconnexion';
    }
    else {
        $listeSalons = '<div class="alert alert-info col-md-12 col-sm-8" role="alert"> Veuillez vous connecter pour voir la liste des salons disponibles.</div>';
        $label_connexion = 'Connexion';
    }
?>

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
                    <div class="smallScreen_logo"></div>
                    <h2 class="wideScreen">Tchat Télécom Saint-Étienne</h2>
                </div>
            </header>

            <h2 class="smallScreen" id="smallTitle">Tchat Télécom Saint-Étienne</h2>

            <div class="row" id="padding">
                <div class="col-sm-2" id="center">
                    <div class="list-group">
                        <h3 class="list-group-item">Menu</h3>
                        <a href="index.php" class="list-group-item active">Accueil</a>
                        <a href="connexion.php" class="list-group-item"><?php echo $label_connexion; ?></a>
                    </div>
                </div>

                <div class="col-sm-10"><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title" id="titre_salon">Salons de discussion</h2>
                        </div>
                        <div class="panel-body" id="conteneur">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1" id="liste_salons">
                                    <button type="button" class="btn btn-default btn-xs btn-block" id="spectateur">Spectateur Global</button>
                                    <?php
                                        echo $listeSalons;
                                    ?>
                                </div>
                                <div class="col-md-10 col-md-offset-1" id="tchat">
                                    <div class="col-md-12" id="zone_tchat"> 
                                    </div>
                                    <div class="col-md-12" id="zone_submit">
                                        <div class="input-group input-group-lg">
                                            <textarea type="text" onkeypress="resizeTextArea(this)" id="messageUtilisateur" class="form-control" placeholder="Tapez votre texte ici ..."></textarea>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit" id="boutonEnvoi">Envoyer</button>
                                            </span>
                                        </div>
                                        <a href="index.php"><span class="btn btn-primary">Retour à la liste des salons</span></a>
                                    </div>
                                </div>
                            </div>
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

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/customize.js"></script>
    </body>
</html>
