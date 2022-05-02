<?php
include_once dirname(__DIR__, 1) . '/lib/WP_Incluyeme_Login_Countries.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$countries = new WP_Incluyeme_Login_Countries();
	if ($_GET["countries"] == 'all' && isset($_GET["countries"])) {
		echo $countries->json_response(200, $countries::allCountries());
		return;
	}
	if (isset($_GET["countries"])) {
		$countries::setCountry($_GET["countries"]);
		echo $countries->json_response(200, $countries::getUniversities());
		return;
	}
	if (isset($_GET["provincias"]) && $_GET['provincias'] === 'CVC') {
		echo $countries->json_response(200, $countries::getProvincias());
		return;
	}
	if (isset($_GET["city"])) {
		echo $countries->json_response(200, $countries::getCities($_GET["city"]));
		return;
	}
}
return;
