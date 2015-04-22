<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.capitales_propiedades".
 *
 * @property integer $id
 * @property string $monto
 * @property integer $capital_id
 * @property integer $factura_id
 * @property integer $documento_registrado_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 * @property DocumentosRegistrados $documentoRegistrado
 */
class CapitalesPropiedades extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.capitales_propiedades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto', 'capital_id', 'factura_id', 'documento_registrado_id'], 'required'],
            [['monto'], 'number'],
            [['capital_id', 'factura_id', 'documento_registrado_id'], 'integer'],
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
            'monto' => Yii::t('app', 'Monto'),
            'capital_id' => Yii::t('app', 'Capital ID'),
            'factura_id' => Yii::t('app', 'Factura ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(DocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }
}
