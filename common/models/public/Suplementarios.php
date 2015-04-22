<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.suplementarios".
 *
 * @property integer $id
 * @property string $tipo_suplementario
 * @property integer $capital_id
 * @property integer $numero
 * @property string $valor
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 */
class Suplementarios extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.suplementarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_suplementario'], 'string'],
            [['capital_id'], 'required'],
            [['capital_id', 'numero'], 'integer'],
            [['valor'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_suplementario' => Yii::t('app', 'Tipo Suplementario'),
            'capital_id' => Yii::t('app', 'Capital ID'),
            'numero' => Yii::t('app', 'Numero'),
            'valor' => Yii::t('app', 'Valor'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapital()
    {
        return $this->hasOne(Capitales::className(), ['id' => 'capital_id']);
    }
}
