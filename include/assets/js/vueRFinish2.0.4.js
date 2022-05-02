/*
 * Copyright (c) 2020
 *
 * Developer by Jesus Nuñez <jesus.nunez2050@gmail.com> .
 */
Vue.config.ignoredElements = ['x-incluyeme', 'fb:login-button']
let app = new Vue({
    el: '#incluyeme-login-wpjb',
    data: {
        userID: null,
        dateStudiesDLaboral: [],
        dateStudiesHLaboral: [],
        url: null,
        countries: [],
        universities: [],
        passwordConfirm: null,
        genre: null,
        name: '',
        email: null,
        password: null,
        validation: null,
        street: null,
        idiomsOther: [],
        lastName: null,
        formFields3: [],
        dateBirthDay: null,
        disCap: null,
        idioms: null,
        levels: null,
        university_otro: [],
        disClass: 'w-100',
        mPhone: null,
        country: null,
        dateStudiesD: [],
        dateStudieB: [],
        titleEdu: [],
        preferJob: [],
        preferJobs: null,
        eduLevel: [],
        formFields: [],
        phone: null,
        jobs: [],
        jobsSalario: [],
        levelExperience: [],
        actuWork: [],
        fPhone: null,
        fiPhone: null,
        mPie: null,
        mSen: null,
        mEsca: null,
        mBrazo: null,
        peso: null,
        mRueda: null,
        mBrazo: null,
        desplazarte: null,
        mDigi: null,
        vHumedos: null,
        vTemp: null,
        vPolvo: null,
        vCompleta: null,
        vAdap: null,
        vAdapText: null,
        aAmbient: null,
        aOral: null,
        aSennas: null,
        aLabial: null,
        aBajo: null,
        aImplante: null,
        aImplanteText: null,
        vLejos: null,
        jobsDescript: [],
        vObserlet: null,
        vTemp: null,
        universities: [],
        vColores: null,
        vDPlanos: null,
        vTecniA: null,
        vTecniAvText: null,
        formFields2: [],
        areaEmployed: [],
        inteEscri: null,
        inteTransla: null,
        inteTarea: null,
        inteActividad: null,
        inteMolesto: null,
        employed: [],
        inteTrabajar: null,
        inteTrabajarSolo: null,
        inteTrabajarOP: null,
        moreDis: null,
        dateBirthDay: null,
        mental: false,
        surdocegueira: false,
        intelectual: false,
        multipla: false,
        visual: false,
        vObservar: null,
        city: null,
        bairro: null,
        cep: null,
        numero: null,
        experiences: null,
        auditiva: false,
        fisica: false,
        image: null,
        img: null,
        dateStudiesH: [],
        reader: null,
        cv: null,
        cvSHOW: null,
        cvReader: null,
        cud: null,
        cudSHOW: null,
        cudReader: null,
        state: null,
        currentStep: 1,
        country_edu: [],
        university_edu: [],
        studies: [],
        study: [],
        idioms: [],
        idiom: [],
        lecLevel: [],
        redLevel: [],
        oralLevel: [],
        awaitChange: false,
        myCV: null,
        myCUD: null,
        myIMG: null,
        provincias: [],
        cities: [],
        aFluida: null,
        meetingIncluyeme: null,
    },
    ready: function () {
        console.log('ready');
    },
    mounted() {
        const incluyemeContent = document.getElementById("content");
        const incluyemeSidebar = document.getElementById("sidebar");
        const incluyemeTitle = document.getElementsByClassName("container  right-sidebar  right-sidebar  has-title");
        if (incluyemeContent && incluyemeSidebar && incluyemeTitle) {
            incluyemeContent.classList.add("col-9");
            incluyemeSidebar.classList.add("col");
            incluyemeSidebar.classList.add("ml-5");
            incluyemeTitle[0].className += " row";
        }
         jQuery('.cep').mask('99999-999');
         jQuery('.fixo').mask('0000-0000');
         jQuery('.celular').mask('99999-9999');
    },
    methods: {
          load_cep: function (event) {
            if(this.cep.length == 9) {
                var url_cep, self;
                if (event) {
                    event.preventDefault();
                }
                cep = this.cep.trim().replace(/[^0-9]/g, '');
                url_cep = 'https://viacep.com.br/ws/' + cep + '/json';
                // clear all headers axios to viacep
                axios.defaults.headers.common = null;
                axios.get(url_cep).then(function (response) {
                    this.street = response.data.logradouro;
                    this.bairro = response.data.bairro;
                    this.state = response.data.uf;
                    this.city = response.data.localidade;
                    jQuery("#numero").focus();
                }.bind(this)).catch(function (error) {
                    console.log(error.statusText);
                });
            }
        },
        setID: async function (userID, url) {
            this.url = url;
            this.userID = userID;
            this.getLevelsIdioms().finally();
            this.getIdioms().finally();
            this.getCountries().finally();
            this.getStudies().finally();
            this.getExperiences().finally();
            this.getPrefersJobs().finally();
            this.getProvincias().finally();
            this.pleaseAwait();
            let data = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/verifications/resume.php?user=' + userID,
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            
            const information = data.message.information;
            const works = data.message.work;
            const studies = data.message.education;
            const idioms = data.message.idioms;
            const endereco = data.message.endereco;
            const resume = data.message.resume;
            const discap = data.message.discap;
            const assets = data.message.assets;
            const discapsSelected = data.message.discapsSelected;
           
            this.myCV = assets[2];
            this.myCUD = assets[1];
            this.myIMG = assets[0];
            this.name = data.message.name;
             this.lastName = data.message.last_name;
            if(information !== null){
                this.meetingIncluyeme = information.meeting_incluyeme;
                this.moreDis = information.moreDis;
                this.mPhone = information.codphonem;
                this.fPhone = information.phonef;
                this.fiPhone = information.codphonef;
                this.genre = information.genre;
                this.dateBirthDay = information.birthday;
                this.phone = information.phonem;
                this.preferJobs = information.preferjob_id;
            }
           
            
            this.formFields2 = Array()
            for (let i = 0; i < works.length; i++) {
                try {
                    const stringChange = this.breakStringWork(works[i].detail_description)
                    this.jobsDescript.push(stringChange[2]);
                    Vue.set(app.levelExperience, i, stringChange[0])
                    Vue.set(app.areaEmployed, i, stringChange[1])
                } catch (e) {
                    this.jobsDescript.push(works[i].detail_description);
                }
                this.employed.push(works[i].grantor);
                this.jobs.push(works[i].detail_title);
                this.actuWork.push(works[i].is_current == 1);
                this.dateStudiesDLaboral.push(works[i].started_at);
                this.jobsSalario.push(works[i].salario);
                this.dateStudiesHLaboral.push(works[i].completed_at);

                this.formFields2.push(i + 1);
            }
            
      
            
            
            this.formFields = Array()
            this.formFields3 = Array();
            for (let i = 0; i < studies.length; i++) {
                try {
                    const stringChange = this.breakString(studies[i].detail_description)
                    this.studies.push(stringChange[1]);
                    Vue.set(app.eduLevel, i, stringChange[0])
                    Vue.set(app.country_edu, i, stringChange[2].trim())

                } catch (e) {

                }
                const find = this.findWord(studies[i].grantor);
                if (find.length > 1) {
                    this.university_edu.push("Otro");
                    this.university_otro.push(find[1]);
                } else {
                    this.university_edu.push(studies[i].grantor);
                    this.university_otro.push(null);
                }

                this.titleEdu.push(studies[i].detail_title);
                this.dateStudieB.push(studies[i].is_current == 1);
                this.dateStudiesD.push(studies[i].started_at);
                this.dateStudiesH.push(studies[i.completed_at]);

                this.formFields.push(i + 1);
            }
            for (let i = 0; i < idioms.length; i++) {
                this.idioms[i] = idioms[i].idioms_id;
                this.lecLevel[i] = idioms[i].slevel;
                this.redLevel[i] = idioms[i].wlevel;
                this.oralLevel[i] = idioms[i].olevel;
                this.formFields3[i] = i + 1;
            }
           
            discapsSelected.map(disabilities => {
                if (disabilities.id == 1 && !this.fisica) {
                    this.fisica = true;
                }
                if (disabilities.id == 2 && !this.auditiva) {
                    this.auditiva = true;
                }
                if (disabilities.id == 3 && !this.visual) {
                    this.visual = true;
                }
                if (disabilities.id == 4 && !this.multipla) {
                    this.multipla = true;
                }
                if (disabilities.id == 5 && !this.intelectual) {
                    this.intelectual = true;
                }
                if (disabilities.id == 6 && !this.mental) {
                    this.mental = true;
                }
                if (disabilities.id == 7 && !this.surdocegueira) {
                    this.surdocegueira = true;
                }
            })
            discap.map(disabilities => {
                if (disabilities.question_id == 1) {
                    this.mPie = disabilities.answer;
                } else if (disabilities.question_id == 2) {
                    this.mSen = disabilities.answer;
                } else if (disabilities.question_id == 3) {
                    this.mEsca = disabilities.answer;
                } else if (disabilities.question_id == 4) {
                    this.mBrazo = disabilities.answer;
                } else if (disabilities.question_id == 5) {
                    this.peso = disabilities.answer;
                } else if (disabilities.question_id == 6) {
                    this.mRueda = disabilities.answer;
                } else if (disabilities.question_id == 7) {
                    this.mDigi = disabilities.answer;
                } else if (disabilities.question_id == 8) {
                    this.desplazarte = disabilities.answer;
                } else if (disabilities.question_id == 9) {
                    this.aAmbient = disabilities.answer;
                } else if (disabilities.question_id == 10) {
                    this.aOral = disabilities.answer;
                } else if (disabilities.question_id == 11) {
                    this.aSennas = disabilities.answer;
                } else if (disabilities.question_id == 12) {
                    this.aLabial = disabilities.answer;
                } else if (disabilities.question_id == 13) {
                    this.aBajo = disabilities.answer;
                } else if (disabilities.question_id == 14) {
                    this.aImplante = disabilities.answer;
                } else if (disabilities.question_id == 15) {
                    this.vLejos = disabilities.answer;
                } else if (disabilities.question_id == 16) {
                    this.vObservar = disabilities.answer;
                } else if (disabilities.question_id == 17) {
                    this.vTecniA = disabilities.answer;
                } else if (disabilities.question_id == 18) {
                    this.vColores = disabilities.answer;
                } else if (disabilities.question_id == 19) {
                    this.vDPlanos = disabilities.answer;
                } else if (disabilities.question_id == 20) {
                    this.vHumedos = disabilities.answer;
                } else if (disabilities.question_id == 21) {
                    this.vTemp = disabilities.answer;
                } else if (disabilities.question_id == 22) {
                    this.vPolvo = disabilities.answer;
                } else if (disabilities.question_id == 23) {
                    this.vCompleta = disabilities.answer;
                } else if (disabilities.question_id == 24) {
                    this.vAdap = disabilities.answer;
                } else if (disabilities.question_id == 25) {
                    this.inteEscri = disabilities.answer;
                } else if (disabilities.question_id == 26) {
                    this.inteTransla = disabilities.answer;
                } else if (disabilities.question_id == 27) {
                    this.inteTarea = disabilities.answer;
                } else if (disabilities.question_id == 28) {
                    this.inteTrabajar = disabilities.answer;
                } else if (disabilities.question_id == 29) {
                    this.inteTrabajarSolo = disabilities.answer;
                } else if (disabilities.question_id == 30) {
                    this.inteMolesto = disabilities.answer;
                } else if (disabilities.question_id == 31) {
                    this.inteActividad = disabilities.answer;
                } else if (disabilities.question_id == 32) {
                    this.aFluida = disabilities.answer;
                } else if (disabilities.question_id == 33) {
                    this.inteTrabajarOP = disabilities.answer;
                }
            })
            this.street = endereco[0].value;
            this.numero = endereco[1].value;
            this.bairro = endereco[2].value;
            this.state = resume[0].candidate_state;
            this.cep = resume[0].candidate_zip_code;
            this.city = resume[0].candidate_location;
            this.getCities().finally();

        },
        findWord: function (str) {
            const a = str.split("Otra institución: ");
            return a
        },
        drop: async function () {
            this.currentStep = 7;
        },
        cargaImg: async function () {
            this.image = null;
            this.img = null;
            this.reader = null;
            if (event.target.files[0]['type'] !== 'image/jpeg' && event.target.files[0]['type'] !== 'image/png' && event.target.files[0]['type'] !== 'image/jpg') {
                alert('El tipo de archivo que ha subido no es valido, aceptamos imagenes en formato .jpg, .png, .jpeg');
                document.getElementById("userIMG").value = "";
                return false;
            }
            this.image = event.target.files[0];
            let reader = new FileReader();
            reader.onload = (event) => {
                this.img = event.target.result;
            };
            this.reader = reader.readAsDataURL(this.image);
        },
        cargaCV: async function () {
            this.cv = null;
            this.cvSHOW = null;
            this.cvReader = null;
            if (event.target.files[0]['type'] !== 'application/pdf' && !(/\.(doc?x|pdf)$/i.test(event.target.files[0].name))) {
                alert('El tipo de archivo que ha subido no es valido, aceptamos documentos en formato .doc, .docx, .pdf');
                document.getElementById("userCV").value = "";
                return false;
            }
            this.cv = event.target.files[0];
            let reader = new FileReader();
            reader.onload = (event) => {
                this.cvSHOW = event.target.result;
            };
            this.cvReader = reader.readAsDataURL(this.cv);
        },
        cargaCUD: async function () {
            this.cud = null;
            this.cudSHOW = null;
            this.cudReader = null;
            if (event.target.files[0]['type'] !== 'application/pdf' && !(/\.(doc?x|pdf)$/i.test(event.target.files[0].name))) {
                alert('El tipo de archivo que ha subido no es valido, aceptamos documentos en formato .doc, .docx, .pdf');
                document.getElementById("userCUD").value = "";
                return false;
            }
            this.cud = event.target.files[0];
            let reader = new FileReader();
            reader.onload = (event) => {
                this.cudSHOW = event.target.result;
            };
            this.cudReader = reader.readAsDataURL(this.cud);
        },
        isValidEmail: async function (email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        googleChange: async function (url) {
            this.url = url;
            let verifications = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/verifications/register.php',
                type: 'POST',
                data: {
                    email: this.email,
                    password: this.password,
                    google: this.google,
                    name: this.name,
                    lastName: this.lastName
                }
            }).done(function (response) {
                return response
            })

            if (verifications.message === false) {
                this.userID = verifications.message;
            } else {
                window.location.href = window.location + '/candidate-panel';
            }
            return true;
        },
        confirmStep3: async function () {
            if (!this.name || !this.lastName) {
                iziToast.warning({
                    title: 'Verifique',
                    message: 'Por favor, llene todos los campos',
                    progressBarColor: 'rgb(0, 255, 184)',
                    buttons: [
                        ['<button>Cerrar</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                                onClosing: function (instance, toast, closedBy) {
                                }
                            }, toast, 'buttonName');
                        }]
                    ],
                });
                if (!this.name) {
                    jQuery([document.documentElement, document.body]).animate({
                        scrollTop: jQuery("#nameLabel").offset().top
                    });
                    jQuery("#names").css('border-color', "red");
                    jQuery("#nameLabel").css('color', "red");
                    jQuery("#lastNames").removeAttr("style");
                    jQuery("#lastNamesLabel").removeAttr("style");
                } else if (!this.lastName) {
                    jQuery([document.documentElement, document.body]).animate({
                        scrollTop: jQuery("#lastNamesLabel").offset().top
                    });
                    jQuery("#lastNames").css('border-color', "red");
                    jQuery("#lastNamesLabel").css('color', "red");
                    jQuery("#names").removeAttr("style");
                    jQuery("#nameLabel").removeAttr("style");
                }
                this.awaitChange = false;
                return false;
            }
            return {
                name: this.name,
                lastName: this.lastName
            }

        },
        confirmStep4: async function () {
            if (!this.genre || !this.dateBirthDay) {
                iziToast.warning({
                    title: 'Verifique',
                    message: 'Por favor, llene todos los campos',
                    progressBarColor: 'rgb(0, 255, 184)',
                    buttons: [
                        ['<button>Cerrar</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                                onClosing: function (instance, toast, closedBy) {
                                }
                            }, toast, 'buttonName');
                        }]
                    ],
                });
                if (!this.genre) {
                    jQuery([document.documentElement, document.body]).animate({
                        scrollTop: jQuery("#genreP").offset().top
                    });
                    jQuery("#inlineCheckbox1").css('color', "red");
                    jQuery("#genreP").css('color', "red");
                    jQuery("#inlineCheckbox2").css('color', "red");
                    jQuery("#inlineCheckbox3").css('color', "red");
                } else if (!this.dateBirthDay) {
                    jQuery("#inlineCheckbox1").removeAttr("style");
                    jQuery("#inlineCheckbox2").removeAttr("style");
                    jQuery("#inlineCheckbox3").removeAttr("style");
                    jQuery("#dateBirthDay").css('border-color', "red");
                    jQuery("#labeldateBirthDay").css('color', "red");
                }
                  jQuery('.cep').mask('99999-999');
                   jQuery('.fixo').mask('0000-0000');
                   jQuery('.celular').mask('99999-9999');
                this.awaitChange = false;
                return false;
            }
            return true;
        },
        confirmStep5: async function () {
            let labelPhone = jQuery("#labelPhone");
            let labelState = jQuery("#labelState");
            let labelCity = jQuery("#labelCity");
            if (!this.mPhone || !this.phone) {
                iziToast.warning({
                    title: 'Verifique',
                    message: 'Por favor, ingrese su numero de teléfono',
                    progressBarColor: 'rgb(0, 255, 184)',
                    buttons: [
                        ['<button>Cerrar</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                                onClosing: function (instance, toast, closedBy) {
                                }
                            }, toast, 'buttonName');
                        }]
                    ],
                });

                jQuery([document.documentElement, document.body]).animate({
                    scrollTop: labelPhone.offset().top
                });
                labelPhone.css('color', "red");
                labelState.removeAttr("style");
                labelCity.removeAttr("style");
                this.awaitChange = false;
                return false;
            }
            if (!this.state) {
                iziToast.warning({
                    title: 'Verifique',
                    message: 'Por favor, ingrese su Provincia/Estado',
                    progressBarColor: 'rgb(0, 255, 184)',
                    buttons: [
                        ['<button>Cerrar</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                                onClosing: function (instance, toast, closedBy) {
                                }
                            }, toast, 'buttonName');
                        }]
                    ],
                });
                labelPhone.removeAttr("style");
                labelCity.removeAttr("style");
                jQuery([document.documentElement, document.body]).animate({
                    scrollTop: labelState.offset().top
                });
                labelState.css('color', "red");
                this.awaitChange = false;
                return false;
            }
            if (!this.city) {
                iziToast.warning({
                    title: 'Verifique',
                    message: 'Por favor, ingrese su Ciudad',
                    progressBarColor: 'rgb(0, 255, 184)',
                    buttons: [
                        ['<button>Cerrar</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                                onClosing: function (instance, toast, closedBy) {
                                }
                            }, toast, 'buttonName');
                        }]
                    ],
                });
                labelPhone.removeAttr("style");
                labelState.removeAttr("style");
                jQuery([document.documentElement, document.body]).animate({
                    scrollTop: labelCity.offset().top
                });
                labelCity.css('color', "red");
                this.awaitChange = false;
                return false;
            }
            return {
                mPhone: this.mPhone,
                state: this.state,
                city: this.city,
                fPhone: this.fPhone,
                fiPhone: this.fiPhone,
                street: this.street,
                cep: this.cep,
                numero: this.numero,
                bairro: this.bairro,
                genre: this.genre,
                dateBirthDay: this.dateBirthDay,
                userID: this.userID,
                phone: this.phone
            }
        },
        confirmStep7: async function () {
            let disCText = jQuery("#disCText");
            if (!this.moreDis) {
                iziToast.warning({
                    title: 'Verifique',
                    message: 'Por favor, cuentenos sobre su disCapacidad',
                    progressBarColor: 'rgb(0, 255, 184)',
                    buttons: [
                        ['<button>Cerrar</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                                onClosing: function (instance, toast, closedBy) {
                                }
                            }, toast, 'buttonName');
                        }]
                    ],
                });
                disCText.css('color', "red");

                jQuery('#exampleFormControlTextarea1').css('border-color', "red");
                this.awaitChange = false;
                return false;
            }
            const data = {
                moreDis: this.moreDis,
                userID: this.userID,
                discaps: []
            }
            if (this.fisica) {
                data.discaps.push(1);
                data.fisica = 1;
                data.mPie = this.mPie;
                data.mSen = this.mSen;
                data.mEsca = this.mEsca;
                data.mBrazo = this.mBrazo;
                data.peso = this.peso;
                data.mRueda = this.mRueda;
                data.desplazarte = this.desplazarte;
                data.mDigi = this.mDigi;
            }
            if (this.auditiva) {
                data.discaps.push(2);
                data.auditiva = 2;
                data.aAmbient = this.aAmbient;
                data.aSennas = this.aSennas;
                data.aLabial = this.aLabial;
                data.aBajo = this.aBajo;
                data.aImplante = this.aImplante;
                data.aImplanteText = this.aImplanteText;
                data.aOral = this.aOral;
            }
            if (this.visual) {
                data.discaps.push(3);
                data.visual = 3;
                data.vLejos = this.vLejos;
                data.vObservar = this.vObservar;
                data.vColores = this.vColores;
                data.vDPlanos = this.vDPlanos;
                data.vTecniA = this.vTecniA;
                data.vTecniAText = this.vTecniAText;
            }
            if (this.multipla) {
                data.discaps.push(4);
                data.multipla = 4;
                data.vHumedos = this.vHumedos;
                data.vTemp = this.vTemp;
                data.vPolvo = this.vPolvo;
                data.vCompleta = this.vCompleta;
                data.vAdap = this.vAdap;
                data.vAdapText = this.vAdapText;

            }
            if (this.intelectual) {
                data.discaps.push(5);
                data.intelectual = 5;
                data.inteEscri = this.inteEscri;
                data.inteTransla = this.inteTransla;
                data.inteTarea = this.inteTarea;
                data.inteActividad = this.inteActividad;
                data.inteMolesto = this.inteMolesto;
                data.inteTrabajar = this.inteTrabajar;
                data.inteTrabajarSolo = this.inteTrabajarSolo;
            }
            if (this.mental) {
                data.discaps.push(6);
                data.mental = 6;
            }
            if (this.surdocegueira) {
                data.discaps.push(7);
                data.surdocegueira = 7;
            }
            return data;
        },
        confirmStep8: async function () {
            const data = new FormData();
            if (this.image !== null || this.cud !== null || this.cv !== null) {
                if (this.image !== null) {
                    data.append('img_path', this.image);
                }
                if (this.cud !== null) {
                    data.append('cud', this.cud);
                }
                if (this.cv !== null) {
                    data.append('cv', this.cv);
                }
                data.append('files', '1');
                data.append('userID', this.userID);
                await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', data)
                    .then(function (response) {
                        return response
                    })
                    .catch(function (error) {
                        return true;
                    });
            }
        },
        confirmStep9: async function () {
            return {
                userID: this.userID,
                country_edu: this.country_edu,
                university_edu: this.university_edu,
                university_otro: this.university_otro,
                studies: this.studies,
                titleEdu: this.titleEdu,
                eduLevel: this.eduLevel,
                dateStudiesD: this.dateStudiesD,
                dateStudiesH: this.dateStudiesH,
                dateStudieB: this.dateStudieB
            }
        },
        confirmStep10: async function () {
            return {
                userID: this.userID,
                employed: this.employed,
                areaEmployed: this.areaEmployed,
                jobs: this.jobs,
                levelExperience: this.levelExperience,
                jobsSalario: this.jobsSalario,
                dateStudiesDLaboral: this.dateStudiesDLaboral,
                dateStudiesHLaboral: this.dateStudiesHLaboral,
                actuWork: this.actuWork,
                jobsDescript: this.jobsDescript,
                jobsSalario: this.jobsSalario
            }
        },
        confirmStep11: async function () {
            return {
                userID: this.userID,
                idioms: this.idioms,
                oLevel: this.oralLevel,
                wLevel: this.redLevel,
                sLevel: this.lecLevel,
                idiomsOther: this.idiomsOther
            }
        },
        confirmStep12: async function () {
            return {
                userID: this.userID,
                preferJobs: this.preferJobs
            }
        },
        actualizar: async function () {
            let one = await this.confirmStep3();
            let two = false;
            let three = false;
            let fourth = false;
            let five = false;
            let six = false;
            let seven = false;
            let eight = false;
            if (one !== false) {
                two = await this.confirmStep4()
            }
            if (two) {
                three = await this.confirmStep5()
            }
            if (three) {
                fourth = await this.confirmStep7()
            }
            if (fourth) {
                five = await this.confirmStep9()
            }
            if (five) {
                six = await this.confirmStep10()
            }
            if (six) {
                seven = await this.confirmStep11()
            }
            if (seven) {
                eight = await this.confirmStep12()
            }

            if (one !== false && two && three && fourth && five && six && seven && eight) {
                const data = {}
                Object.assign(data, one);
                Object.assign(data, two);
                Object.assign(data, three);
                Object.assign(data, fourth);
                Object.assign(data, five);
                Object.assign(data, six);
                Object.assign(data, seven);
                Object.assign(data, eight);
                data.meetingIncluyeme = this.meetingIncluyeme;
                await axios.post(this.url + '/incluyeme-login-extension/include/verifications/resume.php', data)
                    .then(function (response) {
                        return response
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                if (this.image !== null || this.cud !== null || this.cv !== null) {
                    await this.confirmStep8()
                }
                iziToast.success({
                    title: 'Dados atualizados',
                    progressBarColor: 'rgb(0,0,0)',
                    buttons: [
                        ['<button>Fechar</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                                onClosing: function (instance, toast, closedBy) {
                                }
                            }, toast, 'buttonName');
                        }]
                    ],
                });

            }

        },
        dropzone: async function () {
            const url = this.url + '/incluyeme-login-extension/include/verifications/register.php';
            const id = this.userID;
            jQuery("#demo-upload").dropzone({
                init: function () {
                    const dropzone = this;
                    clearDropzone = function () {
                        dropzone.removeAllFiles(true);
                    };
                },
                url: url,
                maxFiles: 1,
                acceptedFiles: 'image/jpg, image/png, image/jpeg',
                addRemoveLinks: true,
                dictInvalidFileType: 'El tipo de archivo que ha subido no es valido, aceptamos imagenes en formato .jpg, .png, .jpeg',
                dictFileTooBig: 'Su archivo no puede pesar mas de 5MB',
                sending: function (file, xhr, formData) {
                    formData.append('userID', id);
                },
                dictMaxFilesExceeded: 'Solo puede subir un archivo, por favor, elimine su archivo anterior',
                paramName: 'img_path',
                maxFilesize: 5,
                dictCancelUpload: 'Cancelar',
                dictRemoveFile: 'Eliminar',
                removedfile: function (file) {
                    let x = true;
                    if (!x) return false;
                    jQuery.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            "userID": id,
                            "removeIMG": 'remove'
                        },
                        dataType: 'json'
                    });
                    let _ref;
                    this.removeAllFiles(true);
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

                },
            });
            jQuery("#CVDROP").dropzone({
                url: url,
                maxFiles: 1,
                acceptedFiles: 'application/pdf,.doc,.docx',
                addRemoveLinks: true,
                dictInvalidFileType: 'El tipo de archivo que ha subido no es valido, aceptamos archivos .pdf, .doc o .docx',
                dictFileTooBig: 'Su archivo no puede pesar mas de 5MB',
                sending: function (file, xhr, formData) {
                    formData.append('userID', id);
                },
                dictMaxFilesExceeded: 'Solo puede subir un archivo, por favor, elimine su archivo anterior',
                paramName: 'cv',
                maxFilesize: 5,
                dictCancelUpload: 'Cancelar',
                dictRemoveFile: 'Eliminar',
                removedfile: function (file) {
                    let x = true;
                    if (!x) return false;
                    jQuery.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            "userID": id,
                            "RemoveCV": 'remove'
                        },
                        dataType: 'json'
                    });
                    let _ref;
                    this.removeAllFiles(true);
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                }
            });
            jQuery("#CUDDROP").dropzone({
                url: url,
                maxFiles: 1,
                acceptedFiles: 'application/pdf,.doc,.docx',
                addRemoveLinks: true,
                dictInvalidFileType: 'El tipo de archivo que ha subido no es valido, aceptamos imagenes en formato .jpg, .png, .jpeg',
                dictFileTooBig: 'Su archivo no puede pesar mas de 5MB',
                sending: function (file, xhr, formData) {
                    formData.append('userID', id);
                },
                dictMaxFilesExceeded: 'Solo puede subir un archivo, por favor, elimine su archivo anterior',
                paramName: 'cud',
                maxFilesize: 5,
                dictCancelUpload: 'Cancelar',
                dictRemoveFile: 'Eliminar',
                removedfile: function (file) {
                    let x = true;
                    if (!x) return false;
                    jQuery.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            "userID": id,
                            "removeCUD": 'remove'
                        },
                        dataType: 'json'
                    });
                    let _ref;
                    this.removeAllFiles(true);
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                }
            });
        },
        getUniversities: async function (id) {
            let universities = await this.getUniver(id);
            this.universities[id] = universities.data.message;
            Vue.set(app.universities, id, universities.data.message)
            if (universities.data.message.length !== 0) {
                this.university_edu[id] = universities.data.message[0].university;
            } else {
                this.university_edu[id] = null;
            }
            this.renderPickers();
        },
        changeUniversity: function (id, changes) {
            if (changes === true) {
                Vue.set(app.university_otro, id, false)
            } else {
                Vue.set(app.university_edu, id, false);
            }
        },
        getUniver: async function (id) {
            return axios.get(this.url + '/incluyeme-login-extension/include/search/countries.php?countries=' + this.country_edu[id], {})
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getCountries: async function (url) {
            let countries = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/countries.php?countries=all',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.countries = countries.message
        },
        getStudies: async function (url) {
            let studies = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/studies.php?studies=all',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.study = studies.message
        },
        getExperiences: async function (url) {
            let experiences = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/experiencesAreas.php?experiences=all',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.experiences = experiences.message
        },
        getPrefersJobs: async function (url) {
            let preferJob = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/prefersJobs.php?experiences=all',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.preferJob = preferJob.message
        },
        getLevelsIdioms: async function (url) {
            let levels = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/idioms.php?levels=all',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.levels = levels.message
        },
        getIdioms: async function (url) {
            let idioms = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/idioms.php?idioms=all',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.idiom = idioms.message
        },
        addStudies: async function () {
            this.formFields.push(1);
        },
        addExp: async function () {
            this.formFields2.push(1);
        },
        addIdioms: async function () {
            this.formFields3.push(1);
        },
        pleaseAwait: function () {
            iziToast.info({
                title: 'Por favor, aguarde.',
                message: 'Estamos buscando as informações.',
                progressBarColor: 'rgb(0,0,0)',
                buttons: [
                    ['<button>Fechar</button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function (instance, toast, closedBy) {
                            }
                        }, toast, 'buttonName');
                    }]
                ],
            });
        },
        pleaseAwait2: function () {
            iziToast.info({
                title: 'Por favor, aguarde.',
                message: 'Estamos verificando seus dados.',
                progressBarColor: 'rgb(0,0,0)',
                buttons: [
                    ['<button>Fechar</button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function (instance, toast, closedBy) {
                            }
                        }, toast, 'buttonName');
                    }]
                ],
            });
        },
        breakString: function (str) {
            let level = str.split('Nivel: ')

            let area = level[1].split('Area de Estudio:');
            level = area[0];
            area = area[1].split('Pais de estudio:');
            let country = area[1];
            area = area[0];
            return [level, Number(area), country]
        },
        breakStringWork: function (str) {
            let level = str.split('Nivel de Experiencia: ')
            let area = level[1].split('Area de Empleo: ');
            level = area[0];
            area = area[1].split('Descripcion: ');
            let country = area[1];
            area = area[0];
            return [Number(level), Number(area), country]
        },
        deleteStudies: async function (index) {
            this.formFields.splice(index, 1);
            this.country_edu.splice(index, 1);
            this.university_edu.splice(index, 1);
            this.university_otro.splice(index, 1);
            this.studies.splice(index, 1);
            this.titleEdu.splice(index, 1);
            this.eduLevel.splice(index, 1);
            this.dateStudiesD.splice(index, 1);
            this.dateStudiesH.splice(index, 1);
            this.dateStudieB.splice(index, 1);
        },
        deleteExp: async function (index) {
            this.formFields2.splice(index, 1);
            this.employed.splice(index, 1);
            this.areaEmployed.splice(index, 1);
            this.jobs.splice(index, 1);
            this.levelExperience.splice(index, 1);
            this.jobsSalario.splice(index, 1);
            this.dateStudiesDLaboral.splice(index, 1);
            this.dateStudiesHLaboral.splice(index, 1);
            this.actuWork.splice(index, 1);
            this.jobsDescript.splice(index, 1);
        },
        deleteIdioms: async function (index) {
            this.formFields3.splice(index, 1);
            this.lecLevel.splice(index, 1);
            this.redLevel.splice(index, 1);
            this.idioms.splice(index, 1);
            this.oralLevel.splice(index, 1);
        },
        getProvincias: async function (url) {
            let provincias = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/countries.php?provincias=CVC',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.provincias = provincias.message
        },
        getCities: async function (id) {
            let cities = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/search/countries.php?city=' + this.state,
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.cities = cities.message;
        },
    }
});
startApp();

 
