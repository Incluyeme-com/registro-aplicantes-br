<?php
include_once dirname(__DIR__, 1) . '/lib/WP_Incluyeme_Login_Countries.php';
header('Content-type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$verifications = new WP_Incluyeme_Login_Countries();
	if (isset($_POST['userID']) && isset($_POST['removeIMG'])) {
		$verifications::deleteIMG($_POST['userID'], 1);
	}
	if (isset($_POST['googleID'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$lastName = $_POST['lastName'];
		$response = $verifications::searchUserExistSocial($email, $password, $name, $lastName, $_POST['google'], $_POST['facebook'], $_POST['linkedin']);
		return;
	}
    if (isset($_POST['linkedin'])) {
	    $verifications::loginLink();
	  // return;
	}
	if (isset($_POST['userID']) && isset($_POST['removeCUD'])) {
		$verifications::deleteIMG($_POST['userID'], 3);
	}
	if (isset($_POST['userID']) && isset($_POST['RemoveCV'])) {
		$verifications::deleteIMG($_POST['userID'], 2);
	}
	if (isset($_POST['userID']) && !empty($_FILES)) {
		
		if (isset($_POST['userID']) && isset($_FILES['img_path']) && !$_FILES['img_path']['error']) {
			$verifications::updateIMG($_POST['userID'], $_FILES['img_path']);
		}
		if (isset($_POST['userID']) && isset($_FILES['cud']) && !$_FILES['cud']['error']) {
			$verifications::updateCUD($_POST['userID'], $_FILES['cud']);
		}
		if (isset($_POST['userID']) && isset($_FILES['cv']) && !$_FILES['cv']['error']) {
			$verifications::updateCV($_POST['userID'], $_FILES['cv']);
		}
		return;
	}
	if ((isset($_POST['google']) || isset($_POST['facebook']) || isset($_POST['linkedin'])) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['lastName'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$lastName = $_POST['lastName'];
		$response = $verifications::searchUserExistSocial($email, $password, $name, $lastName, $_POST['google'], $_POST['facebook'], $_POST['linkedin']);
		echo $verifications->json_response(200, $response);
		return;
	}
	$_POST = json_decode(file_get_contents("php://input"), true);
	if (isset($_POST['email']) && isset($_POST['password']) && !isset($_POST['name']) && !isset($_POST['lastName'])) {
		$email = sanitize_email($_POST['email']);
		$password = $_POST['password'];
		echo $verifications->json_response(200, $verifications::searchUserExist($email, $password));
		return;
	}
	
	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['lastName']) && isset($_POST['haveDiscap'])) {
		$email = sanitize_email($_POST['email']);
		$password = sanitize_email($_POST['password']);
		$name = sanitize_text_field($_POST['name']);
		$lastName = sanitize_text_field($_POST['lastName']);
		$haveDiscap = $_POST['haveDiscap'];
		$response = $verifications::registerUser($email, $password, $name, $lastName,false, $haveDiscap);
		
		echo $verifications->json_response(200, $response);
		return;
	}
	if (isset($_POST['userID']) && isset($_POST['country_edu'])) {
		
		echo $verifications->json_response(200, $verifications::updateUsersEducation($_POST['dateStudieB'],
			$_POST['dateStudiesD'],
			$_POST['dateStudiesH'],
			$_POST['eduLevel'],
			$_POST['studies'],
			$_POST['titleEdu'],
			$_POST['university_edu'],
			$_POST['university_otro'], $_POST['country_edu'], $_POST['userID']));
		return;
	}
	if (isset($_POST['userID']) && isset($_POST['areaEmployed'])) {
		echo $verifications->json_response(200, $verifications::updateUsersWorks($_POST['actuWork'],
			$_POST['areaEmployed'],
			$_POST['dateStudiesDLaboral'],
			$_POST['dateStudiesHLaboral'],
			$_POST['employed'],
			$_POST['jobs'],
			$_POST['jobsDescript'],
			$_POST['levelExperience'],
			$_POST['jobsSalario'],
			$_POST['userID']));
		return;
	}
	if (isset($_POST['genre'])) {
		echo $verifications->json_response(200, $verifications::updateUsersInformation($_POST['city'],
			$_POST['dateBirthDay'],
			$_POST['fPhone'],
			$_POST['fiPhone'],
			$_POST['genre'],
			$_POST['mPhone'],
			$_POST['state'],
			$_POST['street'],
			$_POST['cep'],
			$_POST['numero'],
			$_POST['bairro'],
			$_POST['phone']));
		return;
	}
	if (isset($_POST['userID']) && isset($_POST['discaps']) && isset($_POST['moreDis'])) {
		$verifications::updateDiscapacidades($_POST['userID'], $_POST['discaps'], $_POST['moreDis']);
		if (isset($_POST['userID']) && isset($_POST['fisica'])) {
			$verifications::updateMotriz($_POST['userID'], $_POST['mPie'],
				$_POST['mSen'],
				$_POST['mEsca'],
				$_POST['mBrazo'],
				$_POST['peso'],
				$_POST['mRueda'],
				$_POST['desplazarte'],
				$_POST['mDigi']);
		}
		if (isset($_POST['userID']) && isset($_POST['auditiva'])) {
			$verifications::updateAuditiva($_POST['aAmbient'],
				$_POST['aSennas'],
				$_POST['aLabial'],
				$_POST['aBajo'],
				$_POST['aImplante'], $_POST['aImplanteText'], $_POST['aOral'], $_POST['aFluida'], $_POST['userID']);
		}
		if (isset($_POST['userID']) && isset($_POST['visual'])) {
			$verifications::updateVisual($_POST['userID'],
				$_POST['vLejos'],
				$_POST['vObservar'],
				$_POST['vColores'],
				$_POST['vDPlanos'],
				$_POST['vTecniA'],
				$_POST['vTecniAvText']);
			
		}
		if (isset($_POST['userID']) && isset($_POST['multipla'])) {
			$verifications::updateVisceral($_POST['userID'],
				$_POST['vHumedos'],
				$_POST['vTemp'],
				$_POST['vPolvo'],
				$_POST['vCompleta'],
				$_POST['vAdap'],
			    $_POST['vAdapText']);
		}
		if (isset($_POST['userID']) && isset($_POST['intelectual'])) {
			$verifications::updateIntelectual($_POST['userID'],
				$_POST['inteEscri'],
				$_POST['inteTransla'],
				$_POST['inteTarea'],
				$_POST['inteActividad'],
				$_POST['inteMolesto'],
				$_POST['inteTrabajar'],
				$_POST['inteTrabajarSolo']);
		}
		echo $verifications->json_response(200, 'COMPLETADO');
		return;
	}
	
	if (isset($_POST['userID']) && isset($_POST['idioms'])) {
		$verifications::updateIdioms($_POST['userID'], $_POST['idioms'], $_POST['oLevel'], $_POST['wLevel'], $_POST['sLevel'], $_POST['idiomsOther']);
		echo $verifications->json_response(200, 'COMPLETADO');
		return;
	}
	if (isset($_POST['userID']) && isset($_POST['preferJobs'])) {
		$verifications::updatePrefersJobs($_POST['userID'], $_POST['preferJobs']);
		echo $verifications->json_response(200, 'COMPLETADO');
		return;
	}
	if (isset($_POST['userID']) && isset($_POST['meetingIncluyeme'])) {
		$verifications::meetingIncluyeme($_POST['userID'], $_POST['meetingIncluyeme']);
		echo $verifications->json_response(200, 'COMPLETADO');
		return;
	}
//	echo $verifications->json_response(200, 'COMPLETADO');
}
return;
