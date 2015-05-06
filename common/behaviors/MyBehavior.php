<?php
namespace common\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;

class MyBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'creadoPor',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'actualizadoPor',
        ];
    }

    public function creadoPor()
    {
        if(property_exists(this.get_class(), 'creado_por'))
            $this->creado_por = Yii::$app()->user->identity->id;
    }
    public function actualizadoPor()
    {
        if(property_exists(this.get_class(), 'actualizado_por'))
            $this->actualizado_por = Yii::$app()->user->identity->id;
    }
}