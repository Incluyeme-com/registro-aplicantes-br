<?php
$js = plugins_url() . '/incluyeme-login-extension/include/assets/js/';
$img = plugins_url() . '/incluyeme-login-extension/include/assets/img/incluyeme-place.svg';
$css = plugins_url() . '/incluyeme-login-extension/include/assets/css/';
wp_register_script('popper', $js . 'popper.js', ['jquery'], '1.0.0');
wp_register_script('bootstrapJs', $js . 'bootstrap.min.js', ['jquery', 'popper'], '1.0.0');
wp_register_script('dropZ', $js . 'dropzone.min.js', ['jquery', 'popper'], '1.0.0');
wp_register_script('FAwesome', $js . 'fAwesome.js', [], '1.0.0', false);
wp_register_script('vueJS', $js . 'vueDEV.js', ['bootstrapJs'], '1.0.0');
wp_register_script('Axios', $js . 'axios.min.js', [], '2.0.0');
wp_register_script('selectJS', $js . 'bootstrap-select.min.js', ['bootstrapJs'], '2.0.0');
wp_register_script('bootstrap-notify', $js . 'iziToast.js', ['bootstrapJs'], '2.0.0');
wp_register_script('defaults-es_ES', $js . 'defaults-es_ES.js', ['selectJS'], '2.0.0');
//wp_register_script('materializeJS', $js . 'materialize.min.js');

wp_register_style('bootstrap-css', $css . 'bootstrap.min.css', [], '1.0.0', false);
wp_register_style('bootstrap-notify-css', $css . 'iziToast.min.css', [], '1.0.0', false);
wp_register_style('dropzone-css', $css . 'dropzone.min.css', [], '1.0.0', false);
wp_register_style('selectB-css', $css . 'bootstrap-select.min.css', ['bootstrap-css'], '1.0.0', false);

wp_enqueue_script('popper');
wp_enqueue_script('bootstrapJs');
wp_enqueue_script('vueJS');
wp_enqueue_script('bootstrap-notify');
wp_enqueue_script('vueH', $js . 'vue3.2.5.js', ['vueJS', 'FAwesome'], date("h:i:s"), true);
wp_enqueue_script('dropZ');
wp_enqueue_script('Axios');
wp_enqueue_script('selectJS');
wp_enqueue_script('defaults-es_ES');
//wp_enqueue_script('materializeJS');

wp_enqueue_style('bootstrap-css');
wp_enqueue_style('dropzone-css');
wp_enqueue_style('bootstrap-notify-css');
wp_enqueue_style('selectB-css');
$baseurl = wp_upload_dir();
$baseurl = $baseurl['baseurl'];
$incluyemeNames = 'incluyemeNamesCV';
$incluyemeLoginFB = 'incluyemeLoginFB';
$incluyemeLoginGoogle = 'incluyemeLoginGoogle';
$incluyemeLoginCountry = 'incluyemeLoginCountry';
$incluyemeLoginEstado = 'incluyemeLoginEstado';
$incluyemeGoogleAPI = get_option($incluyemeLoginGoogle);
$FBappId = get_option($incluyemeLoginFB);
$incluyemeLoginFBSECRET = 'incluyemeLoginFBSECRET';
$FBversion = 'v7.0';
$defaultCheckTerminos = 'defaultCheckTerminos';
?>
<?php if (get_option($incluyemeLoginGoogle)) { ?>
	<script src="https://apis.google.com/js/api:client.js"></script>
	<script>
        var googleUser = {};
        var startApp = function () {
            gapi.load('auth2', function () {
                // Retrieve the singleton for the GoogleAuth library and set up the client.
                auth2 = gapi.auth2.init({
                    client_id: '<?php echo get_option($incluyemeLoginGoogle); ?>',
                    cookiepolicy: 'single_host_origin',
                    // Request scopes in addition to 'profile' and 'email'
                    //scope: 'additional_scope'
                });
                attachSignin(document.getElementById('customBtn'));
            });
        };

        function attachSignin(element) {
            auth2.attachClickHandler(element, {},
                function (googleUser) {
                    const profile = googleUser.getBasicProfile();
                    app.$data.email = profile.getEmail();
                    app.$data.password = profile.getEmail();
                    app.$data.passwordConfirm = profile.getEmail();
                    app.$data.name = profile.getGivenName();
                    app.$data.lastName = profile.getFamilyName();
                    app.$data.google = googleUser.getAuthResponse().id_token;
                    app.googleChange('<?php echo plugins_url() ?>');
                }, function (error) {
                    alert(JSON.stringify(error, undefined, 2));
                });
        }
	</script>
<?php } ?>
<?php if (get_option($incluyemeLoginFB) && get_option($incluyemeLoginFBSECRET)) { ?>
	<script>
        function statusChangeCallback(response) {
        }

        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '<?php echo get_option($incluyemeLoginFB); ?>',
                cookie: false,
                xfbml: false,
                version: 'v7.0'
            });

        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function FBLogin() {
            FB.login(function (response) {
                if (response.status === 'connected') {
                    const token = response.authResponse.accessToken
                    app.$data.email = token;
                    app.$data.password = token;
                    app.$data.passwordConfirm = token;
                    app.$data.name = token;
                    app.$data.lastName = token;
                    app.$data.facebook = token;
                    app.googleChange('<?php echo plugins_url() ?>');
                }
            }, {scope: 'public_profile,email'});
        }
	</script>
