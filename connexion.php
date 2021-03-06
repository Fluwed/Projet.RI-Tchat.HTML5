<?php
    include('fonctions.php');
    $message = '';
    $display_admin = 'style="display:none"';
    
    if (!empty($_GET)) {
        if ($_GET['deconnexion'] == 1) {
            $_SESSION = array();
            session_destroy();
            $message = '<div class="alert alert-success col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" role="alert"> Déconnexion réussie </div>';
        }
    }
    
    if (!empty($_POST)) {
        if ($_POST['formulaire'] == 'loginform') {
            $dataUser = userLogin($_POST['username'], $_POST['password']);
            if ($dataUser) {
                session_start(); // nécessite de mettre l'option session.auto_start = 1 dans php.ini
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['userId'] = $dataUser['userId'];
                $_SESSION['isAdmin'] = $dataUser['isAdmin'];
                header('Location: index.php');
            }
            else {
                $message = '<div class="alert alert-danger col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" role="alert"><strong>Erreur :</strong> Identifiants incorrects.</div>';
            }
        }
        else {
            if ($_POST['formulaire'] == 'signupform') {
                if ($_POST['passwd'] == $_POST['passwd2']) {
                    if (strlen($_POST['passwd']) >= 6) {
                        if (userTestExistence($_POST['username'])) {
                            $message = '<div class="alert alert-danger col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" role="alert"><strong>Erreur :</strong> L\'utilisateur existe déjà.</div>';
                        }
                        else {
                            if (userSignup($_POST['username'], $_POST['passwd'])) {
                                $message = '<div class="alert alert-success col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" role="alert">Utilisateur créé, vous pouvez maintenant vous connecter.</div>';
                            }
                            else {
                                $message = '<div class="alert alert-danger col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" role="alert"><strong>Erreur :</strong> Impossible de vous créer un compte, réessayez plus tard.</div>';
                            }
                        }
                    }
                    else {
                        $message = '<div class="alert alert-danger col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" role="alert"><strong>Erreur :</strong> Le mot de passe est trop court (6 caractères minimum).</div>';
                    }
                }
                else {
                    $message = '<div class="alert alert-danger col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" role="alert"><strong>Erreur :</strong> Mots de passe différents.</div>';
                }
            }
            else {
                // On ne fait rien
            }
        }
    }
    
    // Selon si on est connecté ou pas, le label du menu change
    if(isset($_SESSION) AND isset($_SESSION['username'])){
        if ($_SESSION['isAdmin']==1) {
            $display_admin = '';
        }
        $label_connexion = 'Déconnexion';
        $display_connexion = 'style="display:none"';
        $display_deconnexion = '';
    }
    else {
        $label_connexion = 'Connexion';
        $display_connexion = '';
        $display_deconnexion = 'style="display:none"';
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
                        <a href="index.php" class="list-group-item">Accueil</a>
                        <a href="fonction_admin.php" class="list-group-item" <?php echo $display_admin; ?>>Fonctions Admin</a>
                        <a href="connexion.php" class="list-group-item active"><?php echo $label_connexion; ?></a>
                    </div>
                </div>

                <div class="col-sm-10" >
                    <?php echo $message; ?>
                    <div id="loginbox" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" <?php echo $display_connexion; ?>>
                        <div class="panel panel-info" >
                            <div class="panel-heading">
                                <div class="panel-title">Connexion</div>
                            </div>

                            <div class="panel-body" id="panel-body_connexion">
                                <form id="loginform" class="form-horizontal" action='connexion.php' method='post'>
                                    <input type="hidden" name="formulaire" value="loginform" />
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="login-username" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12 controls">
                                              <button type="submit" id="btn-login" href="#" class="btn btn-info">Connexion </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div id="account">
                                                Vous n'avez pas de compte ? 
                                                <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show(); $('.alert').hide()">Inscrivez-vous ici </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="signupbox" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">Inscription</div>
                                <div id="inscription">
                                    <a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Connexion</a>
                                </div>
                            </div>

                            <div class="panel-body" id="panel-body_connexion_2">
                                <form id="signupform" class="form-horizontal" role="form" action='connexion.php' method='post'>
                                    <input type="hidden" name="formulaire" value="signupform" />
                                     
                                    <div class="form-group">
                                        <label for="email" class="col-md-3 control-label">Nom d'utilisateur</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-md-3 control-label">Mot de passe</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" name="passwd" placeholder="Mot de passe" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="icode" class="col-md-3 control-label">Confirmation</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" name="passwd2" placeholder="Confirmation mot de passe" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" id="btn-signup" class="btn btn-info" name="signup">S'inscrire</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div> 
                    
                    <div id="deconnexion" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2" <?php echo $display_deconnexion; ?>>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">Deconnexion</div>
                            </div>

                            <div class="panel-body" id="panel-body_deconnexion">
                                <div class="col-md-6">
                                    <p>Voulez-vous vraiment vous déconnecter ?</p>
                                </div>
                                <div class="col-md-6">
                                    <a href="connexion.php?deconnexion=1"><span class="btn btn-primary" type="submit" id="deconnexion_oui">OUI</span></a>
                                    <a href="index.php"><span class="btn btn-primary" type="submit" id="deconnexion_non">NON</span></a>
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
        
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/customize.js"></script>
    </body>
</html>
