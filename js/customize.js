function resizeTextArea(text) {
    text.style.height = "1px";
    text.style.height = (text.scrollHeight)+"px";
}

function ansModalPass(msgId, auteurName, salon) {
    $('#boutonEnvoiAdmin').data('msg-id', msgId);
    $('#boutonEnvoiAdmin').data('auteur-name', auteurName);
    $('#boutonEnvoiAdmin').data('id-salon', salon);
}

function skipModalPass(msgId) {
    $('#skip_oui').data('msg-id', msgId);
}

function delModalPass(msgId) {
    $('#del_oui').data('msg-id', msgId);
}

$(document).ready(function() {

    function formater_date(date) {
        var tableauDate = date.split(/[- :]/);
        return tableauDate[3]+':'+tableauDate[4];
    }

    function formater_affichage(data) {
        var objet_json = JSON.parse(data);
        var html = '';
        for(i=0; i<objet_json.length; i++){
            html += '<p><strong>'+objet_json[i]["user"]+' à '+formater_date(objet_json[i]["date"])+' :</strong><br />'+objet_json[i]["texte"]+'</p>';
        }
        return html;
    }

    function charger(salon) {
        setTimeout( function() {
            // On récupère les messages et auteurs dans la bas
            $.ajax({
                url : "ajax/getMessages.php",
                type : "POST",
                data : "idSalon="+salon
            })
            .done(function(resultData) {
                // On formate l'affichage
                var html = formater_affichage(resultData);
                
                // To init variables to scroll bottom
                var zone_tchat = document.getElementById("zone_tchat");
                var scrollHeightOld = zone_tchat.scrollHeight;
                
                // On raffraichit la zone d'affichage des messages
                $('#zone_tchat').html(html);
                
                // To scroll bottom
                var scrollHeight = zone_tchat.scrollHeight;
                if (scrollHeight != scrollHeightOld) {
                    zone_tchat.scrollTop = scrollHeight;
                }
            });
            
            // On relance la fonction
            charger(salon);
        }, 1000);
    }

    function formater_date_admin(date) {
        var msPerSeconde = 1000;
        var msPerMinute = msPerSeconde * 60;
        var msPerHour = msPerMinute * 60;
        var msPerDay = msPerHour * 24;
        var msPerMonth = msPerDay * 30;
        var msPerYear = msPerDay * 365;
        
        var tableauDate = date.split(/[- :.]/);
        var msgDate = new Date(tableauDate[0], tableauDate[1]-1, tableauDate[2], tableauDate[3], tableauDate[4], tableauDate[5], Math.trunc(tableauDate[6]/1000));
        var diffTime = Date.now() - msgDate.getTime();
        
        var diffDate = [];
        diffDate[0] = Math.trunc(diffTime/msPerYear);
        if (diffDate[0] != 0) {
            return diffDate[0] + ' an(s)';
        }
        else {
            diffDate[1] = Math.trunc(diffTime/msPerMonth);
            if (diffDate[1] != 0) {
                return diffDate[1] + ' mois';
            }
            else {
                diffDate[2] = Math.trunc(diffTime/msPerDay);
                if (diffDate[2] != 0) {
                    return diffDate[2] + ' jour(s)';
                }
                else {
                    diffDate[3] = Math.trunc(diffTime/msPerHour);
                    if (diffDate[3] != 0) {
                        return diffDate[3] + ' heure(s)';
                    }
                    else {
                        diffDate[4] = Math.trunc(diffTime/msPerMinute);
                        if (diffDate[4] != 0) {
                            return diffDate[4] + ' minute(s)';
                        }
                        else {
                            diffDate[5] = Math.trunc(diffTime/msPerSeconde);
                            if (diffDate[5] != 0) {
                                return diffDate[5] + ' seconde(s)';
                            }
                            else {
                                diffDate[6] = diffTime;
                                return diffDate[6] + ' milli-seconde(s)';
                            }
                        }
                    }
                }
            }
        }
        return "Erreur de date";
    }

    function formater_affichage_admin(data, salon) {
        var objet_json = JSON.parse(data);
        var html = '';
        for(i=0; i<objet_json.length; i++){
            html += '<p id="adminDisplay"><strong>Message de '+objet_json[i]["user"]+' il y a '+formater_date_admin(objet_json[i]["date"])+' :</strong><br/>'
            +'<a href="#ansModal" onclick="ansModalPass('+objet_json[i]["id"]+',\''+objet_json[i]["user"]+'\','+salon+')">Répondre</a>'+' - '
            +'<a href="#skipModal" onclick="skipModalPass('+objet_json[i]["id"]+')">Passer</a>'+' - '
            +'<a href="#delModal" onclick="delModalPass('+objet_json[i]["id"]+')">Supprimer</a>'+'<br />'
            +objet_json[i]["texte"]+'</p>';
        }
        if (html == '') {
            html += '<h3 style="text-align: center">Tous les messages ont été traités !</h3>';
        }
        return html;
    }

    function charger_admin(salon) {
        setTimeout( function() {
            // On récupère les messages et auteurs dans la base
            $.ajax({
                url : "ajax/getMessagesAdmin.php",
                type : "POST",
                data : "idSalon="+salon
            })
            .done(function(resultData) {
                // On formate l'affichage
                var html = formater_affichage_admin(resultData, salon);
                
                // To init variables to scroll bottom
                var zone_tchat_admin = document.getElementById("zone_tchat_admin");
                var scrollHeightOld = zone_tchat_admin.scrollHeight;
                
                // On raffraichit la zone d'affichage des messages
                $('#zone_tchat_admin').html(html);
                
                // To scroll bottom
                var scrollHeight = zone_tchat_admin.scrollHeight;
                if (scrollHeight != scrollHeightOld) {
                    zone_tchat_admin.scrollTop = 0;
                }
            });
            
            // On relance la fonction
            charger_admin(salon);
        }, 1000);
    }

    function envoyerMessage(texte, idSalon) {
        // On récupère les messages et auteurs dans la bas
        $.ajax({
            url : "ajax/setMessage.php",
            type : "POST",
            data : "texte="+texte+"&idSalon="+idSalon
        })
        .fail(function(erreur) {
            console.log(erreur);
        });
    }

    function envoyerMessageAdmin(texte, idSalon) {
        // On récupère les messages et auteurs dans la bas
        $.ajax({
            url : "ajax/setMessageAdmin.php",
            type : "POST",
            data : "texte="+texte+"&idSalon="+idSalon
        })
        .fail(function(erreur) {
            console.log(erreur);
        });
    }

    function setRespondedMessage(msgId) {
        // On récupère les messages et auteurs dans la bas
        $.ajax({
            url : "ajax/setRespondedMessage.php",
            type : "POST",
            data : "msgId="+msgId
        })
        .fail(function(erreur) {
            console.log(erreur);
        });
    }

    function supprimerMessage(msgId) {
        // On récupère les messages et auteurs dans la bas
        $.ajax({
            url : "ajax/delMessage.php",
            type : "POST",
            data : "msgId="+msgId
        })
        .fail(function(erreur) {
            console.log(erreur);
        });
    }

    $('#liste_salons > button').click(function() {
        var titre = $(this).data('titre');
        var idSalon = $(this).data('id-salon');
        var isAdmin = $(this).data('is-admin');
        
        $('#titre_salon').text(titre);
        $('#liste_salons').fadeOut('fast');
        $('#tchat').fadeIn('fast');
        if (idSalon == 0) {
            $('#zone_submit').fadeOut('fast');
        }
        if (isAdmin == 0) {
            $("#boutonEnvoi").data("id-salon", idSalon);
            charger(idSalon);
        }
        else {
            charger_admin(idSalon);
        }
    });

    $('#boutonEnvoi').click(function() {
        var texte = $('#messageUtilisateur').val();
        
        if (texte != '') {
            var idSalon = $(this).data('id-salon');
            envoyerMessage(texte, idSalon);
            $('#messageUtilisateur').val('');
        }
    });

    $('#messageUtilisateur').keypress(function(event) {
        if(event.which == '13') {
            $('#boutonEnvoi').click();
            return false;
        }
    });

    $('#messageAdmin').keypress(function(event) {
        if(event.which == '13') {
            $('#boutonEnvoiAdmin').click();
            return false;
        }
    });

    $('#boutonEnvoiAdmin').click(function() {
        var texte = $('#messageAdmin').val();
        
        if (texte != '') {
            var msgId = $(this).data('msg-id');
            setRespondedMessage(msgId);
            
            var auteurName = $(this).data('auteur-name');
            texte = '@'+auteurName+' - '+texte;
            
            var idSalon = $(this).data('id-salon');
            envoyerMessageAdmin(texte, idSalon)
            $('#messageAdmin').val('');
        }
    });

    $('#skip_oui').click(function() {
        var msgId = $(this).data('msg-id');
        setRespondedMessage(msgId);
    });

    $('#del_oui').click(function() {
        var msgId = $(this).data('msg-id');
        supprimerMessage(msgId);
    });

});
