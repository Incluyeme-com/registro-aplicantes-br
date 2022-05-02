<?php

include_once dirname(__DIR__, 1) . '/lib/WP_Incluyeme_Login_Countries.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$studies = new WP_Incluyeme_Login_Countries();
	echo $studies->json_response(200, $studies::allExpedienciesAreas());
	return;
}
return;