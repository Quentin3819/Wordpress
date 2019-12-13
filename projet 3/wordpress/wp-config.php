<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'projet3' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'quentin01' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'yTKg8.hH*i)GClC.8DJt(*h/Fw28w56l;FSW%Jj]Y;p.AX.}Q2q CFB{`&lp `]{' );
define( 'SECURE_AUTH_KEY',  '~ZS)*k(z*4b^Lr<dm2YwCn~ziU2})_?.B?`G/<B6B!6;U|3qwi:(|-2[m5 9I=d9' );
define( 'LOGGED_IN_KEY',    'Y#JO~7W!r*uI(C^g6ID>H*NRsb}hI<4^<R)e`n!qP8X{.`jzt>?RJI4qdjg74^_3' );
define( 'NONCE_KEY',        'k>204|KxP|b<+G|z%:*_EZUow/.O/[u_<>^521k!oTkKGh=Ss&_WN6O_W2vYd-Zq' );
define( 'AUTH_SALT',        'pzT:{itO}vU5_f>T%:DO4Su{)CzG2-T@e,;XY2Zj6KP#208, aQ(+&}Qvo9]5VD4' );
define( 'SECURE_AUTH_SALT', 'z8e(z$2p:.)x-,Y?/m1u!we=<zDQ Z7#N3i&{+=lh}QLv6D?lMz2zbHX1`+_$J(!' );
define( 'LOGGED_IN_SALT',   ';jJs(GGZ[R#7XKl~)#<=E6>T}b{2(N$Abo,[.;SJ>;3#f22RaZkKdWGM)AT}VRUD' );
define( 'NONCE_SALT',       'W1PJCov=[+IR%%]lTn1X2yY8o8B5I#*pw&+RdOJ5]!#Aw3N87x%|Wrl-|{c2N@[o' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
