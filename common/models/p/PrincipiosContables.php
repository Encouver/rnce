<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.principios_contables".
 *
 * @property integer $id
 * @property string $principio_contable
 * @property string $codigo_sudeaseg
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 */
class PrincipiosContables extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.principios_contables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['principio_contable', 'contratista_id'], 'required'],
            [['principio_contable'], 'string'],
            [['contratista_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['codigo_sudeaseg'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'principio_contable' => Yii::t('app', 'Principio Contable'),
            'codigo_sudeaseg' => Yii::t('app', 'Codigo Sudeaseg'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}
