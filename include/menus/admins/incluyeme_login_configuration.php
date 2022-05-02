<?php
/**
 * Copyright (c) 2020
 *
 * Developer by Jesus Nuñez <jesus.nunez2050@gmail.com> .
 */

function incluyeme_login_configuration()
{
	$discap = 'IncluyemeDiscap';
	$discapMore = 'IncluyemeDiscapMore';
	$state = 'IncluyemeStateConf';
	$city = 'IncluyemeCityConf';
	$cep = 'IncluyemeCepConf';
	$numero = 'IncluyemeNumeroConf';
	$street = 'IncluyemeStreetConf';
	$bairro = 'IncluyemeBairroConf';
	$ingles = 'Incluyemeingles';
	$libras = 'Incluyemelibras';
	$espanhol = 'Incluyemeespanhol';
	$country = 'IncluyemeCountryConf';
	$incluyemeFilters = 'incluyemeFiltersCV';
	$other_idioms = 'usersIdiomsOthers';
	if (isset($_POST['discap'])) {
		$value = $_POST['discap'];
		update_option($discap, sanitize_text_field($value));
		update_option($discap, sanitize_text_field($value));
	}
	if (isset($_POST['discap_cud'])) {
		$value = $_POST['discap_cud'];
		update_option($incluyemeFilters, sanitize_text_field($value));
		update_option($incluyemeFilters, sanitize_text_field($value));
	}
	if (isset($_POST['discap_more'])) {
		$value = $_POST['discap_more'];
		update_option($discapMore, sanitize_text_field($value));
		update_option($discapMore, sanitize_text_field($value));
	}
	if (isset($_POST['state'])) {
		$value = $_POST['state'];
		update_option($state, sanitize_text_field($value));
		update_option($state, sanitize_text_field($value));
	}
	if (isset($_POST['country'])) {
		$value = $_POST['country'];
		update_option($country, sanitize_text_field($value));
		update_option($country, sanitize_text_field($value));
	}
	if (isset($_POST['city'])) {
		$value = $_POST['city'];
		update_option($city, sanitize_text_field($value));
		update_option($city, sanitize_text_field($value));
	}
		if (isset($_POST['cep'])) {
		$value = $_POST['cep'];
		update_option($cep, sanitize_text_field($value));
		update_option($cep, sanitize_text_field($value));
	}
	if (isset($_POST['street'])) {
		$value = $_POST['street'];
		update_option($street, sanitize_text_field($value));
		update_option($street, sanitize_text_field($value));
	}
	if (isset($_POST['numero'])) {
		$value = $_POST['numero'];
		update_option($numero, sanitize_text_field($value));
		update_option($numero, sanitize_text_field($value));
	}
	if (isset($_POST['bairro'])) {
		$value = $_POST['bairro'];
		update_option($bairro, sanitize_text_field($value));
		update_option($bairro, sanitize_text_field($value));
	}
	if (isset($_POST['ingles'])) {
		$value = $_POST['ingles'];
		update_option($ingles, sanitize_text_field($value));
		update_option($ingles, sanitize_text_field($value));
	}
	if (isset($_POST['espanhol'])) {
		$value = $_POST['espanhol'];
		update_option($espanhol, sanitize_text_field($value));
		update_option($espanhol, sanitize_text_field($value));
	}
	if (isset($_POST['libras'])) {
		$value = $_POST['libras'];
		update_option($libras, sanitize_text_field($value));
		update_option($libras, sanitize_text_field($value));
	}
	if (isset($_POST['other_idioms'])) {
		$value = $_POST['other_idioms'];
		update_option($other_idioms, sanitize_text_field($value));
		update_option($other_idioms, sanitize_text_field($value));
	}
	?>
	<div class="container">
		
		<h5>Configuración de Campos</h5>
		
		<div class="card">
			<div class="card-title">
				<div class="card-body">
					<form method="POST">
						<h5>Informacion general</h5>
						<div class="form-group">
							<label for="discap">
								Tipo de Discapacidad
							</label>
							<input name="discap" class="form-control" id="discap" type="text"
							       placeholder="Ingrese el ID del campo para el Tipo de Discapacidad"
							       value="<?php echo get_option($discap) ?>">
						</div>
						<div class="form-group">
							<label for="discap_more">
								Informacion sobre la discapacidad
							</label>
							<input name="discap_more" class="form-control" id="discap_more" type="text"
							       placeholder="Ingrese el ID del campo"
							       value="<?php echo get_option($discapMore) ?>">
						</div>
						<div class="form-group">
							<label for="discap_cud">
								Certificado de Discapacidad
							</label>
							<input name="discap_cud" class="form-control" id="discap_cud" type="text"
							       placeholder="Ingrese el ID del campo"
							       value="<?php echo get_option($incluyemeFilters) ?>">
						</div>
						<div class="form-group">
							<label for="country">
								Pais
							</label>
							<input name="country" class="form-control" id="country" type="text"
							       placeholder="Ingrese el ID del campo para el Pais"
							       value="<?php echo get_option($country) ?>">
						</div>
						<div class="form-group">
							<label for="state">
								Estado
							</label>
							<input name="state" class="form-control" id="state" type="text"
							       placeholder="Ingrese el ID del campo para Estado"
							       value="<?php echo get_option($state) ?>">
						</div>
						<div class="form-group">
							<label for="city">
								Cidade
							</label>
							<input name="city" class="form-control" id="city" type="text"
							       placeholder="Ingrese el ID del campo para Cidade"
							       value="<?php echo get_option($city) ?>">
						</div>
						<div class="form-group">
							<label for="cep">
								Cep
							</label>
							<input name="cep" class="form-control" id="cep" type="text"
							       placeholder="Ingrese el ID del campo para Ciudad"
							       value="<?php echo get_option($cep) ?>">
						</div>
						<div class="form-group">
							<label for="street">
								Endereço
							</label>
							<input name="street" class="form-control" id="street" type="text"
							       placeholder="Ingrese el ID del campo para Endereço"
							       value="<?php echo get_option($street) ?>">
						</div>
						<div class="form-group">
							<label for="numero">
								Número
							</label>
							<input name="cep" class="form-control" id="numero" type="text"
							       placeholder="Ingrese el ID del campo para Número"
							       value="<?php echo get_option($numero) ?>">
						</div>
						<div class="form-group">
							<label for="bairro">
								Bairro
							</label>
							<input name="bairro" class="form-control" id="bairro" type="text"
							       placeholder="Ingrese el ID del campo para Bairro"
							       value="<?php echo get_option($bairro) ?>">
						</div>
						<h5>Idiomas</h5>
						<div class="form-group">
							<label for="idioma_ingles">
								Inglês
							</label>
							<input name="ingles" class="form-control" id="ingles" type="text"
							       placeholder="Ingrese el ID del campo para el idioma Ingles"
							       value="<?php echo get_option($ingles) ?>">
						</div>
						<div class="form-group">
							<label for="espanhol">
								Espanhol
							</label>
							<input name="espanhol" class="form-control" id="espanhol" type="text"
							       placeholder="Ingrese el ID del campo para el idioma Espanhol"
							       value="<?php echo get_option($espanhol) ?>">
						</div>
						<div class="form-group">
							<label for="idioma_portugues">
								Libras
							</label>
							<input name="libras" class="form-control" id="libras" type="text"
							       placeholder="Ingrese el ID del campo para el idioma Libras"
							       value="<?php echo get_option($libras) ?>">
						</div>
						<div class="form-group">
							<label for="other_idioms">
								Outro Idioma
							</label>
							<input name="other_idioms" class="form-control" id="other_idioms" type="text"
							       placeholder="Ingrese el ID del campo para otros idiomas"
							       value="<?php echo get_option($other_idioms) ?>">
						</div>
					 <div class="text-right mt-2">
								<button type="submit"
								        class="btn btn-info"><?php _e("Guardar", "wpjobboard"); ?></button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<?php
}
