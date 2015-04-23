<?php

namespace common\components;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\Expression;

class BaseActiveRecord extends ActiveRecord
{
    public function init() {
        parent::init();
    }
    public function scenarios() {

        $scenarios = parent::scenarios();

        $scenarios['eliminar'] = ['sys_status','sys_creado_el','sys_actualizado_el','sys_finalizado_el'];//Scenario Values Only Accepted

        return $scenarios;

    }

	public function behaviors()
    {
        return [
/*			  'status'=>[
			            'class' => AttributeBehavior::className(),
			            'attributes' => [
			                ActiveRecord::EVENT_BEFORE_INSERT => 'sys_status',
			                ActiveRecord::EVENT_BEFORE_DELETE => 'sys_status',
			            ],
			            'value' => function ($event) {
			            	switch ($event) {
			            		case  ActiveRecord::EVENT_BEFORE_INSERT:
			            			# code...
			            		return true;
			            			break;
  			            		case  ActiveRecord::EVENT_BEFORE_DELETE:
			            			# code... 
  			            		return false;
			            			break;
			            		default:
			            			# code...
			            		return true;
			            			break;
			            	}
			        
			            },
			        ],*/
/*            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['sys_creado_el', 'sys_actualizado_el'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['sys_actualizado_el'],
                    ActiveRecord::EVENT_BEFORE_DELETE => ['sys_finalizado_el'],
                ],
                'value' => new Expression('NOW()'),
            ],*/
            /*'blameable' => [
                'class' => BlameableBehavior::className(),
                //'createdByAttribute' => 'creado_por',
                //'updatedByAttribute' => 'actualizado_por',
                ],*/
        ];
    }

	public function beforeSave($insert){

		parent::beforeSave($insert);

		if (parent::beforeSave($insert)) {
			if($this->scenario != 'eliminar'){
		    	$this->sys_status = true;
		    	$this->sys_actualizado_el = date('Y-m-d H:i:s');
				
				if($this->isNewRecord)
					$this->sys_creado_el = date('Y-m-d H:i:s');
				
					
		    }
	        return true;
	    } else {
	        return false;
	    }
	}

	public function beforeDelete(){

	    if (parent::beforeDelete()) {
	    	//HAY QUE EVITAR QUE ELIMINE EL REGISTRO SOLO QUE SETEE ESTAS VARIABLES.
	       	$this->sys_status = false;
			$this->sys_finalizado_el = date('Y-m-d H:i:s');
			$this->scenario = 'eliminar';
			$this->save();
			//exit();
	        return false;
	    } else {
	        return false;
	    }
	}

}