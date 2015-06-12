<?php
/*
Plugin Name:       České komentáře
Plugin URI:        http://blog.doprofilu.cz
Description:       Plugin převede všechny řetězce, kde se nachází slovo komentář do správného pádu. v 1.1 Lze nastavit vlastní řetězce.
Version:           1.6
Author:            Petr Baloun
Author URI:        http://blog.doprofilu.cz
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:       ceske-komentare
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Load plugin's texdomain
function ceske_komentare_load_plugin_textdomain() {
    load_plugin_textdomain( 'ceske-komentare', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'ceske_komentare_load_plugin_textdomain' );

function ceske_komentare_activation_callback() {
    // Activation code here...
	add_option( 'pocet0', 'Žádný komentář', '', 'yes' );
	add_option( 'pocet1', '1 komentář', '', 'yes' );
	add_option( 'pocet2', '% komentáře', '', 'yes' );
	add_option( 'pocet5', '% komentářů', '', 'yes' );
}
register_activation_hook( __FILE__, 'ceske_komentare_activation_callback' );

function ceske_komentare_get_options() {
	return array(
	'pocet0' => get_option( 'pocet0' ),
	'pocet1' => get_option( 'pocet1' ),
	'pocet2' => get_option( 'pocet2' ),
	'pocet5' => get_option( 'pocet5' ),
	);
}

add_action( 'admin_menu', 'ceske_komentare_register_menu_page' );

function ceske_komentare_register_menu_page(){
    $page_title = esc_html__( 'Administrace', 'ceske-komentare' );
	$menu_title = esc_html__( 'České komentáře', 'ceske-komentare' );
    $capability = 'manage_options';
    $menu_slug = 'ceske_komentare';
    $function = 'ceske_komentare_menu_page';
    add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
}

function ceske_komentare_menu_page() {
	echo '<h1>' . esc_html__( 'Administrace', 'ceske-komentare' ) . '</h1>';
  	include('nastaveni.php');
}

function ceske_komentare( $output, $number ) {
	$options = ceske_komentare_get_options();
 
	$pocet0 = $options['pocet0'];
	$pocet1 = $options['pocet1'];
	$pocet2 = $options['pocet2'];
	$pocet5 = $options['pocet5'];
 
	if ( intval( $number ) === 0) {
		$output = $pocet0;
	} elseif ( intval( $number ) === 1 ) {
		$output = str_replace( '%', number_format_i18n( $number ), $pocet1 );
	} elseif ( intval( $number ) > 1  && intval( $number ) < 5 ) {
		$output = str_replace( '%', number_format_i18n( $number ), $pocet2 );
	} else {
		$output = str_replace( '%', number_format_i18n( $number ), $pocet5 );
	}
	return $output;
} 

add_action('comments_number', 'ceske_komentare', 10, 2);


function ceske_komentare_meta( $links, $file ) { // Add a link to this plugin's settings page
	static $this_plugin;
	if ( !$this_plugin ) { 
		$this_plugin = plugin_basename(__FILE__);
 	}
	if ( $file == $this_plugin ) {
		$settings_link_url = esc_url( admin_url( 'options-general.php?page=ceske_komentare') );
		$settings_link = '<a href="'.$settings_link_url.'">'.esc_html__( 'Nastavení', 'ceske-komentare' ).'</a>';	
		array_unshift( $links, $settings_link );
	}
	return $links; 
}

add_filter( 'plugin_row_meta', 'ceske_komentare_meta', 10, 2 );

?>