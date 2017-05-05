<?php

$stripslashes = create_function('$txt', 'return stripslashes($txt);');

if($_POST['envoi_champs']==1){
    $champs=get_option('wp_sarbacane').$_POST['nom_champs'].';@;';
    update_option( 'wp_sarbacane', $champs);
    ?><script type="text/javascript">document.location.href="admin.php?page=wp_sarbacane#champs"</script><?php 
} else if(isset($_GET['suppr'])){
    $champs = explode(";@;", get_option('wp_sarbacane'));
    foreach ($champs as $i => $value) {
        if($value != $_GET['suppr']){
            $chaine=$chaine.$value.';@;';
        }
    }
    update_option( 'wp_sarbacane', substr($chaine, 0, -3) );
    ?><script type="text/javascript">document.location.href="admin.php?page=wp_sarbacane#champs"</script><?php 
} else if($_POST['envoi_option']==1){
    if($_POST['apres_envoi'] =="on"){$apres_envoi=1;}else{$apres_envoi=0;}
    update_option('wp_sarbacane_form_send', $_POST['lib_envoi']);
    update_option('wp_sarbacane_text_widget', $stripslashes($_POST['texte_perso']));
    update_option('wp_sarbacane_nom_widget', $stripslashes($_POST['titre_perso']));
    update_option('wp_sarbacane_after_envoi', $apres_envoi);
    update_option('wp_sarbacane_after_envoi_2', $_POST['apres_envoi_2']);
    update_option('wp_sarbacane_infos_apres_envoi', $_POST['infos_apres_envoi']);
    if($_POST['infos2_apres_envoi']!="http://"){
        if(preg_match("#^https?://.+#", $_POST['infos2_apres_envoi']) and @fopen($_POST['infos2_apres_envoi'],"r")){
            update_option('wp_sarbacane_infos2_apres_envoi', $_POST['infos2_apres_envoi']);
        } else { ?>
            <script type="text/javascript">alert("<?php _e('Merci de saisir une URL valide', 'wpsarbacane') ?>");</script>
        <?php }
    }
    update_option('wp_sarbacane_before_envoi', $_POST['before_envoi']);
    update_option('wp_sarbacane_before_envoi_label', htmlspecialchars($_POST['before_envoi_label'], ENT_QUOTES) );
    update_option('wp_sarbacane_before_envoi_link', $_POST['lien_avant_envoi_checkbox']);

} else if($_POST['deconnection']==1){
    update_option( 'wp_sarbacane_connect', 0);
} else if($_POST['change_liste']==1){
    update_option( 'wp_sarbacane_nom_liste', $_POST['nom_liste']);
    update_option( 'wp_sarbacane_listeCode', $_POST['liste_code']);
}

if($_GET['add']=="ok"){
    update_option( 'wp_sarbacane_connect', 1);
    update_option( 'wp_sarbacane_id_pass', $_GET['id']);
    update_option( 'wp_sarbacane_licence', $_GET['licence']);
    update_option( 'wp_sarbacane_listeCode', $_GET['num']);
    ?><script type="text/javascript">document.location.href="admin.php?page=wp_sarbacane"</script><?php
}

