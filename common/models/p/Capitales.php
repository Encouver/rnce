<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.capitales".
 *
 * @property integer $id
 * @property boolean $efectivo_banco
 * @property boolean $propiedad
 * @property boolean $inventario
 * @property boolean $biologico
 * @property boolean $intangible
 * @property boolean $pagar_accionista
 * @property boolean $decreto
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $acta_constitutiva_id
 * @property string $efectivo
 * @property integer $certificacion_aporte_id
 * @property string $tipo_capital
 *
 * @property ActasConstitutivas $actaConstitutiva
 * @property CertificacionesAportes $certificacionAporte
 * @property CapitalesEfectivos[] $capitalesEfectivos
 * @property CapitalesPropiedades[] $capitalesPropiedades
 * @property CapitalesPagarAccionistas[] $capitalesPagarAccionistas
 * @property CapitalesDecretos[] $capitalesDecretos
 * @property CapitalesMercancias[] $capitalesMercancias
 */
class Capitales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.capitales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['efectivo_banco', 'propiedad', 'inventario', 'biologico', 'intangible', 'pagar_accionista', 'decreto', 'acta_constitutiva_id', 'certificacion_aporte_id'], 'required'],
            [['efectivo_banco', 'propiedad', 'inventario', 'biologico', 'intangible', 'pagar_accionista', 'decreto', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['acta_constitutiva_id', 'certificacion_aporte_id'], 'integer'],
            [['efectivo'], 'number'],
            [['tipo_capital'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'efectivo_banco' => Yii::t('app', 'Efectivo Banco'),
            'propiedad' => Yii::t('app', 'Propiedad'),
            'inventario' => Yii::t('app', 'Inventario'),
            'biologico' => Yii::t('app', 'Biologico'),
            'intangible' => Yii::t('app', 'Intangible'),
            'pagar_accionista' => Yii::t('app', 'Pagar Accionista'),
            'decreto' => Yii::t('app', 'Decreto'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'efectivo' => Yii::t('app', 'Efectivo'),
            'certificacion_aporte_id' => Yii::t('app', 'Certificacion Aporte ID'),
            'tipo_capital' => Yii::t('app', 'Tipo Capital'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificacionAporte()
    {
        return $this->hasOne(CertificacionesAportes::className(), ['id' => 'certificacion_aporte_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesEfectivos()
    {
        return $this->hasMany(CapitalesEfectivos::className(), ['cuenta_contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesPropiedades()
    {
        return $this->hasMany(CapitalesPropiedades::className(), ['capital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesPagarAccionistas()
    {
        return $this->hasMany(CapitalesPagarAccionistas::className(), ['capital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesDecretos()
    {
        return $this->hasMany(CapitalesDecretos::className(), ['capital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesMercancias()
    {
        return $this->hasMany(CapitalesMercancias::className(), ['capital_id' => 'id']);
    }
}
