<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/wp-load.php';
require_once 'vendor/autoload.php';

abstract class WP_Incluyeme_Countries_Abs
{
    protected static $country;
    protected static $universitiesTable;
    protected static $countriesTable;
    protected static $studies;
    protected static $experiencesAreas;
    protected static $idioms;
    protected static $levelsIdioms;
    protected static $prefersJobs;
    protected static $userName;
    protected static $userLastName;
    protected static $userSlug;
    protected static $userID;
    protected static $wp;
    protected static $usersDiscapTable;
    protected static $usersDisQuestions;
    protected static $usersIdioms;
    protected static $incluyemeFilters;
    protected static $incluyemeUsersInformation;
    protected static $upload_dir;
    protected static $dataPrefix;
    protected static $provinciasTable;
    protected static $citiesTable;
    protected static $incluyemeLoginCountry;
    private static $incluyemeLoginGoogle;
    private static $incluyemeLoginFB;
    private static $incluyemeLoginFBSECRET;
    private static $discaps = 'IncluyemeDiscap';
    private static $discapMore = 'IncluyemeDiscapMore';
    private static $state = 'IncluyemeStateConf';
    private static $street = 'IncluyemeStreetConf';
    private static $city = 'IncluyemeCityConf';
    private static $cep = 'IncluyemeCepConf';
    private static $numero = 'IncluyemNumeroConf';
    private static $bairro = 'IncluyemBairroConf';
    private static $ingles = 'Incluyemeingles';
    private static $libras = 'Incluyemelibras';
    private static $espanhol = 'Incluyemeespanhol';
    private static $countryIncluyeme = 'IncluyemeCountryConf';
    private static $usersIdiomsOthers = 'usersIdiomsOthers';
    
    public function __construct()
    {
        global $wpdb;
        self::$wp = $wpdb;
        self::$dataPrefix = $wpdb->prefix;
        self::$countriesTable = $wpdb->prefix . 'incluyeme_countries';
        self::$universitiesTable = $wpdb->prefix . 'incluyeme_academies';
        self::$studies = $wpdb->prefix . 'incluyeme_areas';
        self::$experiencesAreas = $wpdb->prefix . 'incluyeme_level_experience';
        self::$levelsIdioms = $wpdb->prefix . 'incluyeme_idioms_level';
        self::$idioms = $wpdb->prefix . 'incluyeme_idioms';
        self::$prefersJobs = $wpdb->prefix . 'incluyeme_prefersjobs';
        self::$usersDiscapTable = $wpdb->prefix . 'incluyeme_users_dicapselect';
        self::$usersDisQuestions = $wpdb->prefix . 'incluyeme_users_questions';
        self::$usersIdioms = $wpdb->prefix . 'incluyeme_users_idioms';
        self::$incluyemeUsersInformation = $wpdb->prefix . 'incluyeme_users_information';
        self::$country = false;
        self::$incluyemeFilters = 'incluyemeFiltersCV';
        self::$upload_dir = wp_upload_dir() ['basedir'] . '/wpjobboard/resume/';
        self::$provinciasTable = $wpdb->prefix . 'incluyeme_provincias';
        self:: $citiesTable = $wpdb->prefix . 'incluyeme_cities';
        self::$incluyemeLoginCountry = 'incluyemeLoginCountry';
        self::$incluyemeLoginGoogle = 'incluyemeLoginGoogle';
        self::$incluyemeLoginFB = 'incluyemeLoginFB';
        self::$incluyemeLoginFBSECRET = 'incluyemeLoginFBSECRET';
        self::$discaps = get_option(self::$discaps) ? get_option(self::$discaps) : 'tipo_discapacidad';
        self::$discapMore = get_option(self::$discapMore) ? get_option(self::$discapMore) : 'detalle';
        self::$state = get_option(self::$state) ? get_option(self::$state) : 'IncluyemeStateConf';
        self::$city = get_option(self::$city) ? get_option(self::$city) : 'IncluyemeCityConf';
        self::$cep = get_option(self::$cep) ? get_option(self::$cep) : 'IncluyemeCepConf';
        self::$numero = get_option(self::$numero) ? get_option(self::$numero) : 'IncluyemeNumeroConf';
        self::$bairro = get_option(self::$bairro) ? get_option(self::$bairro) : 'IncluyemeBairroConf';
        self::$ingles = get_option(self::$ingles) ? get_option(self::$ingles) : 'Incluyemeingles';
        self::$libras = get_option(self::$libras) ? get_option(self::$libras) : 'Incluyemelibras';
        self::$espanhol = get_option(self::$espanhol) ? get_option(self::$espanhol) : 'Incluyemeespanhol';
        self::$countryIncluyeme = get_option(self::$countryIncluyeme) ? get_option(self::$countryIncluyeme) : 'IncluyemeCountryConf';
        self::$usersIdiomsOthers = get_option(self::$usersIdiomsOthers) ? get_option(self::$usersIdiomsOthers) : 'usersIdiomsOthers';
    }
    
    /**
     * @param mixed $userID
     */
    public static function setResumeID($userID)
    {
        self::$userID = $userID;
    }
    
