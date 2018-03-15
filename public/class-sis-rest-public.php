<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://digitalwebinfosoft.com
 * @since      1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author  :           Dave Patel
 * @author Skype :      dave.dwis
 * @author Email :      dave.dwis@gmail.com
 */
class Sis_Rest_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of this plugin.
     */
    private $version;


   

    /**
     * The namespace to add to the api calls.
     *
     * @var string The namespace to add to the api call
     */
    private $namespace;

    /**
     * Get Api Key From header.
     *
     * @since    1.0.0
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     */

    private $wpdb_prefix;
    

    private $apiKey;

    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;
    const HTTP_PROCESSING = 102;            // RFC2518
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_NO_CONTENT = 204;
    const HTTP_RESET_CONTENT = 205;
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_MULTI_STATUS = 207;          // RFC4918
    const HTTP_ALREADY_REPORTED = 208;      // RFC5842
    const HTTP_IM_USED = 226;               // RFC3229
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_SEE_OTHER = 303;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_USE_PROXY = 305;
    const HTTP_RESERVED = 306;
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_PERMANENTLY_REDIRECT = 308;  // RFC7238
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_CONFLICT = 409;
    const HTTP_GONE = 410;
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_REQUEST_URI_TOO_LONG = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_I_AM_A_TEAPOT = 418;                                               // RFC2324
    const HTTP_MISDIRECTED_REQUEST = 421;                                         // RFC7540
    const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
    const HTTP_LOCKED = 423;                                                      // RFC4918
    const HTTP_FAILED_DEPENDENCY = 424;                                           // RFC4918
    const HTTP_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;   // RFC2817
    const HTTP_UPGRADE_REQUIRED = 426;                                            // RFC2817
    const HTTP_PRECONDITION_REQUIRED = 428;                                       // RFC6585
    const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
    const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585
    const HTTP_UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_NOT_IMPLEMENTED = 501;
    const HTTP_BAD_GATEWAY = 502;
    const HTTP_SERVICE_UNAVAILABLE = 503;
    const HTTP_GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;
    const HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;                        // RFC2295
    const HTTP_INSUFFICIENT_STORAGE = 507;                                        // RFC4918
    const HTTP_LOOP_DETECTED = 508;                                               // RFC5842
    const HTTP_NOT_EXTENDED = 510;                                                // RFC2774
    const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;                             // RFC6585s


    public static $statusTexts = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',                                               // RFC2324
        421 => 'Misdirected Request',                                         // RFC7540
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Reserved for WebDAV advanced collections expired proposal',   // RFC2817
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        451 => 'Unavailable For Legal Reasons',                               // RFC7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',                                     // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    );

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        global $wpdb;
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->namespace = $this->plugin_name.'/v'.intval($this->version);
        $this->wpdb = $wpdb; 
        $this->wpdb_prefix = $wpdb->prefix; 
        
        /*$this->get_apikey();             */

    }

    /**
    * Add the API with apikey
    */

    public function is_apikey($apikey){
        $this->apiKey = false;
        if(!empty($apikey) &&$apikey==AUTH_KEY){
            $this->apiKey = true;
        }
    }

    /**
    * Add the API with Access Token.
    */

    public function is_accesstoken($accesstoken){
        $this->accessToken = false;

        if(!empty($accesstoken)){
            $isAuthorized = $this->wpdb->get_row( "SELECT id FROM {$this->wpdb_prefix}access_tokens WHERE accessToken = '{$accesstoken}' LIMIT 1" );            
            if(!empty($isAuthorized)) {
                $this->accessToken = true;
            }
        }
    }

    /**
     * Add the endpoints to the API
     */
    public function add_api_routes()
    {
       /*
       * Only Apikey validate urls
       *
       */     
        register_rest_route($this->namespace, 'login', [
            'methods' => 'POST',
            'callback' => array($this, 'get_login'),            
            'args' => array(
                'deviceToken' => array(
                    'required' => false,
                ),
                'deviceId' => array(
                    'required' => true,
                    'description' => __('Please Enter deviceId',$this->plugin_name),
                ),
                'deviceType' => array(
                    'required' => true,
                    'description' => __('Please Enter deviceType',$this->plugin_name),
                    'type' => 'string',
                    'enum' => array('1','2','3',),
                ),
                'username' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => __('Please Enter Username',$this->plugin_name),
                ),
                'password' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => __('Please Enter Password',$this->plugin_name),
                ),
            )
        ]);

       register_rest_route($this->namespace, 'logout', array(
            'methods' => 'POST',
            'callback' => array($this, 'logout'),
       )); 
       register_rest_route($this->namespace, 'register', array(
            'methods' => 'POST',
            'callback' => array($this, 'register'),
            'args' => array(
                'deviceToken' => array(
                    'required' => false,
                ),
                'deviceId' => array(
                    'required' => true,
                    'description' => __('Please Enter deviceId',$this->plugin_name),
                ),
                'deviceType' => array(
                    'required' => true,
                    'description' => __('Please Enter deviceType',$this->plugin_name),
                    'type' => 'string',
                    'enum' => array('1','2','3',),
                ),
                'email' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => 'The user\'s email address',
                    'format' => 'email'
                ),
                'username' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => __('Please Enter Username',$this->plugin_name),
                ),
                'password' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => __('Please Enter Password',$this->plugin_name),
                ),
                'fname' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => __('Please Enter Password',$this->plugin_name),
                ),
                'lname' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => __('Please Enter Password',$this->plugin_name),
                ),

            )
       ));

       register_rest_route($this->namespace, 'forgotpassword', array(
            'methods' => 'POST',
            'callback' => array($this, 'forgotpassword'),
            'args' => array(
                'email' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => 'The user\'s email address',
                    'format' => 'email'
                ),
            )
       ));

        register_rest_route($this->namespace, 'fblogin', array(
            'methods' => 'POST',
            'callback' => array($this, 'fblogin'),
            'args' => array(
                'email' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => 'The user\'s email address',
                    'format' => 'email'
                ),
            )
       ));


       
       /*
       * Only Apikey and access token after login.
       *
       */ 

       
        
    }

     /**
     * Get the user and password in the request body and generate a JWT
     *
     * @param [type] $request [description]
     *
     * @return [type] [description]
     */
    public function get_login($request)
    {
       
       $apikey = $request->get_header('apikey');
       $this->is_apikey($apikey); 
       if(empty($this->apiKey)):
            return array(
                 'message' => 'Unauthorized',
                 'error' => 'Unauthorized',
                 'code' => 'Unauthorized',
                 'data' => array(
                     'error' => 'Unauthorized',
                     'status' => Sis_Rest_Public::HTTP_UNAUTHORIZED,
                 ),
            ); 
       endif;
       
       /*echo "<pre>";print_r($request);*/
       $username = $request->get_param('username');
       $password = $request->get_param('password');
       $deviceId = $request->get_param('deviceId');
       $deviceType = $request->get_param('deviceType');
       $deviceToken = $request->get_param('deviceToken');
       
       

       /** Try to authenticate the user with the passed credentials*/
        $user = wp_authenticate($username, $password);

        /** If the authentication fails return a error*/
        if (is_wp_error($user)) {
            $error_code = $user->get_error_code();
            return array(
                 'message' => $error_code,
                 'code' => $error_code,
                 'error' => $error_code,
                 'data' => array(
                     'error' => $error_code,
                     'status' => Sis_Rest_Public::HTTP_FORBIDDEN,
                 ),
            );
        }
        $userId = $user->ID;
        $accessToken = md5(uniqid(mt_rand(), true));
        $accessTokenData = $this->wpdb->get_row( "SELECT id,accessToken FROM {$this->wpdb_prefix}access_tokens WHERE userId = {$userId} AND deviceId = '{$deviceId}' AND deviceType = '{$deviceType} LIMIT 1'" );
        
        $user = get_user_by('ID',$userId);
        $userdata = (array)$user->data;
        $userroles = (array)$user->roles;        
        if(empty($accessTokenData)) {
           $isAccessTokenCreated =  $this->wpdb->insert($this->wpdb_prefix.'access_tokens',
                array(
                    'userId'    => $userId,
                    'deviceId' => $deviceId,
                    'deviceType'  => $deviceType,
                    'accessToken' => $accessToken,
                    'deviceToken' => $deviceToken,
                    
                )
            );
            if ($userId && $isAccessTokenCreated) {
                return array(
                     'code' => Sis_Rest_Public::HTTP_OK,
                     'message'=> __('You have successfully logged in.',$this->plugin_name),
                     'data' => array_merge(['status' => Sis_Rest_Public::HTTP_OK,'accessToken' => $accessToken,'roles'=>implode(",", $userroles)],$userdata)
                );
            }
        } else {
             return array(
                 'code' => Sis_Rest_Public::HTTP_OK,
                 'message'=> __('You have successfully logged in.',$this->plugin_name),
                 'data' => array_merge(['status' => Sis_Rest_Public::HTTP_OK,'accessToken' => $accessTokenData->accessToken,'roles'=>implode(",", $userroles)],$userdata)
            );
        }
        return array(
            'code' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'error' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,'message'=> 'There was a problem while trying to log you in, please try again.'])
        );
        
    }

    /*
    * facebook login. 
    *
    */


    public function fblogin($request) {

        $apikey = $request->get_header('apikey');
        $this->is_apikey($apikey); 
           if(empty($this->apiKey)):
                return array(
                     'message' => 'Unauthorized',
                     'error' => 'Unauthorized',
                     'code' => 'Unauthorized',
                     'data' => array(
                         'error' => 'Unauthorized',
                         'status' => Sis_Rest_Public::HTTP_UNAUTHORIZED,
                     ),
                ); 
           endif;

        $email = $request->get_param('email');
        $exists = email_exists( $email );
        if ( $exists ) {
            $user = get_user_by('email',$email);
            $userId = $user->ID;
            $accessToken = md5(uniqid(mt_rand(), true));
            $accessTokenData = $this->wpdb->get_row( "SELECT id,accessToken FROM {$this->wpdb_prefix}access_tokens WHERE userId = {$userId} AND deviceId = '{$deviceId}' AND deviceType = '{$deviceType} LIMIT 1'" );
            $userdata = (array)$user->data;
            $userroles = (array)$user->roles;        
            if(empty($accessTokenData)) {
               $isAccessTokenCreated =  $this->wpdb->insert($this->wpdb_prefix.'access_tokens',
                    array(
                        'userId'    => $userId,
                        'deviceId' => $deviceId,
                        'deviceType'  => $deviceType,
                        'accessToken' => $accessToken,
                        'deviceToken' => $deviceToken,
                        
                    )
                );
                if ($userId && $isAccessTokenCreated) {
                    return array(
                         'code' => Sis_Rest_Public::HTTP_OK,
                         'message'=> __('You have successfully logged in.',$this->plugin_name),
                         'data' => array_merge(['status' => Sis_Rest_Public::HTTP_OK,'accessToken' => $accessToken,'roles'=>implode(",", $userroles)],$userdata)
                    );
                }
            } else {
                 return array(
                     'code' => Sis_Rest_Public::HTTP_OK,
                     'message'=> __('You have successfully logged in.',$this->plugin_name),
                     'data' => array_merge(['status' => Sis_Rest_Public::HTTP_OK,'accessToken' => $accessTokenData->accessToken,'roles'=>implode(",", $userroles)],$userdata)
                );
            }
        } else {
           return array(
            'code' => Sis_Rest_Public::HTTP_BAD_REQUEST,
            'message' => __('Email is incorrect.',$this->plugin_name),
            'error' => __('Email is incorrect.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_BAD_REQUEST,'message'=> 'Email is incorrect.'])
            );
        }   


    }    

    public function logout($request){
        /*
        * For Api key
        *
        */
        $apikey = $request->get_header('apikey');
        $this->is_apikey($apikey); 
        if(empty($this->apiKey)):
            return array(
                 'message' => 'Unauthorized',
                 'error' => 'Unauthorized',
                 'code' => 'Unauthorized',
                 'data' => array(
                     'error' => 'Unauthorized',
                     'status' => Sis_Rest_Public::HTTP_UNAUTHORIZED,
                 ),
            ); 
       endif;
       /*
        * For Access Token
        *
        */
        $accessToken = $request->get_header('accessToken');

        $this->is_accesstoken($accessToken); 
        if(empty($this->accessToken)):
            return array(
                 'message' => 'Unauthorized Token',
                 'error' => 'Unauthorized Token',
                 'code' => 'Unauthorized Token',
                 'data' => array(
                     'error' => 'Unauthorized Token',
                     'status' => Sis_Rest_Public::HTTP_UNAUTHORIZED,
                 ),
            ); 
       endif;
      
       try {
            $isAccessTokenDeleted = $this->wpdb->delete($this->wpdb_prefix.'access_tokens', array( 'accessToken' => $accessToken ) );
            if($isAccessTokenDeleted) {
                return array(
                     'code' => Sis_Rest_Public::HTTP_OK,
                     'message'=> __('You have successfully logout.',$this->plugin_name),
                     'data' => array_merge(array(),['status' => Sis_Rest_Public::HTTP_OK])
                );
            }
 
        } catch (\Exception $e) {
            return array(
            'code' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'error' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,'message'=> $e->getMessage()])
            );
           
        }
        return array(
            'code' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'error' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,'message'=> 'There was a problem while trying to log you in, please try again.'])
        );
    }


     /**
     * forgot password .
     *
     * @return Response Data.
     */ 
    function forgotpassword($request){

        $apikey = $request->get_header('apikey');
        $this->is_apikey($apikey); 
        if(empty($this->apiKey)):
            return array(
                 'message' => 'Unauthorized',
                 'error' => 'Unauthorized',
                 'code' => 'Unauthorized',
                 'data' => array(
                     'error' => 'Unauthorized',
                     'status' => Sis_Rest_Public::HTTP_UNAUTHORIZED,
                 ),
            ); 
        endif;

        $email = $request->get_param('email');
        $exists = email_exists( $email );
        if ( $exists ) {
            global $wp_hasher;
            $user_data = get_user_by( 'email', trim( $email) );
            if ( empty( $user_data ) ) {
                return array(
                'code' => Sis_Rest_Public::HTTP_BAD_REQUEST,
                'message' => __('Email is incorrect.',$this->plugin_name),
                'error' => __('Email is incorrect.',$this->plugin_name),
                'data' => array_merge(['status' => Sis_Rest_Public::HTTP_BAD_REQUEST,'message'=> 'Email is incorrect.'])
                );
            } else {
                do_action('lostpassword_post');
                if ( !$user_data ) return false;
                // redefining user_login ensures we return the right case in the email
                $user_login = $user_data->user_login;
                $user_email = $user_data->user_email;
                do_action('retreive_password', $user_login);  // Misspelled and deprecated
                do_action('retrieve_password', $user_login);
                $allow = apply_filters('allow_password_reset', true, $user_data->ID);
                if ( ! $allow )
                    return false;
                else if ( is_wp_error($allow) )
                    return false;
                $key = wp_generate_password( 20, false );
                do_action( 'retrieve_password_key', $user_login, $key );

                if ( empty( $wp_hasher ) ) {
                    require_once ABSPATH . 'wp-includes/class-phpass.php';
                    $wp_hasher = new PasswordHash( 8, true );
                }

                $hashed = $wp_hasher->HashPassword( $key );    
                $this->wpdb->update( $wpdb->users, array( 'user_activation_key' => time().":".$hashed ), array( 'user_login' => $user_login ) );
                $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
                $message .= network_home_url( '/' ) . "\r\n\r\n";
                $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
                $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
                $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
                $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

                if ( is_multisite() )
                    $blogname = $GLOBALS['current_site']->site_name;
                else
                    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

                $title = sprintf( __('[%s] Password Reset'), $blogname );

                $title = apply_filters('retrieve_password_title', $title);
                $message = apply_filters('retrieve_password_message', $message, $key);

                $is_mail = wp_mail($user_email, $title, $message);

                if ( $message && $is_mail=='true'){
                    /*wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...'));*/
                    return array(
                         'code' => Sis_Rest_Public::HTTP_OK,
                         'message'=> __('Link for password reset has been emailed to you. Please check your email.',$this->plugin_name),
                         'data' => array_merge(array(),['status' => Sis_Rest_Public::HTTP_OK])
                    );
                }
            }
        } else {
           return array(
            'code' => Sis_Rest_Public::HTTP_BAD_REQUEST,
            'message' => __('Email is incorrect.',$this->plugin_name),
            'error' => __('Email is incorrect.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_BAD_REQUEST,'message'=> 'Email is incorrect.'])
            );
        }

        return array(
            'code' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'error' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,'message'=> 'There was a problem while trying to log you in, please try again.'])
        );
    }


     public function register($request){
        /*
        * For Api key
        *
        */
        $apikey = $request->get_header('apikey');
        $this->is_apikey($apikey); 
        if(empty($this->apiKey)):
            return array(
                 'message' => 'Unauthorized',
                 'error' => 'Unauthorized',
                 'code' => 'Unauthorized',
                 'data' => array(
                     'error' => 'Unauthorized',
                     'status' => Sis_Rest_Public::HTTP_UNAUTHORIZED,
                 ),
            ); 
       endif;

        $email = sanitize_email($request->get_param('email'));
        $username = sanitize_user( $request->get_param('username'));
        $password = esc_attr( $request->get_param('password'));
        $fname = sanitize_text_field($request->get_param('fname'));
        $lname = sanitize_text_field($request->get_param('lname'));
        $deviceId = $request->get_param('deviceId');
        $deviceType = $request->get_param('deviceType');
        $deviceToken = $request->get_param('deviceToken');

       
        $exists = email_exists( $email );

        if ( !$exists ) {
            $userdata = array(
                'user_login'    =>   $username,
                'user_email'    =>   $email,
                'user_pass'     =>   $password,
                'first_name'    =>   $fname,
                'last_name'     =>   $lname,
            );
            $user = wp_insert_user( $userdata );
           
            if( is_wp_error($user) && count($user->get_error_messages()) > 0) {
                $errorco = '';
                foreach ($user->get_error_messages() as $error) {
                    $errorco =  $error;
                }
                return array(
                'code' => $user->get_error_code(),
                'message' => $errorco,
                'error' => $errorco,
                'data' => array_merge(['status' => Sis_Rest_Public::HTTP_BAD_REQUEST,'message'=> $errorco])
                );
            } else {
                $user = get_user_by('ID',$user);
                $userId = $user->ID;
                $accessToken = md5(uniqid(mt_rand(), true));
                $accessTokenData = $this->wpdb->get_row( "SELECT id,accessToken FROM {$this->wpdb_prefix}access_tokens WHERE userId = {$userId} AND deviceId = '{$deviceId}' AND deviceType = '{$deviceType} LIMIT 1'" );
                $userdata = (array)$user->data;
                $userroles = (array)$user->roles;        
                if(empty($accessTokenData)) {
                   $isAccessTokenCreated =  $this->wpdb->insert($this->wpdb_prefix.'access_tokens',
                        array(
                            'userId'    => $userId,
                            'deviceId' => $deviceId,
                            'deviceType'  => $deviceType,
                            'accessToken' => $accessToken,
                            'deviceToken' => $deviceToken,
                            
                        )
                    );
                    if ($userId && $isAccessTokenCreated) {
                        return array(
                             'code' => 'success',
                             'message'=> __('Account sucessfully created.',$this->plugin_name),
                             'data' => array_merge(['status' => Sis_Rest_Public::HTTP_OK,'accessToken' => $accessToken,'roles'=>implode(",", $userroles)],$userdata)
                        );
                    }
                 } 
            }

        } else {
            return array(
            'code' => Sis_Rest_Public::HTTP_BAD_REQUEST,
            'message' => __('An account with this email already exists.',$this->plugin_name),
            'error' => __('An account with this email already exists.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_BAD_REQUEST,'message'=> 'An account with this email already exists.'])
            );

        }   

         return array(
            'code' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'error' => __('There was a problem while trying to log you in, please try again.',$this->plugin_name),
            'data' => array_merge(['status' => Sis_Rest_Public::HTTP_INTERNAL_SERVER_ERROR,'message'=> 'There was a problem while trying to log you in, please try again.'])
        ); 
       
     }   
}
