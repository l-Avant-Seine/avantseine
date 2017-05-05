<?php
/**
 * @package Sarbacane
 * @version 0.9.1
 */
/*
Plugin Name: Sarbacane
Plugin URI: http://www.sarbacane.com/
Description: Extension Sarbacane pour la collecte d'adresse en OPT-IN en toute simplicité.
Author: Max DECONINCK
Version: 0.9.1
Author URI: http://www.sarbacane.com/
*/

if (!class_exists("wp_sarbacane"))
{  
  
    class wp_sarbacane
    {  
        /** 
         * Constructeur 
         */
        var $adminOptionsName = 'wp_sarbacaneAdminOptions';
        function wp_sarbacane()  
        {  

        }
        function addHeaderCode()  
		{  
		      print '<script type="text/javascript" src="http://www.sarbacane.com/mailing_list.js"></script><style type="text/css">.wp_sarbacane_widget_form input{margin-top:7px;}</style>';  
		}
		function liste_plugin_load_text_domain() {
		   $path = dirname(plugin_basename(__FILE__)) . '/lang/';
		   load_plugin_textdomain('wpsarbacane', null, $path);
		}
		/* Ammin Part */
		function getAdminOptions()   
		{  
		    $wp_sarbacaneAdminOptions = array(  
		            'mail' => 'true'
		        );  
		    $wp_sarbacaneOptions = get_option($this->adminOptionsName);  
		    if (!empty($wp_sarbacaneOptions))
		    {
		        foreach ($wp_sarbacaneOptions as $key => $option)
		            $wp_sarbacaneAdminOptions[$key] = $option;  
		    }
		    update_option($this->adminOptionsName, $wp_sarbacaneAdminOptions);
		    return $wp_sarbacaneAdminOptions;
		}
		function init()
		{  
		    $this->getAdminOptions();
		}
		function printAdminPage() { 
		    $options = $this->getAdminOptions();  
		    if (isset($_POST['update_wp_sarbacaneSettings'])) {  
		        if (isset($_POST['mail'])) {  
		            $options['mail'] = $_POST['mail'];  
		        } 
		        update_option($this->adminOptionsName, $options);  
		        print '<div class="updated"><p><strong>';  
		        _e("Paramètres mis à jour", "wpsarbacane");  
		        print '</strong></p></div>';  
		         
		    }  
		    include('php/admin_settings.php'); // include du formulaire HTML  
		}

		/* Widget Part */
		function initWidget()
		{  
		    wp_register_sidebar_widget(
			    'wpsarbacane_widget',        // your unique widget id
			    __('Sarbacane Widget','wpsarbacane'),          // widget name
			    array(&$this, 'widget_sarbacane'),  // callback function
			    array(                  // options
			        'description' => "Collecte d'adresse en opt-in"
			    )
			);
		}
		
		function widget_sarbacane($args){
		    extract($args);
		    print $before_widget;
		    print $before_title;
		    _e(get_option('wp_sarbacane_nom_widget'), 'wpsarbacane');
		    print $after_title;
		    include('php/widget.php');
		    print $after_widget;
		}

		function installPlug(){
			update_option('wp_sarbacane_langue_generique', "en");
			$locale = apply_filters( 'plugin_locale', get_locale(), "wpsarbacane");
			if($locale=="es_ES"){
				update_option('wp_sarbacane_langue_generique', "es");
				$nb = rand(1, 11);
			    switch ($nb) {
				    case 1:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">programa mailing</a>';
				        break;
				    case 2:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">correo masivo</a>';
				        break;
				    case 3:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">mail masivo</a>';
				        break;
				    case 4:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">enviar emailing</a>';
				        break;
				    case 5:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">envio mailing</a>';
				        break;
				    case 6:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">email masivos</a>';
				        break;
				    case 7:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">envio masivo correos</a>';
				        break;
				    case 8:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">enviar mail masivo</a>';
				        break;
				    case 9:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">envio correo masivo</a>';
				        break;
				    case 10:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">envio masivo mail</a>';
				        break;
				    case 11:
				        $str='<p style="font-size:9px;">Creado por Sarbacán, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacan.es" target="_blank">enviar newsletter</a>';
				        break;
				}
			} else {
				update_option('wp_sarbacane_langue_generique', "fr");
				$nb = rand(1, 9);
			    switch ($nb) {
				    case 1:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">logiciel emailing</a>';
				        break;
				    case 2:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">emailing</a>';
				        break;
				    case 3:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">solution emailing</a>';
				        break;
				    case 4:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">e-mailing</a>';
				        break;
				    case 5:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">solution e-mailing</a>';
				        break;
				    case 6:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">logiciel e-mailing</a>';
				        break;
				    case 7:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">logiciel newsletter</a>';
				        break;
				    case 8:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">outil newsletter</a>';
				        break;
				    case 9:
				        $str='<p style="font-size:9px;">Powered by Sarbacane, <a style="text-decoration:none;color:rgb(119, 118, 118);"href="http://www.sarbacane.com" target="_blank">envoi newsletter</a>';
				        break;
				}
			}
		    update_option( 'wp_sarbacane_marketing', $str);

		    $chaine="email;@;Nom;@;Prenom;@;civilite;@;naissance;@;Adresse;@;Cplmtadresse;@;Cp;@;Ville;@;Pays;@;Tel;@;Fax;@;Portable;@;Societe;@;";
		    update_option( 'wp_sarbacane_full', $chaine);

		    if($locale=="es_ES"){
		    	update_option( 'wp_sarbacane_nom_widget', 'Newsletter');
		    	update_option( 'wp_sarbacane_form_send',  'Enviar');
		    	update_option('wp_sarbacane_text_widget', 'Suscríbete a nuestra newsletter');
		    	update_option('wp_sarbacane_before_envoi_label', 'He leído y aceptado todos los términos y condiciones del servicio');
		    } else if($locale=="fr_FR"){
		    	update_option( 'wp_sarbacane_nom_widget', 'Newsletter');
		    	update_option( 'wp_sarbacane_form_send',  'Envoyer');
		    	update_option('wp_sarbacane_text_widget', 'Inscription à notre newsletter');
		    	update_option('wp_sarbacane_before_envoi_label', "J'accepte les conditions générales du site");
		    } else {
		    	update_option( 'wp_sarbacane_nom_widget', 'Newsletter');
		    	update_option( 'wp_sarbacane_form_send',  'Send');
		    	update_option('wp_sarbacane_text_widget', 'Subscribe to our newsletter');
		    	update_option('wp_sarbacane_before_envoi_label', 'I accept the terms and conditions of the website');
		    }
		    update_option( 'wp_sarbacane', "email;@;");


		}
    }
}
if (class_exists("wp_sarbacane"))
{
    $inst_wp_sarbacane = new wp_sarbacane();
}
if (isset($inst_wp_sarbacane))  
{  
    add_action('wp_head', array(&$inst_wp_sarbacane, 'addHeaderCode'), 1);
    add_action('activate_wp_sarbacane/index.php',  array(&$inst_wp_sarbacane, 'init'));
    add_action('admin_menu', 'wp_sarbacane_ap');
    add_action('plugins_loaded', array(&$inst_wp_sarbacane, 'initWidget'));

    register_activation_hook(__FILE__, array(&$inst_wp_sarbacane, 'installPlug'));

	load_textdomain('wpsarbacane', get_template_directory().'/lang');

	add_action('init', array(&$inst_wp_sarbacane, 'liste_plugin_load_text_domain'));
}
if (!function_exists("wp_sarbacane_ap"))
{
    function wp_sarbacane_ap(){
        global $inst_wp_sarbacane;
        if (!isset($inst_wp_sarbacane)){
            return;
        }
        if (function_exists('add_menu_page'))   
        {
            add_menu_page('WP sarbacane', 'WP Sarbacane', 'administrator', 'wp_sarbacane', array(&$inst_wp_sarbacane, 'printAdminPage'), WP_PLUGIN_URL.'/sarbacane/img/favicon.png');
        }
    }
}
?>