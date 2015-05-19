<?php

namespace common\components;

use common\behaviors\MyBehavior;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\Expression;
use common\models\p\SysInpc;

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
        $behaviors = [

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
            /*                'contratista'=>[
                                'class'=>MyBehavior::className(),
                                'contratista_id'=>'contratista_id',
                                'anho'=>'anho',
            //                    'attributes'=>
            //                        [ActiveRecord::EVENT_BEFORE_INSERT => ['contratista_id']]
                            ],*/
            /*                'timestamp' => [
                                'class' => TimestampBehavior::className(),
                                    'createdAtAttribute'=>'sys_creado_el',
                                    'updatedAtAttribute'=>'sys_actualizado_el',
                                    'attributes' => [
                                        ActiveRecord::EVENT_BEFORE_INSERT => ['sys_creado_el', 'sys_actualizado_el'],
                                        ActiveRecord::EVENT_BEFORE_UPDATE => ['sys_actualizado_el'],
                                    ],
                                    'value' => new Expression('NOW()'),
                            ],*/
            /*                'anhoTimestamp' => [
                                'class' => TimestampBehavior::className(),
                                'attributes' => [
                                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['anho'],
                                ],
                                'value' => new Expression("to_char(NOW(),'MM-YYYY')"),
                            ],*/
            /*                'blameable' => [
                                'class' => BlameableBehavior::className(),
                                'createdByAttribute' => 'creado_por',
                                'updatedByAttribute' => 'actualizado_por',
            //                    'attributes' => [
            //                        ActiveRecord::EVENT_BEFORE_VALIDATE => ['creado_por', 'actualizado_por']
            //                    ]
                            ],*/
            /*              'softDelete' => [
                              'class' => 'amnah\yii2\behaviors\SoftDelete',
                              // these are the default values, which you can omit
                              'attribute' => 'sys_finalizado_el',
                              'timestamp' => null, // this is the same format as in AutoTimestamp
                              'safeMode' => true, // this processes '$model->delete()' calls as soft-deletes
                          ],*/
        ];

        $behaviors['contratista'] = [
            'class' => MyBehavior::className(),
        ];
        if(in_array($this->className(),['Contratista','SysNaturalJuridica','PersonaJuridica','PersonaNatural']))
        {
            $behaviors['softDelete'] = [
                'class' => 'amnah\yii2\behaviors\SoftDelete',
                // these are the default values, which you can omit
                'attribute' => 'sys_finalizado_el',
                'timestamp' => null, // this is the same format as in AutoTimestamp
                'safeMode' => true, // this processes '$model->delete()' calls as soft-deletes
            ];
        }
/*
            $behaviors['timestamp'] = [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'sys_creado_el',
                'updatedAtAttribute' => 'sys_actualizado_el',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['sys_creado_el', 'sys_actualizado_el'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['sys_actualizado_el'],
                ],
                'value' => new Expression('NOW()'),
            ];

            $behaviors['blameable'] = [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'creado_por',
                'updatedByAttribute' => 'actualizado_por',
    //                   'attributes' => [
    //                       ActiveRecord::EVENT_BEFORE_VALIDATE => ['creado_por', 'actualizado_por']
    //                   ]
            ];*/
/*        if(isset($this->sys_finalizado_el))
            $behaviors['softDelete'] = [
                'class' => 'amnah\yii2\behaviors\SoftDelete',
                // these are the default values, which you can omit
                'attribute' => 'sys_finalizado_el',
                'timestamp' => null, // this is the same format as in AutoTimestamp
                'safeMode' => true, // this processes '$model->delete()' calls as soft-deletes
            ];*/

        return $behaviors;
    }

    public  function  beforeValidate(){

       if($this->hasAttribute('contratista_id'))//property_exists($this->className(),'contratista_id'))
            $this->contratista_id = Yii::$app->user->identity->contratista_id;
            
        /* if($this->hasAttribute('anho'))//property_exists($this->className(),'anho'))
            $this->anho = date('m-Y');


        if($this->hasAttribute('sys_status'))//(property_exists($this->className(),'sys_status'))
            $this->sys_status = true;*/

       // die;
         if($this->hasAttribute('anho'))//property_exists($this->className(),'anho'))
            $this->anho = date('m-Y');
        return parent::beforeValidate();
    }
	public function beforeSave($insert){

		if (parent::beforeSave($insert)) {
/*            if($this->hasAttribute('sys_actualizado_el'))//(property_exists($this->className(),'sys_actualizado_el'))
                $this->sys_actualizado_el = date('Y-m-d H:i:s');
            if($this->hasAttribute('actualizado_por'))
                $this->actualizado_por = Yii::$app->user->id;

            if($this->isNewRecord){
                if($this->hasAttribute('sys_creado_el'))//(property_exists($this->className(),'sys_creado_el'))
                    $this->sys_creado_el = date('Y-m-d H:i:s');
                if($this->hasAttribute('creado_por'))//(property_exists($this->className(),'creado_por'))
                    $this->creado_por = Yii::$app->user->id;
            }*/
            //print_r($this);
            //die;
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

    /** Obtiene la relación del usuario que creo el objeto
     * @return \yii\db\ActiveQuery
     */
    public function getCreadoPor()
    {
        if($this->hasAttribute('creado_por'))
            return $this->hasOne(User::className(), ['id' => 'creado_por']);

        return null;
    }

    /** Retorna el un objeto de tipo User si existe el attribute actualizado_por.
     * Retorna null si no existe dicho attribute o el attribute no tiene ningún valor
     * @return \yii\db\ActiveQuery
     */
    public function getActualizadoPor()
    {
        if($this->hasAttribute('actualizado_por'))
            return $this->hasOne(User::className(), ['id' => 'actualizado_por']);

        return null;
    }

/*+++++++++++++++++++++++++++++++METODOS DISPONIBLES PARA HACER LOS CALCULOS EN EL SISTEMA++++++++++++++++++++++++++++*/

    /**
     * @return bool
     *desde y hasta son los meses a calcular incluyendolos, van del 1 al 12
     */
    public function getPromedio($desde, $hasta, $anho=2015)
    {
        $elementos = 0;

        for ($i=$desde; $i <= $hasta; $i++) { 
            $elementos++;
            $arreglo[] = $i;
        }

        $inpcs = SysInpc::find()->where(['mes' => $arreglo, 'anho' => $anho])->all();
        
        $valor = 0;
        foreach ($inpcs as $key => $value) {
             $valor +=$value->indice;
        }

        return ($valor/$elementos);
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
    * @return int
    */
    public function getSumar($arreglo)
    {
        return array_sum($arreglo);
    }

    /**
    * @return float
    */

    public function getInpcCierre()
    {

        //preguntar a raul donde se guarda el cierre del ejer. economico 
        $valor = SysInpc::find()->where(['mes' => '', 'anho' => ''])->all();
        return $valor['indice'];
    }
}