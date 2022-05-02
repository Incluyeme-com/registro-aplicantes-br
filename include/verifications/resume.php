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
		echo $verifications->json_response(200, $verifications::getUserInformation($_GET['user']));
		return;
	}
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$verifications = new WP_Incluyeme_Login_Countries();
	$_POST = json_decode(file_get_contents("php://input"), true);

	$verifications::setResumeID($_POST['userID']);
	if (isset($_POST['userID']) && $verifications::userSessionVerificate($verifications::getResumeID())) {
		if (isset($_POST['name']) && isset($_POST['lastName'])) {
			$name = sanitize_text_field($_POST['name']);
			$lastName = sanitize_text_field($_POST['lastName']);
			$verifications::updateNames($name, $lastName);
			
		}
		if (isset($_POST['userID']) && isset($_POST['country_edu'])) {
			
			$verifications::updateUsersEducation($_POST['dateStudieB'],
				$_POST['dateStudiesD'],
				$_POST['dateStudiesH'],
				$_POST['eduLevel'],
				$_POST['studies'],
				$_POST['titleEdu'],
				$_POST['university_edu'],
				$_POST['university_otro'], $_POST['country_edu'], $_POST['userID']);
			
		}
	
		if (isset($_POST['userID']) && isset($_POST['areaEmployed'])) {
			$verifications::updateUsersWorks($_POST['actuWork'],
				$_POST['areaEmployed'],
				$_POST['dateStudiesDLaboral'],
				$_POST['dateStudiesHLabor'],
				$_POST['employed'],
				$_POST['jobs'],
				$_POST['jobsDescript'],
				$_POST['levelExperience'],
				$_POST['jobsSalario'],
				$_POST['userID']);
		}
		
	
		if (isset($_POST['userID']) && isset($_POST['genre'])) {
			$verifications::updateUsersInformation($_POST['city'],
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
                $_POST['phone'],
				$_POST['meetingIncluyeme']);
			
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
					$_POST['aImplante'], $_POST['aImplanteText'], $_POST['aOral'],$_POST['aFluida'],  $_POST['userID']);
			}
			if (isset($_POST['userID']) && isset($_POST['visual'])) {
				$verifications::updateVisual($_POST['userID'],
					$_POST['vLejos'],
					$_POST['vObservar'],
					$_POST['vColores'],
					$_POST['vDPlanos'],
					$_POST['vTecniA'],
					$_POST['vTecniAvText']
				);
				
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
		}
		if (isset($_POST['userID']) && isset($_POST['idioms'])) {
			$verifications::updateIdioms($_POST['userID'], $_POST['idioms'], $_POST['oLevel'], $_POST['wLevel'], $_POST['sLevel'], $_POST['idiomsOther']);
		}
		if (isset($_POST['userID']) && isset($_POST['preferJobs'])) {
			$verifications::updatePrefersJobs($_POST['userID'], $_POST['preferJobs']);
		}
		if (isset($_POST['userID']) && isset($_POST['preferJobs'])) {
			$verifications::updatePrefersJobs($_POST['userID'], $_POST['preferJobs']);
		}
		echo $verifications->json_response(200, 'COMPLETADO');
	}
}
return;
