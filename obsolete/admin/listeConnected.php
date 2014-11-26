<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salons de discussion de Télécom Saint-Etienne</title>
<link rel='stylesheet' href='../css/skeleton/base.css'>
        <link rel='stylesheet' href='../css/skeleton/skeleton.css'>
        <link rel='stylesheet' href='../css/skeleton/layout.css'>
        <link type='text/css' href='../css/style.css' rel='stylesheet' media='all' />
      
</head>
<body>
<div class="container">
        <img class="sixteen columns" src="../images/bandeau.jpg" />
        <div class="sixteen columns" id="menu">
             <a href="http://recrutement.telecom-st-etienne.fr/tchat/index.php"><img class="one columns" id="home" name="home" src="../images/picto_home_4.gif" onmouseover="home.src='../images/picto_home_5.gif'" onmouseout="home.src='../images/picto_home_4.gif'"/></a>
            
            
        </div>
        <div class="sixteen columns" id ="content">
        <?php
echo "<ul>";
$idSalon=$_GET['room'];


$db = mysql_connect('localhost', 'paul', 'paul'); 
mysql_select_db('Salons',$db); 

//recuperation du nombre d'users
$sql = "select id,auteur from  Auteurs where idSalon=".$idSalon;
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) 
    { 
    echo "<li>".$data['auteur'];
    echo "<form action='../deconnexion.php' method='post'><input type=hidden name='iduser' value='".$data['id']."'><input type=submit value=Déconnexion></form>";
    echo "</li>";
   }
mysql_close(); 
echo "</ul>";
?>

</div>
</div>
</body>
</html>
