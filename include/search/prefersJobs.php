<?php
/**
 * Copyright (c)
 *
 * Developer by Jesus Nuñez <jesus.nunez2050@gmail.com> 2020.
 */


include_once dirname(__DIR__, 1) . '/lib/WP_Incluyeme_Login_Countries.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$studies = new WP_Incluyeme_Login_Countries();
	echo $studies->json_response(200, $studies::allPrefersJobs());
	return;
}
return;