if($_GET['creerlist']=="ok"){
    update_option( 'wp_sarbacane_nom_liste', $_GET['nom']);
    update_option( 'wp_sarbacane_pass', $_GET['pass']);
    update_option( 'wp_sarbacane_listeCode', $_GET['listeCode']);
    ?><script type="text/javascript">document.location.href="admin.php?page=wp_sarbacane"</script><?php
}
?>
<div class="wrap">  
    <div class="icon32" id="icon-edit"><br /></div>  
    <h2><?php _e('Gestion des réglages Sarbacane WP', 'wpsarbacane') ?></h2>
    <br />
    <p>
        <?php _e('Sarbacane vous propose d’installer sur votre blog un widget d’inscription à une liste de diffusion.', 'wpsarbacane') ?><br />
        <?php _e('Les adresses récoltées en opt-in sont codées et stockées sur les serveurs Sarbacane. La confidentialité de ces informations est donc totale.', 'wpsarbacane') ?><br />
        <?php _e('Vos différentes listes d\'adresses e-mail ainsi alimentées peuvent alors être importées depuis votre logiciel Sarbacane 3 parmi les choix de sources de destinataires.', 'wpsarbacane') ?>
    </p>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<?php if(get_option('wp_sarbacane_connect')==0){?>
<div style="width:700px;">
    <form method="post">
        <table class="widefat">
            <tr valign="top">
                <th scope="row"><?php _e('Clé de licence:', 'wpsarbacane') ?></th>
                <td><input type="text" name="lic_sarbacane" id="numero_licence" value=""></td>
            </tr>
            <tr valign="top">
                <th scope="row" colspan="2"><input class="button" id="connection" type="submit" value="<?php _e('Valider', 'wpsarbacane') ?>" /> </th>
            </tr>
        </table>
    </form>
    <p><?php _e("Vous n'avez pas de licence Sarbacane?", 'wpsarbacane') ?> <a href="<?php _e('http://www.sarbacane.com/boutique.asp', 'wpsarbacane') ?>" target="_blank"><?php _e("Découvrez toutes nos offres ici.", 'wpsarbacane') ?></a></p>
    <div style="background-image:url('<?php echo WP_PLUGIN_URL.'/sarbacane/img/bannerWP2.png' ?>');width: 770px;height: 250px;">
        <span style="position: relative;top: 16px;left: 31px;font-size: 16px;color:#4a4849;"><?php _e('Découvrez Sarbacane, le logiciel emailing leader !', 'wpsarbacane') ?></span><br />
        <span style="position: relative;top: 65px;left: 86px;font-size: 14px;color:#4a4849;"><?php _e('Gestion des destinataires', 'wpsarbacane') ?></span><br />
        <span style="position: relative;top: 95px;left: 86px;font-size: 14px;color:#4a4849;"><?php _e('Routage haute délivrabilité', 'wpsarbacane') ?></span><br />
        <span style="position: relative;top: 122px;left: 86px;font-size: 14px;color:#4a4849;width: 225px;display: block;"><?php _e('Statistiques détaillées sur <br />les ouvertures, clics...', 'wpsarbacane') ?></span><br />
        <a href="<?php _e('http://www.sarbacane.com/boutique.asp', 'wpsarbacane') ?>" target="_blank"><button style="padding: 8px 20px;border: none;background: #86ac35;background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…IgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);background: -moz-linear-gradient(top, #86ac35 0%, #619026 76%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #86ac35), color-stop(76%, #619026));background: -webkit-linear-gradient(top, #86ac35 0%, #619026 76%);background: -o-linear-gradient(top, #86ac35 0%, #619026 76%);background: -ms-linear-gradient(top, #86ac35 0%, #619026 76%);background: linear-gradient(to bottom, #86ac35 0%, #619026 76%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#86ac35', endColorstr='#619026', GradientType=0 );-webkit-box-shadow: 0px 2px 2px 0px #888;box-shadow: 0px 2px 2px 0px #888;color: white;position: relative;top: 116px;left: 250px;cursor:pointer"><?php _e('Découvrir', 'wpsarbacane') ?></button></a>
    </div>
    <span style="font-size: 12px;color:#4a4849;position:relative;top:10px;"><i><?php _e('Pour utiliser le plugin Sarbacane Newsletter, il vous faut un abonnement Sarbacane', 'wpsarbacane') ?></i></span>
</div>
<?php }elseif(get_option('wp_sarbacane_connect')==1){ ?>
<div style="width:700px;">
    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
        <input type="hidden" value="1" name="deconnection">
        <table class="widefat">
            <tr valign="top">
                <th scope="row" colspan="2"><input class="button" type="submit" value="<?php _e('Changer de licence', 'wpsarbacane') ?>" /></th>
                <td style="text-align:right;line-height: 32px;"><?php echo 'Lic.: **** - **** - **** - '.substr(get_option('wp_sarbacane_licence'), -4, 4); ?></td>
            </tr>
        </table>
    </form>
</div>
<div style="width:700px;">
    <h3><?php _e("Liste(s) disponible(s)", 'wpsarbacane') ?></h3>
    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"];?>">
        <input type="hidden" value="1" name="change_liste">
        <input type="hidden" value="1" name="nom_liste" id="name_liste">
        <table class="widefat">
            <tr valign="top">
                <th scope="row"><?php _e("Liste à alimenter:", 'wpsarbacane') ?></th>
                <td>
                    <select style="display:none;" name="liste_code" id="liste_select" onchange="$('#name_liste').val($('#liste_select').children('option').filter(':selected').text());">
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row" colspan="2"><input class="button" id="changelist" type="submit" value="<?php _e('Valider', 'wpsarbacane') ?>" /> </th>
            </tr>
        </table>
    </form>
</div>
<div style="width:700px;">
    <h3><?php _e("Créer une nouvelle liste", 'wpsarbacane') ?></h3>
    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"];?>">
        <input type="hidden" value="1" name="creer_liste">
        <table class="widefat">
            <tr valign="top">
                <th scope="row"><?php _e("Nom de votre liste:", 'wpsarbacane') ?></th>
                <td><input type="text" name="nom_liste_sarbacane" id="nom_liste" value="" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Saisissez un mot de passe (appelé clé de liaison):", 'wpsarbacane') ?></th>
                <td>
                    <input type="password" name="pass_sarbacane" id="pass_liste" value="" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Confirmer le mot de passe:", 'wpsarbacane') ?></th>
                <td>
                    <input type="password" name="pass_sarbacane2" id="pass_liste2" value="" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row" colspan="2"><input class="button" id="creerlist" type="submit" value="<?php _e('Créer', 'wpsarbacane') ?>" /> </th>
            </tr>
        </table>
    </form>
</div>
<div style="width:700px;">
    <h3><?php _e("Paramètre d'affichage", 'wpsarbacane') ?></h3>
    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" onsubmit="return checkForm();">
        <input type="hidden" value="1" name="envoi_option">
        <table class="widefat">
            <tr>
                <th><?php _e("Titre du widget:", 'wpsarbacane') ?></th>
                <td><input type="text" name="titre_perso" value="<?php echo get_option('wp_sarbacane_nom_widget'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Texte d'en-tête personnalisable:", 'wpsarbacane') ?></th>
                <td><textarea name="texte_perso" cols="65"><?php echo get_option('wp_sarbacane_text_widget');?></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Libellé du bouton d'inscription:", 'wpsarbacane') ?></th>
                <td><input type="text" name="lib_envoi" value="<?php echo get_option('wp_sarbacane_form_send');?>"></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width: 301px;"><?php _e("Validation du formulaire par case à cocher", 'wpsarbacane') ?>
                <span style="line-height: 25px;<?php if(get_option('wp_sarbacane_before_envoi') == 0){ echo 'display:none;';}?>" id="infos_textes_case_coche"><br /><?php _e("Texte de la case à cocher", 'wpsarbacane') ?><br />
                <?php _e("Lien sur le texte ( optionnel )", 'wpsarbacane') ?></span></th>
                <td>
                    <select id="before_envoi" name="before_envoi" onchange="affichage_checkbox(this.value)">
                        <option <?php if(get_option('wp_sarbacane_before_envoi') == 0){ echo "selected"; }?> value="0"><?php _e("désactiver", 'wpsarbacane') ?></option>
                        <option <?php if(get_option('wp_sarbacane_before_envoi') == 1){ echo "selected"; }?> value="1"><?php _e("activer", 'wpsarbacane') ?></option>
                    </select><br />
                    <input type="text" maxlength="250" value="<?php echo str_replace("\\", "", get_option('wp_sarbacane_before_envoi_label') ); ?>" name="before_envoi_label" id="before_envoi_label" style="width: 242px;<?php if(get_option('wp_sarbacane_before_envoi') == 0){ echo 'display:none;"';}?>" >
                    <input type="text" placeholder="http://" value="<?php echo get_option('wp_sarbacane_before_envoi_link'); ?>" name="lien_avant_envoi_checkbox" id="lien_avant_envoi_checkbox" style="width: 242px;<?php if(get_option('wp_sarbacane_before_envoi') == 0){ echo 'display:none;"';}?>" >
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Masquer le formulaire après soumission", 'wpsarbacane') ?></th>
                <td>
                    <input type="radio" name="apres_envoi" value="off" <?php if(get_option('wp_sarbacane_after_envoi') == 0){ echo "checked";}?>> <?php _e("Non", 'wpsarbacane') ?><br />
                    <input type="radio" name="apres_envoi" value="on" <?php if(get_option('wp_sarbacane_after_envoi') == 1){ echo "checked";}?>> <?php _e("Oui", 'wpsarbacane') ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Action après soumission:", 'wpsarbacane') ?></th>
                <td>
                    <select name="apres_envoi_2" onchange="affichageApresEnvoi(this[this.selectedIndex].value)">
                        <option <?php if(get_option('wp_sarbacane_after_envoi_2') == 0){ echo "selected"; }?> value="0"><?php _e("Afficher le message générique", 'wpsarbacane') ?></option>
                        <option <?php if(get_option('wp_sarbacane_after_envoi_2') == 1){ echo "selected"; }?> value="1"><?php _e("Afficher ce message personnalisé :", 'wpsarbacane') ?></option>
                        <option <?php if(get_option('wp_sarbacane_after_envoi_2') == 2){ echo "selected"; }?> value="2"><?php _e("Rediriger le visiteur sur cette adresse :", 'wpsarbacane') ?></option>
                    </select><br />
                    <textarea name="infos_apres_envoi" rows="3" cols="45"id="infos_apres_envoi" <?php if(get_option('wp_sarbacane_after_envoi_2') == 1){ } else {echo 'style="display:none;"';}?>><?php echo get_option('wp_sarbacane_infos_apres_envoi');?></textarea>
                    <input type="text" value="<?php if(get_option('wp_sarbacane_infos2_apres_envoi')!=""){ echo get_option('wp_sarbacane_infos2_apres_envoi'); } else { echo "http://"; }?>" name="infos2_apres_envoi" id="infos2_apres_envoi" style="width: 242px;<?php if(get_option('wp_sarbacane_after_envoi_2') == 2){ } else {echo 'display:none;"';}?>" >
                </td>
            </tr>
            <tr valign="top">
                <th scope="row" colspan="2"><input class="button" type="submit" value="<?php _e('Valider', 'wpsarbacane') ?>" /> </th>
            </tr>
        </table>
    </form>
