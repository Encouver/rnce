<?php
namespace common\behaviors;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\base\Behavior;

class MyBehavior extends AttributeBehavior
{
    public $contratista_id;
    public $creado_por;
    public $actualizado_por;
    public $anho;

    public $value;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'creadoPor',
            //ActiveRecord::EVENT_BEFORE_INSERT => 'actualizadoPor',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'actualizadoPor',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'contratistaId',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'anho',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'sysStatus',
        ];
    }
    /**
     * @inheritdoc
     */
    /*   public function init()
       {
           parent::init();

           if (empty($this->attributes)) {
               $this->attributes = [
                   BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->contratista_id, $this->creado_por, $this->actualizado_por, $this->anho],
                   BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->actualizado_por,
               ];
           }
       }*/

    public function sysStatus()
    {
        if($this->owner->hasAttribute('sys_status'))
            $this->owner->sys_status = true;//Yii::$app->get('user',false)->identity->contratista_id;
    }

    public function contratistaId()
    {
        if($this->owner->hasAttribute('contratista_id'))
            $this->owner->contratista_id = Yii::$app->user->identity->contratista_id;
    }
    public function creadoPor()
    {
        $dateTime = date('Y-m-d H:i:m');
        //if($this->owner->isNewRecord) {
            if ($this->owner->hasAttribute('creado_por'))
                $this->owner->creado_por = Yii::$app->user->identity->id;
            if ($this->owner->hasAttribute('sys_creado_el'))
                //$this->owner->touch('sys_creado_el');
                $this->owner->sys_creado_el = $dateTime;
            if($this->owner->hasAttribute('actualizado_por'))
                $this->owner->actualizado_por = Yii::$app->user->identity->id;
            if($this->owner->hasAttribute('sys_actualizado_el'))
                //$this->owner->touch('sys_actualizado_el');
                $this->owner->sys_actualizado_el = $dateTime;
        //}
    }

    public function actualizadoPor()
    {
        if($this->owner->hasAttribute('actualizado_por'))
            $this->owner->actualizado_por = Yii::$app->user->identity->id;
        if($this->owner->hasAttribute('sys_actualizado_el'))
            //$this->owner->touch('sys_actualizado_el');
            $this->owner->sys_actualizado_el = date('Y-m-d H:i:m');
    }
    public function anho()
    {
        if($this->owner->hasAttribute('anho'))
            $this->owner->anho = date('m-Y');
    }
}