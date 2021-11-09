<?php

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'avantseine');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b@(?^4}(# :[L$_75+ODY C_9C;>p+[( VTc_-=N3W>oU!N:-oU7e9~9H7},~$Gz');
define('SECURE_AUTH_KEY',  'KziTu..]G{wHE.JG|&;<]|m<U/4!Q/8Rg1j3;&gG9}L%FCD7P<A2-}cp*oO{^ ej');
define('LOGGED_IN_KEY',    'gsgZbU|2<35a]d|Q1.-K,~%m6o5|t*TEkTG5Qm2Gk_*/eR-W4;mem<bC$~Mx%J>[');
define('NONCE_KEY',        '.^&M+%+sB]}UMG;Z8&P~q0a</0%|/hWwsS+bqDqM ^$1dsJm8fO--tdn~-9+r(LV');
define('AUTH_SALT',        'f4!hvjoFwuF~eo}Gelxv!EbnQ]55~zM(xL${^+.=xo$?<l--1E![-Z4d8Nj.aeZ(');
define('SECURE_AUTH_SALT', 'sfgLi<5|2Xw8892d3+e}ni(nQ=+;-%?xc-]a]cEP$mBLt>tik6xXtfp3(LJ!Ux62');
define('LOGGED_IN_SALT',   '+-7>IBhi0,Ld.G$8ClxzBz&l?R?MIVA@udKM>f?-E^!@ypG&i5tX6B6e+Jh#[`<9');
define('NONCE_SALT',       'Slpx]q!B<[bl{(ye~q*hR+|=U$+zdmjF pw;7Dqak5pKh5/l8w]Q ]l)Ctd!~nFC');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'alglas_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if (!defined('ABSPATH'))
     define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