</div>

<div style="width:700px;" id="champs">
    <h3><?php _e('Liste des champs', 'wpsarbacane') ?></h3>
    <table class="widefat">
         <?php

            $lang_champs['email']=__('email', 'wpsarbacane');
            $lang_champs['Nom']=__('Nom', 'wpsarbacane');
            $lang_champs['Prenom']=__('Prenom', 'wpsarbacane');
            $lang_champs['civilite']=__('civilite', 'wpsarbacane');
            $lang_champs['naissance']=__('naissance', 'wpsarbacane');
            $lang_champs['Adresse']=__('Adresse', 'wpsarbacane');
            $lang_champs['Cplmtadresse']=__('Cplmtadresse', 'wpsarbacane');
            $lang_champs['Cp']=__('Cp', 'wpsarbacane');
            $lang_champs['Ville']=__('Ville', 'wpsarbacane');
            $lang_champs['Pays']=__('Pays', 'wpsarbacane');
            $lang_champs['Tel']=__('Tel', 'wpsarbacane');
            $lang_champs['Fax']=__('Fax', 'wpsarbacane');
            $lang_champs['Portable']=__('Portable', 'wpsarbacane');
            $lang_champs['Societe']=__('Societe', 'wpsarbacane');

            $champs = explode(";@;", get_option('wp_sarbacane'));
            foreach ($champs as $i => $value) { ?>
                <?php if($value != ""){ ?>
                <tr valign="top">
                    <th scope="row"><?php echo $lang_champs[$value]; ?></th>
                    <td>
                    <?php if($value != "email"){ ?>
                        <a href="?page=wp_sarbacane&suppr=<?php echo $value; ?>"><img title="<?php _e('Supprimer le champ', 'wpsarbacane') ?> <?php echo $value; ?>" style="margin-top: 5px;" src="<?php echo WP_PLUGIN_URL.'/sarbacane/img/none.png' ?>" alt="suppr" /></a>
                    <?php } ?>
                    </td>
                </tr>
                <?php }
            } ?>
        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
        <input type="hidden" value="1" name="envoi_champs">
        <tr>
            <th scope="row"><?php _e('Ajouter le champ:', 'wpsarbacane') ?></th>
            <td>
                <select name="nom_champs">
                <?php
                    $champs = explode(";@;", get_option('wp_sarbacane_full'));
                    foreach ($champs as $i => $value) { ?>
                        <?php if($value != ""){
                            if($value != "email"){ ?>
                                <option value="<?php echo $value;?>"><?php echo $lang_champs[$value];?></option>
                            <?php }
                        }
                    }
                ?>
                </select><input class="button" type="submit" name="update_wp_sarbacaneSettings" value="<?php _e('Ajouter', 'wpsarbacane') ?>" />
            </td>
        </tr>
        </form>
    </table>
