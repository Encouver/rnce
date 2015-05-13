<?php

namespace common\components;

use yii\web\Controller;

class BaseController extends Controller
{
    public function init() {
        parent::init();
    }

    public function probando() {
        exit();
    }

	public function behaviors()
	{
	    return [
	        'ghost-access'=> [
	            'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
	        ],
	    ];
	}

	/**
	 * @inheritdoc
	 */
	public function beforeAction($action)
	{
	    if (parent::beforeAction($action)) {
	        // If you want to change it only in one or few actions, add additional check

	        //Yii::$app->user->loginUrl = ['user-management/auth/login'];

	        return true;
	    } else {
	        return false;
	    }
	}
}