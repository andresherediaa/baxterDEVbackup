<?php
# Database Configuration
define( 'DB_NAME', "baxter" );
define( 'DB_USER', "root" );
define( 'DB_PASSWORD', "" );
define( 'DB_HOST', "localhost" );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '0hOXzbw[WQ2q!xoP-Za1Npzao+30e~*sG?f%?9~q/|_c5DRirN@7{jYE-|1,e-5,');
define('SECURE_AUTH_KEY',  '<5I39W3*`p5]LZt3|K>JM[XUie@{+M+o/3$6T_Y]c_NvJ1>,jg`iOEim-o)te-P}');
define('LOGGED_IN_KEY',    '6#-fI=G)7|RiLf+(y.{,@9p>^+b3=57oEBi*ZzbB@=cLQF<ir[a-+RxuVq:peT.W');
define('NONCE_KEY',        'a4<iW?L~5FqE5gg.1W$lqn:p@9O0J|K+03m-:{t<YoBqf`-f,i,TU16+D0k5L4?.');
define('AUTH_SALT',        'nL@VuGd8G~$Y:rtKl^<Z`|8G&7r?jQsq-9qkQHpy!CPpmZo7kaWu]h2DOZwU27-L');
define('SECURE_AUTH_SALT', ',8lTxn!nj8?M9:^V##`8Lg._|K?=.@I+#PUYDeK00rCY1}3 P%(3?+&ge>t6r<LR');
define('LOGGED_IN_SALT',   'P-UF%_)#EkLID5qIeFh?t`HtO9(Lq%YLe6OEe)V2*qV9a( 3_#VR|F;;!A$5FC71');
define('NONCE_SALT',       'WH~~SlA8%h(OgwGE5C%ft7S9Wy:Ko. }8XDr~T,5>F Q7VBRJrO)|}ZkOI^wyUeW');


# Localized Language Stuff

define( 'WP_CACHE', true );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'baxterstdev' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', '6bee555c85a14e575c33024ebe6e1957260118cd' );

define( 'WPE_CLUSTER_ID', '100244' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'baxterstccny-dev' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_MODS', false );

define( 'DISALLOW_FILE_EDIT', false );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', false );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'baxterstdev.wpengine.com', 1 => 'baxterstdev.wpenginepowered.com', );

$wpe_varnish_servers=array ( 0 => 'pod-100244', );

$wpe_special_ips=array ( 0 => '104.196.163.46', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );

define( 'WPE_SFTP_ENDPOINT', '' );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
define( 'WP_SITEURL', 'http://localhost/baxter/' );
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