</div>

<input type="hidden" id="liste_diff" value="<?php echo get_option('wp_sarbacane_nom_liste');?>">
<?php } ?>
<script type="text/javascript">
    function affichageApresEnvoi(valeur){
        switch (valeur){ 
        case "0": 
            $("#infos_apres_envoi").hide();
            $("#infos2_apres_envoi").hide();
        break; 
        case "1": 
            $("#infos_apres_envoi").show();
            $("#infos2_apres_envoi").hide();
        break;
        case "2":
            $("#infos_apres_envoi").hide();
            $("#infos2_apres_envoi").show();
        break;
        }
    }
    function checkForm(){
        
        if($("#before_envoi").val() == 1 ){
            if( $("#before_envoi_label").val() == "" ){
                alert("<?php _e('Merci de saisir un texte de la case à cocher', 'wpsarbacane') ?>");
                return false;
            }
            if( $("#lien_avant_envoi_checkbox").val() != "" ){
                var url = $("#lien_avant_envoi_checkbox").val();
                var regex = /^http:\/\/.{3,}\..{2,5}\//;
                if(regex.test(url) == false) {
                    alert("<?php _e('Merci de saisir un lien valide', 'wpsarbacane') ?>");
                    return false;
                }
            }
        }
    }
    function getXDomainRequest() {
        var xdr = null;
        if (window.XDomainRequest) {
            xdr = new XDomainRequest(); 
        } else if (window.XMLHttpRequest) {
            xdr = new XMLHttpRequest(); 
        } else {
            alert("<?php _e('Votre navigateur ne gère pas l\'AJAX cross-domain !', 'wpsarbacane') ?>");
        }
        return xdr; 
    }
    function affichage_checkbox(value){
        if (value==1){
            $("#before_envoi_label").show();
            $("#lien_avant_envoi_checkbox").show();
            $("#infos_textes_case_coche").show();
        } else {
            $("#before_envoi_label").hide();
            $("#lien_avant_envoi_checkbox").hide();
            $("#infos_textes_case_coche").hide();
        }
    }
    $("#connection").click(function(){
        var xdr = getXDomainRequest();
        xdr.onload = function() {
            var id=xdr.responseText;
            if(id != ""){
                var xdr2 = getXDomainRequest();
                xdr2.onload = function() {
                    var liste=xdr2.responseText;
                    var infosListe=liste.split('/*/');
                        details=infosListe[0].split('/-/');
                        document.location.href='admin.php?page=wp_sarbacane&licence='+$("#numero_licence").val()+'&add=ok&id='+id+'&num='+details[0];
                }
                xdr2.open("GET", "http://www.sarbacane.com/ws/id_liste_list.asp?list=<?php echo get_option('wp_sarbacane_id_pass');?>");
                xdr2.send();
            } else {
                alert("<?php _e('Aucun compte associer à votre licence. Merci de recommencer.', 'wpsarbacane'); ?>")
            }
        }
        xdr.open("GET", "http://sarbacane.com/ws/lic_id_licence.asp?licence="+$("#numero_licence").val());
        xdr.send();

        return false;
    });

    $("#creerlist").click(function(){
        if($("#pass_liste").val()!=$("#pass_liste2").val()){
            alert("<?php _e('Vos mots de passe sont différents', 'wpsarbacane'); ?>");
            return false;
        }
        if( ($("#pass_liste").val() == "") || ($("#pass_liste2").val() == "") || ($("#numero_licence").val() == "")  || ($("#nom_liste").val() == "")){
            alert("<?php _e('Merci de remplir tout les champs.', 'wpsarbacane'); ?>");
            return false;
        }
        var val_nom=$("#nom_liste").val();
        var val_pass=$("#pass_liste").val();
        var Regex=new RegExp("[^a-zA-Z0-9_]", "g");
        var nom=val_nom.replace(Regex, "");
        var pass=val_pass.replace(Regex, "");
        var xdr = getXDomainRequest();
        var id='<?php echo get_option("wp_sarbacane_id_pass");?>';
        xdr.onload = function() {
            var xdr2 = getXDomainRequest();
            xdr2.onload = function() {
                listeCode= xdr2.responseText;
                document.location.href="admin.php?page=wp_sarbacane&creerlist=ok&nom="+nom+"&pass="+pass+"&listeCode="+listeCode;
            }
            xdr2.open("GET", "http://sarbacane.com/ws/id_list.asp?liste="+nom);
            xdr2.send();
        }
        xdr.open("GET", "http://sarbacane.com/admin/mailing_list.asp?creer="+nom+"&key_link="+pass+"&id="+id);
        xdr.send();

        return false;
    });


    $(document).ready(function(){
        var xdr = getXDomainRequest();
        xdr.onload = function() {
            var liste=xdr.responseText;
            var infosListe=liste.split('/*/');
            for (var i = 0; i < (infosListe.length-1); i++) {
                details=infosListe[i].split('/-/');
                if($("#liste_diff").val()==details[1]){
                    $("#liste_select").append('<option selected value="'+details[0]+'">'+details[1]+'</option>');
                } else {
                    $("#liste_select").append('<option value="'+details[0]+'">'+details[1]+'</option>');
                }
                $("#liste_select").fadeIn();
            }
            if(infosListe.length == 1){
                $("#liste_select").parent("td").html('<p style="text-align: right;"><?php _e("Aucune liste de diffusion. Vous avez la possibilité d’en créer ci-dessous.", "wpsarbacane") ?></p>');
                $("#changelist").parent("th").parent("tr").hide();
            }
        }
        xdr.open("GET", "http://www.sarbacane.com/ws/id_liste_list.asp?list=<?php echo get_option('wp_sarbacane_id_pass');?>");
        xdr.send();
    });
</script>