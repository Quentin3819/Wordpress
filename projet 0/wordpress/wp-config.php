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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'NFxp(C8Kg$RDPf8aj^-#?GG%HFG>=;d)|Z~h6Y]N$[u{?~DkdrE9Z0!Spp|ukgG6' );
define( 'SECURE_AUTH_KEY',  'r&Y25N7Hy}3iA*{_FR#4pax%K^DKm|K~c@YZ<37g2~U!V691o`3m`R!2 @PzI`[&' );
define( 'LOGGED_IN_KEY',    '3r]2&Lad<u #;<UoJy^vcoxO=M)RZqM>CYgP&%ew&%KeJQ,%,z9z^3rBs<fRJ60;' );
define( 'NONCE_KEY',        ').rhZV=>0T2I*KCM~c~97<&3-aFz}cnWZ#;+&bo_ZHj)Vv?UzN 8:J`B+`m$l8tJ' );
define( 'AUTH_SALT',        ';%1M3wKaJTD6aXxh<}5nAaI7+4~icN@cE8/9Z +%yM.WG|d704d$a+:~VV0m_G]V' );
define( 'SECURE_AUTH_SALT', 'B6JMD=pH0hM_J;[c2.pKU{v%j!LOZ5gc.b q%Bv@Q%|s%B1=I/*a:GDh{Is4XMdQ' );
define( 'LOGGED_IN_SALT',   'lZ*5_AuZkb|T(oqmmZPi4o}VUR?jhU)df 02<IaHA,DWVBo;QFIWHH$}nNpa9 yo' );
define( 'NONCE_SALT',       '|;F>vj`?TX1/woHHT$7r7d9u8m$-<3zytl4EDl@_h4ea(},zr;eu~dbRTU)&KoK>' );
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
