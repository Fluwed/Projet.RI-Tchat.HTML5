$(document).ready(function(){
	$('#liste_salons > button').click(function() {
		var titre = $(this).data('titre');
        var idSalon = $(this).data('id-salon');
        
        $("#boutonEnvoi").data("id-salon", idSalon);
        
        $('#titre_salon').text(titre);
        $('#liste_salons').fadeOut('fast');
        $('#tchat').fadeIn('fast');

        charger(idSalon);
	});
    
    function formater_date(date){
        var tableauDate = date.split(/[- :]/);
        var objetDate = new Date(tableauDate[0], tableauDate[1]-1, tableauDate[2], tableauDate[3], tableauDate[4], tableauDate[5]);
        
        return tableauDate[3]+':'+tableauDate[4];
    }
    
    function formater_affichage(data){
        var objet_json = JSON.parse(data);
        var html = '';
        for(i=0; i<objet_json.length; i++){
            html += '<p><strong>'+objet_json[i]["user"]+' à '+formater_date(objet_json[i]["date"])+' :</strong><br />'+objet_json[i]["texte"]+'<p>';
        }
        return html;
    }
    
    function charger(salon){
        setTimeout( function(){
            // On récupère les messages et auteurs dans la bas
            $.ajax({
                url : "ajax/getMessages.php",
                type : "POST",
                data : "idSalon="+salon
            })
            .done(function(resultData) {
                // On formate l'affichage
                var html = formater_affichage(resultData);
                
                // On raffraichit la zone d'affichage des messages
                $('#zone_tchat').html(html);
            });
            
            // On relance la fonction
            charger(salon);
        }, 1000);
    }
    
    function envoyerMessage(texte, idSalon){
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
    
    $('#boutonEnvoi').click(function() {  
        var texte = $('#messageUtilisateur').val();
        var idSalon = $(this).data('id-salon');
        envoyerMessage(texte, idSalon);
        $('#messageUtilisateur').val('');
	});
});