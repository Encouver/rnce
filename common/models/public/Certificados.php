<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.certificados".
 *
 * @property integer $id
 * @property string $tipo_certificado
 * @property integer $capital_id
 * @property integer $numero_asociacion
 * @property integer $numero_aportacion
 * @property integer $numero_rotativo
 * @property integer $numero_inversion
 * @property string $valor_asociacion
 * @property string $valor_aportacion
 * @property string $valor_rotativo
 * @property string $valor_inversion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 */
class Certificados extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.certificados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_certificado'], 'string'],
            [['capital_id'], 'required'],
            [['capital_id', 'numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion'], 'integer'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion'], 'number'],
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
            'tipo_certificado' => Yii::t('app', 'Tipo Certificado'),
            'capital_id' => Yii::t('app', 'Capital ID'),
            'numero_asociacion' => Yii::t('app', 'Numero Asociacion'),
            'numero_aportacion' => Yii::t('app', 'Numero Aportacion'),
            'numero_rotativo' => Yii::t('app', 'Numero Rotativo'),
            'numero_inversion' => Yii::t('app', 'Numero Inversion'),
            'valor_asociacion' => Yii::t('app', 'Valor Asociacion'),
            'valor_aportacion' => Yii::t('app', 'Valor Aportacion'),
            'valor_rotativo' => Yii::t('app', 'Valor Rotativo'),
            'valor_inversion' => Yii::t('app', 'Valor Inversion'),
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
