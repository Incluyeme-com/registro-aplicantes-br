<?php
/**
 * Copyright (c) 2020.
 * Jesus Nuñez <Jesus.nunez2050@gmail.com>
 */
function getCountrys()
{
	global $wpdb;
	return $wpdb->get_results("
    SELECT *
    FROM  ".$wpdb->prefix."incluyeme_countries");
	
}

function incluyeme_login_adminPage()
{
	$incluyemeLoginFB = 'incluyemeLoginFB';
	$incluyemeLoginGoogle = 'incluyemeLoginGoogle';
	$incluyemeLoginCountry = 'incluyemeLoginCountry';
	$incluyemeLoginEstado = 'incluyemeLoginEstado';
	$incluyemeLoginFBSECRET = 'incluyemeLoginFBSECRET';
    $defaultCheckTerminos = 'defaultCheckTerminos';
	if (isset($_POST['incluyemeLoginFB'])) {
		$value = $_POST['incluyemeLoginFB'];
		update_option($incluyemeLoginFB, sanitize_text_field($value));
		update_option($incluyemeLoginFB, sanitize_text_field($value));
	}
	if (isset($_POST['incluyemeLoginGoogle'])) {
		$value = $_POST['incluyemeLoginGoogle'];
		update_option($incluyemeLoginGoogle, sanitize_text_field($value));
		update_option($incluyemeLoginGoogle, sanitize_text_field($value));
	}
	if (isset($_POST['incluyemeLoginCountry'])) {
		$value = $_POST['incluyemeLoginCountry'];
		update_option($incluyemeLoginCountry, sanitize_text_field($value));
		update_option($incluyemeLoginCountry, sanitize_text_field($value));
	}
	if (isset($_POST['incluyemeLoginEstado'])) {
		$value = $_POST['incluyemeLoginEstado'];
		update_option($incluyemeLoginEstado, sanitize_text_field($value));
		update_option($incluyemeLoginEstado, sanitize_text_field($value));
	}
	if (isset($_POST['incluyemeLoginFBSECRET'])) {
		$value = $_POST['incluyemeLoginFBSECRET'];
		update_option($incluyemeLoginFBSECRET, sanitize_text_field($value));
		update_option($incluyemeLoginFBSECRET, sanitize_text_field($value));
	}
	if (isset($_POST['defaultCheckTerminos'])) {
		$value = $_POST['defaultCheckTerminos'];
		update_option($defaultCheckTerminos, sanitize_text_field($value));
		update_option($defaultCheckTerminos, sanitize_text_field($value));
	}
	if (isset($_POST['deleteIncluyeme'])) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$query = "DELETE
  FROM " . $prefix . "incluyeme_users_dicapselect
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume);";
		$wpdb->query($query);
		$query = "	DELETE
  FROM " . $prefix . "incluyeme_users_idioms
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume); ";
		$wpdb->query($query);
		$query = "  DELETE
  FROM " . $prefix . "incluyeme_users_information
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume); ";
		$wpdb->query($query);
		$query = " DELETE
  FROM " . $prefix . "incluyeme_users_questions
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume);";
		$wpdb->query($query);
	}
	?>
	<div class="container">
		<div class="card">
			<div class="card-title">
				<h5>Configuración General</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col">
						<form method="POST">
							<div class="row">
								<div class="col-12">
									<label for="incluyemeLoginGoogle"><b><?php _e("Ingrese el ID de su aplicacion Google", "wpjobboard"); ?></b></label>
									<input type="text"
									       class="form-control"
									       id="incluyemeLoginGoogle"
									       name="incluyemeLoginGoogle"
									       value="<?php echo get_option($incluyemeLoginGoogle) ? get_option($incluyemeLoginGoogle) : ''; ?>"
									       placeholder="<?php _e("Google ID", "wpjobboard"); ?>">
									
									<span class="mt-2"></span>
								</div>
								<div class="col-12 mt-2">
									<label for="incluyemeLoginFB"><b><?php _e("Ingrese el ID de su aplicacion Facebook", "wpjobboard"); ?></b></label>
									<input type="text"
									       class="form-control"
									       id="incluyemeLoginFB"
									       name="incluyemeLoginFB"
									       value="<?php echo get_option($incluyemeLoginFB) ? get_option($incluyemeLoginFB) : ''; ?>"
									       placeholder="<?php _e("Facebook ID", "wpjobboard"); ?>">
								</div>
								<div class="col-12 mt-2">
									<label for="incluyemeLoginFB"><b><?php _e("Ingrese la clave secreta de su aplicacion Facebook", "wpjobboard"); ?></b></label>
									<input type="text"
									       class="form-control"
									       id="incluyemeLoginFBSECRET"
									       name="incluyemeLoginFBSECRET"
									       value="<?php echo get_option($incluyemeLoginFBSECRET) ? get_option($incluyemeLoginFBSECRET) : ''; ?>"
									       placeholder="<?php _e("Facebook Secret Key", "wpjobboard"); ?>">
								</div>
								<div class="col-12 mt-2">
									<label for="incluyemeLoginCountry"><b><?php _e("Pais", "wpjobboard"); ?></b></label>
									<select type="text"
									        class="form-control"
									        id="incluyemeLoginCountry"
									        name="incluyemeLoginCountry">
										<?php $country = getCountrys();
										foreach ($country as $country) {
											?>
											<option <?php  echo get_option($incluyemeLoginCountry) === $country->country_code ?  'selected' : '';  ?> value="<?php echo $country->country_code ?>"><?php echo $country->country_name ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-12 mt-2">
									<label for="incluyemeLoginEstado"><b><?php _e("Provincia o Estado", "wpjobboard"); ?></b></label>
									<select type="text"
									        class="form-control"
									        id="incluyemeLoginEstado"
									        name="incluyemeLoginEstado">
										<option <?php echo get_option($incluyemeLoginEstado) === 'Estado' ? 'selected' : '' ?>
												value="Estado"> Estado
										</option>
										<option <?php echo get_option($incluyemeLoginEstado) === 'Provincia' ? 'selected' : '' ?>
												value="Provincia"> Provincia
										</option>
										<option <?php echo get_option($incluyemeLoginEstado) === 'Departamento' ? 'selected' : '' ?>
												value="Departamento"> Departamento
										</option>
										<option <?php echo get_option($incluyemeLoginEstado) === 'Región' ? 'selected' : '' ?>
												value="Región"> Regiones
										</option>
									
									</select>
								</div>
								<div class="col-12 mt-2">
									<label for="defaultCheckTerminos"><b><?php _e("Ingrese la URL para los terminos y condiciones de Incluyeme", "wpjobboard"); ?></b></label>
									<input type="text"
									       class="form-control"
									       id="defaultCheckTerminos"
									       name="defaultCheckTerminos"
									       value="<?php echo get_option($defaultCheckTerminos) ? get_option($defaultCheckTerminos) : ''; ?>"
									       placeholder="<?php _e("https://incluyeme.com/terminos", "wpjobboard"); ?>">
								</div>
							
							</div>
							<div class="text-right mt-2">
								<button type="submit"
								        class="btn btn-info"><?php _e("Guardar", "wpjobboard"); ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col">
						<form method="POST">
							<input style="display: none" type="text"
							       class="form-control"
							       id="deleteIncluyeme"
							       name="deleteIncluyeme"
							       value="<?php echo get_option($incluyemeLoginCountry) ? get_option($incluyemeLoginCountry) : ''; ?>"
							       placeholder="<?php _e("Field Name.", "wpjobboard"); ?>">
							<div class="text-right mt-2">
								<button type="submit"
								        class="btn btn-danger"><?php _e("Eliminar Datos Inconsistentes", "wpjobboard"); ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function incluyeme_login_styles($hook)
{
	$current_screen = get_current_screen();
	if (!strpos($current_screen->base, 'incluyemelogin') && !strpos($current_screen->base, 'inclueyemeLoginConfiguration')) {
		return;
	} else {
		$css = plugins_url() . '/incluyeme-login-extension/include/assets/css/';
		wp_register_style('bootstrap-admin', $css . 'bootstrap.min.css', [], '1.0.0', false);
		wp_enqueue_style('bootstrap-admin');
	}
}

function incluyemeSave_Login_Options()
{

	$incluyemeLoginFB = 'incluyemeLoginFB';
	$incluyemeLoginGoogle = 'incluyemeLoginGoogle';
	$incluyemeLoginCountry = 'incluyemeLoginCountry';
	if (isset($_POST['incluyemeLoginFB'])) {
		$value = $_POST['incluyemeLoginFB'];
		update_option($incluyemeLoginFB, sanitize_text_field($value));
		update_option($incluyemeLoginFB, sanitize_text_field($value));
	}
	if (isset($_POST['incluyemeLoginGoogle'])) {
		$value = $_POST['incluyemeLoginGoogle'];
		update_option($incluyemeLoginGoogle, sanitize_text_field($value));
		update_option($incluyemeLoginGoogle, sanitize_text_field($value));
	}
	if (isset($_POST['incluyemeLoginCountry'])) {
		$value = $_POST['incluyemeLoginCountry'];
		update_option($incluyemeLoginCountry, sanitize_text_field($value));
		update_option($incluyemeLoginCountry, sanitize_text_field($value));
	}
	if (isset($_POST['deleteIncluyeme'])) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$query = "DELETE
  FROM " . $prefix . "incluyeme_users_dicapselect
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume);";

		$wpdb->query($query);
		$query = "	DELETE
  FROM " . $prefix . "incluyeme_users_idioms
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume); ";
	
		$wpdb->query($query);
		$query = "  DELETE
  FROM " . $prefix . "incluyeme_users_information
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume); ";
		
		$wpdb->query($query);
		$query = " DELETE
  FROM " . $prefix . "incluyeme_users_questions
WHERE resume_id NOT IN (SELECT
      " . $prefix . "wpjb_resume.id
    FROM " . $prefix . "wpjb_resume);";

		$wpdb->query($query);
	}
	wp_redirect(get_current_screen());
	exit;
}

add_action('admin_post_my_test_sub_save', 'incluyemeSave_Login_Options');
