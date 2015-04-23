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

}