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
if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    //..
	update_option( 'pocet0', $_POST['pocet0']);
	update_option( 'pocet1', $_POST['pocet1']);
	update_option( 'pocet2', $_POST['pocet2']);
	update_option( 'pocet5', $_POST['pocet5']);
}
if ( ! isset( $_POST['updated'] ) )
		$_POST['updated'] = false;
if ( false !== $_POST['updated']) : ?>
		<div id="message" class="updated fade"><p><strong><?php _e( 'Nastavení uloženo' ); ?></strong></p></div>
	<?php endif; ?>
<div class="wrap">
<h2>České komentáře nastavení</h2>
<form action="" method="post">
<label class="left" for="pocet0"><b>Text při žádném komentáři</b>: </label><input type="text" id="pocet0" name="pocet0" value="<?php echo get_option('pocet0')?>"></br>
<label class="left" for="pocet1"><b>Text při 1 komentáři</b>:</label><input id="pocet1" type="text" name="pocet1" value="<?php echo get_option('pocet1')?>"></br>
<label class="left" for="pocet2"><b>Text při 2 - 4 komentářích</b>:</label><input id="pocet2" type="text" name="pocet2" value="<?php echo get_option('pocet2')?>"></br>
<label class="left" for="pocet5"><b>Text při více jak 4 komentáříh (5,6,...)</b>:</label><input id="pocet5" type="text" name="pocet5" value="<?php echo get_option('pocet5')?>"><br>
<input type="hidden" name="updated">
<b>Pozn: Je možné používat zástupný znak "%" pro dosazení aktuálního počtu komentářů</b>
<?php submit_button ('Uložit nastavení'); ?>
</form>
