<?php
include_once dirname(__DIR__, 1) . '/lib/WP_Incluyeme_Login_Countries.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$studies = new WP_Incluyeme_Login_Countries();
	if (isset($_GET["levels"])) {
		echo $studies->json_response(200, $studies::allLevels());
		return;
	}
	if (isset($_GET["idiomsAll"])) {
		echo $studies->json_response(200, $studies::allIdiomResume());
		return;
	}
	echo $studies->json_response(200, $studies::allIdioms());
	return;
}
return;
