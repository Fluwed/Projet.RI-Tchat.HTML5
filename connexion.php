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
                        <a href="index.php" class="list-group-item">Accueil</a>
                        <a href="connexion.php" class="list-group-item active">Connexion</a>
                        <a href="" class="list-group-item">Admin</a>
                    </div>
                </div>

                <div class="col-sm-10">                      
                        <div id="loginbox" style="margin-top:20px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                            <div class="panel panel-info" >
                                    <div class="panel-heading">
                                        <div class="panel-title">Sign In</div>
                                        <div style="float:right; font-size: 78%; position: relative; top:-10px"><a href="#" style="color:white">Forgot password ?</a></div>
                                    </div>     

                                    <div style="padding-top:30px" class="panel-body" >

                                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                            
                                        <form id="loginform" class="form-horizontal" role="form">
                                                    
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                                                    </div>
                                                
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                                    </div>
                                                
                                            <div class="input-group">
                                                      <div class="checkbox">
                                                        <label>
                                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                                        </label>
                                                      </div>
                                                    </div>


                                                <div style="margin-top:10px" class="form-group">
                                                    <!-- Button -->

                                                    <div class="col-sm-12 controls">
                                                      <a id="btn-login" href="#" class="btn btn-info">Login </a>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-md-12 control">
                                                        <div style="border-top: 1px solid#337AB7; padding-top:15px; font-size:85%" >
                                                            Don't have an account !   
                                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                                              Sign Up Here
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </form>     
                                     </div>                     
                               </div>  
                        </div>
                        
                        <div id="signupbox" style=" display:none; margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="panel-title">Sign Up</div>
                                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()" style="color:#FFF">Sign In</a></div>
                                </div>  
                                <div class="panel-body" >
                                    <form id="signupform" class="form-horizontal" role="form">
                                        
                                        <div id="signupalert" style="display:none" class="alert alert-danger">
                                            <p>Error:</p>
                                            <span></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="col-md-3 control-label">Email</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                            
                                        <div class="form-group">
                                            <label for="firstname" class="col-md-3 control-label">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-md-3 control-label">Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" name="passwd" placeholder="Password">
                                            </div>
                                        </div>
                                            
                                        <div class="form-group">
                                            <label for="icode" class="col-md-3 control-label">Invitation Code</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="icode" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- Button -->                                        
                                            <div class="col-md-offset-3 col-md-9">
                                                <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
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
