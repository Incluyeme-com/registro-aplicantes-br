<?php
/**
 * Copyright (c) 2020.
 * Jesus Nuñez <Jesus.nunez2050@gmail.com>
 */
require_once plugin_dir_path(__FILE__) . 'admins/incluyeme_login_adminPage.php';
require_once plugin_dir_path(__FILE__) . 'admins/incluyeme_login_configuration.php';
add_action('admin_menu', 'incluyeme_login_menus');
add_action('admin_enqueue_scripts', 'incluyeme_login_styles');
function incluyeme_login_menus()
{
	add_menu_page(
		'Incluyeme - Login',
		'Incluyeme - Login',
		'manage_options',
		'incluyemelogin',
		'incluyeme_login_adminPage'
	);
	
	add_submenu_page('incluyemelogin',
		'Configuracion de Campos',
		'Configuracion de Campos',
		'manage_options',
		'inclueyemeLoginConfiguration',
		'incluyeme_login_configuration'
	);
}
