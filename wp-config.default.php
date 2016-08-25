<?php
/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file. These can then be overridden in the environment config files.
 *
 * Please note if you add constants in this file (i.e. define statements)
 * these cannot be overridden in environment config files.
 *
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '%(pTZH5/GWM,qQ)>4hsi:;%ekyAE)kk[qsI;!T,nh$B13IWUPr0pT%c}(KGy*|5J');
define('SECURE_AUTH_KEY',  'ruz%f^,Y8+@|M`RXd:)28:Wv3bDg{3Gqn*pSmnS`>8$IYwf$|<KI)hy|X)<<Owqg');
define('LOGGED_IN_KEY',    '|h]J:|egbTNX()s[i;ieRe?Wl;4(|5`g|{V+qqU?8||u8H:-yTnW=X~d`G?f|.6O');
define('NONCE_KEY',        '9VagSl$@B?a`Y@,ML#Br j-3Z4-G~2@rW5m/)gvZO`qf6`++`M&-.~:_j;n2f~n2');
define('AUTH_SALT',        'tW3zP2|AuBr_fMfeu-K-@]cjYmZyQo`3J#Kv2KeAA]y^Z+M [f,@5h?svy-T]UR?');
define('SECURE_AUTH_SALT', 'n6jk4i0Hz8@{v@!v?rT|DF+D=T]@1)`]e_ZI{$/Z0NPt9iU)Xqt., |THHpsP>dt');
define('LOGGED_IN_SALT',   'N[{:;/WIL#+W|/oIYk` ?|%L&7O,WG5=)xd$=gs+5v+R93#v(qDY2%=Oh=5A+rp~');
define('NONCE_SALT',       'v,!+K&0%{ch.|q!^}o{uYw]]DdA|5?3{0-$|M65C!X&f.0q3!5P$==~t!sOm$;u6');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');
