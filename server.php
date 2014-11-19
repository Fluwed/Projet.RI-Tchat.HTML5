<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

function sendMsg($id, $msg,$logged,$users,$gestion="",$mymsg="") 
{
$arr = array('message' => $msg, 'logged' => $logged, 'users' => $users,'gestion' => $gestion,'mymessage'=> $mymsg);

$json=json_encode($arr);

  echo "id: $id" . PHP_EOL;
  echo "data: $json" . PHP_EOL;
  echo PHP_EOL;
  ob_flush();
  flush();
}


//timestamp
$mydate=time();
$idSalon=$_GET['room'];
$iduser=$_GET['iduser'];

$db = mysql_connect('tse-pilat.univ-st-etienne.fr', 'root', ''); 
mysql_select_db('Salons',$db); 

if(isset($_GET['iduser']) && isset($_GET['msg']))
{
	//ecriture des auteurs dans la base auteur
	$sqlAuteur = "select auteur from Auteurs where id=".$_GET['iduser'].";" ; 
	$reqAuteur = mysql_query($sqlAuteur) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());
	$num_rows = mysql_num_rows($reqAuteur);
	if (isset($_GET['isAdmin'])) $isAdmin=1; 
	else $isAdmin=0;
	if ($num_rows==0) //l'utilisateur n'existe pas dans la base, il faut le créer
		{
		$sqlInsertAuteur = "insert into Auteurs (id,auteur,isAdmin,timestamp) values (".$_GET['iduser'].",'".$_GET['user']."',".$isAdmin.",".$mydate.")" ; 
		$reqInsertAuteur = mysql_query($sqlInsertAuteur) or die('Erreur SQL !<br>'.$sqlInsertAuteur.'<br>'.mysql_error()); 
		if ($isAdmin==0)
			{
			//REcuperation des managers pour les users du salon
			$managers=array();
			$sql = "select id from Auteurs where isAdmin=1 and idSalon=".$idSalon ; 
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			while($data = mysql_fetch_assoc($req)) 
    			{
    	 		$managers[]=$data['id'];
    			}
    		//Recuperation des users affecté à chaque manager
    		$bestnb=10000;$bestmanager=1;
    		for ($i=0;$i<count($managers);$i++)
    			{
    			$sql = "select count(id) as nombre from Auteurs where isAdmin=0 and idSalon=".$idSalon." and idManager=".$managers[$i] ; 
    			// echo $sql."<br/>";
				$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				while($data = mysql_fetch_assoc($req)) 
    				{
    	 			$nb=$data['nombre'];
    	 			//echo "NB :".$nb;
    	 			if ($nb<$bestnb) {$bestmanager=$managers[$i];$bestnb=$nb;}
    				}
				}
			
    		//on va affecter le nouvel user à ce manager (le manager qui en a le moins ;)
    		$sql = "update Auteurs set idManager=".$bestmanager." where id=".$_GET['iduser'];
    		//echo $sql;
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());
			}
		}
    

	
}

if(isset($_GET['iduser']) && isset($_GET['msg']))
{
	
	$sql = "insert into Messages (texte,idAuteur,idSalon,timestampmessage) values ('".$_GET['msg']."',".$_GET['iduser'].",".$idSalon.",".$mydate.")" ; 
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());      
}

//suppression des messages anciens
$oldtimestamp=$mydate-7200;
$sql = "delete from Messages where timestampmessage<".$oldtimestamp;

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

//suppression des auteurs anciens
$oldtimestamp=$mydate-7200;
$sql = "delete from Auteurs where timestamp<".$oldtimestamp;

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

//recuperation du nombre d'users
$sql = "select count(id) as nb from  Auteurs where idSalon=".$idSalon;
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) 
    { 
    $nbusers=$data['nb'];
   }


//recupération des messages 
$sql = "select * from Messages,Auteurs where Messages.idSalon=".$idSalon." and idAuteur=Auteurs.id order by timestampmessage asc" ; 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$contents=""; 
$mycontents="";
while($data = mysql_fetch_assoc($req)) 
    { 
    $stamp=date("H:i:s",$data['timestampmessage']);
    // on affiche les informations de l'enregistrement en cours 
    if ($data['isAdmin']==1)
    	{
    	 $contents.="<div class='msgtse'>".$data['auteur'].'('.$stamp.') : '.$data['texte'].'<br></div>';
    	 if ($data['idAuteur']==$iduser)
    	 $mycontents.="<div class='mymsgtse' onclick=Reponse(\"".$data['auteur']."\")>".$data['auteur'].'('.$stamp.') : '.$data['texte'].'<br></div>';
    	 }
	else
		{
		//echo "Managé par ".$data['idManager']." versus ".$iduser;
		if ($data['idManager']==$iduser) //c'est un message managé par l'utilisateur en cours
			{
			$contents.="<div class='msgmanager'>".$data['auteur'].'('.$stamp.') : '.$data['texte'].'<br></div>';
			$mycontents.="<div class='mymsgmanager' onclick=Reponse(\"".$data['auteur']."\")>".$data['auteur'].'('.$stamp.') : '.$data['texte'].'<br></div>';
			} 
    	else
    		$contents.="<div class='msgln'>".$data['auteur'].'('.$stamp.') : '.$data['texte'].'<br></div>'; 
    	}
    } 	

//Recuperation des users pour chaque manager
$managers=array();
$managersName=array();
$sql = "select id,auteur from Auteurs where isAdmin=1 and idSalon=".$idSalon ; 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) 
    {
    $managers[]=$data['id'];
    
    $managersName[]=$data['auteur'];
    
    }
//Recuperation des users affecté à chaque manager
$gestion="";
for ($i=0;$i<count($managers);$i++)
    {
    $gestion.=$managersName[$i].":";
    $sql = "select auteur from Auteurs where isAdmin=0 and idSalon=".$idSalon." and idManager=".$managers[$i] ; 
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req)) 
    	{
    	$gestion.=$data['auteur'].", ";
    	}
    $gestion.="<br/>";
	}

sendMsg(time(),$contents,$user,$nbusers,$gestion,$mycontents);
mysql_close(); 

?>