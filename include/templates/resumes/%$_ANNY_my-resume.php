<?php
$js = plugins_url() . '/incluyeme-login-extension/include/assets/js/';
$img = plugins_url() . '/incluyeme-login-extension/include/assets/img/incluyeme-place.svg';
$css = plugins_url() . '/incluyeme-login-extension/include/assets/css/';
wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', ['jquery'], '1.0.0');
wp_register_script('bootstrapJs', $js . 'bootstrap.min.js', ['jquery', 'popper'], '1.0.0');
wp_register_script('dropZ', $js . 'dropzone.min.js', ['jquery', 'popper'], '1.0.0');
wp_register_script('FAwesome', $js . 'fAwesome.js', [], '1.0.0', false);
wp_register_script('maskmoney', $js . 'jquery.maskMoney.js');
wp_register_script('mascaras', $js . 'jquery.mask.min.js');
wp_register_script('vueJS', $js . 'vueDEV.js', ['bootstrapJs'], '1.0.0');
wp_register_script('Axios', $js . 'axios.min.js', [], '2.0.0');
wp_register_script('bootstrap-notify', $js . 'iziToast.js', ['bootstrapJs'], '2.0.0');
//wp_register_script('materializeJS', $js . 'materialize.min.js');

wp_register_style('bootstrap-css', $css . 'bootstrap.min.css', [], '1.0.0', false);
wp_register_style('bootstrap-notify-css', $css . 'iziToast.min.css', [], '1.0.0', false);
wp_register_style('dropzone-css', $css . 'dropzone.min.css', [], '1.0.0', false);

wp_enqueue_script('popper');
wp_enqueue_script('bootstrapJs');
wp_enqueue_script('vueJS');
wp_enqueue_script('bootstrap-notify');
wp_enqueue_script('maskmoney');
wp_enqueue_script('mascaras');
wp_enqueue_script('vueH', $js . 'vueRFinish2.0.4.js', ['vueJS', 'FAwesome', 'dropZ'], date("h:i:s"), true);
wp_enqueue_script('dropZ');
wp_enqueue_script('Axios');
//wp_enqueue_script('materializeJS');

wp_enqueue_style('bootstrap-css');
wp_enqueue_style('dropzone-css');
wp_enqueue_style('bootstrap-notify-css');
$baseurl = wp_upload_dir();
$baseurl = $baseurl['baseurl'];
$incluyemeNames = 'incluyemeNamesCV';
$incluyemeGoogleAPI = get_option($incluyemeLoginGoogle);
$FBappId = get_option($incluyemeLoginFB);
$FBversion = 'v7';
$incluyemeLoginFB = 'incluyemeLoginFB';
$incluyemeLoginGoogle = 'incluyemeLoginGoogle';
$incluyemeLoginCountry = 'incluyemeLoginCountry';
$incluyemeLoginEstado = 'incluyemeLoginEstado';
?>
	<style>
        #main-content .container:before {
            background: none !important;
        }
        .dropzone {
            border: 2px dashed rgba(0, 0, 0, .3) !important;
            border-radius: 20px !important;
            color: rgba(0, 0, 0, .3) !important;
            margin-top: 2em !important;
            margin-bottom: 2em !important;
        }

        .deleteIncluyeme {
            background-color: #ee7566 !important;
            border-color: #ee7566 !important;
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
        },
        .btn-link {
            color: black !important;
        }

        .btn-link:hover,
        .btn-link:focus,
        .btn-link:active,
        .btn-link.active {
            background: none !important;
        }
	
	</style>
