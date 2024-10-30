<?php
/*
 Plugin Name: LovedBy.Pro
 Plugin URI: http://lovedby.pro
 Description: LovedBy.Pro is the easiest way to monetize the links on your site. You can link directly to other sites as you do today. Loved.by Pro affiliates those links for you. 
 Author: LovedBy.Pro
 Version: 1.2
 Author URI: http://lovedby.pro
 */


define ("LOVEDBY_VERSION", "1.2");
define ("INVALID_API_KEY_ERROR", "INVALID_API_KEY");
define ("UNKNOWN_CLIENT_ERROR" ,"UNKNOWN_CLIENT");
define ("UNKNOWN_ACTION" , "UNKNOWN_ACTION");


if (!class_exists('LovedByPro')) {
	class LovedByPro	{

		var $version;
		var $api_key;
	
			
		/**
		 * PHP 4 Compatible Constructor
		 */
		function LovedByPro(){$this->__construct();}

		/**
		 * PHP 5 Constructor
		 */
		function __construct(){

			$this->version = LOVEDBY_VERSION;
			$this->api_key = get_option('lovedby_api_key');

			if(is_admin()){
				add_action('admin_menu', array(& $this, 'admin_menu'));	
			}
			
			add_action( "wp_footer", array(& $this, 'lovedby_plugin') );

		}

		function admin_menu(){
			//global $menu, $submenu;
			add_submenu_page('options-general.php', 'Loved.by Pro', 'Loved.by Pro', 8, 'lovedby_settings', array(& $this, 'admin_menu_template'));
		}

		function admin_menu_template() {
			include("lovedby_settings.php");
		}

	
		// adds the Loved.by Javascript to the footer
		function lovedby_plugin() {
			$api_key = get_option('lovedby_api_key');
			if( $api_key ) {
			?>
		  	<script type="text/javascript">
				
				try {
				var lvdby_conf = {'apiKey' : '<?php print ( $api_key ); ?>'};
				var isSSL = ('https:' == document.location.protocol);
				var scriptProto = isSSL ? 'https://' : 'http://'; 
				document.write(unescape("%3Cscript src='"+scriptProto+"api.loved.by/v1/js?api_key=<?php print ( $api_key ); ?>' type='text/javascript'%3E%3C/script%3E"));
				} catch(err) {}

			  </script>
			<?php
		  	}
		}

	}
}

//instantiate the class
if (class_exists('LovedByPro')) {
	$LovedByPro = new LovedByPro();
}

?>
