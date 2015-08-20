<?php
use webvimark\modules\UserManagement\components\UserAuthEvent;

return [
	'id' => 'RNC',
    'language' => 'es-VE',
    //'sourceLanguage' => 'es-LA',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'i18n' => [
		    'translations' => [
			    'app*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@common/messages',
				],
                'modules/user-management/*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'basePath' => '@common/messages',
                    'fileMap'        => [
                        'modules/user-management/back' => 'back.php',
                        'modules/user-management/front' => 'front.php',
                    ],
                ],
		        'frontend*' => [
		            'class' => 'yii\i18n\PhpMessageSource',
		            'basePath' => '@common/messages',
		             //'sourceLanguage' => 'en-US',
		        ],
		        'backend*' => [
		            'class' => 'yii\i18n\PhpMessageSource',
		            'basePath' => '@common/messages',
		             //'sourceLanguage' => 'en-US',
		        ],
		    ],
		],
		'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'localhost',
                'username' => 'username',
                'password' => 'password',
                'port' => '465',
                'encryption' => 'tls',
                //'localDomain' => '[127.0.0.1]',
            ],
        ],
	    'user' => [
	        'class' => 'webvimark\modules\UserManagement\components\UserConfig',
	        'loginUrl' => ['user-management/auth/login'],
	        // Comment this if you don't want to record user logins
	        'on afterLogin' => function($event) {
	                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
	            }
	    ],
      /* 'formatter' => [
            'class' => 'yii\i18n\formatter',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
        ]*/
    ],
	'modules'=>[
		//https://github.com/webvimark/user-management
	    'user-management' => [
	        'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'useEmailAsLogin'=>false,
            'rolesAfterRegistration'=>['contratista'],
            'confirmationTokenExpire'=>3600,
            'mailerOptions'=>[],
/*            'commonPermissionName'=>'commonPermission',
            'registrationFormClass'=>'webvimark\modules\UserManagement\models\forms\RegistrationForm',
            'emailConfirmationRequired'=>true,
            'registrationRegexp'=>'/^(\w|\d)+$/',
            'registrationBlackRegexp'=>'/^(.)*admin(.)*$/i',
            'maxAttempts'=>5,
            'attemptsTimeout'=>60,
            'captchaOptions'=>[
                'class'     => 'yii\captcha\CaptchaAction',
                'minLength' => 3,
                'maxLength' => 4,
                'offset'    => 5
            ],*/
	        // Here you can set your handler to czhange layout for any controller or action
	        // Tip: you can use this event in any module
	        'on beforeAction'=>function(yii\base\ActionEvent $event) {
	                if ( $event->action->uniqueId == 'user-management/auth/login' )
	                {
	                    //$event->action->controller->layout = 'loginLayout.php';
	                };
	            },
            'on afterRegistration' => function(UserAuthEvent $event) {
                // Here you can do your own stuff like assign roles, send emails and so on
                //$event->user->assignRole($event->user->getId(),'contratista');
            },
	    ],
		 'gridview' =>  [
		        'class' => '\kartik\grid\Module'
		        // enter optional module parameters below - only if you need to  
		        // use your own export download action or custom translation 
		        // message source
		        // 'downloadAction' => 'gridview/export/download',
		        // 'i18n' => []
		 ],
        'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
            // other module settings
        ],

        'markdown' => [
        	// the module class
	        'class' => 'kartik\markdown\Module',
	        
	        // the controller action route used for markdown editor preview
	        'previewAction' => '/markdown/parse/preview',

	        'downloadAction' => '/markdown/parse/download',
        
	        // the list of custom conversion patterns for post processing
	        'customConversion' => [
	            '<table>' => '<table class="table table-bordered table-striped">'
	        ],

	        'smartyPants' => true,
        
	        // array the the internalization configuration for this module
	        /*'i18n' => [
	            'class' => 'yii\i18n\PhpMessageSource',
	           // 'basePath' => '@markdown/messages',
	            'forceTranslation' => true
	        ],*/

    	],
	],
];
