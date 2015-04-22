<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.sys_inpc".
 *
 * @property integer $id
 * @property integer $mes
 * @property string $indice
 * @property integer $anho
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 */
class SysInpc extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_inpc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mes', 'indice', 'anho'], 'required'],
            [['mes', 'anho'], 'integer'],
            [['indice'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['mes', 'anho'], 'unique', 'targetAttribute' => ['mes', 'anho'], 'message' => 'The combination of Mes and Anho has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mes' => Yii::t('app', 'Mes'),
            'indice' => Yii::t('app', 'Indice'),
            'anho' => Yii::t('app', 'Anho'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }
}
