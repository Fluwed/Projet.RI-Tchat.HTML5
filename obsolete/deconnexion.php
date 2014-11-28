<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salons de discussion de Télécom Saint-Etienne</title>
<link rel='stylesheet' href='css/skeleton/base.css'>
        <link rel='stylesheet' href='css/skeleton/skeleton.css'>
        <link rel='stylesheet' href='css/skeleton/layout.css'>
        <link type='text/css' href='css/style.css' rel='stylesheet' media='all' />
      
</head>
<body>
<div class="container">
        <img class="sixteen columns" src="images/bandeau.jpg" />
        <div class="sixteen columns" id="menu">
             <a href="http://recrutement.telecom-st-etienne.fr/chat2/index.php"><img class="one columns" id="home" name="home" src="images/picto_home_4.gif" onmouseover="home.src='images/picto_home_5.gif'" onmouseout="home.src='images/picto_home_4.gif'"/></a>
            
            
        </div>
        <div class="sixteen columns" id ="content">
        
<?php

$idUser=$_POST['iduser'];

$db = mysql_connect('tse-pilat.univ-st-etienne.fr', 'root', ''); 
mysql_select_db('Salons',$db); 
//on teste d'abord si l'utilisateur que l'on deconnecte est un manager 
//si oui il faut redistribuer les utilisateurs managés aux autres utilisateurs
$sql = "select isAdmin,idSalon from Auteurs where id=".$idUser;
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) 
    { 
    $isAdmin=$data['isAdmin'];
    $idSalon=$data['idSalon'];
   	}
if ($isAdmin==1)//on va detruire un manager
	{
	$sql = "select id from Auteurs where idManager=".$idUser;
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req)) //liste des utilisateurs managés
    	{ 
    	$idUtilisateur=$data['id'];
    	//REcuperation des managers pour les users du salon
		$managers=array();
		$sql = "select id from Auteurs where isAdmin=1 and idSalon=".$idSalon." and id<>".$idUser ; 
		$req2 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		while($data2 = mysql_fetch_assoc($req2)) 
    			{
    	 		$managers[]=$data2['id'];
    			}
    	//Recuperation des users affecté à chaque manager
    	$bestnb=10000;$bestmanager=1;
    	for ($i=0;$i<count($managers);$i++)
    		{
    		$sql = "select count(id) as nombre from Auteurs where isAdmin=0 and idSalon=".$idSalon." and idManager=".$managers[$i] ; 
    		// echo $sql."<br/>";
			$req3 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			while($data3 = mysql_fetch_assoc($req3)) 
    				{
    	 			$nb=$data3['nombre'];
    	 			//echo "NB :".$nb;
    	 			if ($nb<$bestnb) {$bestmanager=$managers[$i];$bestnb=$nb;}
    				}
			}
			
    	//on va affecter le nouvel user à ce manager (le manager qui en a le moins ;)
    	$sql = "update Auteurs set idManager=".$bestmanager." where id=".$idUtilisateur;
    	//echo $sql;
		$req4 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			
   		}
	}
$sql = "delete from Auteurs where id=".$idUser;
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

echo "Deconnecté<br/>";
?>

</div>
</div>
</body>
</html>