<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.pagos_accionistas_decretos".
 *
 * @property integer $id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $decreto_div_excedente_id
 * @property integer $accionista_id
 * @property string $monto_cancelado
 * @property string $fecha
 * @property boolean $cheque
 * @property boolean $transferencia
 * @property boolean $efectivo
 * @property string $numero_cheque
 * @property string $numero_transferencia
 * @property string $recibo_pago
 *
 * @property DecretosDivExcedentes $decretoDivExcedente
 * @property AccionistasOtros $accionista
 */
class PagosAccionistasDecretos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.pagos_accionistas_decretos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_status', 'cheque', 'transferencia', 'efectivo'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha'], 'safe'],
            [['decreto_div_excedente_id', 'accionista_id', 'monto_cancelado', 'fecha', 'cheque', 'transferencia', 'efectivo'], 'required'],
            [['decreto_div_excedente_id', 'accionista_id'], 'integer'],
            [['monto_cancelado'], 'number'],
            [['numero_cheque', 'numero_transferencia', 'recibo_pago'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'decreto_div_excedente_id' => Yii::t('app', 'Decreto Div Excedente ID'),
            'accionista_id' => Yii::t('app', 'Accionista ID'),
            'monto_cancelado' => Yii::t('app', 'Monto Cancelado'),
            'fecha' => Yii::t('app', 'Fecha'),
            'cheque' => Yii::t('app', 'Cheque'),
            'transferencia' => Yii::t('app', 'Transferencia'),
            'efectivo' => Yii::t('app', 'Efectivo'),
            'numero_cheque' => Yii::t('app', 'Numero Cheque'),
            'numero_transferencia' => Yii::t('app', 'Numero Transferencia'),
            'recibo_pago' => Yii::t('app', 'Recibo Pago'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecretoDivExcedente()
    {
        return $this->hasOne(DecretosDivExcedentes::className(), ['id' => 'decreto_div_excedente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionista()
    {
        return $this->hasOne(AccionistasOtros::className(), ['id' => 'accionista_id']);
    }
}
