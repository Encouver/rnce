<?php

namespace common\components;

use yii\db\ActiveRecord;

class BaseActiveRecord extends ActiveRecord
{
    public function init() {
        parent::init();
    }

	public function beforeSave($insert){
		//$this->sys_status = true;
		if(!$this->isNewRecord)
			$this->sys_actualizado_el = date('Y-m-d');
		parent::beforeSave($insert);
	}

	public function beforeDelete(){
		$this->sys_status = false;
		$this->sys_finalizado_el = date('Y-m-d');
		//parent::beforeDelete();
	}

}