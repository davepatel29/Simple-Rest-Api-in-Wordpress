<?php

/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.

 * @link       http://digitalwebinfosoft.com
 * @since      1.0.0
 *
 * @author  :           Dave Patel
 * @author Skype :      dave.dwis
 * @author Email :      dave.dwis@gmail.com
 */

class Activator {

	/**
	 * Short Description.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$min_php = '5.6.0';

		global $wpdb;

		$table_db_name = $wpdb->prefix . 'access_tokens';

		if($wpdb->get_var("show tables like '$table_db_name'") != $table_db_name) 
		{
			$sql = "CREATE TABLE " . $table_db_name . " (
				  id int(10) UNSIGNED NOT NULL,
				  userId int(11) NOT NULL,
				  deviceToken text COLLATE utf8mb4_unicode_ci,
				  deviceId text COLLATE utf8mb4_unicode_ci,
				  deviceType int(4) DEFAULT NULL,
				  accessToken varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
				  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				  PRIMARY KEY (id)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}

		// Check PHP Version and deactivate & die if it doesn't meet minimum requirements.
		if ( version_compare( PHP_VERSION, $min_php, '<' ) ) {
					deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die( 'This plugin requires a minmum PHP Version of ' . $min_php );
		}

	}

}