<?php } ?>
<style>
    #main-content .container:before {
        background: none !important;
    }
    .deleteIncluyeme {
        background-color: #ee7566 !important;
        border-color: #ee7566 !important;
    }

    .dropzone .dz-preview .dz-error-message {
        top: 150px !important;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .dropzone {
        border: 2px dashed rgba(0, 0, 0, .3) !important;
        border-radius: 20px !important;
        color: rgba(0, 0, 0, .3) !important;
    }

    .myButton {
        box-shadow: 2px 2px 4px 0px #bfbfbf;
        background-color: #ffffff;
        border-radius: 4px;
        border: 1px solid #ffffff;
        display: inline-block;
        cursor: pointer;
        color: #bababa;
        padding: 16px 31px;
        height: 2.5rem;
    }

    .myButton:hover,
    .myButton:focus,
    .myButton:active,
    .myButton.active {
        background-color: #bababa !important;
    }

    .panel-heading {
        position: relative;
    }

    .panel-heading[data-toggle="collapse"]:after {
        font-family: '"Font Awesome 5 Free"';
        content: "\f063";
        position: absolute;
        color: #b0c5d8;
        font-size: 18px;
        line-height: 22px;
        right: 20px;
        top: calc(50% - 10px);

        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading[data-toggle="collapse"].collapsed:after {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .myButton2:hover,
    .myButton2:focus,
    .myButton2:active,
    .myButton2.active {
        background-color: #318de6 !important;
    }

    .myButton2 {
        background-color: #318de6 !important;
    }

    .btn-info:hover,
    .btn-info:focus,
    .btn-info:active,
    .btn-info.active {
        background-color: #318de6 !important;
    }

    .btn-info {
        background-color: #318de6 !important;
    }

    ,

    .btn-link {
        color: black !important;
    }

    .btn-link:hover,
    .btn-link:focus,
    .btn-link:active,
    .btn-link.active {
        background: none !important;
    }

    body:not(.et-tb) #main-content .container, body:not(.et-tb-has-header) #main-content .container {
        padding-top: 0 !important;
    }
</style>
<div class="container m-auto">
	<div id="incluyeme-login-wpjb">
		<div id="searchTOP"></div>
		<div v-if="noDisPage === false" class="container">
			<template id="step1" v-if="currentStep == 1">
				<x-incluyeme class="container text-center">
					<h1>Cadastre-se</h1>
					<p>Encontre vagas para Pessoas com deficiência</p>
				</x-incluyeme>
                <?php if (get_option($incluyemeLoginGoogle)) { ?>
					<x-incluyeme class="row text-center justify-content-center">
						<x-incluyeme id='gSignInWrapper' class="col-lg-6 col-sm-12">
							<button id="customBtn" type="button" class="btn myButton w-100">
								<i class="fa fa-google mr-2"></i>
								<span class="text-gray">Entre com o Google</span>
							</button>
						</x-incluyeme>
					</x-incluyeme>
                <?php } ?>
                <?php if (get_option($incluyemeLoginFB) && get_option($incluyemeLoginFBSECRET)) { ?>
					<x-incluyeme class="row text-center justify-content-center">
						<x-incluyeme class="col-lg-6 col-sm-12 mt-2">
							<button scope="public_profile,email" onclick="FBLogin()"
							        class="btn btn-primary w-100 myButton2" style="box-shadow: 2px 2px 4px 0px #bfbfbf; border-radius: 4px;
		border: 1px solid #007bff;height: 2.5rem; background-color: #318de6 !important;">
								<i class="fa fa-facebook mr-2"></i>
								<span class="text-gray">Entre com o Facebook</span>
							</button>
						</x-incluyeme>
					</x-incluyeme>
                <?php } ?>
				<hr class="w-100">
				<x-incluyeme class="row">
					<x-incluyeme class="form-group col-12">
						<label id="emilLabel" for="emil">Insira seu email <span
									style="font-size: 2em;color: black;">*<span></label>
						<input type="email" v-model="email" class="form-control" id="emil"
						       placeholder="Insira seu email">
						<p v-if="validation === 1" style="color: red">Este email já possui cadastro</p>
						<p v-if="validation === 2" style="color: red">Por favor, insira um email válido</p>
					</x-incluyeme>
					<x-incluyeme class="form-group col-12">
						<label id="labelPassword4" for="inputPassword4">Insira uma senha <span
									style="font-size: 2em;color: black;">*<span></label>
						<input type="password" v-model="password" class="form-control" id="inputPassword4"
						       placeholder="Insira uma senha">
						<p v-if="validation === 3" style="color: red">Sua senha deve conter cinco (5) caracteres ou
						                                              mais</p>
					</x-incluyeme>
					<x-incluyeme class="form-group col-12">
						<label id="repostPLabel" for="repostP">Repita sua senha <span
									style="font-size: 2em;color: black;">*<span></label>
						<input type="password" v-model="passwordConfirm" class="form-control" id="repostP"
						       placeholder="Repita sua senha">
						<p v-if="validation === 4" style="color: red">Sua senha não confere</p>
					</x-incluyeme>
					<x-incluyeme class="form-group col-12 ml-3">
						<input class="form-check-input" type="checkbox" value="" v-model="defaultCheckDiscapacidad"
						       id="defaultCheckDiscapacidad">
						<label id="defaultCheckDiscapacidadLabel" class="form-check-label"
						       for="defaultCheckDiscapacidad">Entendo que estou me cadastrando em uma plataforma para <b>pessoas com deficiência</b>
							<p v-if="validation === 'discapacidadTerms'" style="color: red">Para continuar na <?php echo
                                ucwords($_SERVER['HTTP_HOST']) ?> você deve selecionar <b>a caixa acima</b> </p>
						</label>
						<!--	<input class="form-check-input" type="checkbox" value="" v-model="defaultCheckTerminos"
							       id="defaultCheckTerminos">
							<label id="defaultCheckTerminosLabel" class="form-check-label" for="defaultCheckTerminos">
								Al registrarte estas de acuerdo con nuestros <a
										href="<?php //echo get_option($defaultCheckTerminos); ?>" target="_blank">Términos y
								                                                                            Condiciones</a>
								y nuestra política de privacidad
								<p v-if="validation === 'terms'" style="color: red">Debe aceptar nuestros Términos y
								                                                    Condiciones</p>
							</label> -->
					</x-incluyeme>
					<x-incluyeme class="form-group col-12">
						<button type="submit" class="btn btn-info w-100 w-100"
						        @click.prevent="goToStep(2, '<?php echo plugins_url() ?>')">Cadastre-se com
						                                                                    email
						</button>
					</x-incluyeme>
				</x-incluyeme>
			
			</template>
			<template id="step2" v-if="currentStep == 2">
				<x-incluyeme class="container text-center">
					<h1>Qual o seu nome?</h1>
				</x-incluyeme>
				<x-incluyeme class="row">
					<x-incluyeme class="form-group col-12">
						<label id="nameLabel" for="names">Nome <span
									style="font-size: 2em;color: black;">*<span></label>
						<input v-model="name" type="text" class="form-control" id="names"
						       placeholder="Insira seu nome" onkeydown="return /[a-z, ]/i.test(event.key)">
						<p v-if="validation === 5" style="color: red">Por favor, insira seu nome</p>
					</x-incluyeme>
					<x-incluyeme class="form-group col-12">
						<label id="lastNamesLabel" for="lastNames">Sobrenome <span
									style="font-size: 2em;color: black;">*<span></label>
						<input v-model="lastName" type="text" class="form-control" id="lastNames"
						       placeholder="Insira seu sobrenome" onkeydown="return /[a-z, ]/i.test(event.key)">
						<p v-if="validation === 6" style="color: red">Por favor, insira seu sobrenome</p>
					</x-incluyeme>
				</x-incluyeme>
				<x-incluyeme class="container text-center">
					<h1 id="haveDiscap">Você tem alguma deficiência? <span style="font-size: 2em;color: black;">*<span>
					</h1>
				</x-incluyeme>
				<x-incluyeme class="row">
					<x-incluyeme class="form-group col">
						<x-incluyeme class="form-check form-check-inline">
							<input type="radio" style="transform: scale(1.4) !important;" name="disCap" id="disCap"
							       v-on:click='disCap = true'
							       v-on:click='disClass = "w-50"'
							       class="form-check-input">
							<label for="disCap" class="form-check-label">Tenho uma deficiência</label>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="form-group col">
						<x-incluyeme class="form-check form-check-inline">
							<input type="radio" style="transform: scale(1.4) !important;" id="disCapF" name="disCap"
							       v-on:click='disCap = false'
							       v-on:click='disClass = "w-100"'
							       class="form-check-input">
							<label class="form-check-label" for="disCapF">Não tenho uma deficiência</label>
						</x-incluyeme>
					</x-incluyeme>
					<p v-if="validation === 20" style="color: red">Por favor, indique se tem alguma deficiência</p>
				</x-incluyeme>
				<button type="submit" class="btn btn-info w-100 w-100 mt-3"
				        @click.prevent="goToStep(3, '<?php echo plugins_url() ?>')">
					Seguinte
				</button>
			</template>
			<template id="step3" v-if="currentStep == 3">
				<x-incluyeme class="container text-center">
					<h1>Gênero e data de nascimento</h1>
				</x-incluyeme>
				<x-incluyeme class="row">
					<x-incluyeme class="col-12">
						<p id="genreP">Gênero <span style="font-size: 2em;color: black;">*<span></p>
						<x-incluyeme class="form-check form-check-inline">
							<input class="form-check-input" type="radio" style="transform: scale(1.4) !important;"
							       id="inlineCheckbox1"
							       value="Masculino" v-model="genre">
							<label class="form-check-label"
							       for="inlineCheckbox1"
							       style="color: black"><?php _e("Masculino", "incluyeme-login-extension"); ?></label>
						</x-incluyeme>
						<x-incluyeme class="form-check form-check-inline">
							<input class="form-check-input" type="radio" style="transform: scale(1.4) !important;"
							       id="inlineCheckbox2"
							       name="inlineCheckbox1"
							       value="Feminino" v-model="genre">
							<label class="form-check-label"
							       for="inlineCheckbox2"
							       style="color: black"><?php _e("Feminino", "incluyeme-login-extension"); ?></label>
						</x-incluyeme>
						<x-incluyeme class="form-check form-check-inline">
							<input class="form-check-input" type="radio" style="transform: scale(1.4) !important;"
							       id="inlineCheckbox3"
							       name="inlineCheckbox1"
							       value="Não Binário" v-model="genre">
							<label class="form-check-label"
							       for="inlineCheckbox3"
							       style="color: black"><?php _e("Não Binário", "incluyeme-login-extension"); ?></label>
						</x-incluyeme>
						<p v-if="validation === 7" style="color: red">Por favor, insira o gênero que você mais se identifica</p>
					</x-incluyeme>
					<x-incluyeme class="col mt-4 mb-2">
						<label id="labeldateBirthDay"
						       for="dateBirthDay"><?php _e("Data de Nascimento <span style='font-size: 2em;color: black;'>*<span>", "incluyeme-login-extension"); ?></label>
						<input type="date" v-model="dateBirthDay" name="dateBirthDay" class="form-control"
						       id="dateBirthDay"
						       placeholder="Insira sua data de nascimento">
						<p v-if="validation === 8" style="color: red">Por favor, insira sua data de nascimento</p>
					</x-incluyeme>
				</x-incluyeme>
				<x-incluyeme v-if="google==true||facebook==true" class="container text-center">
					<h1 id="haveDiscap">Você tem alguma deficiência? <span style="font-size: 2em;color: black;">*<span>
					</h1>
				</x-incluyeme>
				<x-incluyeme v-if="google==true||facebook==true" class="row">
					<x-incluyeme class="form-group col">
						<x-incluyeme class="form-check form-check-inline">
							<input type="radio" style="transform: scale(1.4) !important;" name="disCap" id="disCap"
							       v-on:click='disCap = true'
							       v-on:click='disClass = "w-50"'
							       class="form-check-input">
							<label for="disCap" class="form-check-label">Tenho uma deficiência</label>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="form-group col">
						<x-incluyeme class="form-check form-check-inline">
							<input type="radio" style="transform: scale(1.4) !important;" id="disCapF" name="disCap"
							       v-on:click='disCap = false'
							       v-on:click='disClass = "w-100"'
							       class="form-check-input">
							<label class="form-check-label" for="disCapF">Não tenho uma deficiência</label>
						</x-incluyeme>
					</x-incluyeme>
					<p v-if="validation === 20" style="color: red">Por favor, indique se tem alguma deficiência</p>
				</x-incluyeme>
				<x-incluyeme class="row mt-2">
					<x-incluyeme class="col">
						<button type="confirmar" class="btn btn-info w-100"
						        @click.prevent="goToStep(4, '<?php echo plugins_url() ?>')">Seguinte
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step4" v-if="currentStep == 4">
				<x-incluyeme class="container text-center">
					<h1>Contato</h1>
				</x-incluyeme>
				<div class="container">
					<label id="labelPhone"
					       for="mPhone"><?php _e("Telefone celular <span style='font-size: 2em;color: black;'>*<span>", "incluyeme-login-extension"); ?></label>
					<x-incluyeme class="row align-items-center">
						<x-incluyeme class="col-lg-4 col col-md-12 mb-3 mb-sm-0">
							<input type="number" min='0' v-model="mPhone" class="form-control" id="mPhone"
							       placeholder="Código da Área">
						</x-incluyeme>
						<x-incluyeme class="col-1 text-center d-none d-lg-block">
							<span><b>-</b></span>
						</x-incluyeme>
						<x-incluyeme class="col-lg-7 col-md-12">
							<label for="Phone" style="display: none"></label>
							<input type="number" min='0' v-model="phone" class="form-control" id="Phone"
							       placeholder="Telefone Celular">
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row align-items-center">
						<x-incluyeme v-if="validation === 9 || validation === 20"
						             class="col-lg-4 col col-md-12 mb-3 mb-sm-0">
							<p v-if="validation === 9" style="color: red">Por favor, insira seu telefone celular</p>
						</x-incluyeme>
						<x-incluyeme class="col-1 text-center d-none d-lg-block">
							<span><b></b></span>
						</x-incluyeme>
						<x-incluyeme class="col-lg-7 col-md-12">
							<p v-if="validation === 20" style="color: red">Por favor, insira seu telefone celular</p>
						</x-incluyeme>
					</x-incluyeme>
				</div>
				<div class="container mt-3 mb-sm-0">
					<label for="fPhone"><?php _e("Telefone Fixo", "incluyeme-login-extension"); ?></label>
					<x-incluyeme class="row align-items-center">
						<x-incluyeme class="col-lg-4 col col-md-12 mb-3 mb-sm-0">
							<input type="number" min='0' v-model="fPhone" class="form-control" id="fPhone"
							       placeholder="Código da Área">
						</x-incluyeme>
						<x-incluyeme class="col-1 text-center d-none d-lg-block">
							<span><b>-</b></span>
						</x-incluyeme>
						<x-incluyeme class="col-lg-7 col-md-12">
							<label for="Phone" style="display: none"></label>
							<input type="number" min='0' v-model="fiPhone" class="form-control" id="Phone"
							       placeholder="Telefone Fixo">
						</x-incluyeme>
					</x-incluyeme>
				
				</div>
                <?php if (!get_option($incluyemeLoginCountry)) { ?>
					<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label id="labelState"
								       for="state"><?php _e((get_option($incluyemeLoginEstado) ? get_option($incluyemeLoginEstado) : ' Provincia/Estado') . "<span style='font-size: 2em;color: black;'>*<span>", "incluyeme-login-extension"); ?></label>
								<input v-model="state" type="text" class="form-control" id="state">
								<p v-if="validation === 10" style="color: red">Por favor, insira
								                                               seu <?php (get_option($incluyemeLoginEstado) ? get_option($incluyemeLoginEstado) : ' Estado') ?></p>
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label id="labelCity"
								       for="city"><?php _e("Cidade <span style='font-size: 2em;color: black;'>*<span>", "incluyeme-login-extension"); ?></label>
								<input v-model="city" type="text" class="form-control" id="city">
								<p v-if="validation === 11" style="color: red">Por favor, insira sua cidade</p>
							</x-incluyeme>
						</x-incluyeme>
					</div>
                <?php } else { ?>
					<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label id="labelState"
								       for="state"><?php _e((get_option($incluyemeLoginEstado) ? get_option($incluyemeLoginEstado) : ' Provincia/Estado') . "<span style='font-size: 2em;color: black;'>*<span>", "incluyeme-login-extension"); ?></label>
								<select v-model="state" type="text" data-live-search="true" data-container="body"
								        class="form-control selectpicker" id="state"
								        v-on:change="getCities()">
									<option v-for="provincias in provincias"
									        :value="provincias.cities_provin" class="text-capitalize">
										{{provincias.cities_provin}}
									</option>
                                    <?php if (get_option($incluyemeLoginCountry) !== 'BR') { ?>
										<option value="Otra">Outro</option>
                                    <?php } ?>
								</select>
								<p v-if="validation === 10" style="color: red">Por favor, insira
								                                               seu <?php (get_option($incluyemeLoginEstado) ? get_option($incluyemeLoginEstado) : 'Estado') ?></p>
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label id="labelCity"
								       for="city"><?php _e("Cidade <span style='font-size: 2em;color: black;'>*<span>", "incluyeme-login-extension"); ?></label>
								<select v-model="city" type="text" data-live-search="true" data-container="body"
								        class="form-control selectpicker" id="city">
									<option v-for="citiy in cities"
									        v-bind:value="citiy.cities_name" class="text-capitalize">
										{{citiy.cities_name}}
									</option>
									<option value="Otra">Outra</option>
								</select>
								<p v-if="validation === 11" style="color: red">Por favor, insira sua cidade</p>
							</x-incluyeme>
						</x-incluyeme>
					</div>
                <?php } ?>
				<div class="container mt-3 mb-sm-0">
					<x-incluyeme class="row align-items-center">
						<x-incluyeme class="form-group col">
							<label for="street"><?php _e("Endereço", "incluyeme-login-extension"); ?></label>
							<input v-model="street" type="text" class="form-control"
							       id="street">
						</x-incluyeme>
					</x-incluyeme>
				</div>
				<x-incluyeme class="row">
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 mt-3"
						        @click.prevent="goToStep(3, '<?php echo plugins_url() ?>')">Voltar
						</button>
					</x-incluyeme>
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 mt-3"
						        @click.prevent="goToStep(5, '<?php echo plugins_url() ?>')">Seguinte
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step5" v-if="currentStep == 5">
				<x-incluyeme class="container text-center">
					<h1 v-if="disCap" id="disSelects">Por favor, indique sua deficiência</h1>
				</x-incluyeme>
				<div class="container">
					<div class="container m-auto">
						<x-incluyeme v-if="disCap" class="row ml-5">
							<x-incluyeme class="col mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="fisica" id="Fisica">
								<label class="form-check-label" for="Fisica">
									Física
								</label>
							</x-incluyeme>
							<x-incluyeme class="col-lg-6 col-md-12 mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="multipla" id="Multipla"
\								       name="Múltipla">
								<label class="form-check-label" for="Multipla">
									Múltipla
								</label>
							</x-incluyeme>
							<x-incluyeme class="col-lg-6 col-md-12 mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="auditiva" id="Auditiva">
								<label class="form-check-label" for="Auditiva">
									Auditiva
								</label>
							</x-incluyeme>
							<x-incluyeme class="col-lg-6 col-md-12 mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="mental" id="Mental">
								<label class="form-check-label" for="Mental">
									Mental
								</label>
							</x-incluyeme>
							<x-incluyeme class="col-lg-6 col-md-12 mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="visual" id="Visual">
								<label class="form-check-label" for="Visual">
									Visual
								</label>
							</x-incluyeme>
							<x-incluyeme class="col-lg-6 col-md-12 mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="surdocegueira" id="Surdocegueira">
								<label class="form-check-label" for="Surdocegueira">
									Surdocegueira
								</label>
							</x-incluyeme>
							<x-incluyeme class="col-lg-6 col-md-12 mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="intelectual"
								       id="Intelectual">
								<label class="form-check-label" for="Intelectual">
									Intelectual
								</label>
							</x-incluyeme>
						</x-incluyeme>
						<p v-if="validation === 12" style="color: red">Por favor, nos diga mais sobre sua deficiência</p>
					</div>
				</div>
				<x-incluyeme class="row">
					<x-incluyeme class="col">
						<button v-if="disCap===true" type="submit" class="btn btn-info w-100 w-100 mt-3"
						        @click.prevent="goToStep(4, '<?php echo plugins_url() ?>')">
							Voltar
						</button>
					</x-incluyeme>
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 mt-3" v-bind:class="[disClass]"
						        @click.prevent="goToStep(disCap ? 6 : false)">
							{{disCap ? 'Seguinte' : 'Finalizar'}}
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step6" v-if="currentStep == 6">
				<x-incluyeme id="accordion">
					<x-incluyeme v-if="fisica" class="card">
						<x-incluyeme class="card-header p-0 m-0" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-link " data-toggle="collapse"
								        data-target="#collapseOne"
								        aria-expanded="true" aria-controls="collapseOne">
									<i class="fas fa-arrow-down"></i>
									<h5 style="display:inline;"> Física</h5>
								</button>
							</h5>
						</x-incluyeme>
						
						<x-incluyeme id="collapseOne" class="collapse show" aria-labelledby="headingOne"
						             data-parent="#accordion">
							<x-incluyeme class="card-body">
								<div class="container">
									<x-incluyeme class="row">
										<x-incluyeme class="col-12">
											<span>Você consegue ficar de pé sem se apoiar por mais de uma hora?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mPieS"
												       value="Sim" v-model="mPie" name="mPie">
												<label class="form-check-label"
												       for="mPieS"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mPie"
												       value="Não" v-model="mPie" name="mPie">
												<label class="form-check-label"
												       for="mPie"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você consegue ficar sentado sem se apoiar por mais de uma hora? </span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mSenS"
												       value="Sim" v-model="mSen" name="mSen">
												<label class="form-check-label"
												       for="mSenS"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mSen"
												       value="Não" v-model="mSen" name="mSen">
												<label class="form-check-label"
												       for="mSen"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você consegue subir ou descer escadas sem a ajuda de alguém?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mEscaS"
												       value="Sim" v-model="mEsca" name="mEsca">
												<label class="form-check-label"
												       for="mEscaS"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mEsca"
												       value="Não" v-model="mEsca" name="mEsca">
												<label class="form-check-label"
												       for="mEsca"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você consegue movimentar seus braços?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mBrazoS"
												       value="Sim" v-model="mBrazo" name="mBrazo">
												<label class="form-check-label"
												       for="mBrazoS"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mBrazo"
												       value="Não" v-model="mBrazo" name="mBrazo">
												<label class="form-check-label"
												       for="mBrazo"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você consegue segurar peso sem a ajuda de alguém?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="peso"
												       value="Não" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="peso"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="pesoKg"
												       value="Até 5 Kg" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="pesoKg"
												       style="color: black"><?php _e("Até 5 Kg", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="peso10"
												       value="Até 10 Kg" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="peso10"
												       style="color: black"><?php _e("Até 10 Kg", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="peso20"
												       value="Até 20 Kg" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="peso20"
												       style="color: black"><?php _e("Até 20 Kg", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você é cadeirante?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mRuedaS"
												       value="Sim" v-model="mRueda" name="mRueda">
												<label class="form-check-label"
												       for="mRuedaS"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mRueda"
												       value="Não" v-model="mRueda" name="mRueda">
												<label class="form-check-label"
												       for="mRueda"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você utiliza de alguma ajuda técnica para se movimentar?
										</span><br>
										<x-incluyeme class="form-check form-check-inline">
											<input class="form-check-input" type="radio"
											       style="transform: scale(1.4) !important;" id="desplazarte"
											       value="Bengala" v-model="desplazarte" name="desplazarte">
											<label class="form-check-label"
											       for="desplazarte"
											       style="color: black"><?php _e("Bengala", "incluyeme-login-extension"); ?></label>
										</x-incluyeme>
										<x-incluyeme class="form-check form-check-inline">
											<input class="form-check-input" type="radio"
											       style="transform: scale(1.4) !important;" id="Muletas"
											       value="Muletas" v-model="desplazarte" name="desplazarte">
											<label class="form-check-label"
											       for="Muletas"
											       style="color: black"><?php _e("Muletas", "incluyeme-login-extension"); ?></label>
										</x-incluyeme>
										<x-incluyeme class="form-check form-check-inline">
											<input class="form-check-input" type="radio"
											       style="transform: scale(1.4) !important;" id="Outros"
											       value="Outros" v-model="desplazarte" name="desplazarte">
											<label class="form-check-label"
											       for="Outros"
											       style="color: black"><?php _e("Outros", "incluyeme-login-extension"); ?></label>
										</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você consegue digitar no teclado sem a ajuda de algum aparelho
										      assistivo? </span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mDigiS"
												       value="Sim" v-model="mDigi" name="mDigi">
												<label class="form-check-label"
												       for="mDigiS"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="mDigi"
												       value="Não" v-model="mDigi" name="mDigi">
												<label class="form-check-label"
												       for="mDigi"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
									</x-incluyeme>
								</div>
							</x-incluyeme>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme v-if="multipla" class="card">
						<x-incluyeme class="card-header m-0 p-0" id="headingTwo">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse"
								        data-target="#collapseTwo"
								        aria-expanded="false" aria-controls="collapseTwo">
									<i class="fas fa-arrow-down"></i>
									<h5 style="display:inline;"> Múltipla</h5>
								
								</button>
							</h5>
						</x-incluyeme>
						<x-incluyeme id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
						             data-parent="#accordion">
							<div class="card-body">
								<div class="container">
									<x-incluyeme class="row">
										<x-incluyeme class="col-12">
											<span> Deficiência Física</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vHumedos"
												       value="Sim" v-model="vHumedos" name="vHumedos">
												<label class="form-check-label"
												       for="vHumedos"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vHumedosS"
												       value="Não" v-model="vHumedos" name="vHumedos">
												<label class="form-check-label"
												       for="vHumedosS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
								<span>Deficiência Intelectual </span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vTemp"
												       value="Sim" v-model="vTemp" name="vTemp">
												<label class="form-check-label"
												       for="vTemp"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vTempN"
												       value="Não" v-model="vTemp" name="vTemp">
												<label class="form-check-label"
												       for="vTempN"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Deficiência Mental</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vPolvo"
												       value="Sim" v-model="vPolvo" name="vPolvo">
												<label class="form-check-label"
												       for="vPolvo"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vPolvov"
												       value="Não" v-model="vPolvo" name="vPolvo">
												<label class="form-check-label"
												       for="vPolvov"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Deficiências Sensoriais
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vAdap"
												       value="Auditiva" v-model="vAdap" name="vAdap">
												<label class="form-check-label"
												       for="vAdap"
												       style="color: black"><?php _e("Auditiva", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vAdapS"
												       value="Visual" v-model="vAdap" name="vAdap">
												<label class="form-check-label"
												       for="vAdapS"
												       style="color: black"><?php _e("Visual", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vAdapAS"
												       value="Surdocegueira" v-model="vAdap"
												       name="vAdap">
												<label class="form-check-label"
												       for="vAdapAS"
												       style="color: black"><?php _e("Surdocegueira", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<div class="row">
													<div class="col-lg col-md-12">
														<label class="form-check-label mr-2"
														       style="color: black; font-weight: 400"
														       for='vSalidas'><?php _e("Otro", "incluyeme-login-extension"); ?></label>
													</div>
													<div class="col-lg-12 col-md-12">
														<input class="form-check-input" type="text" id="vSalidas"
														       v-model="vAdap" name="vAdap"
														       placeholder="Escreva aqui">
													</div>
												</div>
											</x-incluyeme>
										</x-incluyeme>
									</x-incluyeme>
								</div>
							</div>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme v-if="auditiva" class="card">
						<x-incluyeme class="card-header m-0 p-0" id="headingThree">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse"
								        data-target="#collapseThree"
								        aria-expanded="false" aria-controls="collapseThree">
									<i class="fas fa-arrow-down"></i>
									<h5 style="display:inline;"> Auditiva</h5>
								
								</button>
							</h5>
						</x-incluyeme>
						<x-incluyeme id="collapseThree" class="collapse" aria-labelledby="headingThree"
						             data-parent="#accordion">
							<x-incluyeme class="card-body">
								<div class="container">
									<x-incluyeme class="row">
										<x-incluyeme class="col-12">
											<span>Você consegue discriminar diferentes sons no ambiente?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aAmbient"
												       value="Sim" v-model="aAmbient" name="aAmbient">
												<label class="form-check-label"
												       for="aAmbient"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aAmbientS"
												       value="Não" v-model="aAmbient" name="aAmbient">
												<label class="form-check-label"
												       for="aAmbientS"
												       style="color: black"> <?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você se comunica oralmente?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aOral"
												       value="Sim" v-model="aOral" name="aOral">
												<label class="form-check-label"
												       for="aOral"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aOralN"
												       value="Não" v-model="aOral" name="aOral">
												<label class="form-check-label"
												       for="aOralN"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você utiliza língua de sinais (Libras) para se comunicar?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aSennas"
												       value="Sim" v-model="aSennas" name="aSennas">
												<label class="form-check-label"
												       for="aSennas"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aSennasS"
												       value="Não" v-model="aSennas" name="aSennas">
												<label class="form-check-label"
												       for="aSennasS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você utiliza a leitura labial para se comunicar?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aLabial"
												       value="Sim" v-model="aLabial" name="aLabial">
												<label class="form-check-label"
												       for="aLabial"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aLabialS"
												       value="Não" v-model="aLabial" name="aLabial">
												<label class="form-check-label"
												       for="aLabialS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Em um ambiente com diferentes ruídos (por exemplo, no escritório) você consegue estabelecer uma comunicação oral clara com outra pessoa?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aBajo"
												       value="Sim" v-model="aBajo" name="aBajo">
												<label class="form-check-label"
												       for="aBajo"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aBajoS"
												       value="Não" v-model="aBajo" name="aBajo">
												<label class="form-check-label"
												       for="aBajoS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você consegue estabelecer uma comunicação clara por telefone (sem o uso de mensagens ou chat)?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aFluida"
												       value="Sim" v-model="aFluida" name="aFluida">
												<label class="form-check-label"
												       for="aFluida"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aFluidaS"
												       value="Não" v-model="aFluida" name="aFluida">
												<label class="form-check-label"
												       for="aFluidaS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você utiliza algum aparelho assistivo para se comunicar?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aImplante"
												       value="Implante Coclear" v-model="aImplante" name="aImplante">
												<label class="form-check-label"
												       for="aImplante"
												       style="color: black"><?php _e("Implante Coclear", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aImplantes"
												       value="Fones de ouvido" v-model="aImplante" name="aImplante">
												<label class="form-check-label"
												       for="aImplantes"
												       style="color: black"><?php _e("Fones de ouvido", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<label class="form-check-label mr-2"
												       style="color: black; font-weight: 400"
												       for="aImplantesText"><?php _e("Outro", "incluyeme-login-extension"); ?></label>
												<input class="form-check-input" type="text" id="aImplantesText"
												       v-model="aImplante" name="aImplante" placeholder="">
											</x-incluyeme>
										</x-incluyeme>
									</x-incluyeme>
								</div>
							</x-incluyeme>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme v-if='visual' class="card">
						<x-incluyeme class="card-header m-0 p-0" id="headingFive">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse"
								        data-target="#collapseFive"
								        aria-expanded="false" aria-controls="collapseFive">
									<i class="fas fa-arrow-down"></i>
									<h5 style="display:inline;"> Visual</h5>
								
								</button>
							</h5>
						</x-incluyeme>
						<x-incluyeme id="collapseFive" class="collapse" aria-labelledby="headingFive"
						             data-parent="#accordion">
							<x-incluyeme class="card-body">
								<div class="container">
									<x-incluyeme class="row">
										<x-incluyeme class="col-12">
											<span> Você tem dificuldade em distinguir objetos ou textos que estão distantes?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vLejos"
												       value="Sim" v-model="vLejos" name="vLejos">
												<label class="form-check-label"
												       for="vLejos"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vLejosS"
												       value="Não" v-model="vLejos" name="vLejos">
												<label class="form-check-label"
												       for="vLejosS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
								<span>Você tem dificuldade em distinguir objetos ou textos que estão próximos?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vObservar"
												       value="Sim" v-model="vObservar" name="vObservar">
												<label class="form-check-label"
												       for="vObservar"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vObservarS"
												       value="Não" v-model="vObservar" name="vObservar">
												<label class="form-check-label"
												       for="vObservarS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você tem dificuldade em distinguir as cores (daltonismo)?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vColores"
												       value="Sim" v-model="vColores" name="vColores">
												<label class="form-check-label"
												       for="vColores"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vColoresS"
												       value="Não" v-model="vColores" name="vColores">
												<label class="form-check-label"
												       for="vColoresS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você consegue identificar elementos visuais encontrados em planos diferentes, por exemplo: frente ou verso (perspectiva)?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vDPlanos"
												       value="Sim" v-model="vDPlanos" name="vDPlanos">
												<label class="form-check-label"
												       for="vDPlanos"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vDPlanos"
												       value="Não" v-model="vDPlanos" name="vDPlanos">
												<label class="form-check-label"
												       for="vDPlanosS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Você utiliza alguma tecnologia assistiva?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vTecniA"
												       value="Leitores de tela
como Jaws ou NVDA" v-model="vTecniA" name="vTecniA">
												<label class="form-check-label"
												       for="vTecniA"
												       style="color: black"><?php _e("Leitores de tela
como Jaws ou NVDA", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vTecniAS"
												       value="Lupas digitais" v-model="vTecniA"
												       name="vTecniA">
												<label class="form-check-label"
												       for="vTecniAS"
												       style="color: black"><?php _e("Lupas digitais", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vTecniASS"
												       value="Óculos" v-model="vTecniA" name="vTecniAS">
												<label class="form-check-label"
												       for="vTecniASS"
												       style="color: black"><?php _e("Óculos", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<div class="row">
													<div class="col-lg col-md-12">
														<label class="form-check-label mr-2"
														       style="color: black; font-weight: 400"
														       for="vTecniAvAS"><?php _e("Outro", "incluyeme-login-extension"); ?></label>
													</div>
													<div class="col-lg-12 col-md-12">
														<input class="form-check-input" type="text" id="vTecniAvAS"
														       v-model="vTecniA" name="vTecniAvAS"
														       placeholder="Escreva aqui">
													</div>
												</div>
											
											</x-incluyeme>
										</x-incluyeme>
									</x-incluyeme>
								</div>
							</x-incluyeme>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme v-if="intelectual" class="card">
						<x-incluyeme class="card-header m-0 p-0" id="headingFourt">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse"
								        data-target="#collatseFourt"
								        aria-expanded="false" aria-controls="collatseFourt">
									<i class="fas fa-arrow-down"></i>
									<h5 style="display:inline;"> Intelectual</h5>
								
								</button>
							</h5>
						</x-incluyeme>
						<x-incluyeme id="collatseFourt" class="collapse" aria-labelledby="headingFourt"
						             data-parent="#accordion">
							<x-incluyeme class="card-body">
								<div class="container">
									<x-incluyeme class="row">
										<x-incluyeme class="col-12">
											<span>Você sabe ler e escrever?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteEscri"
												       value="Sim" v-model="inteEscri" name="inteEscri">
												<label class="form-check-label"
												       for="inteEscri"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteEscriS"
												       value="Não" v-model="inteEscri" name="inteEscri">
												<label class="form-check-label"
												       for="inteEscriS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você utiliza transporte público para ir ao trabalho, como ônibus, metrô, trem etc?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteTransla"
												       value="Sim" v-model="inteTransla" name="inteTransla">
												<label class="form-check-label"
												       for="inteTransla"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteTranslaS"
												       value="Não" v-model="inteTransla" name="inteTransla">
												<label class="form-check-label"
												       for="inteTranslaS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Te incomoda que te chamem a atenção quando você comete um erro?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteActividad"
												       value="Sim" v-model="inteActividad" name="inteActividad">
												<label class="form-check-label"
												       for="inteActividad"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteActividadS"
												       value="Não" v-model="inteActividad" name="inteActividad">
												<label class="form-check-label"
												       for="inteActividadS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Te incomoda quando as tarefas do seu trabalho mudam constantemente?</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteMolesto"
												       value="Sim" v-model="inteMolesto" name="inteMolesto">
												<label class="form-check-label"
												       for="inteMolesto"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteMolestoS"
												       value="Não" v-model="inteMolesto" name="inteMolesto">
												<label class="form-check-label"
												       for="inteMolestoS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você gosta de trabalhar sozinho?</span>
											</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteTrabajar"
												       value="Sim" v-model="inteTrabajar" name="inteTrabajar">
												<label class="form-check-label"
												       for="inteTrabajar"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="inteTrabajarS"
												       value="Não" v-model="inteTrabajar"
												       name="inteTrabajar">
												<label class="form-check-label"
												       for="inteTrabajarS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<span>Você gosta de trabalhar com outras pessoas?</span>
											</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="inteTrabajarOP"
												       style="transform: scale(1.4) !important;"
												       value="Sim" v-model="inteTrabajarOP" name="inteTrabajarOP">
												<label class="form-check-label"
												       for="inteTrabajarOP"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="inteTrabajarOPS"
												       value="Não" v-model="inteTrabajarOP"
												       name="inteTrabajarOP">
												<label class="form-check-label"
												       for="inteTrabajarOPS"
												       style="color: black"><?php _e("Não", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<span>Onde você mais gosta de trabalhar?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;"
												       id="inteTrabajarSolo"
												       value="Lugares fechados como dentro de um escritório"
												       v-model="inteTrabajarSolo"
												       name="inteTrabajarSolo">
												<label class="form-check-label"
												       for="inteTrabajarSolo"
												       style="color: black"><?php _e("Lugares fechados como dentro de um escritório", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;"
												       id="inteTrabajarSoloS"
												       value="Ambientes exteriores como por exemplo jardins, parques, centros esportivos, etc."
												       v-model="inteTrabajarSolo" name="inteTrabajarSolo">
												<label class="form-check-label"
												       for="inteTrabajarSoloS"
												       style="color: black"><?php _e("Ambientes exteriores como por exemplo jardins, parques, centros esportivos, etc.", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="inteTrabajarSoloS2"
												       value="Tanto Faz" v-model="inteTrabajarSolo"
												       name="inteTrabajarSolo">
												<label class="form-check-label"
												       for="inteTrabajarSoloS2"
												       style="color: black"><?php _e("Tanto Faz", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
									</x-incluyeme>
								</div>
							</x-incluyeme>
						</x-incluyeme>
					</x-incluyeme>
				</x-incluyeme>
				<p v-if="fisica || multipla || auditiva || visual || intelectual">Não é necessário responder a todas
				                                                                  as perguntas listadas acima</p>
				<div class="container mt-1">
					<x-incluyeme class="w-100 ">
						<label id="disCText" for="exampleFormControlTextarea1">Por favor, nos conte mais sobre a sua deficiência
							<span
									style="font-size: 2em;color: black;">*<span></label>
						<textarea class="form-control" id="exampleFormControlTextarea1" v-model="moreDis"
						          rows="3"></textarea>
						<p v-if="validation === 11" style="color: red">Por favor, nos conte mais sobre a sua deficiência</p>
					</x-incluyeme>
				</div>
				<x-incluyeme class="row">
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 w-100 mt-3"
						        @click.prevent="goToStep(5, '<?php echo plugins_url() ?>')">
							Voltar
						</button>
					</x-incluyeme>
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 w-100 mt-3"
						        @click.prevent="goToStep(7, '<?php echo plugins_url() ?>')">Seguinte
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step7" v-if="currentStep == 7">
				<div class="container">
					<h1>Adicione sua Foto, Currículo
					    e <?php echo get_option($incluyemeNames) ? ' ' . get_option($incluyemeNames) : ' Laudo Médico'; ?> </h1>
					<div class="">
						<h3 id="userIMGlabel">Foto de Perfil</h3>
						<x-incluyeme class="row m-auto">
							<x-incluyeme class="col-12">
								<form action="/upload" class="dropzone needsclick dz-clickable" id="demo-upload">
									<div class="dz-message needsclick">
										<button type="button" class="dz-button">Arraste e solte seus arquivos OU clique aqui
										</button>
										<br>
									</div>
									<div>
									</div>
								</form>
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<div class="">
						<h3 id="dropZoneCVLabel">Currículo</h3>
						<x-incluyeme class="row m-auto">
							<x-incluyeme class="col-12">
								<form action="/upload" class="dropzone needsclick dz-clickable" id="CVDROP">
									<div class="dz-message needsclick">
										<button type="button" class="dz-button">Arraste e solte seus arquivos OU clique aqui
										</button>
										<br>
									</div>
								</form>
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<div class="">
						<h3 id="drop-zoneCUDLabel"><?php echo get_option($incluyemeNames) ? get_option($incluyemeNames) : 'Laudo Médico'; ?></h3>
						<x-incluyeme class="row m-auto">
							<x-incluyeme class="col-12">
								<form action="/upload" class="dropzone needsclick dz-clickable" id="CUDDROP">
									<div class="dz-message needsclick">
										<button type="button" class="dz-button">Arraste e solte seus arquivos OU clique aqui
										</button>
										<br>
									</div>
								</form>
							</x-incluyeme>
						</x-incluyeme>
					</div>
				</div>
				<div class="container">
					<x-incluyeme class="row m-auto">
						<x-incluyeme class="col">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3"
							        @click.prevent="goToStep(6, '<?php echo plugins_url() ?>')">
								Voltar
							</button>
						</x-incluyeme>
						<x-incluyeme class="col">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3"
							        @click.prevent="goToStep(8, '<?php echo plugins_url() ?>')">
								Seguinte
							</button>
						</x-incluyeme>
					</x-incluyeme>
				</div>
			</template>
			<template id="step8" v-if="currentStep == 8">
				<div class="container">
					<h1>Educação</h1>
				</div>
				<div v-for="(fieldName, pos) in formFields" :key="pos" class="container">
					<div class="row">
						<x-incluyeme class="col">
							<label for="country_edu"><?php _e("Pais", "incluyeme-login-extension"); ?></label>
							<select id="country_edu" v-model="country_edu[pos]" data-live-search="true"
							        data-container="body" class="form-control selectpicker"
							        v-on:change="getUniversities(pos)">
								<option v-for="(countries, index) of countries" :value="countries.country_code">
									{{countries.country_name}}
								</option>
							</select>
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label for="university_edu"><?php _e("Instituição de Ensino", "incluyeme-login-extension"); ?></label>
							<select id="university_edu" v-model="university_edu[pos]" data-live-search="true"
							        data-container="body" class="form-control selectpicker">
								<option v-for="university in universities[pos]"
								        :value="university.university" v-on:change="changeUniversity(pos, true)">
									{{university.university}}
								</option>
								<option value="Outro">
									Outra
								</option>
							</select>
						</x-incluyeme>
					</div>
					<div class="row mt-2" v-if="university_edu[pos] =='Otro'">
						<x-incluyeme class="col">
							<label for="university_eduText"><?php _e("Outro", "incluyeme-login-extension"); ?></label>
							<input type="text" v-model="university_otro[pos]" class="form-control"
							       id="university_eduText"
							       placeholder="Instituição"
							       v-on:change="changeUniversity(pos, false)">
						</x-incluyeme>
						<x-incluyeme class="col-12"><small>Escreva o nome da sua Instituição Educacional se não
						                                   aparecer
						                                   na
						                                   lista</small></x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label
									for="studies"><?php _e("Área de Estudo", "incluyeme-login-extension"); ?></label>
							<select id="studies" v-model="studies[pos]" data-live-search="true" data-container="body"
							        class="form-control selectpicker">
								<option v-for="(studies, index) of study"
								        :value="studies.id" class="text-capitalize">
									{{studies.name_inc_area}}
								</option>
							</select>
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label for="titleEdu"><?php _e("Título", "incluyeme-login-extension"); ?></label>
							<input type="text" v-model="titleEdu[pos]" class="form-control" id="titleEdu"
							       placeholder="Exemplo: Bacharel em administração">
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label for="eduLevel"><?php _e("Grau de Escolaridade", "incluyeme-login-extension"); ?></label>
							<input type="text" v-model="eduLevel[pos]" class="form-control" id="eduLevel"
							       placeholder="Exemplo: Bacharel">
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col-lg-6 col-md-12">
							<x-incluyeme class="row">
								<x-incluyeme class="col-12">
									<x-incluyeme class="form-group">
										<label for="dateStudiesD"><?php _e("De", "incluyeme-login-extension"); ?></label>
									</x-incluyeme>
								</x-incluyeme>
								<x-incluyeme class="col-12">
									<x-incluyeme class="form-group">
										<input type="date" v-model="dateStudiesD[pos]" name="dateStudiesD"
										       class="form-control"
										       id="dateStudiesD">
									</x-incluyeme>
								</x-incluyeme>
							</x-incluyeme>
						</x-incluyeme>
						<x-incluyeme class="col-lg-6 col-md-12">
							<x-incluyeme class="row">
								<x-incluyeme class="col-12">
									<x-incluyeme class="form-group">
										<label for="dateStudiesH"><?php _e("Até", "incluyeme-login-extension"); ?></label>
									</x-incluyeme>
								</x-incluyeme>
								<x-incluyeme class="col-12">
									<x-incluyeme class="form-group">
										<input v-if="!dateStudieB[pos]" type="date" v-model="dateStudiesH[pos]"
										       name="dateStudiesH"
										       class="form-control"
										       id="dateStudiesH" :disabled="dateStudieB[pos]===true"
										       v-on:change='dateStudieB[pos] = false'>
									</x-incluyeme>
								</x-incluyeme>
								<x-incluyeme class="col-12 ml-3 ml-sm-3 pt-1 ml-lg-1">
									<div class="container">
										<input class="form-check-input" type="checkbox"
										       style="transform: scale(1.4) !important;" :id="dateStudieB[pos]"
										       :name="dateStudieB[pos]"
										       v-model="dateStudieB[pos]" v-on:change='dateStudiesH[pos] = false'>
										<label class="form-check-label"
										       :for="dateStudieB[pos]"
										       style="color: black"><?php _e("Estudo aqui atualmente", "incluyeme-login-extension"); ?></label>
									</div>
								</x-incluyeme>
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<div class='row mt-2'>
						<x-incluyeme class="col-12 text-right mr-0 pr-0">
							<button type="submit" class="btn btn-danger w-100 w-100 mt-3 deleteIncluyeme"
							        @click.prevent="deleteStudies(pos)">
								- Apagar Estudo
							</button>
						</x-incluyeme>
					</div>
					<hr class="w-100" v-if="formFields.length !== 1">
				</div>
				
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col text-center">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3"
							        @click.prevent="addStudies()">
								+ Adicionar Estudo
							</button>
						</x-incluyeme>
				</div>
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3"
							        @click.prevent="goToStep(7, '<?php echo plugins_url() ?>')">
								Voltar
							</button>
						</x-incluyeme>
						<x-incluyeme class="col">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3"
							        @click.prevent="goToStep(9, '<?php echo plugins_url() ?>')">
								Seguinte
							</button>
						</x-incluyeme>
					</x-incluyeme>
				</div>
			</template>
			<template id="step9" v-if="currentStep == 9">
				<div class="container">
					<h1>Experiência Profissional</h1>
				</div>
				<div class="container" v-for="(formFields2, pos) in formFields2" :key="pos">
					<x-incluyeme class="row">
						<x-incluyeme class="col">
							<label for="companies">Empresa</label>
							<input v-model="employed[pos]" type="text" class="form-control" id="companies"
							       placeholder="Empresa">
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col-lg-6 col-md-12">
							<label for="studies" class="">Área</label>
							<select id="studies" v-model="areaEmployed[pos]" data-live-search="true"
							        data-container="body" class="form-control selectpicker">
								<option v-for="(estudies, index) of study"
								        :value="estudies.id" class="text-capitalize">
									{{estudies.name_inc_area}}
								</option>
							</select>
						</x-incluyeme>
						<x-incluyeme class="col-lg-6 col-md-12 mt-2 mt-lg-0">
							<label for="names">Cargo </label>
							<input v-model="jobs[pos]" type="text" class="form-control" id="names"
							       placeholder="Cargo">
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col-lg-6 col-md-12">
							<label for="levelExperience" class="">Experiência Profissional</label>
							<select id="levelExperience" v-model="levelExperience[pos]" data-live-search="true"
							        data-container="body" class="form-control selectpicker">
								<option v-for="(experiences, index) of experiences"
								        :value="experiences.id" class="text-capitalize">
									{{experiences.name_incluyeme_exp}}
								</option>
							</select>
						</x-incluyeme>
						<x-incluyeme class="col-lg-6 col-md-12 ml-3 ml-sm-3 ml-lg-0" style="margin: auto; float: left;">
							<div style="position: relative;  top: 3px;">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;"
								       :id="actuWork[pos]" :name="actuWork[pos]"
								       v-model="actuWork[pos]">
								<label class="form-check-label"
								       :for="actuWork[pos]"
								       style="color: black"><?php _e("Trabalho aqui atualmente", "incluyeme-login-extension"); ?></label>
							</div>
						</x-incluyeme>
					</x-incluyeme>
					<div class="row mt-2">
						<x-incluyeme class="col-lg-6 col-md-12">
							<x-incluyeme class="row">
								<x-incluyeme class="col-12 pr-0">
									<x-incluyeme class="form-group">
										<label for="dateStudiesDLaboral"><?php _e("Início", "incluyeme-login-extension"); ?></label>
									</x-incluyeme>
								</x-incluyeme>
								<x-incluyeme class="col-12 pr-0">
									<x-incluyeme class="form-group">
										<input type="date" v-model="dateStudiesDLaboral[pos]"
										       name="dateStudiesDLaboral"
										       class="form-control"
										       id="dateStudiesDLaboral">
									</x-incluyeme>
								</x-incluyeme>
							</x-incluyeme>
						</x-incluyeme>
						<x-incluyeme class="col-lg-6 col-md-12" v-if="!actuWork[pos]">
							<x-incluyeme class="row">
								<x-incluyeme class="col-12">
									<x-incluyeme class="form-group">
										<label for="dateStudiesHLaboral"><?php _e("Até", "incluyeme-login-extension"); ?></label>
									</x-incluyeme>
								</x-incluyeme>
								<x-incluyeme class="col-12">
									<x-incluyeme class="form-group">
										<input type="date" v-model="dateStudiesHLaboral[pos]"
										       name="dateStudiesHLaboral"
										       class="form-control"
										       id="dateStudiesHLaboral" :disabled="actuWork[pos]===true">
									</x-incluyeme>
								</x-incluyeme>
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col-12">
							<label for="jobsDescript">Descrição do Cargo</label>
							<textarea class="form-control" id="jobsDescript" v-model="jobsDescript[pos]"
							          rows="3"></textarea>
						</x-incluyeme>
					</x-incluyeme>
					<div class="row mt-2">
						<x-incluyeme class="col text-center">
							<button type="submit" class="btn btn-danger w-100 w-100 mt-3 deleteIncluyeme"
							        @click.prevent="deleteExp(pos)">
								- Apagar Experiência
							</button>
						</x-incluyeme>
					</div>
					<hr class="w-100" v-if="formFields2.length !== 1">
				</div>
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col text-center">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3"
							        @click.prevent="addExp()">
								+ Adicionar Experiência
							</button>
						</x-incluyeme>
				</div>
				<x-incluyeme class="row">
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 w-100 mt-3"
						        @click.prevent="goToStep(10, '<?php echo plugins_url() ?>')">
							Seguinte
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step10" v-if="currentStep == 10">
				<div class="container">
					<h1>Idiomas</h1>
				</div>
				<div class="container" v-for="(formFields3, pos) in formFields3" :key="pos">
					<x-incluyeme class="row">
						<x-incluyeme class="col">
							<label for="idioms">Idioma</label>
							<select v-model="idioms[pos]" type="text" data-live-search="true" data-container="body"
							        class="form-control selectpicker" id="idioms"
							        placeholder="Idiomas">
								<option v-for="(idioms, index) of idiom"
								        :value="idioms.id" class="text-capitalize">
									{{idioms.name_idioms}}
								</option>
								<option value="Outro" class="text-capitalize">
									Outro
								</option>
							</select>
							<div class="pt-2">
								<input placeholder="Por favor, insira o idioma" id="idioms"
								       v-model="idiomsOther[pos]" class="form-control" type="text"
								       v-if="idioms[pos] == 'Outro'">
							</div>
						</x-incluyeme>
					
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col">
							<label for="lecLevel" class="">Nível de Leitura</label>
							<select id="lecLevel" v-model="lecLevel[pos]" data-live-search="true" data-container="body"
							        class="form-control selectpicker mt-2">
								<option v-for="(levels, index) of levels"
								        :value="levels.id" class="text-capitalize">
									{{levels.name_level}}
								</option>
							</select>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col">
							<label for="redLevel" class="">Nível de Escrita</label>
							<select id="redLevel" v-model="redLevel[pos]" data-live-search="true" data-container="body"
							        class="form-control selectpicker mt-2">
								<option v-for="(levels, index) of levels"
								        :value="levels.id" class="text-capitalize">
									{{levels.name_level}}
								</option>
							</select>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col">
							<label for="oralLevel" class="">Nível de Conversação</label>
							<select id="oralLevel" v-model="oralLevel[pos]" data-live-search="true"
							        data-container="body" class="form-control selectpicker mt-2">
								<option v-for="(levels, index) of levels"
								        :value="levels.id" class="text-capitalize">
									{{levels.name_level}}
								</option>
							</select>
						</x-incluyeme>
					</x-incluyeme>
					<div class='row mt-2'>
						<x-incluyeme class="col-12 text-right mr-0 pr-0">
							<button type="submit" class="btn btn-danger w-100 w-100 mt-3 deleteIncluyeme"
							        @click.prevent="deleteIdioms(pos)">
								- Apagar Idioma
							</button>
						</x-incluyeme>
					</div>
					<hr class="w-100" v-if="formFields3.length !== 1">
				</div>
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col text-center">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3"
							        @click.prevent="addIdioms()">
								+ Adicionar Idioma
							</button>
						</x-incluyeme>
				</div>
				<x-incluyeme class="row">
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 w-100 mt-3"
						        @click.prevent="goToStep(11, '<?php echo plugins_url() ?>')">
							Seguinte
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step11" v-if="currentStep == 11">
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col text-center">
							<h1>Em qual área você gostaria de trabalhar?</h1>
							<select v-if="currentStep == 11" v-model="preferJobs" type="text" data-live-search="true"
							        data-container="body" class="form-control selectpicker" id="preferJobs">
								<option v-for="(preferJobs, index) of preferJob"
								        :value="preferJobs.id" class="text-capitalize">
									{{preferJobs.jobs_prefers}}
								</option>
							</select>
						</x-incluyeme>
					</x-incluyeme>
				</div>
				<x-incluyeme class="row">
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 w-100 mt-3"
						        @click.prevent="goToStep(10, '<?php echo plugins_url() ?>')">
							Voltar
						</button>
					</x-incluyeme>
					<x-incluyeme class="col">
						<button type="submit" class="btn btn-info w-100 w-100 mt-3"
						        @click.prevent="goToStep(12, '<?php echo plugins_url() ?>')">
							Seguinte
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step12" v-if="currentStep == 12">
				<div class="container">
					<div class="row">
						<div class="col text-center">
							<h1>Onde ouviu falar do Grupo Talento incluir?</h1>
							<textarea placeholder="Onde ouviu falar sobre nós?" class="form-control"
							          id="meetingIncluyeme" v-model="meetingIncluyeme"
							          rows="3"></textarea>
						</div>
					</div>
				</div>
				<x-incluyeme class="row mt-2">
					<x-incluyeme class="col">
						<button type="confirmar" class="btn btn-info w-100"
						        @click.prevent="goToStep(13, '<?php echo plugins_url() ?>')">Finalizar
						</button>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step13" v-if="currentStep == 13">
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col-12 text-center">
							<h1>Agradecemos por se cadastrar!</h1>
							<p>Em breve você será direcionado para a nossa página de vagas!</p>
						</x-incluyeme>
					</x-incluyeme>
				</div>
			</template>
		</div>
		<h1 v-if="noDisPage!==false">Trabalhamos pela inclusão de pessoas com deficiência no mercado de trabalho</h1>
		<div class="container">
			<h5>Campos marcados com um <span
						style="font-size: 2em;color: black;">* </span>
			    são obrigatórios
			</h5>
		</div>
	</div>
</div>
<?php if (get_option($incluyemeLoginGoogle)) { ?>
	<script>
        function onSignIn(googleUser) {
            const profile = googleUser.getBasicProfile();
            app.$data.email = profile.getEmail();
            app.$data.password = profile.getEmail();
            app.$data.passwordConfirm = profile.getEmail();
            app.$data.name = profile.getGivenName();
            app.$data.lastName = profile.getFamilyName();
            app.googleChange('<?php echo plugins_url() ?>');
        }
	</script>

<?php } ?>

