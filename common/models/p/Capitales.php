<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.capitales".
 *
 * @property integer $id
 * @property string $tipo_capital
 * @property boolean $accion
 * @property boolean $certificado
 * @property boolean $suplementario
 * @property boolean $efectivo
 * @property boolean $propiedad
 * @property boolean $inventario
 * @property boolean $biologico
 * @property boolean $intangible
 * @property boolean $pagar_accionista
 * @property boolean $decreto
 * @property string $capital_social
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CapitalesEfectivos[] $capitalesEfectivos
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property Acciones[] $acciones
 * @property Contratistas $contratista
 * @property DocumentosRegistrados $documentoRegistrado
 * @property CapitalesDecretos[] $capitalesDecretos
 * @property CapitalesPagarAccionistas[] $capitalesPagarAccionistas
 * @property Certificados[] $certificados
 * @property CapitalesPropiedades[] $capitalesPropiedades
 * @property CertificacionesAportes[] $certificacionesAportes
 * @property CapitalesMercancias[] $capitalesMercancias
 * @property Suplementarios[] $suplementarios
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
            [['tipo_capital'], 'string'],
            [['accion', 'certificado', 'suplementario', 'efectivo', 'propiedad', 'inventario', 'biologico', 'intangible', 'pagar_accionista', 'decreto', 'capital_social', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['accion', 'certificado', 'suplementario', 'efectivo', 'propiedad', 'inventario', 'biologico', 'intangible', 'pagar_accionista', 'decreto', 'sys_status'], 'boolean'],
            [['capital_social'], 'number'],
            [['contratista_id', 'documento_registrado_id'], 'integer'],
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
            'tipo_capital' => Yii::t('app', 'Tipo Capital'),
            'accion' => Yii::t('app', 'Accion'),
            'certificado' => Yii::t('app', 'Certificado'),
            'suplementario' => Yii::t('app', 'Suplementario'),
            'efectivo' => Yii::t('app', 'Efectivo'),
            'propiedad' => Yii::t('app', 'Propiedad'),
            'inventario' => Yii::t('app', 'Inventario'),
            'biologico' => Yii::t('app', 'Biologico'),
            'intangible' => Yii::t('app', 'Intangible'),
            'pagar_accionista' => Yii::t('app', 'Pagar Accionista'),
            'decreto' => Yii::t('app', 'Decreto'),
            'capital_social' => Yii::t('app', 'Capital Social'),
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
    public function getCapitalesEfectivos()
    {
        return $this->hasMany(CapitalesEfectivos::className(), ['cuenta_contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['capital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcciones()
    {
        return $this->hasMany(Acciones::className(), ['capital_id' => 'id']);
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
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(DocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
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
    public function getCapitalesPagarAccionistas()
    {
        return $this->hasMany(CapitalesPagarAccionistas::className(), ['capital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificados::className(), ['capital_id' => 'id']);
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
    public function getCertificacionesAportes()
    {
        return $this->hasMany(CertificacionesAportes::className(), ['capital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesMercancias()
    {
        return $this->hasMany(CapitalesMercancias::className(), ['capital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuplementarios()
    {
        return $this->hasMany(Suplementarios::className(), ['capital_id' => 'id']);
    }
}
