<?php
/* La session en cours est fermée */
session_start();
include("../includes/conf.php");

if ($_SESSION['nomLogin'] != NULL)
{
    session_unset();
    session_destroy(); 
}

$server = "localhost";
$user = "paul";
$pass = "paul";

//récupération des salons ouverts
$db = mysql_connect($server, $user,$pass); 
mysql_query("SET NAMES UTF8");

//mysql_select_db($tableTchat,$db); 
mysql_select_db('Salons',$db); 

//suppression des salons dont la date de fermeture est passée
$mydate=time();
$sql = "delete from Salons where timestampfermeture<".$mydate ; 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());

$sql = "select * from Salons" ; 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sqlAuteur.'<br>'.mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tchat - Concours Télécom Saint-Etienne</title>
    <link href="../includes/css/concours.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
</head>

<body style="background-image:url(../images/bkg_pagetype.gif); background-repeat:repeat-x;">
    <div id="maincontent">
        <div id="mainleft">
            <img src="../images/header_pagetype_01.gif" width="250" height="132" class="left">
            <img src="../images/header_pagetype_02.jpg" width="497" height="132" class="right">
            <div id="contenuleft">
                <h3>
                    <span class="white"><br>Télécom Saint-Etienne</span><br>
                    <span class="filiere">en vidéo</span>
                </h3>
                <div id="filierefocus">
                    <!-- <h1 class="noir">&nbsp;</h1>
                    <h2><span class="gras">&nbsp;</span></h2>
                    <h2><span class="gras">&nbsp;</h2> -->
                    <div id="video" style="margin-left: 25px;">
                        <a href="" onclick="window.open('http://www.youtube.com/watch?v=0p7kzOZP60k','MediaPlayer','width=950,height=700');return false;"><img src="../images/video.jpg" width="160" height="90"></a>
                        <p>L'école en vidéo</p>
                    </div>
                
                    <!-- <div id="video">
                        <a href="http://www.youtube.com/watch?v=lz2RCpvCXoI" target="_blank"><img src="images/video.jpg" width="160" height="90"></a>
                        <p>Découvrez en images, <br>
                        la filière initiale</p>
                    </div> -->
                </div>

                <div id="indexadresse">
                    <h1>Télécom Saint-Etienne</h1>
                    <h2>&Eacute;cole d'Ingénieurs</h2>
                    <p> 25 rue du Dr Remy Annino <br/>
                        42000 Saint-Etienne</p>
                    <p>T&eacute;l:33(0)477 915 888 <br />
                        Fax:33(0)4 77 915 899</p>
                    <p>&nbsp;</p>
                    <p><a href="mailto:concours@telecom-st-etienne.fr?subject=Site concours Télécom Saint-Etienne : filière initiale" class="btncontact">contact</a></p>
                </div>
            </div>
            <!-- Zone centrale -->
            <div id="contenucentre">
                <h1>Tchat en ligne</h1>
               <?php
                while($data = mysql_fetch_assoc($req)) 
                {
                    if ($mydate > $data['timestampouverture'] && $mydate < $data['timestampfermeture']) 
                    {
                        echo "<br><br><br><form action='salon.php' method='post'>";
                            echo "<input type='hidden' name='idSalon' value=".$data['id'].">";
                            echo "<input type='hidden' name='nameSalon' value='".$data['salon']."'>";
                            echo "<input type=submit class='btnmodifier' style='width: 480px;' value='Accédez au salon : ".$data['salon']."&#13;&#10;(Ouvert du ".date ("j M Y H:i",$data['timestampouverture'])." au ".date ("j M Y H:i",$data['timestampfermeture']).")"."'>";
                        echo "</form><br/<br/>";
                    }
                    else echo "<p><span class='grey'style='font-size:16px'>A venir : ".$data['salon']." (Ouvert du ".date ("j M Y H:i",$data['timestampouverture'])." au ".date ("j M Y H:i",$data['timestampfermeture']).")</span></p>";
                }
                ?>
                <p>&nbsp;</p>
            </div>
        </div><!-- fin du mainleft -->

        <div id="mainright">
            <a href="http://www.telecom-st-etienne.fr" target="_blank"><img src="../images/header_03.jpg" width="119" height="188" class="left"></a>
            <a href="http://www.univ-st-etienne.fr" target="_blank"><img src="../images/header_04.jpg" width="94" height="89" class="left"></a>
            <a href="http://www.mines-telecom.fr" target="_blank"><img src="../images/header_05.jpg" width="94" height="99" class="left"></a>
            <div style="margin-bottom:35px;">&nbsp;</div>
            <p style="margin-left:15px;"><a href="../index.php" class="btngrey">Retour accueil</a></p>

            <h1>&nbsp;</h1>
            <h1>Télécharger la plaquette<br>Télécom Saint-Etienne</h1>
            <p><a href="../fichiers/plaquette tse.pdf" target="_blank"><img src="../images/plaquette_pdf.gif" width="127" height="164" style="margin-left:15px;"></a></p>
            <h1>&nbsp;</h1>
            <h1><a href="http://www.telecom-st-etienne.fr"><img src="../images/picto_www.png" width="42" height="19" style="vertical-align:text-bottom;margin-right:5px;">Télécom Saint-Etienne</a></h1>
            <p>
                <a href="https://twitter.com/#!/TSERecrutement"><img src="../images/pictos_res_soc_int_01.png" width="21" height="21" style="margin-left:20px;"></a>
                <a href="https://www.facebook.com/telecomsaintetienne"><img src="../images/pictos_res_soc_int_02.png" width="21" height="21" style="margin-left:8px;"></a>
                <a href="http://www.linkedin.com/groups/TELECOM-SaintEtienne-ex-ISTASE-111221"><img src="../images/pictos_res_soc_int_03.png" width="21" height="21" style="margin-left:8px;"></a>
            </p>
        </div><!-- fin du mainright -->
    </div> <!-- fin du maincontent -->
    <!-- Bandeau logos partenaire -->
    <div id="bandeauBas">
        <img src="../images/logos_partenaires.gif" border="0" width="323" height="49" class="indexpartenaires" usemap="#planetmap">  
        <map name="planetmap">
            <area shape="rect" coords="4,4,51,46" href="http://www.mines-telecom.fr/fr_accueil.html" alt="Institut Mines-Télécom" />
            <area shape="rect" coords="68,4,100,47" href="http://www.enseignementsup-recherche.gouv.fr/" alt="Ministère" />
            <area shape="rect" coords="105,5,190,44" href="http://www.universite-lyon.fr/" alt="Université de Lyon" />
            <area shape="rect" coords="192,6,237,40" href="http://www.cti-commission.fr/" alt="CTI"/>
            <area shape="rect" coords="257,10,310,37" href="http://www.ingenieurs-telecom-st-etienne.fr/" alt="A2i" />
        </map> 
    </div>
    <div id="piedpage"></div>
</body>
</html>

<?php
/* Validation */
// $mysqli->commit();
// $mysqli->close();
?>  
