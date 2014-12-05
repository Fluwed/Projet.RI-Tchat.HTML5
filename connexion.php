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
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
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
                        <a href="index.php" class="list-group-item">Accueil</a>
                        <a href="connexion.php" class="list-group-item active">Connexion</a>
                    </div>
                </div>

                <div class="col-sm-10">                      
                    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                        <div class="panel panel-info" >
                                <div class="panel-heading">
                                    <div class="panel-title">Connexion</div>
                                    <div id ="connect"><a href="#" id="forgot_pass">Mot de passe oublié ?</a></div>
                                </div>     

                                <div class="panel-body">        
                                    <form id="loginform" class="form-horizontal">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input type="text" id="login-username" class="form-control" name="username" value="" placeholder="Identifiant ou Email" required>                                        
                                        </div>
                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input id="login-password" type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                        </div>
                                            
                                        <div class="input-group">
                                             <div class="checkbox">
                                                 <label>
                                                      <input id="login-remember" type="checkbox" name="remember" value="1"> Rester connecté
                                                  </label>
                                              </div>
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
                                                    <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">Inscrivez vous ici </a>
                                                </div>
                                            </div>
                                        </div> 
                                  </form>     
                              </div>                     
                          </div>  
                    </div>
                    
                    <div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">Inscription</div>
                                <div id="inscription">
                                    <a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Connexion</a>
                                </div>
                            </div> 
                                
                            <div class="panel-body" >
                                <form id="signupform" class="form-horizontal" role="form">
                                   <!-- <div id="signupalert" class="alert alert-danger">
                                        <p>Error:</p>
                                        <span></span>
                                    </div> -->

                                    <div class="form-group">
                                        <label for="email" class="col-md-3 control-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                        
                                    <div class="form-group">
                                        <label for="firstname" class="col-md-3 control-label">Nom</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="lastname" class="col-md-3 control-label">Prénom</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="prénom" placeholder="Prénom" required>
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
                                            <input type="text" class="form-control" name="passwd2" placeholder="Confirmation mot de passe">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- Button -->                                        
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" id="btn-signup" class="btn btn-info"><i class="icon-hand-right"></i>S'inscrire</button>
                                        </div>
                                    </div>                                           
                                </form>
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
    </body>
</html>
