<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.denominaciones_comerciales".
 *
 * @property integer $id
 * @property integer $sys_denominacion_comercial_id
 * @property integer $sys_subdenominacion_comercial_id
 * @property string $codigo_situr
 * @property boolean $fin_lucro
 * @property string $cooperativa_capital
 * @property string $cooperativa_distribuicion
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property Contratistas $contratista
 * @property SysDenominacionesComerciales $sysDenominacionComercial
 * @property DocumentosRegistrados $documentoRegistrado
 * @property SysSubdenominacionesComerciales $sysSubdenominacionComercial
 */
class DenominacionesComerciales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.denominaciones_comerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_denominacion_comercial_id', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['sys_denominacion_comercial_id', 'sys_subdenominacion_comercial_id', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['fin_lucro', 'sys_status'], 'boolean'],
            [['cooperativa_capital', 'cooperativa_distribuicion'], 'string'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['codigo_situr'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_denominacion_comercial_id' => Yii::t('app', 'Sys Denominacion Comercial ID'),
            'sys_subdenominacion_comercial_id' => Yii::t('app', 'Sys Subdenominacion Comercial ID'),
            'codigo_situr' => Yii::t('app', 'Codigo Situr'),
            'fin_lucro' => Yii::t('app', 'Fin Lucro'),
            'cooperativa_capital' => Yii::t('app', 'Cooperativa Capital'),
            'cooperativa_distribuicion' => Yii::t('app', 'Cooperativa Distribuicion'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
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
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['denominacion_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysDenominacionComercial()
    {
        return $this->hasOne(SysDenominacionesComerciales::className(), ['id' => 'sys_denominacion_comercial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(DocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysSubdenominacionComercial()
    {
        return $this->hasOne(SysSubdenominacionesComerciales::className(), ['id' => 'sys_subdenominacion_comercial_id']);
    }
}
