<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salons de discussion de Télécom Saint-Etienne</title>
<link rel='stylesheet' href='../css/skeleton/base.css'>
        <link rel='stylesheet' href='../css/skeleton/skeleton.css'>
        <link rel='stylesheet' href='../css/skeleton/layout.css'>
        <link type='text/css' href='../css/style.css' rel='stylesheet' media='all' />
       	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    	<link rel="stylesheet" href="jquery.ui.timepicker.css" />
    	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    	<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    	<script src="jquery.ui.timepicker.js"></script>
    	
    
    	
    		<script>$(function() {$( "#datepickerO" ).datepicker({ dateFormat: "dd-mm-yy" });});</script>
    		<script>$(function() {$('#timepickerO').timepicker();});</script>
    		<script>$(function() {$( "#datepickerF" ).datepicker({ dateFormat: "dd-mm-yy" });});</script>
    		<script>$(function() {$('#timepickerF').timepicker();});</script>
     
      
</head>
<body>
<div class="container">
        <img class="sixteen columns" src="../images/bandeau.jpg" />
        
        <div class="sixteen columns" id ="content">
			<!--création d'un salon-->
			<form action='createsalon.php' method='post'>
			<table width = "80%" align="center" style="margin-left:180px;">
				<tr style="font-size:1.2em;">
				<td colspan=2><input type='text' name='nameSalon' placeholder="Nom du salon"></td>
				</tr>
				<tr>
				<td>Date ouverture : <input type="text" name="do" id="datepickerO" /></td>
				<td>Heure ouverture : <input type="text" name="ho" id="timepickerO" /></td>
				</tr>
				<tr>
				<td>Date fermeture : <input type="text" name="df" id="datepickerF" /></td>
				<td>Heure fermeture : <input type="text" name="hf" id="timepickerF" /></td>
				</tr>
			</table>
			<input type=submit class=full-width value='Créez le salon'>
			</form>
			
			<ul style="font-size : 1.2em;">
			<?php
			$mydate=time();
			//récupération des salons ouverts
			$db = mysql_connect('localhost', 'paul', 'paul'); 
			mysql_select_db('Salons',$db); 
			
			//suppression des salons dont la date de fermeture est passée
			$mydate=time();
			$sql = "delete from Salons where timestampfermeture<".$mydate ; 
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());
			
			$sql = "select * from Salons" ; 
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());
			while($data = mysql_fetch_assoc($req)) 
    			{
    	 		if ($mydate>$data['timestampouverture'] && $mydate<$data['timestampfermeture']) 
    	 			{
    	 			echo $data['id']."/".$data['salon'];
    	 			echo "<form action='salonmanager.php' method='post'><input type='hidden'name='idSalon' value=".$data['id']."><input type='hidden'name='nameSalon' value='".$data['salon']."'><input type=submit class=full-width value='Accédez au salon ".$data['salon']." (Ouvert du ".date ("j M Y h:i",$data['timestampouverture'])." au ".date ("j/M/Y h:i",$data['timestampfermeture']).")"."'><form><br/><br/>";
    	 			}	
    	 		else echo "<li align=center>A venir : ".$data['salon']." (Ouvert du ".date ("j M Y h:i",$data['timestampouverture'])." au ".date ("j/M/Y h:i",$data['timestampfermeture']).")</li>";
    	 		}
    		?>
    	</div>
</div>
</body>
</html>
