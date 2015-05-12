<?php
namespace common\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;

class MyBehavior extends Behavior
{
    public $creado_por;
    public $actualizado_por;
    public $anho;
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'creadoPor',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'contratistaId',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'actualizadoPor',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'anho',
        ];
    }

    public function contratistaId()
    {
        //if(gproperty_exists(et_class($this), 'contratista_id'))
            $this->contratista_id = Yii::$app()->user->identity->contratista_id;
    }
    public function creadoPor()
    {
        //if(property_exists($this.owner, 'creado_por'))
            $this->creado_por = Yii::$app()->user->identity->id;
    }

    public function actualizadoPor()
    {
        //if(property_exists(get_class($this), 'actualizado_por'))
            $this->actualizado_por = Yii::$app()->user->identity->id;
    }
    public function anho()
    {
        //if(property_exists(get_class($this), 'anho'))
            $this->anho = date('m-Y');
    }
}