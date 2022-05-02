<?php
/**
 * Copyright (c) 2020
 *
 * Developer by Jesus Nuñez <jesus.nunez2050@gmail.com> .
 */

include_once dirname(__DIR__, 1) . '/lib/WP_Incluyeme_Login_Countries.php';
header('Content-type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$verifications = new WP_Incluyeme_Login_Countries();
	if (isset($_GET['user'])) {
		echo $verifications->json_response(200, $verifications::getUser($_GET['user']));
		return;
	}
}
