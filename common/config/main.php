<?php
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
        ],
	    'user' => [
	        'class' => 'webvimark\modules\UserManagement\components\UserConfig',

	        // Comment this if you don't want to record user logins
	        'on afterLogin' => function($event) {
	                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
	            }
	    ],
    ],
	'modules'=>[
	    'user-management' => [
	        'class' => 'webvimark\modules\UserManagement\UserManagementModule',

	        // Here you can set your handler to change layout for any controller or action
	        // Tip: you can use this event in any module
	        'on beforeAction'=>function(yii\base\ActionEvent $event) {
	                if ( $event->action->uniqueId == 'user-management/auth/login' )
	                {
	                    $event->action->controller->layout = 'loginLayout.php';
	                };
	            },
	    ],
	],
];
