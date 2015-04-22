<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_caev".
 *
 * @property integer $id
 * @property string $grupo
 * @property string $denominacion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas[] $contratistas
 */
class SysCaev extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_caev';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grupo', 'denominacion'], 'required'],
            [['denominacion'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['grupo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'grupo' => Yii::t('app', 'Grupo'),
            'denominacion' => Yii::t('app', 'Denominacion'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratistas()
    {
        return $this->hasMany(Contratistas::className(), ['ppal_caev_id' => 'id']);
    }
}
