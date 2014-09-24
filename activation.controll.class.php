<?php
class activation_Checkit
{
     static function install()
     {
		global $wpdb;
		$wpdb->show_errors = true;
		$charset_collate = '';

		if ( ! empty( $wpdb->charset ) ) {
		  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}

		if ( ! empty( $wpdb->collate ) ) {
		  $charset_collate .= " COLLATE {$wpdb->collate}";
		}
		$table_name= $wpdb->prefix . "checkit";

	    $sql = " CREATE TABLE $table_name(
			id INT NOT NULL AUTO_INCREMENT ,
			position VARCHAR(50) NOT NULL,
			is_check TINYINT(1) NOT NULL,
			PRIMARY KEY ( `id` )	
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
     }
     static function uninstall()
     {
     	global $wpdb;
		$wpdb->show_errors = true;
		$table_name = $wpdb->prefix . "checkit";
		$wpdb->query("DROP TABLE IF EXISTS $table_name");
     }
}