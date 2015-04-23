<?php

namespace common\components;

use yii\db\ActiveRecord;

class BaseActiveRecord extends ActiveRecord
{
    public function init() {
        parent::init();
    }

	public function beforeSave($insert){

		parent::beforeSave($insert);

		if (parent::beforeSave($insert)) {
	        //$this->sys_status = true;
			if(!$this->isNewRecord)
				$this->sys_actualizado_el = date('Y-m-d');
	        return true;
	    } else {
	        return false;
	    }
	}

	public function beforeDelete(){

	    if (parent::beforeDelete()) {
	    	//HAY QUE EVITAR QUE ELIMINE EL REGISTRO SOLO QUE SETEE ESTAS VARIABLES.
	       	$this->sys_status = false;
			$this->sys_finalizado_el = date('Y-m-d');

	        return true;
	    } else {
	        return false;
	    }
	}

}