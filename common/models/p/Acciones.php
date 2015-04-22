<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.acciones".
 *
 * @property integer $id
 * @property string $tipo_accion
 * @property integer $numero_principal
 * @property integer $numero_comun
 * @property integer $numero_preferencial
 * @property string $valor_principal
 * @property string $valor_comun
 * @property string $valor_preferencial
 * @property integer $capital_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 */
class Acciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.acciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_accion'], 'string'],
            [['numero_principal', 'numero_comun', 'numero_preferencial', 'capital_id'], 'integer'],
            [['valor_principal', 'valor_comun', 'valor_preferencial'], 'number'],
            [['capital_id'], 'required'],
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
            'tipo_accion' => Yii::t('app', 'Tipo Accion'),
            'numero_principal' => Yii::t('app', 'Numero Principal'),
            'numero_comun' => Yii::t('app', 'Numero Comun'),
            'numero_preferencial' => Yii::t('app', 'Numero Preferencial'),
            'valor_principal' => Yii::t('app', 'Valor Principal'),
            'valor_comun' => Yii::t('app', 'Valor Comun'),
            'valor_preferencial' => Yii::t('app', 'Valor Preferencial'),
            'capital_id' => Yii::t('app', 'Capital ID'),
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
