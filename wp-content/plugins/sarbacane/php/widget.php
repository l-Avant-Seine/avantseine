<script type="text/javascript" src="http://www.sarbacane.com/mailing_list.js"></script>
<form name="mailing_list" class="wp_sarbacane_widget_form" onsubmit="<?php if(get_option('wp_sarbacane_before_envoi') > 0){ ?> if(!document.getElementById('check_avant_envoi').checked){alert('<?php _e('Merci de cocher la case pour valider le formulaire', 'wpsarbacane'); ?>');return false;} <?php } ?> process(); return false;" method="post">
    <input name="id_user" type="hidden" value="<?php echo get_option('wp_sarbacane_id_pass'); ?>">
    <input name="list" type="hidden" value="<?php echo get_option('wp_sarbacane_listeCode'); ?>">
    <?php 
    if(get_option('wp_sarbacane_after_envoi') == 1){ ?>
    <input name="first_callback" type="hidden" value="1">
    <?php }
    if(get_option('wp_sarbacane_after_envoi_2') == 0){ ?>
        <input name="lng" type="hidden" value="<?php echo get_option('wp_sarbacane_langue_generique') ?>">
    <?php } else if(get_option('wp_sarbacane_after_envoi_2') == 1){ ?>
        <input name="lng" type="hidden" value="<?php echo get_option('wp_sarbacane_langue_generique') ?>">
        <input name="callback_text" type="hidden" value="<?php echo get_option('wp_sarbacane_infos_apres_envoi') ?>">
    <?php }else if(get_option('wp_sarbacane_after_envoi_2') == 2){ ?>
        <input name="callback_url" type="hidden" value="<?php echo get_option('wp_sarbacane_infos2_apres_envoi') ?>">
    <?php }
    if(get_option('wp_sarbacane_text_widget') != ""){
        echo "<p>".get_option('wp_sarbacane_text_widget')."</p>";
    }
    ?>
    <p id="mailing_list_result" style="margin-bottom: 5px;"></p>
    <div class="form"> 
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
		    for ($i=0; $i<(sizeof($champs)-1); $i++){
		    	$value=$champs[$i];
		         ?><input onFocus="if(this.value=='<?php echo $lang_champs[$value];?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php echo $lang_champs[$value];?>'}" class="input_form_sarbacane" type="text" value="<?php echo $lang_champs[$value];?>" name="<?php echo strtolower($lang_champs[$value]);?>" /><?php
		    }
        
            if(get_option('wp_sarbacane_before_envoi') > 0 ) {
                ?><br /><input type="checkbox" id="check_avant_envoi" /><span style="margin-left:3px" id="sarbacane_text_label_checkbox"><?php if( get_option('wp_sarbacane_before_envoi_link') != "" ){ echo '<a href="'.get_option('wp_sarbacane_before_envoi_link').'" target="_blank">'; } echo str_replace("\\", "", get_option('wp_sarbacane_before_envoi_label') ); if( get_option('wp_sarbacane_before_envoi_link') != "" ){ echo '</a>'; } ?></span><br /><?php
            }

        ?>
        <input name="send" type="submit" value="<?php echo get_option('wp_sarbacane_form_send');?>" /><br />
        <span style="font-size: 9px; opacity: 0.8;color:rgb(119, 118, 118);"><?php echo get_option( 'wp_sarbacane_marketing');?></span>
    </div>
</form><br />