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
           // ActiveRecord::EVENT_BEFORE_INSERT => ['creadoPor','actualizadoPor'],
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'contratistaId',
            //ActiveRecord::EVENT_BEFORE_UPDATE => 'actualizadoPor',
            ActiveRecord::EVENT_BEFORE_INSERT => 'anho',
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

    public function contratistaId()
    {
        //if(gproperty_exists(et_class($this), 'contratista_id'))

            $this->owner->contratista_id = Yii::$app->get('user',false)->identity->contratista_id;
    }
/*    public function creadoPor()
    {
        //if(property_exists($this.owner, 'creado_por'))
            $this->creado_por = Yii::$app()->user->identity->id;
    }

    public function actualizadoPor()
    {
        //if(property_exists(get_class($this), 'actualizado_por'))
            $this->actualizado_por = Yii::$app()->user->identity->id;
    }*/
    public function anho()
    {
        //if(property_exists(get_class($this), 'anho'))
            $this->owner->anho = date('m-Y');
    }
}