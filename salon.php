<?php if (!isset($_POST['idSalon']))
	header('Location: index.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<style>
body
{
	width: 100%;
	margin: 0 auto;
}
#chats
{
	height: 500px;
	overflow-y: scroll;
}
#msg
{
	font-size: 12px;
	width: 99%;
	border: 1px solid #DDD;
	border-radius: 5px;
	-moz-border-radius: 5px;
	font-family: Arial, Helvetica, sans-serif;
	margin: 5px auto 20px;
	padding: 5px;
	border-image: initial;
}
.msgln
{
	padding: 3px;
	
}
.msgln:nth-child(odd)
{
	background-color: #EAEAEA;
}

.msgtse
{
	padding: 3px;
	background-color: #99CCFF;
	text-align:right;
}

footer
{
	position: fixed;
	bottom: 10px;
}
</style>
</head>
<body>
<?php
	$room = $_POST['idSalon'] ;
	$roomname= $_POST['nameSalon'] ;
	echo $room."/".$roomname;
?>
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
             <a href="http://recrutement.telecom-st-etienne.fr/tchat/index.php"><img class="one columns" id="home" name="home" src="images/picto_home_4.gif" onmouseover="home.src='images/picto_home_5.gif'" onmouseout="home.src='images/picto_home_4.gif'"/></a>
            <div class="twelve columns" id="bienvenue">
                <p><?php echo $roomname?>&nbsp;</p>
            </div>
        </div>
        <div class="sixteen columns" id ="content">
<div id="chats"></div>
<div id="utilisateur">Utilisateur</div><div id="connected">Utilisateurs connectés</div>

<form onsubmit="javascript:sendMsg();return false;">
	<input type="text" name="text" id="msg" autocomplete="off" placeholder="Tapez ici votre message"/>
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="./jquery.alerts.js"></script>
<link href="./jquery.alerts.css" rel="stylesheet" type="text/css" media="screen"> 

<script>
var username = '';
var idUser='';

if(!idUser)
{
	idUser=Math.floor(Math.random() * 100000)+1;
	jPrompt("Bonjour ! Quel est votre prénom/pseudo?", "", "Pseudo",function(r) 
			{
    		if( r ) username=r;
			});
	//jConfirm("Souhaitez vous nous laisser une adresse mail pour que l'on puisse vous envoyer des informations sur l'école?","","Adresse Mail", function(r)
	//	{
	//	jPrompt("Merci ! Quel est votre mail?", "","Email",function(r2)
	//		{
	//		$.get('/tchat/stockmail.php?email='+email+'&user='+username+'&room=<?php echo $room; ?>');
	//		});
	//	});
		
		
}

function sendMsg(){
	if(!username)
	{
		jPrompt("Bonjour ! Quel est votre prénom/pseudo?", "", "Pseudo",function(r) 
			{
    		if( r ) username=r;
			});
		if(!username)
		{
			return;
		}
	}

	var msg = document.getElementById("msg").value;
	if(!msg)
	{
		return;
	}
	
	document.getElementById("chats").innerHTML+=strip('<div class="msgln">'+username+' : '+msg+'<br/></div>');
	$("#chats").animate({ scrollTop: 2000 }, 'normal');
	$.get('/tchat/server.php?msg='+msg+'&user='+username+'&iduser='+idUser+'&room=<?php echo $room; ?>', function(data)
	{
		
		document.getElementById("msg").value = '';
		document.getElementById("utilisateur").innerHTML="Vous êtes connecté sous le pseudo : "+username;
		document.getElementById("coord").innerHTML="<form action='coord.php' method='post'><input type=hidden name='iduser' value='"+idUser+"'><input type=submit value='Laissez nous vos coordonnées !'></form>";

		document.getElementById("deconnexion").innerHTML="<form action='deconnexion.php' method='post'><input type=hidden name='iduser' value='"+idUser+"'><input type=submit value=Déconnexion></form>";

	});
}

var old = '';
var chaine='/tchat/server.php?iduser='+idUser+'&room=<?php echo $room; ?>';
var source = new EventSource(chaine);

source.onmessage = function(e)
{
	//alert("Message"+e);
	if(old!=e.data)
	{
		obj = JSON && JSON.parse(e.data) || $.parseJSON(e.data);	
		document.getElementById("chats").innerHTML='<span>'+obj.message+'</span>';
		old = e.data;
		document.getElementById("connected").innerHTML=obj.users+" connectés";
	
	}
};

function strip(html)
{
	var tmp = document.createElement("DIV");
	tmp.innerHTML = html;
	return tmp.textContent||tmp.innerText;
}
</script>
<div id="coord"></div>
<div id="deconnexion"></div>

</div>
</div>
</body>
</html>