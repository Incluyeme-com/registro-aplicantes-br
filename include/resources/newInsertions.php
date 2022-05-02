<?php
/*
 * Copyright (c) 2020
 *
 * Developer by Jesus Nuñez <jesus.nunez2050@gmail.com> .
 */


function newInsertions()
{
    global $wpdb;
    $row = $wpdb->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = {$wpdb->prefix}incluyeme_users_information AND column_name = 'meeting_incluyeme'");
    
    if (empty($row)) {
        $wpdb->query("alter table {$wpdb->prefix}incluyeme_users_information add meeting_incluyeme text null;");
    }
}