    public static function allCountries()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$countriesTable);
    }
    
    public static function getUniversities()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$universitiesTable . ' where country = ' . self::getCountry());
    }
    
    /**
     * @return mixed
     */
    public static function getCountry()
    {
        return '"' . self::$country . '"';
    }
    
    /**
     * @param mixed $country
     */
    public static function setCountry($country)
    {
        self::$country = $country;
    }
    
    public static function allStudies()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$studies . " WHERE active = 1");
    }
    
    public static function allExpedienciesAreas()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$experiencesAreas . " WHERE active = 1");
    }
    
    public static function allIdioms()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$idioms . " WHERE active = 1");
    }
    
    public static function allIdiomResume()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$idioms . " WHERE active = 1 order by id LIMIT 4");
    }
    
    public static function allLevels()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$levelsIdioms . " WHERE active = 1");
    }
    
    public static function allPrefersJobs()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$prefersJobs . " WHERE active = 1");
    }
    
     public static function loginLink(){
        include 'vendor/hybridauth/hybridauth/src/autoload.php';
        session_start();
        $config = [
            'callback' => 'https://jobstalentoincluir.com.br/wp-content/plugins/incluyeme-login-extension/include/lib/abstracts/vendor/hybridauth/hybridauth/examples/example_06/callback.php',
            'keys' => ['id' => '77enshq5lqkzdk', 'secret' => 'qyQS2hPoW7lDAkrT'],
        ];
   
        $github = new Hybridauth\Provider\LinkedIn($config);
        
        $github->authenticate();
         


        $userProfile = $github->getUserProfile();
       
        //echo 'Hi ' . $userProfile->displayName;
        try {
            $github->getUserProfile();
        }
        
        /**
         * Catch Curl Errors
         *
         * This kind of error may happen in case of:
         *     - Internet or Network issues.
         *     - Your server configuration is not setup correctly.
         *
         * The full list of curl errors that may happen can be found at http://curl.haxx.se/libcurl/c/libcurl-errors.html
         */
        catch (Hybridauth\Exception\HttpClientFailureException $e) {
            echo 'Curl text error message : ' . $github->getHttpClient()->getResponseClientError();
        }
        
        /**
         * Catch API Requests Errors
         *
         * This usually happens when requesting a:
         *     - Wrong URI or a mal-formatted http request.
         *     - Protected resource without providing a valid access token.
         */
        catch (Hybridauth\Exception\HttpRequestFailedException $e) {
            echo 'Raw API Response: ' . $github->getHttpClient()->getResponseBody();
        }
        
        /**
         * Base PHP's exception that catches everything [else]
         */
        catch (\Exception $e) {
            echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
        }



    }
    
    public static function searchUserExist($email, $password)
    {
        $user = email_exists($email);
        if ($user) {
            return true;
        }
        return false;
    }
    
    public static function searchUserExistSocial($email, $password, $name, $lastName, $google = null, $facebook = null, $linkedin = null)
    {
         if (($linkedin !== false) && ($linkedin !== null)) {
            $user = email_exists($email);
        
            if ($user) {
                $user = get_user_by('email', $email);
                self::$userID = $user->ID;
                self::auto_login_new_userSocial();
                $redirect_to = site_url() . '/registro-usuarios/';
                wp_redirect($redirect_to);
                exit();
            }
            self::registerUser($email, $password, $name, $lastName, true);
            // return 78523;
         }
        
        if (($facebook !== false) && ($facebook !== null)) {
            $fb = new \Facebook\Facebook([
                'app_id' => get_option(self::$incluyemeLoginFB),
                'app_secret' => get_option(self::$incluyemeLoginFBSECRET),
                'default_graph_version' => 'v2.10',
            ]);
   
            
            try {
                $response = $fb->get(
                    '/me?fields=first_name, last_name,email',
                    $facebook
                );
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                return false;
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                 echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            }
            
            $me = $response->getGraphUser();
            $email = $me->getProperty('email');
            $password = $me->getProperty('email') . $me->getProperty('first_name');
            $name = $me->getProperty('first_name');
            $lastName = $me->getProperty('last_name');
            $user = email_exists($email);
            
        
            if ($user) {
                $user = get_user_by('email', $email);
                self::$userID = $user->ID;
                self::auto_login_new_userSocial();
                $redirect_to = site_url() . '/registro-usuarios/';
                wp_redirect($redirect_to);
                exit();
            }
            self::registerUser($email, $password, $name, $lastName, true);
            // return 78523;
        } else {
            return false;
        }
    }
    
    private static function auto_login_new_userSocial()
    {
        wp_set_current_user(self::$userID);
        wp_set_auth_cookie(self::$userID);
    }
    
    public static function registerUser($email, $password, $first_name, $last_name, $social = false, $haveDiscap = false)
    {
        self::$userName = $first_name;
        self::$userLastName = $last_name;
        self::$userID = wp_insert_user([
            "user_login" => $email,
            "user_email" => $email,
            "user_pass" => $password,
            "role" => "subscriber"
        ]);
        
        update_user_meta(self::$userID, 'first_name', $first_name);
        update_user_meta(self::$userID, 'last_name', $last_name);
        self::$userSlug = Wpjb_Utility_Slug::generate(Wpjb_Utility_Slug::MODEL_RESUME, $first_name . ' ' . $last_name);
        $temp = wpjb_upload_dir("resume", "", null, "basedir");
        $finl = dirname($temp) . "/" . self::$userID;
        wpjb_rename_dir($temp, $finl);
        self::userRegisterWPBJ($haveDiscap == 'noDIS');
        if ($social) {
            self::auto_login_new_userSocial();
        } else {
            self::auto_login_new_user();
        }
        return;
    }
    
    private static function userRegisterWPBJ($haveDiscap)
    {
        global $wpdb;
        $registerTime = current_time('mysql');
        $post_id = wp_insert_post([
            "post_title" => trim(self::$userName . " " . self::$userLastName),
            "post_name" => self::$userSlug,
            "post_type" => "resume",
            "post_status" => 'publish',
            "comment_status" => "closed"
        ]);
        $wpdb->insert($wpdb->prefix . 'wpjb_resume', [
            'post_id' => $post_id,
            'user_id' => self::$userID,
            'candidate_slug' => self::$userSlug,
            'created_at' => $registerTime,
            'modified_at' => $registerTime
        ]);
        $id = $wpdb->insert_id;
        self::$wp->insert(self::$wp->prefix . 'wpjb_resume_search', [
            'fullname' => self::$userName . ' ' . self::$userLastName,
            'location' => '',
            'details' => '',
            'details_all' => '',
            'resume_id' => $id,
        ]);
        if ($haveDiscap == true) {
            self::updateDiscapacidades($id, ['Ninguna'], 'Ninguna');
        }
        return $wpdb->insert_id;
    }
    
    public static function updateDiscapacidades($userID, $discaps, $moreDis)
    {
        $result2 = self::$wp->get_results("SELECT * from " . self::$dataPrefix . "wpjb_meta where   meta_type = 3 and name = '" . self::$discaps . "'");
        if (count($result2) > 0) {
            self::$wp->get_results('DELETE from ' . self::$dataPrefix . 'wpjb_meta_value WHERE object_id = ' . $userID . '  AND meta_id = ' . $result2[0]->id);
        }
        
        for ($i = 0; $i < count($discaps); $i++) {
            if ($discaps[$i] === 'Ninguna') {
                
                if (count($result2) > 0) {
                    self::$wp->insert(self::$dataPrefix . "wpjb_meta_value", [
                        'value' => 'Nenhuma',
                        'object_id' => $userID,
                        'meta_id' => $result2[0]->id
                    ]);
                }
                return true;
            }
            $result = self::$wp->get_results('SELECT * from ' . self::$usersDiscapTable . ' where resume_id = ' . $userID . '  AND discap_id = ' . $discaps[$i]);
            $disca = null;
            switch ($discaps[$i]) {
                case 1:
                    $disca = 'Física';
                    break;
                case 2:
                    $disca = 'Auditiva';
                    break;
                case 3:
                    $disca = 'Visual';
                    break;
                case 4:
                    $disca = 'Múltipla';
                    break;
                case 5:
                    $disca = 'Intelectual';
                    break;
                case 6:
                    $disca = 'Mental';
                    break;
                case 7:
                    $disca = 'Surdocegueira';
                    break;
                default:
                    $disca = null;
                    break;
            }
            if ($disca != null) {
                if (count($result2) > 0) {
                    self::$wp->insert(self::$dataPrefix . "wpjb_meta_value", [
                        'value' => $disca,
                        'object_id' => $userID,
                        'meta_id' => $result2[0]->id
                    ]);
                }
            }
            if (count($result) <= 0) {
                self::$wp->insert(self::$usersDiscapTable, [
                    'discap_id' => $discaps[$i],
                    'resume_id' => $userID
                ]);
            }
            
        }
        
        self::$wp->get_results('UPDATE ' . self::$incluyemeUsersInformation . ' SET     moreDis  = "' . $moreDis . '" WHERE resume_id = ' . $userID);
        if (count($discaps) !== 0) {
            self::$wp->get_results('DELETE from ' . self::$usersDiscapTable . ' WHERE resume_id = ' . $userID . '  AND discap_id NOT IN (' . implode(',', $discaps) . ')');
        }
        
        
        if ($moreDis !== null) {
            $result = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta where    meta_type = 3 and name =  ' . "'" . self::$discapMore . "'");
            if (count($result) > 0) {
                $search = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta_value where meta_id  = ' . $result[0]->id . ' and object_id = ' . $userID);
                
                if (count($search) > 0) {
                    self::$wp->update(self::$dataPrefix . 'wpjb_meta_value', [
                        'value' => $moreDis,
                        'meta_id' =>
                            $result[0]->id,
                        'object_id' => $userID], ['meta_id' =>
                        $result[0]->id,
                        'object_id' => $userID]);
                } else if (count($result) > 0) {
                    self::$wp->insert(self::$dataPrefix . 'wpjb_meta_value', [
                        'value' => $moreDis,
                        'meta_id' =>
                            $result[0]->id,
                        'object_id' => $userID]);
                }
            }
        }
        return true;
    }
    
    private static function auto_login_new_user()
    {
        wp_set_current_user(self::$userID);
        wp_set_auth_cookie(self::$userID);
        exit;
    }
    
    public static function searchUserExistSocialINIT($email, $password, $name, $lastName, $google = null, $facebook = null, $linkedin = null)
    {
         if (($linkedin !== false) && ($linkedin !== null)) {
            $user = email_exists($email);
        
            if ($user) {
                $user = get_user_by('email', $email);
                self::$userID = $user->ID;
                self::auto_login_new_userSocial();
                $redirect_to = site_url() . '/registro-usuarios/';
                wp_redirect($redirect_to);
                exit();
            }
            self::registerUser($email, $password, $name, $lastName, true);
            // return 78523;
         }
        
        if ($google !== false && $google !== null && $password !== $name) {
            $client = new Google_Client(['client_id' => get_option(self::$incluyemeLoginGoogle)]);
            $payload = $client->verifyIdToken($google);
            if ($payload) {
                $user = email_exists($payload['email']);
                if ($payload['email'] == $email && $user) {
                    $user = get_user_by('email', $payload['email']);
                    self::$userID = $user->ID;
                    self::auto_login_new_userSocial();
                    $redirect_to = site_url() . '/registro-usuarios';
                    wp_redirect($redirect_to);
                    exit();
                }
                self::registerUser($email, $password, $name, $lastName, true);
                $user = get_user_by('email', $payload['email']);
                self::$userID = $user->ID;
                return self::$userID;
            }
        }
        if ($facebook !== false && $facebook !== null) {
            $fb = new \Facebook\Facebook([
                'app_id' => get_option(self::$incluyemeLoginFB),
                'app_secret' => get_option(self::$incluyemeLoginFBSECRET),
                'default_graph_version' => 'v2.10',
            ]);
            try {
                $response = $fb->get(
                    '/me?fields=first_name, last_name,email',
                    $facebook
                );
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                return false;
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                return false;
            }
            
            $me = $response->getGraphUser();
            $email = $me->getProperty('email');
            $password = $me->getProperty('email') . $me->getProperty('first_name');
            $name = $me->getProperty('first_name');
            $lastName = $me->getProperty('last_name');
            $user = email_exists($email);
            if ($user) {
                $user = get_user_by('email', $email);
                self::$userID = $user->ID;
                self::auto_login_new_userSocial();
                $redirect_to = site_url() . '/registro-usuarios';
                wp_redirect($redirect_to);
                exit();
            }
            self::registerUser($email, $password, $name, $lastName, true);
            return 78523;
        } else {
            return false;
        }
    }
    
    public static function redirect()
    {
        @ob_flush();
        @ob_end_flush();
        @ob_end_clean();
        $redirect_to = site_url() . '/trabajos';
        wp_safe_redirect($redirect_to);
        exit;
    }
    
    public static function updateUsersEducation($dateStudieB, $dateStudiesD, $dateStudiesH, $eduLevel, $studies, $titleEdu, $university_edu, $university_otro, $country_edu, $userID)
    {
        self::$wp->get_results('DELETE from ' . self::$wp->prefix . 'wpjb_resume_detail' . ' WHERE resume_id = ' . $userID . '  AND type = 2');
        for ($i = 0; $i < count($titleEdu); $i++) {
            self::$wp->insert(self::$wp->prefix . 'wpjb_resume_detail', [
                'resume_id' => $userID,
                'type' => 2,
                'started_at' => $dateStudiesD[$i] ?? $dateStudiesD[$i] ?? date("Y-m-d H:i:s"),
                'completed_at' => $dateStudiesH[$i] ?? $dateStudiesH[$i] ?? '',
                'is_current' => $dateStudieB[$i] ?? $dateStudieB[$i] ?? '',
                'grantor' => $university_edu[$i]  &&$university_edu[$i] !== 'Otro' ?  $university_edu[$i] :  "Otra institución: ". $university_otro[$i],
                'detail_title' => $titleEdu[$i] ?? $titleEdu[$i] ?? '',
                'detail_description' => 'Nivel: ' . ($eduLevel[$i] ?? $eduLevel[$i] ?? ' No Posee. ') . ' Area de Estudio: ' . ($studies[$i] ?? $studies[$i] ?? 'No Posee. ') . ' Pais de estudio: ' . ($country_edu[$i] ?? $country_edu[$i] ?? ' No Posee. ')
            ]);
        }
        return $userID;
    }
    
    public static function updateUsersWorks($actuWork, $areaEmployed, $dateStudiesDLaboral, $dateStudiesHLaboral, $employed, $jobs, $jobsDescript, $levelExperience, $jobsSalario, $userID)
    {
        self::$wp->get_results('DELETE from ' . self::$wp->prefix . 'wpjb_resume_detail' . ' WHERE resume_id = ' . $userID . '  AND type = 1');
        for ($i = 0; $i < count($jobs); $i++) {
            self::$wp->insert(self::$wp->prefix . 'wpjb_resume_detail', [
                'resume_id' => $userID,
                'type' => 1,
                'started_at' => $dateStudiesDLaboral[$i] ?? $dateStudiesDLaboral[$i] ?? date("Y-m-d H:i:s"),
                'completed_at' => $dateStudiesHLaboral[$i] ?? $dateStudiesHLaboral[$i] ?? date("Y-m-d H:i:s"),
                'is_current' => $actuWork[$i] ?? $actuWork[$i] ?? '',
                'grantor' => $employed[$i] ?? ($employed[$i] ?? ''),
                'detail_title' => $jobs[$i] ?? $jobs[$i] ?? '',
                'salario' =>  $jobsSalario[$i] ?? $jobsSalario[$i] ?? '',
                'detail_description' => 'Nivel de Experiencia: ' . ($levelExperience[$i] ?? ' Nao possui. ') . ' Area de Empleo: ' . ($areaEmployed[$i] ?? 'Nao possui. ') . ' Descricao: ' . ($jobsDescript[$i] ?? 'Não possui. ') .' Salario: '. ($jobsSalario[$i] ?? 'Não possui. ')
            ]);
        }
        return $userID;
    }
    
    public static function updateUsersInformation($city, $dateBirthDay, $fPhone, $fiPhone, $genre, $mPhone, $state, $street, $cep, $numero, $bairro, $phone, $meetingIncluyeme = false)
    {
        $userID = get_current_user_id();
        $verifications = self::$wp->get_results('SELECT * FROM ' . self::$dataPrefix . 'wpjb_resume
                                        WHERE ' . self::$dataPrefix . 'wpjb_resume.user_id = ' . $userID . ' LIMIT 1 ');
        if (count($verifications) <= 0) {
            return true;
        }
        $userID = $verifications[0]->id;
        $verification = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'incluyeme_users_information where resume_id = ' . $userID);
        self::$wp->update(self::$wp->prefix . 'wpjb_resume_search', [
            'location' => get_option(self::$incluyemeLoginCountry) . ' ' . $state . ' ' . $city,
        ], ['resume_id' => $userID]);
        self::$wp->update(self::$wp->prefix . 'wpjb_resume', [
            'phone' => $mPhone . ' ' . $phone,
            'candidate_country' => get_option(self::$incluyemeLoginCountry),
            'candidate_state' => $state,
            'candidate_zip_code' => $cep,
            'candidate_location' => $city
        ], ['user_id' => get_current_user_id()]);
        if (count($verification) > 0) {
            self::$wp->update(self::$incluyemeUsersInformation, [
                'genre' => $genre ?? '',
                'birthday' => $dateBirthDay ?? '',
                'phonem' => $phone ?? '',
                'codphonem' => $mPhone ?? '',
                'phonef' => $fPhone ?? '',
                'codphonef' => $fiPhone ?? '',
                'province' => $state ?? '',
                'city' => $city ?? '',
            ], ['resume_id' => $userID]);
        } else {
            self::$wp->insert(self::$incluyemeUsersInformation, [
                'genre' => $genre ?? '',
                'birthday' => $dateBirthDay ?? '',
                'phonem' => $phone ?? '',
                'codphonem' => $mPhone ?? '',
                'phonef' => $fPhone ?? '',
                'codphonef' => $fiPhone ?? '',
                'province' => $state ?? '',
                'resume_id' => $userID,
            ]);
        }
        if ($meetingIncluyeme !== false) {
            self::meetingIncluyeme($userID, $meetingIncluyeme);
        }
        if ($street !== '') {
            $verificaendereco = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta where meta_type = 3 and name ="street"');
            if (count($verificaendereco) > 0) {
                self::$wp->delete(self::$dataPrefix . "wpjb_meta_value", [
                    'object_id' => $userID,
                    'meta_id' => $verificaendereco[0]->id
                ]);
                self::$wp->insert(self::$dataPrefix . "wpjb_meta_value", [
                    'value' => $street,
                    'object_id' => $userID,
                    'meta_id' => $verificaendereco[0]->id
                
                ]);
            }
        }
        if ($numero !== '') {
            $verificanumero = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta where meta_type = 3 and name = "numero"');
            if (count($verificanumero) > 0) {
                self::$wp->delete(self::$dataPrefix . "wpjb_meta_value", [
                    'object_id' => $userID,
                    'meta_id' => $verificanumero[0]->id
                ]);
                self::$wp->insert(self::$dataPrefix . "wpjb_meta_value", [
                    'value' => $numero,
                    'object_id' => $userID,
                    'meta_id' => $verificanumero[0]->id
                
                ]);
            }
        }
         if ($bairro !== '') {
            $verificabairro = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta where meta_type = 3 and name =  "bairro"');
            if (count($verificabairro) > 0) {
                self::$wp->delete(self::$dataPrefix . "wpjb_meta_value", [
                    'object_id' => $userID,
                    'meta_id' => $verificabairro[0]->id
                ]);
                self::$wp->insert(self::$dataPrefix . "wpjb_meta_value", [
                    'value' => $bairro,
                    'object_id' => $userID,
                    'meta_id' => $verificabairro[0]->id
                
                ]);
            }
        }
        return $userID;
    }
    
    public static function meetingIncluyeme($userID, $meetingIncluyeme)
    {
        $prefix = self::$wp->prefix;
        $row = self::$wp->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$prefix}incluyeme_users_information' AND column_name = 'meeting_incluyeme'");
       
        if (empty($row)) {
            self::$wp->query("alter table {$prefix}incluyeme_users_information add meeting_incluyeme text null;");
        }
        self::$wp->update(self::$incluyemeUsersInformation, [
            'meeting_incluyeme' => $meetingIncluyeme,
        
        ], ['resume_id' => $userID]);
    }
    
    public static function updateMotriz($userID, $mPie, $mSen, $mEsca, $mBrazo, $peso, $mRueda, $desplazarte, $mDigi)
    {
        if (isset($mPie)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 1');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $mPie,
                ], ['resume_id' => $userID, 'question_id' => 1]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 1,
                    'answer' => $mPie,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($mSen)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 2');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $mSen,
                ], ['resume_id' => $userID, 'question_id' => 2]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 2,
                    'answer' => $mSen,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($mEsca)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 3');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $mEsca,
                ], ['resume_id' => $userID, 'question_id' => 3]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 3,
                    'answer' => $mEsca,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($mBrazo)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 4');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $mBrazo,
                ], ['resume_id' => $userID, 'question_id' => 4]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 4,
                    'answer' => $mBrazo,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($peso)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 5');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $peso,
                ], ['resume_id' => $userID, 'question_id' => 5]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 5,
                    'answer' => $peso,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($mRueda)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 6');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $mRueda,
                ], ['resume_id' => $userID, 'question_id' => 6]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 6,
                    'answer' => $mRueda,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($desplazarte)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 8');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $desplazarte,
                ], ['resume_id' => $userID, 'question_id' => 8]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 8,
                    'answer' => $desplazarte,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($mDigi)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 7');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $mDigi,
                ], ['resume_id' => $userID, 'question_id' => 7]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 7,
                    'answer' => $mDigi,
                    'resume_id' => $userID,
                ]);
            }
        }
        return true;
    }
    
    public static function updateAuditiva($aAmbient, $aSennas, $aLabial, $aBajo, $aImplante, $aImplanteText, $aOral, $aFluida, $userID)
    {
        if (isset($aAmbient)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 9');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $aAmbient,
                ], ['resume_id' => $userID, 'question_id' => 9]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 9,
                    'answer' => $aAmbient,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($aFluida)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 32');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $aFluida,
                ], ['resume_id' => $userID, 'question_id' => 32]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 32,
                    'answer' => $aFluida,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($aSennas)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 11');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $aSennas,
                ], ['resume_id' => $userID, 'question_id' => 11]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 11,
                    'answer' => $aSennas,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($aLabial)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 12');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $aLabial,
                ], ['resume_id' => $userID, 'question_id' => 12]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 12,
                    'answer' => $aLabial,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($aBajo)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 13');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $aBajo,
                ], ['resume_id' => $userID, 'question_id' => 13]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 13,
                    'answer' => $aBajo,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($aImplante)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 14');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $aImplante,
                    'outro'  => $aImplanteText,
                ], ['resume_id' => $userID, 'question_id' => 14]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 14,
                    'outro'  => $aImplanteText,
                    'answer' => $aImplante,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($aOral)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 10');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $aOral,
                ], ['resume_id' => $userID, 'question_id' => 10]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 10,
                    'answer' => $aOral,
                    'resume_id' => $userID,
                ]);
            }
        }
        return true;
    }
    
    public static function updateVisual($userID, $vLejos, $vObservar, $vColores, $vDPlanos, $vTecniA, $vTecniAvText)
    {
        if (isset($vLejos)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 15');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vLejos,
                ], ['resume_id' => $userID, 'question_id' => 15]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 15,
                    'answer' => $vLejos,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vObservar)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 16');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vObservar,
                ], ['resume_id' => $userID, 'question_id' => 16]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 16,
                    'answer' => $vObservar,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vColores)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 18');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vColores,
                ], ['resume_id' => $userID, 'question_id' => 18]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 18,
                    'answer' => $vColores,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vDPlanos)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 19');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vDPlanos,
                ], ['resume_id' => $userID, 'question_id' => 19]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 19,
                    'answer' => $vDPlanos,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vTecniA)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 17');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vTecniA,
                    'outro' => $vTecniAvText,
                ], ['resume_id' => $userID, 'question_id' => 17]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 17,
                    'outro' => $vTecniAvText,
                    'answer' => $vTecniA,
                    'resume_id' => $userID,
                ]);
            }
        }
        return true;
    }
    
    public static function updateVisceral($userID, $vHumedos, $vTemp, $vPolvo, $vCompleta, $vAdap, $vAdapText)
    {
        if (isset($vHumedos)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 20');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vHumedos,
                ], ['resume_id' => $userID, 'question_id' => 20]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 20,
                    'answer' => $vHumedos,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vTemp)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 21');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vTemp,
                ], ['resume_id' => $userID, 'question_id' => 21]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 21,
                    'answer' => $vTemp,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vPolvo)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 22');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vPolvo,
                ], ['resume_id' => $userID, 'question_id' => 22]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 22,
                    'answer' => $vPolvo,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vCompleta)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 23');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vCompleta,
                ], ['resume_id' => $userID, 'question_id' => 23]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 23,
                    'answer' => $vCompleta,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($vAdap)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 24');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $vAdap,
                    'outro' => $vAdapText,
                ], ['resume_id' => $userID, 'question_id' => 24]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 24,
                    'answer' => $vAdap,
                    'outro' => $vAdapText,
                    'resume_id' => $userID,
                ]);
            }
        }
        return true;
    }
    
    public static function updateIntelectual($userID, $inteEscri, $inteTransla, $inteTarea, $inteActividad, $inteMolesto, $inteTrabajar, $inteTrabajarSolo)
    {
        if (isset($inteEscri)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 25');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $inteEscri,
                ], ['resume_id' => $userID, 'question_id' => 25]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 25,
                    'answer' => $inteEscri,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($inteTransla)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 26');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $inteTransla,
                ], ['resume_id' => $userID, 'question_id' => 26]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 26,
                    'answer' => $inteTransla,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($inteTarea)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 27');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $inteTarea,
                ], ['resume_id' => $userID, 'question_id' => 27]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 27,
                    'answer' => $inteTarea,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($inteActividad)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 31');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $inteActividad,
                ], ['resume_id' => $userID, 'question_id' => 31]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 31,
                    'answer' => $inteActividad,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($inteMolesto)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 30');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $inteMolesto,
                ], ['resume_id' => $userID, 'question_id' => 30]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 30,
                    'answer' => $inteMolesto,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($inteTrabajar)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 28');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $inteTrabajar,
                ], ['resume_id' => $userID, 'question_id' => 28]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 28,
                    'answer' => $inteTrabajar,
                    'resume_id' => $userID,
                ]);
            }
        }
        if (isset($inteTrabajarSolo)) {
            $verification = self::$wp->get_results('SELECT * from ' . self::$usersDisQuestions . ' where resume_id = ' . $userID . '  AND question_id = 29');
            if (count($verification) > 0) {
                self::$wp->update(self::$usersDisQuestions, [
                    'answer' => $inteTrabajarSolo,
                ], ['resume_id' => $userID, 'question_id' => 29]);
            } else {
                self::$wp->insert(self::$usersDisQuestions, [
                    'question_id' => 29,
                    'answer' => $inteTrabajarSolo,
                    'resume_id' => $userID,
                ]);
            }
        }
        return true;
    }
    
    public static function updatePrefersJobs($userID, $preferJobs)
    {
        self::$wp->update(self::$incluyemeUsersInformation, [
            'preferjob_id' => $preferJobs,
        
        ], ['resume_id' => $userID]);
    }
    
    public static function deleteIMG($userID, $value = false)
    {
        if ($value !== false && self::userSessionVerificate($userID)) {
            $dir1 = self::$upload_dir . $userID;
            $dir = self::$upload_dir . $userID;
            if ($value === 1) {
                $dir .= '/image';
            } else if ($value === 2) {
                $dir .= '/cv';
            } else if ($value === 3) {
                $dir .= '/' . (get_option(self::$incluyemeFilters) ? get_option(self::$incluyemeFilters) : 'certificado_discapacidad');
            }
            if (self::searchDIR($dir1) && self::searchDIR($dir)) {
                self::deleteDirForIMGS($dir);
            }
            return true;
        }
        return false;
    }
    
    public static function userSessionVerificate($resume)
    {
        $userID = get_current_user_id();
        if ($userID <= 0) {
            $sessions = WP_Session_Tokens::get_instance($userID);
            $sessions->destroy_all();
            return false;
        }
        $verifications = self::$wp->get_results('SELECT
                                          *
                                        FROM ' . self::$dataPrefix . 'wpjb_resume
                                        WHERE ' . self::$dataPrefix . 'wpjb_resume.user_id = ' . $userID . '
                                        AND ' . self::$dataPrefix . 'wpjb_resume.id = ' . $resume);
        if (count($verifications) > 0) {
            return true;
        }
        return false;
    }
    
    private static function searchDIR($dir)
    {
        if (file_exists($dir)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function deleteDirForIMGS($dirPath)
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    
    public static function updateCV($userID, $CV)
    {
        $dir1 = self::$upload_dir . $userID;
        $dir = self::$upload_dir . $userID . '/cv';
        if (self::searchDIR($dir1)) {
            if (!self::searchDIR($dir)) {
                mkdir($dir1 . '/cv');
            }
            self::deleteDIRS($dir);
            @move_uploaded_file($CV['tmp_name'], $dir . '/' . basename($CV["name"]));
        } else {
            mkdir($dir1);
            self::updateCV($userID, $CV);
        }
    }
    
    private static function deleteDIRS($dir)
    {
        $folder = @scandir($dir);
        if (count($folder) > 2) {
            $search = opendir($dir);
            while ($file = readdir($search)) {
                if ($file != "." and $file != ".." and $file != "index.php") {
                    rmdir($dir . '/' . $file);
                }
            }
        }
    }
    
    public static function updateCUD($userID, $CUD)
    {
        $dir1 = self::$upload_dir . $userID;
        $dir = self::$upload_dir . $userID . '/' . (get_option(self::$incluyemeFilters) ? get_option(self::$incluyemeFilters) : 'certificado_discapacidad');
        if (self::searchDIR($dir1)) {
            if (!self::searchDIR($dir)) {
                mkdir($dir1 . '/' . (get_option(self::$incluyemeFilters) ? get_option(self::$incluyemeFilters) : 'certificado_discapacidad'));
            }
            self::deleteDIRS($dir);
            @move_uploaded_file($CUD['tmp_name'], $dir . '/' . basename($CUD["name"]));
        } else {
            mkdir($dir1);
            self::updateCUD($userID, $CUD);
        }
    }
    
    public static function updateIMG($userID, $IMG)
    {
        $dir1 = self::$upload_dir . $userID;
        $dir = self::$upload_dir . $userID . '/image';
        if (self::searchDIR($dir1)) {
            if (!self::searchDIR($dir)) {
                mkdir($dir1 . '/image');
            }
            self::deleteDIRS($dir);
        } else {
            mkdir($dir1);
            self::updateIMG($userID, $IMG);
        }
        @move_uploaded_file($IMG['tmp_name'], $dir . '/' . basename($IMG["name"]));
    }
    
    public static function updateIdioms($userID, $idioms, $oLevel, $wLevel, $sLevel, $idiomsOther)
    {
        $idiomsOthers = '';
        for ($i = 0; $i < count($idioms); $i++) {
            // if ($idiomsOther[$i] !== null) {
            //     if ($i == 0) {
            //         $idiomsOthers .= $idiomsOther[$i];
            //     } else {
            //         $idiomsOthers .= ", " . $idiomsOther[$i] . ' ';
            //     }
            //     $result = self::$wp->get_results('SELECT * from ' . self::$idioms . ' where name_idioms = ' . '"' . $idiomsOther[$i] . '"');
            //     if (count($result) <= 0) {
            //         self::$wp->insert(self::$idioms, ['name_idioms' => $idiomsOther[$i]]);
            //         $idioms[$i] = self::$wp->insert_id;
            //     } else {
            //         $idioms[$i] = $result[0]->id;
            //     }
            // }
            
            $result = self::$wp->get_results('SELECT * from ' . self::$usersIdioms . ' where resume_id = ' . $userID . '  AND idioms_id = ' . $idioms[$i]);
            if (count($result) > 0) {
                self::$wp->update(self::$usersIdioms, [
                    'idioms_id' => $idioms[$i],
                    'slevel' => $sLevel[$i] ?? 1,
                    'olevel' => $oLevel[$i] ?? 1,
                    'wlevel' => $wLevel[$i] ?? 1,
                
                ], ['resume_id' => $userID, 'idioms_id' => $idioms[$i]]);
            } else {
                self::$wp->insert(self::$usersIdioms, [
                    'idioms_id' => $idioms[$i],
                    'slevel' => $sLevel[$i] ?? 1,
                    'olevel' => $oLevel[$i] ?? 1,
                    'wlevel' => $wLevel[$i] ?? 1,
                    'resume_id' => $userID,
                    'idioms_id' => $idioms[$i]
                
                ]);
            }
       
            $idiomsName = null;
            switch ($idioms[$i]) {
                case 1 :
                    $idiomsName = self::$ingles;
                    break;
                case 2:
                    $idiomsName = self::$libras;
                    break;
                case 3:
                    $idiomsName = self::$espanhol;
                    break;
                default:
                    $idiomsName = null;
                    break;
            }
            
            $level = 'Nenhum';
            switch ($sLevel[$i]) {
                case 1 :
                    $level = 'Básico';
                    break;
                case 2:
                    $level = 'Intermediário';
                    break;
                case 3:
                    $level = 'Avançado';
                    break;
                case 4:
                    $level = 'Bilingüe';
                    break;
            }
            if ($idiomsName !== null) {
                switch ($oLevel[$i]) {
                    case 1 :
                        $level = 'Básico';
                        break;
                    case 2:
                        $level = 'Intermediário';
                        break;
                    case 3:
                        $level = 'Avançado';
                        break;
                    case 4:
                        $level = 'Bilingüe';
                        break;
                }
            }
            if ($idiomsName !== null) {
                switch ($wLevel[$i]) {
                    case 1 :
                        $level = 'Básico';
                        break;
                    case 2:
                        $level = 'Intermediário';
                        break;
                    case 3:
                        $level = 'Avançado';
                        break;
                    case 4:
                        $level = 'Bilingüe';
                        break;
                }
            }
            if ($idiomsName !== null) {
                $result = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta where    meta_type = 3 and name = ' . "'" . $idiomsName . "'");
                if (count($result) > 0) {
                    $search = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta_value where meta_id  = ' . $result[0]->id . ' and object_id = ' . $userID);
                    
                    if (count($search) > 0) {
                        self::$wp->update(self::$dataPrefix . 'wpjb_meta_value', [
                            'value' => $level,
                            'meta_id' =>
                                $result[0]->id,
                            'object_id' => $userID], ['meta_id' =>
                            $result[0]->id,
                            'object_id' => $userID]);
                    } else if (count($result) > 0) {
                        self::$wp->insert(self::$dataPrefix . 'wpjb_meta_value', [
                            'value' => $level,
                            'meta_id' =>
                                $result[0]->id,
                            'object_id' => $userID]);
                    }
                }
            }
        }
        
        if ($idiomsOthers !== '') {
            $result = self::$wp->get_results('SELECT * from ' . self::$dataPrefix . 'wpjb_meta where    meta_type = 3 and name =  ' . "'" . self::$usersIdiomsOthers . "'");
            if (count($result) > 0) {
                self::$wp->delete(self::$dataPrefix . "wpjb_meta_value", [
                    'object_id' => $userID,
                    'meta_id' => $result[0]->id
                ]);
                self::$wp->insert(self::$dataPrefix . "wpjb_meta_value", [
                    'value' => $idiomsOthers,
                    'object_id' => $userID,
                    'meta_id' => $result[0]->id
                
                ]);
            }
        }
        
        if (empty($idioms)) {
             self::$wp->get_results('DELETE from ' . self::$usersIdioms . ' WHERE resume_id = ' . $userID . '');
        }
        else{
            self::$wp->get_results('DELETE from ' . self::$usersIdioms . ' WHERE resume_id = ' . $userID . '  AND idioms_id NOT IN (' . implode(',', $idioms) . ')');
          
        }
        
    }
    
    public static function getUserInformation($id)
    {
        $prefixSearch = self::$dataPrefix;
        if (!self::userSessionVerificate($id)) {
            return 'DONT HAVE ACCESS';
        }
        $information = self::$wp->get_results('SELECT
    ' . self::$dataPrefix . 'incluyeme_prefersjobs.jobs_prefers,
    ' . self::$dataPrefix . 'incluyeme_users_information.*
FROM    ' . self::$dataPrefix . 'incluyeme_users_information
  LEFT OUTER JOIN   ' . self::$dataPrefix . 'incluyeme_prefersjobs
    ON  ' . self::$dataPrefix . 'incluyeme_users_information.preferjob_id =     ' . self::$dataPrefix . 'incluyeme_prefersjobs.id WHERE ' . self::$incluyemeUsersInformation . '.resume_id = ' . $id);
        $works = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'wpjb_resume_detail where type = 1 and resume_id = ' . $id);
        $education = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'wpjb_resume_detail where type = 2 and resume_id = ' . $id);
        $endereco = self::$wp->get_results('SELECT * FROM `wp_wpjb_meta` INNER JOIN `wp_wpjb_meta_value` ON wp_wpjb_meta.id = wp_wpjb_meta_value.meta_id WHERE wp_wpjb_meta_value.object_id =' . $id);
        $resume = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'wpjb_resume where id = ' . $id);
        $discaps = self::$wp->get_results("SELECT
  {$prefixSearch}incluyeme_users_questions.question_id,
  {$prefixSearch}incluyeme_users_questions.answer,
  {$prefixSearch}incluyeme_discapacities_questions.discapacities_questions,
  {$prefixSearch}incluyeme_discapacities.discap_name,
  {$prefixSearch}incluyeme_discapacities.id
FROM {$prefixSearch}incluyeme_users_questions
  INNER JOIN {$prefixSearch}incluyeme_discapacities_questions
    ON {$prefixSearch}incluyeme_users_questions.question_id = {$prefixSearch}incluyeme_discapacities_questions.id
  RIGHT OUTER JOIN {$prefixSearch}incluyeme_discapacities
    ON {$prefixSearch}incluyeme_discapacities_questions.incluyeme_discapacities_id = {$prefixSearch}incluyeme_discapacities.id
  LEFT OUTER JOIN {$prefixSearch}incluyeme_users_dicapselect
    ON {$prefixSearch}incluyeme_discapacities.id = {$prefixSearch}incluyeme_users_dicapselect.discap_id
    AND {$prefixSearch}incluyeme_users_questions.resume_id = {$prefixSearch}incluyeme_users_dicapselect.resume_id
WHERE  {$prefixSearch}incluyeme_users_dicapselect.resume_id = {$id}
GROUP BY {$prefixSearch}incluyeme_users_questions.question_id,
         {$prefixSearch}incluyeme_users_questions.answer,
         {$prefixSearch}incluyeme_discapacities_questions.discapacities_questions,
         {$prefixSearch}incluyeme_discapacities.discap_name,
         {$prefixSearch}incluyeme_discapacities.id");
        $idioms = self::$wp->get_results('SELECT * FROM ' . self::$wp->prefix . 'incluyeme_users_idioms WHERE ' . self::$wp->prefix . 'incluyeme_users_idioms.resume_id = ' . $id);
        $discapsSelected = self::$wp->get_results("SELECT
  wp_incluyeme_users_dicapselect.discap_id as id
FROM wp_incluyeme_users_dicapselect where resume_id ={$id}");

        return (object)['discapsSelected' => $discapsSelected, 'assets' => self::getCV($id), 'idioms' => $idioms, 'discap' => $discaps, 'work' => $works, 'education' => $education, 'endereco' => $endereco, 'resume' => $resume, 'information' => $information[0], 'name' => get_user_meta(get_current_user_id(), 'first_name')[0], 'last_name' => get_user_meta(get_current_user_id(), 'last_name')[0]];
    }
    
    private static function getCV($id)
    {
        
        $CVS = get_option(self::$incluyemeFilters) ? get_option(self::$incluyemeFilters) : 'certificado-discapacidad';
        $path = wp_upload_dir();
        $basePath = $path['basedir'];
        $baseDir = $path['baseurl'];
        $route = $basePath . '/wpjobboard/resume/' . $id;
        $dir = $baseDir . '/wpjobboard/resume/' . $id;
        if (file_exists($route)) {
            if (file_exists($route . '/cv/')) {
                $folder = @scandir($route . '/cv/');
                if (count($folder) > 2) {
                    $search = opendir($route . '/cv/');
                    while ($file = readdir($search)) {
                        if ($file != "." and $file != ".." and $file != "index.php") {
                            $CV = $dir . '/cv/' . $file;
                        }
                    }
                } else {
                    $CV = false;
                }
            } else {
                $CV = false;
            }
            if (file_exists($route . '/image/')) {
                $folder = @scandir($route . '/image/');
                if (count($folder) > 2) {
                    $search = opendir($route . '/image/');
                    while ($file = readdir($search)) {
                        if ($file != "." and $file != ".." and $file != "index.php") {
                            $img = $dir . '/image/' . $file;
                        }
                    }
                } else {
                    $img = false;
                }
            } else {
                $img = false;
            }
            if (file_exists($route . '/' . $CVS . '/')) {
                $folder = @scandir($route . '/' . $CVS . '/');
                if (count($folder) > 2) {
                    $search = opendir($route . '/' . $CVS . '/');
                    while ($file = readdir($search)) {
                        if ($file != "." and $file != ".." and $file != "index.php") {
                            $CUD = $dir . '/' . $CVS . '/' . $file;
                        }
                    }
                } else {
                    $CUD = false;
                }
            } else {
                $CUD = false;
            }
        } else {
            $img = false;
            $CUD = false;
            $CV = false;
        }
        return [$img, $CUD, $CV];
    }
    
    public static function getUser($id)
    {
        if (!self::sessionVerificated($id)) {
            return 'DONT HAVE ACCESS';
        }
        $prefixSearch = self::$dataPrefix;
        $information = self::$wp->get_results('SELECT
    ' . self::$dataPrefix . 'incluyeme_prefersjobs.jobs_prefers,
    ' . self::$dataPrefix . 'incluyeme_users_information.*
FROM    ' . self::$dataPrefix . 'incluyeme_users_information
  LEFT OUTER JOIN   ' . self::$dataPrefix . 'incluyeme_prefersjobs
    ON  ' . self::$dataPrefix . 'incluyeme_users_information.preferjob_id =     ' . self::$dataPrefix . 'incluyeme_prefersjobs.id WHERE ' . self::$incluyemeUsersInformation . '.resume_id = ' . $id);
        $works = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'wpjb_resume_detail where type = 1 and resume_id = ' . $id);
        $education = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'wpjb_resume_detail where type = 2 and resume_id = ' . $id);
        $userID = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'wpjb_resume where id = ' . $id);
        $discapsSelected = self::$wp->get_results("SELECT
  wp_incluyeme_users_dicapselect.discap_id as id
FROM wp_incluyeme_users_dicapselect where resume_id ={$id}");
        $discaps = self::$wp->get_results("SELECT
  {$prefixSearch}incluyeme_users_questions.question_id,
  {$prefixSearch}incluyeme_users_questions.answer,
  {$prefixSearch}incluyeme_discapacities_questions.discapacities_questions,
  {$prefixSearch}incluyeme_discapacities.discap_name,
  {$prefixSearch}incluyeme_discapacities.id
FROM {$prefixSearch}incluyeme_users_questions
  INNER JOIN {$prefixSearch}incluyeme_discapacities_questions
    ON {$prefixSearch}incluyeme_users_questions.question_id = {$prefixSearch}incluyeme_discapacities_questions.id
  RIGHT OUTER JOIN {$prefixSearch}incluyeme_discapacities
    ON {$prefixSearch}incluyeme_discapacities_questions.incluyeme_discapacities_id = {$prefixSearch}incluyeme_discapacities.id
  LEFT OUTER JOIN {$prefixSearch}incluyeme_users_dicapselect
    ON {$prefixSearch}incluyeme_discapacities.id = {$prefixSearch}incluyeme_users_dicapselect.discap_id
    AND {$prefixSearch}incluyeme_users_questions.resume_id = {$prefixSearch}incluyeme_users_dicapselect.resume_id
WHERE  {$prefixSearch}incluyeme_users_dicapselect.resume_id = {$id}
GROUP BY {$prefixSearch}incluyeme_users_questions.question_id,
         {$prefixSearch}incluyeme_users_questions.answer,
         {$prefixSearch}incluyeme_discapacities_questions.discapacities_questions,
         {$prefixSearch}incluyeme_discapacities.discap_name,
         {$prefixSearch}incluyeme_discapacities.id");
        $idioms = self::$wp->get_results('SELECT * FROM ' . self::$wp->prefix . 'incluyeme_users_idioms WHERE ' . self::$wp->prefix . 'incluyeme_users_idioms.resume_id = ' . $id);
        
        return (object)["discapsSelected" => $discapsSelected, 'assets' => self::getCV($id), 'idioms' => $idioms, 'discap' => $discaps, 'work' => $works, 'education' => $education, 'information' => $information[0], 'name' => get_user_meta($userID[0]->user_id, 'first_name'), 'last_name' => get_user_meta($userID[0]->user_id, 'last_name')];
    }
    
    public static function sessionVerificated($resume)
    {
        $userID = get_current_user_id();
        if ($userID <= 0) {
            $sessions = WP_Session_Tokens::get_instance($userID);
            $sessions->destroy_all();
            return false;
        }
        return true;
    }
    
    public static function updateNames($name, $lastName)
    {
        $userID = get_current_user_id();
        update_user_meta($userID, 'first_name', $name);
        update_user_meta($userID, 'last_name', $lastName);
        $userID = self::$wp->get_results('SELECT * from ' . self::$wp->prefix . 'wpjb_resume where id = ' . self::getResumeID());
        $my_resume = [
            'ID' => $userID[0]->post_id,
            'post_title' => $name . ' ' . $lastName,
        ];
        wp_update_post($my_resume);
        self::$wp->update(self::$dataPrefix . 'wpjb_resume_search', [
            'fullname' => $name . ' ' . $lastName
        ], ['resume_id' => self::getResumeID()]);
    }
    
    /**
     * @return mixed
     */
    public static function getResumeID()
    {
        return self::$userID;
    }
    
    public static function getProvincias()
    {
        global $wpdb;
        
        if (get_option(self::$incluyemeLoginCountry) == 'CO') {
            return $wpdb->get_results("SELECT
                                          *
                                        FROM  " . self::$provinciasTable . "
                                        WHERE country_code = 'CO' ORDER BY cities_provin");
        }
        return $wpdb->get_results("SELECT * from " . self::$provinciasTable . ' where country_code = "' . get_option(self::$incluyemeLoginCountry) . '" ');
    }
    
    public static function getCities($cityCode)
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * from " . self::$citiesTable . ' where cities_location = "' . $cityCode . '"');
    }
}
