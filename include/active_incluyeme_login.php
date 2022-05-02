<?php
/**
 * Copyright (c) 2020.
 * Jesus Nuñez <Jesus.nunez2050@gmail.com>
 */


function incluyeme_login_load()
{
    incluyeme_login_files();
    incluyeme_login_sql_Start();
    incluyeme_login_files1();
    incluyeme_login_files2();
    incluyeme_login_file_myHome();
    incluyeme_updateDatabase();
}

function incluyeme_login_files_research()
{
    incluyeme_login_files();
    incluyeme_login_files1();
    incluyeme_login_files2();
}

function incluyeme_login_files()
{
    $template = plugin_dir_path(__FILE__) . '/templates/resumes/register.php';
    $route = get_template_directory();
    if (!file_exists($route . '/wpjobboard/resumes/register.php')) {
        mkdir($route . '/wpjobboard');
        mkdir($route . '/wpjobboard/resumes');
        copy($template, $route . '/wpjobboard/resumes/register.php');
    } else {
        copy($template, $route . '/wpjobboard/resumes/register.php');
    }
}

function incluyeme_login_files1()
{
    $template = plugin_dir_path(__FILE__) . '/templates/resumes/resume.php';
    $route = get_template_directory();
    if (!file_exists($route . '/wpjobboard/resumes/resume.php')) {
        mkdir($route . '/wpjobboard');
        mkdir($route . '/wpjobboard/resumes');
        copy($template, $route . '/wpjobboard/resumes/resume.php');
    } else {
        $templateSize = filesize(plugin_dir_path(__FILE__) . '/templates/resumes/resume.php');
        $templateExist = filesize($route . '/wpjobboard/resumes/resume.php');
        if ($templateExist !== $templateSize) {
            copy($template, $route . '/wpjobboard/resumes/resume.php');
        }
    }
}

function incluyeme_login_files2()
{
    $template = plugin_dir_path(__FILE__) . '/templates/resumes/my-resume.php';
    $route = get_template_directory();
    if (!file_exists($route . '/wpjobboard/resumes/my-resume.php')) {
        mkdir($route . '/wpjobboard');
        mkdir($route . '/wpjobboard/resumes');
        copy($template, $route . '/wpjobboard/resumes/my-resume.php');
    } else {
        $templateSize = filesize(plugin_dir_path(__FILE__) . '/templates/resumes/my-resume.php');
        $templateExist = filesize($route . '/wpjobboard/resumes/my-resume.php');
        if ($templateExist !== $templateSize) {
            
            copy($template, $route . '/wpjobboard/resumes/my-resume.php');
        }
    }
}

function incluyeme_login_sql_Start()
{
    global $wpdb;
    $files = plugin_dir_path(__FILE__) . '/resources/';
    $created = $files . 'incluyeme_login.sql';
    $table_name = $wpdb->prefix . 'incluyeme_academies';
    $query = $wpdb->prepare('SHOW TABLES LIKE %s', $wpdb->esc_like($table_name));
    if (!$wpdb->get_var($query) == $table_name) {
        $queries = explode("; --", file_get_contents($created));
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $query = str_replace('{$wpdb->prefix}', $wpdb->prefix, $query);
                $query = str_replace('{$wpjb->prefix}', $wpdb->prefix, $query);
                $wpdb->query($query);
            }
        }
    }
}
function incluyeme_login_file_myHome()
{
    
    $template = plugin_dir_path(__FILE__) . '/templates/resumes/my-home.php';
    $route = get_template_directory();
    if (!file_exists($route . '/wpjobboard/resumes/my-home.php')) {
        mkdir($route . '/wpjobboard');
        mkdir($route . '/wpjobboard/resumes');
        copy($template, $route . '/wpjobboard/resumes/my-home.php');
    } else {
        $templateSize = filesize(plugin_dir_path(__FILE__) . '/templates/resumes/my-home.php');
        $templateExist = filesize($route . '/wpjobboard/resumes/my-home.php');
        if ($templateExist !== $templateSize) {
            
            copy($template, $route . '/wpjobboard/resumes/my-home.php');
        }
    }
}

function Update334()
{
    global $wpdb;
    $files = plugin_dir_path(__FILE__) . '/resources/';
    $created = $files . '3.3.4.sql';
    
    $table_name = $wpdb->prefix . 'incluyeme_cities';
    $queries = explode("; --", file_get_contents($created));
    foreach ($queries as $query) {
        $wpdb->show_errors();
        $query = trim($query);
        if (!empty($query)) {
            $query = str_replace('{$wpdb->prefix}', $wpdb->prefix, $query);
            $query = str_replace('{$wpjb->prefix}', $wpdb->prefix, $query);
            
            $wpdb->query($query);
            if($wpdb->last_error !== '') :
                $wpdb->print_error();
            endif;
        }
    }
    
}

function Update344()
{
    global $wpdb;
    $files = plugin_dir_path(__FILE__) . '/resources/';
    $created = $files . '3.4.4.sql';
    
    $table_name = $wpdb->prefix . 'incluyeme_cities';
    $queries = explode("; --", file_get_contents($created));
    foreach ($queries as $query) {
        $wpdb->show_errors();
        $query = trim($query);
        if (!empty($query)) {
            $query = str_replace('{$wpdb->prefix}', $wpdb->prefix, $query);
            $query = str_replace('{$wpjb->prefix}', $wpdb->prefix, $query);
            
            $wpdb->query($query);
            if($wpdb->last_error !== '') :
                $wpdb->print_error();
            endif;
        }
    }
    
}
