<?php

/*
Plugin Name: Incluyeme Login Extension
Plugin URI: https://github.com/Cro22
Description: Extension de funciones (Registro) para el Plugin WPJob Board
Author: Jesus Nuñez
Version: 3.4.9
Author URI: https://github.com/Cro22
Text Domain: incluyeme-login-extension
Domain Path: /languages
*/

defined('ABSPATH') or exit;
require_once plugin_dir_path(__FILE__) . 'include/active_incluyeme_login.php';
require_once plugin_dir_path(__FILE__) . 'include/menus/incluyeme_login_menu.php';
require_once plugin_dir_path(__FILE__) . 'include/resources/newInsertions.php';
add_action('admin_init', 'incluyeme_requirements_Login_Extension');
add_action('plugins_loaded', 'incluyemeLogin_loaderCheck');
add_action('plugins_loaded', 'incluyeme_loadResume');
add_action('plugins_loaded', 'incluyeme_loadMyResume');
function plugin_name_i18n_incluyeme_login()
{
    load_plugin_textdomain('plugin-name', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

add_action('plugins_loaded', 'plugin_name_i18n_incluyeme_login');

function incluyeme_requirements_Login_Extension()
{
    if (is_admin() && current_user_can('activate_plugins') && !is_plugin_active('wpjobboard/index.php')) {
        add_action('admin_notices', 'incluyemeLogin_notice');
        deactivate_plugins(plugin_basename(__FILE__));
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    }
    if (is_admin() && current_user_can('activate_plugins') && is_plugin_active('wpjobboard/index.php')) {
        incluyeme_login_load();
    }
}

function incluyemeLogin_notice()
{
    ?>
	<div class="error"><p> <?php echo __('Sorry, but Incluyeme plugin requires the WPJob Board plugin to be installed and
	                      active.', 'incluyeme'); ?> </p></div>
    <?php
}

function incluyemeLogin_loaderCheck()
{
    $version = '3.4.2';
    $check = strcmp(get_option('incluyemeLoginVersion'), $version);
    if ($check !== 0) {
        $template = plugin_dir_path(__FILE__) . '/include/templates/resumes/register.php';
        $route = get_template_directory();
        if (!file_exists($route . '/wpjobboard/resumes/register.php')) {
            mkdir($route . '/wpjobboard');
            mkdir($route . '/wpjobboard/resumes');
            copy($template, $route . '/wpjobboard/resumes/register.php');
        } else {
            copy($template, $route . '/wpjobboard/resumes/register.php');
        }
    }
    
}

function incluyeme_loadResume()
{
    $version = '3.4.9';
    $check = strcmp(get_option('incluyeme_loadResume'), $version);
    if ($check !== 0) {
        $template = plugin_dir_path(__FILE__) . '/include/templates/resumes/resume.php';
        $route = get_template_directory();
        if (!file_exists($route . '/wpjobboard/resumes/resume.php')) {
            mkdir($route . '/wpjobboard');
            mkdir($route . '/wpjobboard/resumes');
            copy($template, $route . '/wpjobboard/resumes/resume.php');
        } else {
            copy($template, $route . '/wpjobboard/resumes/resume.php');
        }
        update_option('incluyeme_loadResume', $version);
    }
}

function incluyeme_loadMyResume()
{
    $version = '3.4.9';
    $check = strcmp(get_option('loadResumeMy'), $version);
    if ($check !== 0) {
        $template = plugin_dir_path(__FILE__) . '/include/templates/resumes/my-resume.php';
        $route = get_template_directory();
        if (!file_exists($route . '/wpjobboard/resumes/my-resume.php')) {
            mkdir($route . '/wpjobboard');
            mkdir($route . '/wpjobboard/resumes');
            copy($template, $route . '/wpjobboard/resumes/my-resume.php');
        } else {
            copy($template, $route . '/wpjobboard/resumes/my-resume.php');
        }
        update_option('loadResumeMy', $version);
    }
    
}

function incluyeme_MyHome()
{
    $version = '3.4.2';
    $check = strcmp(get_option('loadMyHome'), $version);
    if ($check !== 0) {
        $template = plugin_dir_path(__FILE__) . '/include/templates/resumes/my-home.php';
        $route = get_template_directory();
        if (!file_exists($route . '/wpjobboard/resumes/my-home.php')) {
            mkdir($route . '/wpjobboard');
            mkdir($route . '/wpjobboard/resumes');
            copy($template, $route . '/wpjobboard/resumes/my-home.php');
        } else {
            copy($template, $route . '/wpjobboard/resumes/my-home.php');
        }
        update_option('loadMyHome', $version);
    }
    
}

function incluyeme_updateDatabase()
{
    $version = '3.4.6';
    $check = strcmp(get_option('IncluyemeDataBaseUpdate'), $version);
    if ($check !== 0) {
        Update344();
    }
    update_option('IncluyemeDataBaseUpdate', $version);
    
}

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/Incluyeme-com/registro-aplicantes-br',
    __FILE__,
    'incluyeme-login-applicants'
);
