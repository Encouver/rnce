<?php

namespace common\components;

use common\behaviors\MyBehavior;
use Yii;
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
/*    public function scenarios() {

        $scenarios = parent::scenarios();

        $scenarios['eliminar'] = ['sys_status','sys_creado_el','sys_actualizado_el','sys_finalizado_el'];//Scenario Values Only Accepted

        return $scenarios;

    }*/

	public function behaviors()
    {
        return [

/*                'status'=>[
                    'class' => AttributeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => 'sys_status',
                        ActiveRecord::EVENT_BEFORE_DELETE => 'sys_status',
                    ],
                    'value' => function ($event) {
                        switch ($event) {
                            case  ActiveRecord::EVENT_BEFORE_INSERT:
                                $this.sys_status = true;
                                # code...
                            return true;
                                break;
                            case  ActiveRecord::EVENT_BEFORE_DELETE:
                                $this.sys_status = false;
                                # code...
                            return true;
                                break;
                            default:
                                # code...
                            return true;
                                break;
                        }

                    },
                ],*/
                'contratista'=>[
                    'class'=>MyBehavior::className(),
                    'contratista_id'=>'contratista_id',
                    'anho'=>'anho',
                  /*  'attributes'=>
                        [ActiveRecord::EVENT_BEFORE_INSERT => ['contratista_id']]*/
                ],
                'timestamp' => [
                    'class' => TimestampBehavior::className(),
                        'createdAtAttribute'=>'sys_creado_el',
                        'updatedAtAttribute'=>'sys_actualizado_el',
                        'attributes' => [
                            ActiveRecord::EVENT_BEFORE_INSERT => ['sys_creado_el', 'sys_actualizado_el'],
                            ActiveRecord::EVENT_BEFORE_UPDATE => ['sys_actualizado_el'],
                        ],
                        'value' => new Expression('NOW()'),
                ],
/*                'anhoTimestamp' => [
                    'class' => TimestampBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_VALIDATE => ['anho'],
                    ],
                    'value' => new Expression("to_char(NOW(),'MM-YYYY')"),
                ],*/
                'blameable' => [
                    'class' => BlameableBehavior::className(),
                    'createdByAttribute' => 'creado_por',
                    'updatedByAttribute' => 'actualizado_por',
             /*       'attributes' => [
                        ActiveRecord::EVENT_BEFORE_VALIDATE => ['creado_por', 'actualizado_por']
                    ]*/
                ],
  /*              'softDelete' => [
                    'class' => 'amnah\yii2\behaviors\SoftDelete',
                    // these are the default values, which you can omit
                    'attribute' => 'sys_finalizado_el',
                    'timestamp' => null, // this is the same format as in AutoTimestamp
                    'safeMode' => true, // this processes '$model->delete()' calls as soft-deletes
                ],*/
        ];
    }

    public  function  beforeValidate(){

/*        //if(isset($this->anho))
            $this->anho = date('m-Y');

        //if(isset($this->creado_por))
            $this->creado_por = Yii::$app->user->id;

        //if($this->actualizado_por) {
            $this->actualizado_por = Yii::$app->user->id;
           // print_r('hola');
        //}
/*        $this->sys_status = true;
        $this->sys_actualizado_el = date('Y-m-d H:i:s');

        if($this->isNewRecord)
            $this->sys_creado_el = date('Y-m-d H:i:s');*/
       // die;*/
        return parent::beforeValidate();
    }
	public function beforeSave($insert){

		//parent::beforeSave($insert);

		if (parent::beforeSave($insert)) {
	/*		if($this->scenario != 'eliminar' and isset($this->sys_status)
                and isset($this->sys_status) and isset($this->sys_actualizado_el)  and isset($this->sys_creado_el)){*/
/*		    	$this->sys_status = true;
		    	$this->sys_actualizado_el = date('Y-m-d H:i:s');
				
				if($this->isNewRecord)
					$this->sys_creado_el = date('Y-m-d H:i:s');
				
					*/
		    //}

	        return true;
	    } else {
	        return false;
	    }
	}

/*	public function beforeDelete(){

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
	}*/

    /**
     * @return \yii\db\ActiveQuery
     */
 /*   public function getCreadoPor()
    {
        if(isset(this->creado_por))
            return $this->hasOne(User::className(), ['id' => 'creado_por']);
        else
            return null;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
  /*  public function getActualizadoPor()
    {
        if(isset(this->actualizado_por))
            return $this->hasOne(User::className(), ['id' => 'actualizado_por']);
        else
            return null;
    }*/

/*+++++++++++++++++++++++++++++++METODOS DISPONIBLES PARA HACER LOS CALCULOS EN EL SISTEMA++++++++++++++++++++++++++++*/

    /**
     * @return bool
     */
    public function getPromedio()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getPorCapas()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getDelCosto()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getLineal()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getDecreciente()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getBasadoUso()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getVarlorRazonable()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function getRevaluacion()
    {
        return true;
    }

}