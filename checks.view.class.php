<?php

class views_Checkit
{
	static function checkit_view()
	{
		require_once _dir . '/list.table.class.php';
	    $ListTable = new checkit_ListTable();
	    $ListTable->prepare_items();

		include _dir . '/template/checkit.html';
	}

	static function checkit_panel()
	{
		global $wpdb; 
		$table_name = $wpdb->prefix . "checkit";
		$wpdb->show_errors = true;
		
		if(isset($_POST['new_position']))
		{
			$position_name 	= $_POST['posicion_name'];
			$position_check = (isset($_POST['posicion_check']) ? 1 : 0);
			$error = "";
			$ok = "";

			if($position_name != "")
			{
				$check_name = $wpdb->get_row("SELECT id FROM $table_name WHERE position = '".$position_name."'", ARRAY_A);

				if(count($check_name) <= 0)
				{
					$result = $wpdb->insert($table_name,
						array( 
							'position' => $position_name,
							'is_check' => $position_check
						),
						array( 
							'%s', 
							'%d' 
						)
					);

					if($result) $ok = "Check agregado correctamente.";
				}
				else
				{
					$error = "El nombre de este &laquo;Check&raquo; ya existe, intente con otro.";
				}
			}
			else
			{
				$error = "Debe ingresar un nombre. Si no selecciona &laquo;¿Está disponible?&raquo;, no estará disponible por defecto.";
			}
		}
		
		include _dir . '/template/panel.html';
	}

	static function checkit_get($_nameCheckit)
	{
		global $wpdb; 
		$table_name = $wpdb->prefix . "checkit";
		$wpdb->show_errors = true;

		$checkit = $wpdb->get_row("SELECT * FROM $table_name WHERE position = '".$_nameCheckit."'", ARRAY_A);

		if(count($checkit) > 0)
		{
			return (intval($checkit['is_check']) == 1 ? true : false);
		}
		else
		{
			return false;
		}
	}
}