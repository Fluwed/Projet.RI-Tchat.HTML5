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
        
        <div class="sixteen columns" id ="content">
			<!--création d'un salon-->
			
			<?php
			//insertion du salons ouverts
			$titre=$_POST['nameSalon'];
			$do=$_POST['do'];
			$ho=$_POST['ho'];
			$df=$_POST['df'];
			$hf=$_POST['hf'];
			$timestampouverture=strtotime($do." ".$ho);
			echo $timestampouverture;
			$timestampf=strtotime($df." ".$hf);
			echo $timestampf;
			
			
			$db = mysql_connect('localhost', 'paul', 'paul'); 
			mysql_select_db('Salons',$db); 
			$sql = "insert into Salons (salon,timestampouverture,timestampfermeture) values ('".$titre."','".$timestampouverture."','".$timestampf."');" ;
			//echo $sql; 
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());
			echo "Salon ".$titre ." (Ouvert du ".$dO." à ".$hO." au  ".$df." à ".$hf.") créé";
			echo "<form action='index.php' method='post'><input type='submit' value='Retour à la liste des salons'></form>";
			?>
    	</div>
</div>
</body>
</html>