<?php if ($_SESSION['errro-applications-incluyeme'] !== null) { ?>
	<div class="wpjb-flash-error">
		<span class="wpjb-glyphs wpjb-icon-ok"><?php echo $_SESSION; ?></span>
	</div>
<?php } ?>
	<div id="incluyeme-login-wpjb">
		<div class="container">
			<template id="step2">
				<x-incluyeme class="container text-center">
					<h1>Qual o seu nome?</h1>
				</x-incluyeme>
				<x-incluyeme class="row">
					<x-incluyeme class="form-group col-12">
						<label id="nameLabel" for="names">Nome <span
									style="font-size: 2em;color: black;">*<span></label>
						<input v-model="name" type="text" class="form-control" id="names"
						       placeholder="Ingresa tus nombres" onkeydown="return /[a-z, ]/i.test(event.key)">
						<p v-if="validation === 5" style="color: red">Por favor, insira seu nome</p>
					</x-incluyeme>
					<x-incluyeme class="form-group col-12">
						<label id="lastNamesLabel" for="lastNames">Sobrenome <span
									style="font-size: 2em;color: black;">*<span></label>
						<input v-model="lastName" type="text" class="form-control" id="lastNames"
						       placeholder="insira seu sobrenome" onkeydown="return /[a-z, ]/i.test(event.key)">
						<p v-if="validation === 6" style="color: red">Por favor, insira seu sobrenome</p>
					</x-incluyeme>
				</x-incluyeme>
			</template>
			<template id="step3">
				<x-incluyeme class="container text-center">
					<h1>Qual seu g??nero e data de nascimento?</h1>
				</x-incluyeme>
				<x-incluyeme class="row">
					<x-incluyeme class="col-12">
						<p id="genreP">G??nero <span style="font-size: 2em;color: black;">*<span></p>
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
							       value="N??o Bin??rio" v-model="genre">
							<label class="form-check-label"
							       for="inlineCheckbox3"
							       style="color: black"><?php _e("N??o Bin??rio", "incluyeme-login-extension"); ?></label>
						</x-incluyeme>
						<p v-if="validation === 7" style="color: red">Por favor, insira o g??nero que voc?? mais se identifica</p>
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
			</template>
			<template id="step4">
				<x-incluyeme class="container text-center">
					<h1>Contato</h1>
				</x-incluyeme>
				<div class="container">
					<label id="labelPhone"
					       for="mPhone"><?php _e("Telefone Celular <span style='font-size: 2em;color: black;'>*<span>", "incluyeme-login-extension"); ?></label>
					<x-incluyeme class="row align-items-center">
						<x-incluyeme class="col-lg-4 col col-md-12 mb-3 mb-sm-0">
							<input type="number" min='0' v-model="mPhone" class="form-control" id="mPhone"
							       placeholder="C??digo da ??rea">
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
							       placeholder="C??digo da ??rea">
						</x-incluyeme>
						<x-incluyeme class="col-1 text-center d-none d-lg-block">
							<span><b>-</b></span>
						</x-incluyeme>
						<x-incluyeme class="col-lg-7 col-md-12">
							<label for="Fone" style="display: none"></label>
							<input type="number" min='0' v-model="fiPhone" class="form-control" id="Fone"
							       placeholder="Telefono Fixo">
						</x-incluyeme>
					</x-incluyeme>
				
				</div>
            			<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label for="cep"><?php _e("CEP", "incluyeme-login-extension"); ?></label>
								<input v-model="cep" type="text" class="form-control cep" id="cep" @keyup="load_cep()">
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label id="labelState"
								       for="state"><?php _e((get_option($incluyemeLoginEstado) ? get_option($incluyemeLoginEstado) : ' Provincia/Estado') . "<span style='font-size: 2em;color: black;'>*</span>", "incluyeme-login-extension"); ?></label>
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
								       for="city"><?php _e("Cidade <span style='font-size: 2em;color: black;'>*</span>", "incluyeme-login-extension"); ?></label>
								<input v-model="city" type="text" class="form-control" id="city">
								<p v-if="validation === 11" style="color: red">Por favor, insira sua cidade</p>
							</x-incluyeme>
						</x-incluyeme>
					</div>
					<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label for="bairro"><?php _e("Bairro", "incluyeme-login-extension"); ?></label>
								<input v-model="bairro" type="text" class="form-control" id="bairro">
							</x-incluyeme>
						</x-incluyeme>
					</div>

				<div class="container mt-3 mb-sm-0">
					<x-incluyeme class="row align-items-center">
						<x-incluyeme class="form-group col">
							<label for="street"><?php _e("Endere??o", "incluyeme-login-extension"); ?></label>
							<input v-model="street" type="text" class="form-control" id="street">
						</x-incluyeme>
					</x-incluyeme>
				</div>
				<div class="container mt-3 mb-sm-0">
						<x-incluyeme class="row align-items-center">
							<x-incluyeme class="form-group col">
								<label for="numero"><?php _e("N??mero", "incluyeme-login-extension"); ?></label>
								<input v-model="numero" type="text" class="form-control" id="numero">
							</x-incluyeme>
						</x-incluyeme>
					</div>
			</template>
			<template id="step5">
				<x-incluyeme class="container text-center">
					<h1>Voc?? tem defici??ncia? <span style="font-size: 2em;color: black;">*<span></h1>
				</x-incluyeme>
				<div class="container">
					<h5 id="disSelects">Indique quais</h5>
					<div class="container m-auto">
						<x-incluyeme class="row ml-5">
							<x-incluyeme class="col mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="fisica" id="Fisica">
								<label class="form-check-label" for="Fisica">
									F??sica
								</label>
							</x-incluyeme>
							<x-incluyeme class="col-lg-6 col-md-12 mb-2 mb-sm-0">
								<input class="form-check-input" type="checkbox"
								       style="transform: scale(1.4) !important;" v-model="multipla" id="Multipla"
								       name="M??ltipla">
								<label class="form-check-label" for="Multipla">
									M??ltipla
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
						<p v-if="validation === 12" style="color: red">Por favor, nos diga mais sobre sua
						                                               defici??ncia</p>
					</div>
				</div>
			</template>
			<template id="step6">
				<x-incluyeme id="accordion">
				<x-incluyeme v-if="fisica" class="card">
						<x-incluyeme class="card-header p-0 m-0" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-link " data-toggle="collapse"
								        data-target="#collapseOne"
								        aria-expanded="true" aria-controls="collapseOne">
									<i class="fas fa-arrow-down"></i>
									<h5 style="display:inline;"> F??sica</h5>
								</button>
							</h5>
						</x-incluyeme>
						
						<x-incluyeme id="collapseOne" class="collapse show" aria-labelledby="headingOne"
						             data-parent="#accordion">
							<x-incluyeme class="card-body">
								<div class="container">
									<x-incluyeme class="row">
										<x-incluyeme class="col-12">
											<span>Voc?? consegue ficar de p?? sem se apoiar por mais de uma hora?</span><br>
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
												       value="N??o" v-model="mPie" name="mPie">
												<label class="form-check-label"
												       for="mPie"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? consegue ficar sentado sem se apoiar por mais de uma hora? </span><br>
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
												       value="N??o" v-model="mSen" name="mSen">
												<label class="form-check-label"
												       for="mSen"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? consegue subir ou descer escadas sem a ajuda de algu??m?</span><br>
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
												       value="N??o" v-model="mEsca" name="mEsca">
												<label class="form-check-label"
												       for="mEsca"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? consegue movimentar seus bra??os?
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
												       value="N??o" v-model="mBrazo" name="mBrazo">
												<label class="form-check-label"
												       for="mBrazo"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? consegue segurar peso sem a ajuda de algu??m?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="peso"
												       value="N??o" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="peso"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="pesoKg"
												       value="At?? 5 Kg" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="pesoKg"
												       style="color: black"><?php _e("At?? 5 Kg", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="peso10"
												       value="At?? 10 Kg" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="peso10"
												       style="color: black"><?php _e("At?? 10 Kg", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="peso20"
												       value="At?? 20 Kg" v-model="peso" name="peso">
												<label class="form-check-label"
												       for="peso20"
												       style="color: black"><?php _e("At?? 20 Kg", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? ?? cadeirante?
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
												       value="N??o" v-model="mRueda" name="mRueda">
												<label class="form-check-label"
												       for="mRueda"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? utiliza de alguma ajuda t??cnica para se movimentar?
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
											<br><span>Voc?? consegue digitar no teclado sem a ajuda de algum aparelho
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
												       value="N??o" v-model="mDigi" name="mDigi">
												<label class="form-check-label"
												       for="mDigi"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
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
									<h5 style="display:inline;"> M??ltipla</h5>
								
								</button>
							</h5>
						</x-incluyeme>
						<x-incluyeme id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
						             data-parent="#accordion">
							<div class="card-body">
								<div class="container">
									<x-incluyeme class="row">
										<x-incluyeme class="col-12">
											<span>Defici??ncia F??sica</span><br>
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
												       value="N??o" v-model="vHumedos" name="vHumedos">
												<label class="form-check-label"
												       for="vHumedosS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Defici??ncia Intelectual </span><br>
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
												       value="N??o" v-model="vTemp" name="vTemp">
												<label class="form-check-label"
												       for="vTempN"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Defici??ncia Mental</span><br>
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
												       value="N??o" v-model="vPolvo" name="vPolvo">
												<label class="form-check-label"
												       for="vPolvov"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<!--
										<x-incluyeme class="col-12">
										<span>Defici??ncia Intelectual</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vCompleta"
												       value="Sim" v-model="vCompleta" name="vCompleta">
												<label class="form-check-label"
												       for="vCompleta"
												       style="color: black"><?php _e("Sim", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vCompletaS"
												       value="N??o" v-model="vCompleta" name="vCompleta">
												<label class="form-check-label"
												       for="vCompletaS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										-->
										<x-incluyeme class="col-12">
											<br><span>Defici??ncia Sensorial</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vAdap"
												       value="Visual" v-model="vAdap" name="vAdap">
												<label class="form-check-label"
												       for="vAdap"
												       style="color: black"><?php _e("Visual", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vAdapS"
												       value="Auditiva" v-model="vAdap" name="vAdap">
												<label class="form-check-label"
												       for="vAdapS"
												       style="color: black"><?php _e("Auditiva", "incluyeme-login-extension"); ?></label>
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
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vAdapOut"
												       value="Outro" v-model="vAdap" name="vAdap">
												<label class="form-check-label"
												       for="vAdapOut"
												       style="color: black"><?php _e("Outro", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>										

											<x-incluyeme class="form-check form-check-inline">
												<label class="form-check-label mr-2"
												       style="color: black; font-weight: 400"
												       for='vAdapText'><?php _e("Descreva aqui", "incluyeme-login-extension"); ?></label>
												<input class="form-check-input" type="text" id="vAdapText"
												       v-model="vAdapText" name="vAdapText"
												       placeholder="Escreva aqui">
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
											<span>Voc?? consegue discriminar diferentes sons no ambiente?</span><br>
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
												       value="N??o" v-model="aAmbient" name="aAmbient">
												<label class="form-check-label"
												       for="aAmbientS"
												       style="color: black"> <?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? se comunica oralmente?</span><br>
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
												       value="N??o" v-model="aOral" name="aOral">
												<label class="form-check-label"
												       for="aOralN"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? utiliza l??ngua de sinais (Libras) para se comunicar?</span><br>
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
												       value="N??o" v-model="aSennas" name="aSennas">
												<label class="form-check-label"
												       for="aSennasS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? utiliza a leitura labial para se comunicar?
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
												       value="N??o" v-model="aLabial" name="aLabial">
												<label class="form-check-label"
												       for="aLabialS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Em um ambiente com diferentes ru??dos (por exemplo, no escrit??rio) voc?? consegue estabelecer uma comunica????o oral clara com outra pessoa?</span><br>
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
												       value="N??o" v-model="aBajo" name="aBajo">
												<label class="form-check-label"
												       for="aBajoS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? consegue estabelecer uma comunica????o clara por telefone (sem o uso de mensagens ou chat)?</span><br>
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
												       value="N??o" v-model="aFluida" name="aFluida">
												<label class="form-check-label"
												       for="aFluidaS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? utiliza algum aparelho assistivo para se comunicar?</span><br>
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
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="aImplant"
												       value="Outro" v-model="aImplante" name="aImplante">
												<label class="form-check-label"
												       for="aImplant"
												       style="color: black"><?php _e("Outro", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check form-check-inline">
												<label class="form-check-label mr-2"
												       style="color: black; font-weight: 400"
												       for="aImplantesText"><?php _e("Descreve qual aparelho", "incluyeme-login-extension"); ?></label>
												<input class="form-check-input" type="text" id="aImplantesText"
												       v-model="aImplanteText" name="aImplanteText" placeholder="">
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
											<span> Voc?? tem dificuldade em distinguir objetos ou textos que est??o distantes?</span><br>
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
												       value="N??o" v-model="vLejos" name="vLejos">
												<label class="form-check-label"
												       for="vLejosS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? tem dificuldade em distinguir objetos ou textos que est??o pr??ximos?</span><br>
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
												       value="N??o" v-model="vObservar" name="vObservar">
												<label class="form-check-label"
												       for="vObservarS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? tem dificuldade em distinguir as cores (daltonismo)?</span><br>
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
												       value="N??o" v-model="vColores" name="vColores">
												<label class="form-check-label"
												       for="vColoresS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<br><span>Voc?? consegue identificar elementos visuais encontrados em planos diferentes, por exemplo: frente ou verso (perspectiva)?
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
												       value="N??o" v-model="vDPlanos" name="vDPlanos">
												<label class="form-check-label"
												       for="vDPlanosS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
										<br><span>Voc?? utiliza alguma tecnologia assistiva?
										</span><br>
											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vTecniA"
												       value="Leitores de tela como Jaws ou NVDA" v-model="vTecniA" name="vTecniA">
												<label class="form-check-label"
												       for="vTecniA"
												       style="color: black"><?php _e("Leitores de tela como Jaws ou NVDA", "incluyeme-login-extension"); ?></label>
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
												       value="??culos" v-model="vTecniA" name="vTecniA">
												<label class="form-check-label"
												       for="vTecniASS"
												       style="color: black"><?php _e("??culos", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>

											<x-incluyeme class="form-check form-check-inline">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;" id="vTecniASSS"
												       value="Outro" v-model="vTecniA" name="vTecniA">
												<label class="form-check-label"
												       for="vTecniASSS"
												       style="color: black"><?php _e("Outro", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											
											<x-incluyeme class="form-check form-check-inline">
													<label class="form-check-label mr-2"
													       style="color: black; font-weight: 400"
													       for="vTecniAvText"><?php _e("Descreva aqui", "incluyeme-login-extension"); ?></label>
													<input class="form-check-input" type="text" id="vTecniAvText"
													       v-model="vTecniAvText" name="vTecniAvText"
													       placeholder="Escreva aqui">											
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
											<span>Voc?? sabe ler e escrever?</span><br>
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
												       value="N??o" v-model="inteEscri" name="inteEscri">
												<label class="form-check-label"
												       for="inteEscriS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? utiliza transporte p??blico para ir ao trabalho, como ??nibus, metr??, trem etc?</span><br>
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
												       value="N??o" v-model="inteTransla" name="inteTransla">
												<label class="form-check-label"
												       for="inteTranslaS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Te incomoda que te chamem a aten????o quando voc?? comete um erro?</span><br>
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
												       value="N??o" v-model="inteActividad" name="inteActividad">
												<label class="form-check-label"
												       for="inteActividadS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Te incomoda quando as tarefas do seu trabalho mudam constantemente?</span><br>
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
												       value="N??o" v-model="inteMolesto" name="inteMolesto">
												<label class="form-check-label"
												       for="inteMolestoS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? gosta de trabalhar sozinho?</span><br>
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
												       value="N??o" v-model="inteTrabajar"
												       name="inteTrabajar">
												<label class="form-check-label"
												       for="inteTrabajarS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Voc?? gosta de trabalhar com outras pessoas?</span><br>
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
												       style="transform: scale(1.4) !important;"
												       value="N??o" v-model="inteTrabajarOP"
												       name="inteTrabajarOP">
												<label class="form-check-label"
												       for="inteTrabajarOPS"
												       style="color: black"><?php _e("N??o", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
										</x-incluyeme>
										<x-incluyeme class="col-12">
											<br><span>Onde voc?? mais gosta de trabalhar?</span><br>
											<x-incluyeme class="form-check">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;"
												       id="inteTrabajarSolo"
												       value="Lugares fechados como dentro de um escrit??rio"
												       v-model="inteTrabajarSolo"
												       name="inteTrabajarSolo">
												<label class="form-check-label"
												       for="inteTrabajarSolo"
												       style="color: black"><?php _e("Lugares fechados como dentro de um escrit??rio", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check">
												<input class="form-check-input" type="radio"
												       style="transform: scale(1.4) !important;"
												       id="inteTrabajarSoloS"
												       value="Ambientes exteriores como por exemplo jardins, parques, centros esportivos, etc."
												       v-model="inteTrabajarSolo" name="inteTrabajarSolo">
												<label class="form-check-label"
												       for="inteTrabajarSoloS"
												       style="color: black"><?php _e("Ambientes exteriores como por exemplo jardins, parques, centros esportivos, etc.", "incluyeme-login-extension"); ?></label>
											</x-incluyeme>
											<x-incluyeme class="form-check">
												<input class="form-check-input" type="radio" id="inteTrabajarSoloS2"
														style="transform: scale(1.4) !important;"
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
				<p v-if="fisica || multipla || auditiva || visual || intelectual">N??o ?? necess??rio responder a todas as
				                                                                  perguntas listadas acima</p>
				<div class="container mt-1">
					<x-incluyeme class="w-100 ">
						<label id="disCText" for="exampleFormControlTextarea1">Por favor, nos conte mais sobre a sua defici??ncia
							<span
									style="font-size: 2em;color: black;">*<span></label>
						<textarea class="form-control" id="exampleFormControlTextarea1" v-model="moreDis"
						          rows="3"></textarea>
						<p v-if="validation === 11" style="color: red">Por favor, nos conte mais sobre a sua
						                                               defici??ncia</p>
					</x-incluyeme>
				</div>
			</template>
			<template id="step7">
				<div class="container">
					<h1>Adicione sua Foto, Curr??culo
					    e <?php echo get_option($incluyemeNames) ? ' ' . get_option($incluyemeNames) : ' Laudo m??dico'; ?> </h1>
					<div class="">
						<a :href="myIMG" id="userIMGlabel">Foto de Perfil</a>
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
						<a :href="myCV" id="dropZoneCVLabel">Curriculum Vitae</a>
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
						<a :href="myCUD"
						   id="drop-zoneCUDLabel"><?php echo get_option($incluyemeNames) ? get_option($incluyemeNames) : 'Laudo M??dico'; ?></a>
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
			</template>
			<template id="step8">
				<div class="container">
					<h1>Educa????o</h1>
				</div>
				<div v-for="(fieldName, pos) in formFields" :key="pos" class="container">
					<div class="row">
						<x-incluyeme class="col">
							<label for="country_edu"><?php _e("Pais", "incluyeme-login-extension"); ?></label>
							<select id="country_edu" v-model="country_edu[pos]" class="form-control"
							        v-on:change="getUniversities(pos)">
								<option v-for="(countries, index) of countries" :value="countries.country_code">
									{{countries.country_name}}
								</option>
							</select>
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label for="university_edu"><?php _e("Institui????o Educacional", "incluyeme-login-extension"); ?></label>
							<select id="university_edu" v-model="university_edu[pos]" class="form-control">
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
					<div class="row mt-2" v-if="university_edu[pos] =='Outro'">
						<x-incluyeme class="col">
							<label for="university_eduText"><?php _e("Outro", "incluyeme-login-extension"); ?></label>
							<input type="text" v-model="university_otro[pos]" class="form-control"
							       id="university_eduText"
							       placeholder="Instituci??n"
							       v-on:change="changeUniversity(pos, false)">
						</x-incluyeme>
						<x-incluyeme class="col-12"><small>Escreva o nome da sua institui????o educacional se n??o
						                                   aparecer
						                                   na lista abaixo</small></x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label
									for="studies"><?php _e("??rea de Estudo", "incluyeme-login-extension"); ?></label>
							<select id="studies" v-model="studies[pos]" class="form-control">
								<option v-for="(studies, index) of study"
								        :value="studies.id" class="text-capitalize">
									{{studies.name_inc_area}}
								</option>
							</select>
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label for="titleEdu"><?php _e("T??tulo", "incluyeme-login-extension"); ?></label>
							<input type="text" v-model="titleEdu[pos]" class="form-control" id="titleEdu"
							       placeholder="Exemplo: Bacharel em Administra????o">
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col">
							<label for="eduLevel"><?php _e("Nivel Educativo", "incluyeme-login-extension"); ?></label>
							<input type="text" v-model="eduLevel[pos]" class="form-control" id="eduLevel"
							       placeholder="Exemplo: Bacharel">
						</x-incluyeme>
					</div>
					<div class="row mt-2">
						<x-incluyeme class="col-lg-6 col-md-12">
							<x-incluyeme class="row">
								<x-incluyeme class="col-12">
									<x-incluyeme class="form-group">
										<label for="dateStudiesD"><?php _e("In??cio", "incluyeme-login-extension"); ?></label>
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
										<label for="dateStudiesH"><?php _e("At??", "incluyeme-login-extension"); ?></label>
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
										       style="color: black"><?php _e("Trabalho aqui atualmente", "incluyeme-login-extension"); ?></label>
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
			</template>
		<template id="step9">
				<div class="container">
					<h1>Experi??ncia Profissional</h1>
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
							<label for="studies" class="">??rea</label>
							<select id="studies" v-model="areaEmployed[pos]" class="form-control">
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
							<label for="studies" class="">Experi??ncia Profissional</label>
							<select id="studies" v-model="levelExperience[pos]" class="form-control">
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
								       style="color: black"><?php _e("Trabalha aqui atualmente?", "incluyeme-login-extension"); ?></label>
							</div>
						</x-incluyeme>
					</x-incluyeme>
					<div class="row mt-2">
						<x-incluyeme class="col-lg-6 col-md-12">
							<x-incluyeme class="row">
								<x-incluyeme class="col-12 pr-0">
									<x-incluyeme class="form-group">
										<label for="dateStudiesDLaboral"><?php _e("In??cio", "incluyeme-login-extension"); ?></label>
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
						<x-incluyeme class="col-12 ml-3 ml-sm-3 pt-1 ml-lg-1">
									<div class="container">
										<input class="form-check-input" type="checkbox"
										       style="transform: scale(1.4) !important;"
										       :id="actuWork[pos]" :name="actuWork[pos]"
										       v-model="actuWork[pos]" v-on:change='dateStudiesHLaboral[pos] = false'>
										<label class="form-check-label"
										       :for="actuWork[pos]"
										       style="color: black"><?php _e("Trabalho aqui atualmente", "incluyeme-login-extension"); ?></label>
									</div>
					  </x-incluyeme>
					</div>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col-12">
							<label for="jobsDescript">Descri????o do Cargo</label>
							<textarea class="form-control" id="jobsDescript" v-model="jobsDescript[pos]"
							          rows="3"></textarea>
						</x-incluyeme>
					</x-incluyeme>
					<div class="row mt-2">
						<x-incluyeme class="col text-center">
							<button type="submit" class="btn btn-danger w-100 w-100 mt-3 deleteIncluyeme"
							        @click.prevent="deleteExp(pos)">
								- Apagar Experi??ncia
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
								+ Adicionar Experi??ncia
							</button>
						</x-incluyeme>
				</div>
			</template>
			<template id="step10">
				<div class="container">
					<h1>Idiomas</h1>
				</div>
				<div class="container" v-for="(formFields3, pos) in formFields3" :key="pos">
					<x-incluyeme class="row">
						<x-incluyeme class="col">
							<label for="idioms">Idioma</label>
							<select v-model="idioms[pos]" type="text" class="form-control" id="idioms"
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
								<input placeholder="Por favor, escriba el nombre del idioma" id="idioms"
								       v-model="idiomsOther[pos]" class="form-control" type="text"
								       v-if="idioms[pos] == 'Outro'">
							</div>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col">
							<label for="lecLevel" class="">N??vel de Leitura</label>
							<select id="lecLevel" v-model="lecLevel[pos]" class="form-control mt-2">
								<option v-for="(levels, index) of levels"
								        :value="levels.id" class="text-capitalize">
									{{levels.name_level}}
								</option>
							</select>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col">
							<label for="redLevel" class="">Nivel de Escrita</label>
							<select id="redLevel" v-model="redLevel[pos]" class="form-control mt-2">
								<option v-for="(levels, index) of levels"
								        :value="levels.id" class="text-capitalize">
									{{levels.name_level}}
								</option>
							</select>
						</x-incluyeme>
					</x-incluyeme>
					<x-incluyeme class="row mt-2">
						<x-incluyeme class="col">
							<label for="oralLevel" class="">N??vel de Conversa????o</label>
							<select id="oralLevel" v-model="oralLevel[pos]" class="form-control mt-2">
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
			</template>
			<template id="step11">
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col text-center">
							<h1>Em qual ??rea voc?? gostaria de trabalhar?</h1>
							<select v-model="preferJobs" type="text" class="form-control" id="preferJobs">
								<option v-for="(preferJobs, index) of preferJob"
								        :value="preferJobs.id" class="text-capitalize">
									{{preferJobs.jobs_prefers}}
								</option>
							</select>
						</x-incluyeme>
					</x-incluyeme>
				</div>
			</template>
			<template id="step12">
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col text-center">
							<h1>De onde ouviu falar do Grupo Talento incluir?</h1>
							<textarea placeholder="Nos conte como nos conheceu" v-model="meetingIncluyeme" rows="3"
							          type="text" class="form-control" id="meetingIncluyeme"></textarea>
						</x-incluyeme>
					</x-incluyeme>
				</div>
			</template>
			<template id="step11">
				<div class="container">
					<x-incluyeme class="row">
						<x-incluyeme class="col text-center">
							<button type="submit" class="btn btn-info w-100 w-100 mt-3" @click.prevent="actualizar()">
								Atualizar
							</button>
						</x-incluyeme>
				</div>
			</template>
		</div>
	</div>
	
	<script>
        function startApp() {
            app.setID('<?php echo $resume->id ?>', '<?php echo plugins_url() ?>');
            app.dropzone('<?php echo plugins_url() ?>');
        }
	</script>
<?php
$_SESSION['errro-applications-incluyeme'] = null;
?>
