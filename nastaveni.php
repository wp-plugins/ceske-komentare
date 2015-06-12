<style>
label {
  width:  230px;
}

.left {
  position:  relative;
  display:  block;
  float:  left;
}
</style>
<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
	if ( 
		true === current_user_can( 'manage_options' ) //only administrators can update strings
		&& false !== wp_verify_nonce( $_POST['_wpnonce'], 'ceske-komentare-update' ) //nonces verify intention
	) {	
		update_option( 'pocet0', sanitize_text_field( $_POST['pocet0'] ) );
		update_option( 'pocet1', sanitize_text_field( $_POST['pocet1'] ) );
		update_option( 'pocet2', sanitize_text_field( $_POST['pocet2'] ) );
		update_option( 'pocet5', sanitize_text_field( $_POST['pocet5'] ) );
		$updated = true;
	}
}
if ( true === isset( $updated ) && true === $updated ) : ?>
	<div id="message" class="updated fade"><p><strong><?php esc_html_e( 'Nastavení uloženo', 'ceske-komentare' ); ?></strong></p></div>
<?php endif; ?>

<div class="wrap">
<h2><?php esc_html_e( 'České komentáře nastavení', 'ceske-komentare' ); ?></h2>
<form action="<?php echo esc_url( admin_url( 'options-general.php?page=ceske_komentare' ) ); ?>" method="post">
<label class="left" for="pocet0"><b><?php esc_html_e( 'Text při žádném komentáři', 'ceske-komentare' ); ?></b>: </label><input type="text" id="pocet0" name="pocet0" value="<?php echo esc_attr( get_option('pocet0' ) ); ?>"></br>
<label class="left" for="pocet1"><b><?php esc_html_e( 'Text při 1 komentáři', 'ceske-komentare' ); ?></b>:</label><input id="pocet1" type="text" name="pocet1" value="<?php echo esc_attr( get_option('pocet1') ); ?>"></br>
<label class="left" for="pocet2"><b><?php esc_html_e( 'Text při 2 - 4 komentářích', 'ceske-komentare' ); ?></b>:</label><input id="pocet2" type="text" name="pocet2" value="<?php echo esc_attr( get_option('pocet2') ); ?>"></br>
<label class="left" for="pocet5"><b><?php esc_html_e( 'Text při více jak 4 komentářích (5,6,...)', 'ceske-komentare' ); ?></b>:</label><input id="pocet5" type="text" name="pocet5" value="<?php echo esc_attr( get_option('pocet5') ); ?>"><br>
<b><?php esc_html_e( 'Pozn: Je možné používat zástupný znak "%" pro dosazení aktuálního počtu komentářů', 'ceske-komentare' ); ?></b>
<?php 
	wp_nonce_field( 'ceske-komentare-update' );
	submit_button ( esc_html__( 'Uložit nastavení', 'ceske-komentare' ) );
	?>
