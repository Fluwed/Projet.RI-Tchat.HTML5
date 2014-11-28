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
        if(isset($_POST['name'])) $name=$_POST['name'];
        else $name="Anonyme";
        if(isset($_POST['mail'])) $mail=$_POST['mail'];
        else $mail=".";
        if(isset($_POST['comment'])) $comment=$_POST['comment'];
        else $comment=".";
        $timestampouverture=time();
			
        $db = mysql_connect('tse-pilat.univ-st-etienne.fr', 'root', ''); 
		mysql_select_db('Salons',$db); 
		$sql = "insert into Coord (comment,timestamp,mail,nom) values ('".$comment."','".$timestampouverture."','".$mail."','".$name."');" ;
			//echo $sql; 
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());
			echo "Merci";
			echo "<form action='index.php' method='post'><input type='submit' value='Retour à la liste des salons'></form>";
		?>	
        </div>
</div>
</body>
</html>