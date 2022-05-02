Vue.config.ignoredElements = ['x-incluyeme', 'fb:login-button']
Vue.component('step1', {
    template: '#step1',
    props: [
        'currentStep',
        'step1'
    ]
});
Vue.component('step2', {
    template: '#step2',
    props: [
        'currentStep',
        'step2'
    ]
});
Vue.component('step3', {
    template: '#step3',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step4', {
    template: '#step4',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step5', {
    template: '#step5',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step6', {
    template: '#step6',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step7', {
    template: '#step7',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step8', {
    template: '#step8',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step9', {
    template: '#step9',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step10', {
    template: '#step10',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step11', {
    template: '#step11',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step12', {
    template: '#step12',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
Vue.component('step13', {
    template: '#step13',
    props: [
        'currentStep',
        'step1',
        'step2'
    ]
});
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
        name: null,
        cities: [],
        email: null,
        password: null,
        street: null,
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
        aFluida: null,
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
        jobsSalario: [],
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
        moreDis: null,
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
        validation: false,
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
        idiomsOther: [],
        awaitChange: false,
        google: false,
        facebook: false,
        linkedin:false,
        provincias: [],
        inteTrabajarOP: null,
        noDisPage: false,
        meetingIncluyeme: null,
        defaultCheckDiscapacidad: false,
        defaultCheckTerminos: false,
    },
    ready: function () {
        console.log('ready');
    },
    mounted() {
        this.formFields2.push(1);
        this.formFields3.push(1);
        this.noDisPage = false;
        this.method1();
    },
    methods: {
        method1:function(){
              this.getTeste();
        },
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
                    this.street = response.data.logradouro
                    this.bairro = response.data.bairro;
                    this.state = response.data.uf;
                    this.city = response.data.localidade;
                    jQuery("#numero").focus();
                }.bind(this)).catch(function (error) {
                    console.log(error.statusText);
                });
            }
        },
            fetchBrowserInfo:function(){
                var browserInfo = {};
                browserInfo.appName = navigator.appName;
                browserInfo.appCodeName = navigator.appCodeName;
                browserInfo.cookieEnable = navigator.cookieEnabled;
                browserInfo.prodName = navigator.product;
                browserInfo.appVersion = navigator.appVersion;
                browserInfo.appOs = navigator.platform;
                browserInfo.appLang = navigator.language;
                browserInfo.vendorName = navigator.vendor;
        	browserInfo.loginDomain = "cdn";
                return browserInfo;
            },
        linkedinlog: async function (url, verification = true) {
            this.url = url;
            let verifications = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/verifications/register.php',
                type: 'POST',
                dataType: 'jsonp',
                data: {linkedin:'linkedin'}
            }).done(function (response, status, xhr) {
                var ct = xhr.getResponseHeader("content-type") || "";
                if (ct.indexOf('html') > -1) {
                    window.location.href = '/trabajos';
                }
                return response
            })

        },
        goToStep: async function (step, url = false) {
            if (this.currentStep === 13) {
                return;
            }
            this.url = url;
            if (this.awaitChange === true) {
                return;
            }
            switch (Number(step)) {
                case 2:
                    this.awaitChange = true;
                    if (await this.confirmStep2(step) === true && this.currentStep <= 2) {
                        this.getLevelsIdioms().finally();
                        this.getIdioms().finally();
                        this.getCountries().finally();
                        this.getStudies().finally();
                        this.getExperiences().finally();
                        this.getPrefersJobs().finally();
                        this.getProvincias().finally();
                        this.currentStep = step;
                        this.goToTop();

                    }
                    this.goToTop();
                    break;
                case 3:
                    if (this.currentStep <= 3) {
                        this.awaitChange = true;
                        await this.confirmStep3(step);
                    } else {
                        this.currentStep = step;
                        this.goToTop();

                    }
                    this.goToTop();
                    break;
                case 4:
                    if (this.currentStep <= 4) {
                        this.awaitChange = true;
                        await this.confirmStep4(step);

                    } else {
                        this.currentStep = step;
                        this.goToTop();

                    }
                    this.goToTop();
                    break;
                case 5:
                    if (this.currentStep <= 5) {

                        this.awaitChange = true;
                        await this.confirmStep5(step);
                    } else {
                        this.currentStep = step;
                        this.goToTop();

                    }
                    this.goToTop();
                    break;
                case 6:
                    await this.confirmStep6(step);
                    this.goToTop();

                    break;
                case 7:
                    if (this.currentStep <= 7) {
                        this.awaitChange = true;
                        await this.confirmStep7(step);
                    } else {
                        this.currentStep = step
                    }

                    this.goToTop();

                    break;
                case 8:
                    if (this.currentStep <= 8) {
                        this.awaitChange = true;
                        await this.confirmStep8(step);
                    } else {
                        this.currentStep = step
                    }

                    this.goToTop();
                    break;
                case 9:
                    if (this.currentStep <= 9) {
                        this.awaitChange = true;
                        await this.confirmStep9(step)
                    } else {
                        this.currentStep = step
                    }

                    this.goToTop();
                    break;
                case 10:
                    if (this.currentStep <= 10) {
                        this.awaitChange = true;
                        await this.confirmStep10(step)
                    } else {
                        this.currentStep = step
                    }

                    this.goToTop();
                    break;
                case 11:
                    if (this.currentStep <= 11) {
                        this.awaitChange = true;
                        await this.confirmStep11(step)
                    } else {
                        this.currentStep = step
                    }

                    this.goToTop();
                    break;
                case 12:
                    if (this.currentStep <= 12) {
                        this.awaitChange = true;
                        await this.confirmStep12(step)
                    } else {
                        this.currentStep = step
                    }

                    this.goToTop();
                    break;
                case 13:
                    if (this.currentStep <= 13) {
                        this.awaitChange = true;
                        await this.confirmStep13(step)
                    } else {
                        this.currentStep = step
                    }

                    this.goToTop();
                    break;
                default:
                    console.log('default')
                    this.currentStep = step;

                    this.goToTop();
            }

        },
        drop: async function () {
            this.currentStep = 7;
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
        isValidEmail: async function (email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        confirmStep2: async function (step) {

            let confirmEmail = await this.isValidEmail(this.email);
            if (!confirmEmail || this.password === null || !this.password) {
                this.validation = 2;
                this.awaitChange = false;
                jQuery("#emil").css('border-color', "red");
                jQuery("#emilLabel").css('color', "red");
                jQuery("#inputPassword4").removeAttr("style");
                jQuery("#labelPassword4").removeAttr("style");
                jQuery("#repostP").removeAttr("style");
                jQuery("#repostPLabel").removeAttr("style");
                jQuery("#defaultCheckTerminosLabel").css('color', "black");
                jQuery("#defaultCheckDiscapacidadLabel").css('color', "black");
                return false;
            } else if (this.password === null || !this.password) {
                this.validation = 3;
                jQuery("#inputPassword4").css('border-color', "red");
                jQuery("#labelPassword4").css('color', "red");
                jQuery("#emil").removeAttr("style");
                jQuery("#emilLabel").removeAttr("style");
                jQuery("#defaultCheckTerminosLabel").css('color', "black");
                jQuery("#defaultCheckDiscapacidadLabel").css('color', "black");
                return false;
            } else if (this.password.length < 5) {
                this.validation = 3;
                jQuery("#inputPassword4").css('border-color', "red");
                jQuery("#labelPassword4").css('color', "red");
                jQuery("#defaultCheckTerminosLabel").css('color', "black");
                jQuery("#defaultCheckDiscapacidadLabel").css('color', "black");
                this.awaitChange = false;
                return false;
            } else if (this.password !== this.passwordConfirm) {
                this.validation = 4;
                jQuery("#repostP").css('border-color', "red");
                jQuery("#repostPLabel").css('color', "red");
                jQuery("#inputPassword4").removeAttr("style");
                jQuery("#labelPassword4").removeAttr("style");
                jQuery("#emil").removeAttr("style");
                jQuery("#emilLabel").removeAttr("style");
                jQuery("#defaultCheckTerminosLabel").css('color', "black");
                jQuery("#defaultCheckDiscapacidadLabel").css('color', "black");
                this.awaitChange = false;
                return false;
            } else if (!this.defaultCheckDiscapacidad) {
                jQuery("#repostP").removeAttr("style");
                jQuery("#repostPLabel").removeAttr("style");
                jQuery("#inputPassword4").removeAttr("style");
                jQuery("#labelPassword4").removeAttr("style");
                jQuery("#emil").removeAttr("style");
                jQuery("#emilLabel").removeAttr("style");
                jQuery("#defaultCheckDiscapacidadLabel").css('color', "red");
              //  jQuery("#defaultCheckTerminosLabel").css('color', "black");
                this.validation = 'discapacidadTerms';
                this.awaitChange = false;
                return false;
            } /*else if (!this.defaultCheckTerminos) {
                jQuery("#repostP").removeAttr("style");
                jQuery("#repostPLabel").removeAttr("style");
                jQuery("#inputPassword4").removeAttr("style");
                jQuery("#labelPassword4").removeAttr("style");
                jQuery("#emil").removeAttr("style");
                jQuery("#emilLabel").removeAttr("style");
                jQuery("#defaultCheckTerminosLabel").css('color', "red");
                jQuery("#defaultCheckDiscapacidadLabel").css('color', "black");
                this.validation = 'terms';
                this.awaitChange = false;
                return false;
            }*/
            this.pleaseAwait();
            let verifications = await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
                email: this.email,
                password: this.password
            })
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });
            if (verifications.data.message === true) {
                this.validation = 1;
                jQuery("#repostP").removeAttr("style");
                jQuery("#repostPLabel").removeAttr("style");
                jQuery("#inputPassword4").removeAttr("style");
                jQuery("#labelPassword4").removeAttr("style");
                jQuery("#emil").css('border-color', "red");
                jQuery("#emilLabel").css('color', "red");
            //    jQuery("#defaultCheckTerminosLabel").css('color', "black");
                jQuery("#defaultCheckDiscapacidadLabel").css('color', "black");
                this.awaitChange = false;
                return false;
            } else if (verifications.data.message === false) {
                this.awaitChange = false;
                this.currentStep = step;
            }
            this.awaitChange = false;
            return true;
        },
        linkedinChange: async function (url) {
            this.url = url;
            let verifications = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/verifications/register.php',
                type: 'POST',
                data: data.linkedin
            }).done(function (response, status, xhr) {
                var ct = xhr.getResponseHeader("content-type") || "";
                if (ct.indexOf('html') > -1) {
                    window.location.href = '/trabajos';
                }
                return response
            })

            this.awaitChange = false;
            this.userID = verifications.message;
            this.currentStep = 3;
            data.googleID = verifications.message
            await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/verifications/register.php',
                type: 'POST',
                data: data
            }).done(function (response, status, xhr) {
                return response
            })
            this.getLevelsIdioms().finally();
            this.getIdioms().finally();
            this.getCountries().finally();
            this.getStudies().finally();
            this.getExperiences().finally();
            this.getPrefersJobs().finally();
            this.getProvincias().finally();
            return true;
        },
        googleChange: async function (url, verification = true) {
            this.url = url;
            const data = {
                email: this.email,
                password: this.password,
                name: this.name,
                lastName: this.lastName
            };
            if (this.google) {
                data.google = this.google;
                data.facebook = false;
                data.linkedin = false;
            } else if (this.facebook) {
                data.facebook = this.facebook;
                data.linkedin = false;
                data.google = false;
            } else if (this.linkedin) {
                data.linkedin = this.linkedin;
                data.facebook = false;
                data.google = false;
            }
            else {
                return false;
            }
            let verifications = await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/verifications/register.php',
                type: 'POST',
                data: data
            }).done(function (response, status, xhr) {
                var ct = xhr.getResponseHeader("content-type") || "";
                if (ct.indexOf('html') > -1) {
                    window.location.href = '/painel_do_talento';
                }
                return response
            })

            this.awaitChange = false;
            this.userID = verifications.message;
            this.currentStep = 3;
            data.googleID = verifications.message
            await jQuery.ajax({
                url: this.url + '/incluyeme-login-extension/include/verifications/register.php',
                type: 'POST',
                data: data
            }).done(function (response, status, xhr) {
                return response
            })
            this.getLevelsIdioms().finally();
            this.getIdioms().finally();
            this.getCountries().finally();
            this.getStudies().finally();
            this.getExperiences().finally();
            this.getPrefersJobs().finally();
            this.getProvincias().finally();
            return true;
        },
        confirmStep3: async function (step) {
            if (!this.name) {
                this.validation = 5;
                jQuery("#names").css('border-color', "red");
                jQuery("#nameLabel").css('color', "red");
                jQuery("#lastNames").removeAttr("style");
                jQuery("#lastNamesLabel").removeAttr("style");
                this.awaitChange = false;
                return false;
            } else if (!this.lastName) {
                this.validation = 6;
                jQuery("#lastNames").css('border-color', "red");
                jQuery("#lastNamesLabel").css('color', "red");
                jQuery("#names").removeAttr("style");
                jQuery("#nameLabel").removeAttr("style");
                this.awaitChange = false;
                return false;
            } else if (this.disCap == null) {
                this.validation = 20;
                jQuery("#haveDiscap").css('color', "red");
                jQuery("#names").removeAttr("style");
                jQuery("#nameLabel").removeAttr("style");
                jQuery("#lastNames").removeAttr("style");
                jQuery("#lastNamesLabel").removeAttr("style");
                this.awaitChange = false;
                return false;
            }
            this.pleaseAwait();
            let verifications = await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
                email: this.email,
                password: this.password,
                name: this.name,
                lastName: this.lastName,
                haveDiscap: this.disCap === false ? 'noDIS' : 'siDIS'
            })
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });
            this.userID = verifications.data.message;
            this.awaitChange = false;
            if (this.disCap === false) {
                this.noDisPage = true;
                this.goToTop();
                return false;
            }
            this.currentStep = step;
            this.goToTop();
        },
        confirmStep4: async function (step) {
            if (!this.genre) {
                this.validation = 7;
                jQuery("#inlineCheckbox1").css('color', "red");
                jQuery("#genreP").css('color', "red");
                jQuery("#inlineCheckbox2").css('color', "red");
                jQuery("#inlineCheckbox3").css('color', "red");
                jQuery("#dateBirthDay").removeAttr('style');
                jQuery("#labeldateBirthDay").removeAttr('style');
                this.awaitChange = false;
                return;
            } else if (!this.dateBirthDay) {
                this.validation = 8;
                jQuery("#inlineCheckbox1").removeAttr("style");
                jQuery("#inlineCheckbox2").removeAttr("style");
                jQuery("#inlineCheckbox3").removeAttr("style");
                jQuery("#genreP").removeAttr("style");
                jQuery("#dateBirthDay").css('border-color', "red");
                jQuery("#labeldateBirthDay").css('color', "red");
                this.awaitChange = false;
                return;
            }
            if (this.disCap === false && (this.google || this.facebook)) {
                this.noDisPage = true;
                this.goToTop();
                return false;
            }
            this.awaitChange = false;
            this.currentStep = step;
            this.goToTop();
            this.renderPickers();
        },
        confirmStep5: async function (step) {

            let labelPhone = jQuery("#labelPhone");
            let labelState = jQuery("#labelState");
            let labelCity = jQuery("#labelCity");
            if (!this.mPhone) {
                this.validation = 9;
                labelPhone.css('color', "red");
                labelState.removeAttr("style");
                labelCity.removeAttr("style");
                this.awaitChange = false;
                return;
            }
            if (!this.phone) {
                this.validation = 20;
                labelPhone.css('color', "red");
                labelState.removeAttr("style");
                labelCity.removeAttr("style");
                this.awaitChange = false;
                return;
            }
            if (!this.state) {
                this.validation = 10;
                labelPhone.removeAttr("style");
                labelCity.removeAttr("style");

                labelState.css('color', "red");
                this.awaitChange = false;
                return;
            }
            if (!this.city) {
                this.validation = 11;
                labelPhone.removeAttr("style");
                labelState.removeAttr("style");

                labelCity.css('color', "red");
                this.awaitChange = false;
                return;
            }
            this.pleaseAwait();
            let verification = await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
                mPhone: this.mPhone,
                state: this.state,
                cep: this.cep,
                city: this.city,
                fPhone: this.fPhone,
                fiPhone: this.fiPhone,
                street: this.street,
                bairro: this.bairro,
                numero: this.numero,
                genre: this.genre,
                dateBirthDay: this.dateBirthDay,
                userID: this.userID,
                phone: this.phone
            })
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });
            this.userID = verification.data.message;
            this.awaitChange = false;
            this.currentStep = step;
            this.goToTop();
        },
        confirmStep7: async function (step) {

            let disCText = jQuery("#disCText");
            if (!this.moreDis) {
                this.validation = 11;
                disCText.css('color', "red");

                jQuery('#exampleFormControlTextarea1').css('border-color', "red");
                this.awaitChange = false;
                return;
            }
            this.pleaseAwait();
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
                data.aFluida = this.aFluida;
            }
            if (this.visual) {
                data.discaps.push(3);
                data.visual = 3;
                data.vLejos = this.vLejos;
                data.vObservar = this.vObservar;
                data.vColores = this.vColores;
                data.vDPlanos = this.vDPlanos;
                data.vTecniA = this.vTecniA;
                data.vTecniAvText = this.vTecniAvText;
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
                data.inteTrabajarOP = this.inteTrabajarOP
            }
            if (this.mental) {
                data.discaps.push(6);
                data.mental = 6;
            }
            if (this.surdocegueira) {
                data.discaps.push(7);
                data.surdocegueira = 7;
            }
            await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', data)
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });
            this.currentStep = step;
            await this.drop();
            this.dropzone();
            this.awaitChange = false;
            this.goToTop();
        },
        confirmStep8: async function (step) {
            this.awaitChange = false;
            this.currentStep = step;
            this.goToTop();
        },
        confirmStep9: async function (step) {
            this.pleaseAwait();
            await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
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
            })
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });
            this.awaitChange = false;
            this.currentStep = step;
            this.goToTop();
        },
        confirmStep10: async function (step) {

            this.pleaseAwait();
            await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
                userID: this.userID,
                employed: this.employed,
                areaEmployed: this.areaEmployed,
                jobs: this.jobs,
                levelExperience: this.levelExperience,
                 jobsSalario: this.jobsSalario,
                actuWork: this.actuWork,
                dateStudiesDLaboral: this.dateStudiesDLaboral,
                dateStudiesHLaboral: this.dateStudiesHLaboral,
                jobsDescript: this.jobsDescript
            })
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });
            this.awaitChange = false;
            this.currentStep = step;
            this.goToTop();
        },
        confirmStep11: async function (step) {
            this.pleaseAwait();
            await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
                userID: this.userID,
                idioms: this.idioms,
                oLevel: this.oralLevel,
                wLevel: this.redLevel,
                sLevel: this.lecLevel,
                idiomsOther: this.idiomsOther
            })
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });
            this.awaitChange = false;
            this.currentStep = step;
            this.goToTop();
        },
        confirmStep12: async function (step) {
            this.pleaseAwait();
            await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
                userID: this.userID,
                preferJobs: this.preferJobs
            })
                .then(function (response) {
                    return response
                })
                .catch(function (error) {
                    return true;
                });

            this.awaitChange = false;
            this.currentStep = step;
            this.goToTop();
        },
        confirmStep13: async function (step) {
            if (this.meetingIncluyeme !== null && this.meetingIncluyeme !== "") {
                this.pleaseAwait();
                await axios.post(this.url + '/incluyeme-login-extension/include/verifications/register.php', {
                    userID: this.userID,
                    meetingIncluyeme: this.meetingIncluyeme
                })
                    .then(function (response) {
                        return response
                    })
                    .catch(function (error) {
                        return true;
                    });
            }
            this.awaitChange = false;
            this.currentStep = step;
            window.location.href = '/agradecemos';
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
        getTeste: async function (id) {
            let universities = await jQuery.ajax({
                url: 'https://jobstalentoincluir.com.br/wp-content/plugins/incluyeme-login-extension/include/search/countries.php?countries=BR',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
           
           
            this.universities[0] = universities.message;

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
            this.formFields.push(1)
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
                url: this.url + '/incluyeme-login-extension/include/search/idioms.php?idiomsAll=allRegistro',
                type: 'GET',
                dataType: 'json'
            }).done(success => {
                return success;
            });
            this.idiom = idioms.message
        },
        addStudies: async function () {
            this.formFields.push(1);
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            })
        },
        addExp: async function () {
            this.formFields2.push(1);
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            })
        },
        addIdioms: async function () {
            this.formFields3.push(1);
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            })
        },
        goToTop: function () {
            const content = jQuery('#content').offset() ? jQuery('#content').offset() : jQuery('#main-content').offset();
            jQuery('html, bfody').animate({
                scrollTop: content.top - 20
            }, 500);
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
            this.actuWork.splice(index, 1);
            this.dateStudiesDLaboral.splice(index, 1);
            this.dateStudiesHLaboral.splice(index, 1);
            this.jobsDescript.splice(index, 1);
            this.jobsSalario.splice(index, 1);
        },
        deleteIdioms: async function (index) {
            this.formFields3.splice(index, 1);
            this.lecLevel.splice(index, 1);
            this.redLevel.splice(index, 1);
            this.idioms.splice(index, 1);
            this.oralLevel.splice(index, 1);
        },
        pleaseAwait: function () {
            this.validation = false;
            iziToast.info({
                title: 'Verificando',
                message: 'Estamos verificando suas informações, por favor aguarde.',
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
        confirmStep6: async function (step) {
            if (!this.fisica && !this.multipla && !this.auditiva && !this.visual && !this.intelectual && !this.mental && !this.surdocegueira) {
                jQuery("#disSelects").css('color', "red");
                this.validation = 12
            } else {
                jQuery("#disSelects").removeAttr("style");
                this.currentStep = step;
                this.validation = null;
            }
            this.goToTop();
        },
        renderPickers: function () {
            jQuery('.selectpicker').selectpicker('refresh');

        }
    },
    watch: {
        currentStep: function (val, old) {
            if (val === 4) {
                this.$nextTick(function () {
                    jQuery('#city').selectpicker('refresh');
                    jQuery('#state').selectpicker('refresh');
                    jQuery('.cep').mask('99999-999');
                    jQuery('.celular').mask('99999-9999');
                    jQuery('.fixo').mask('0000-0000');
                    jQuery("[data-id='country_edu']").css("display", "none");
                    jQuery("[data-id='university_edu']").css("display", "none");
                });
            }
            if (val === 8) {
                this.$nextTick(function () {
                    jQuery('#country_edu').selectpicker('val','BR');
                    jQuery('#university_edu').selectpicker('refresh');
                    jQuery('#studies').selectpicker('refresh');
                });
            }
            if (val === 9) {
                jQuery('#country_edu').css('display', 'none');
                this.$nextTick(function () {
                    jQuery("[data-id='country_edu']").css("display", "none");
                    jQuery("[data-id='university_edu']").css("display", "none");
                    jQuery('#studies').selectpicker('refresh');
                    jQuery('#levelExperience').selectpicker('refresh');
                });
            }
            if (val === 10) {
                this.$nextTick(function () {
                    jQuery('#studies').selectpicker('hide');
                    jQuery('#lecLevel').selectpicker('refresh');
                    jQuery('#redLevel').selectpicker('refresh');
                    jQuery('#idioms').selectpicker('refresh');
                    jQuery('#oralLevel').selectpicker('refresh');
                    jQuery("[data-id='preferJobs']").css("display", "none");
                });
            }
            if (val === 11) {
                this.$nextTick(function () {
                    jQuery('#studies').selectpicker('hide');
                    jQuery('#preferJobs').selectpicker('refresh');
                    jQuery('#redLevel').selectpicker('hide');
                    jQuery('#idioms').selectpicker('hide');
                    jQuery('#oralLevel').selectpicker('hide');
                });
            }
            if (val === 12) {
                this.$nextTick(function () {
                    jQuery('#preferJobs').selectpicker('hide');
                });
            }


        },
        cities: function () {
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            });
        }, universities: function () {
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            });
        }, study: function () {
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            });
        }, experiences: function () {
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            });
        }, idiom: function () {
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            });
        }, levels: function () {
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            });
        },
        country_edu: function () {
            this.$nextTick(function () {
                jQuery('.selectpicker').selectpicker('refresh');
            });
        },
    }
});
startApp();



