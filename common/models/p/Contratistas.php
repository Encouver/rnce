<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.contratistas".
 *
 * @property integer $id
 * @property integer $natural_juridica_id
 * @property integer $estatus_contratista_id
 * @property string $sigla
 * @property string $principio_contable
 * @property integer $ppal_caev_id
 * @property integer $comp1_caev_id
 * @property integer $comp2_caev_id
 * @property integer $contacto_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_sector
 *
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property Capitales[] $capitales
 * @property AccionistasOtros[] $accionistasOtros
 * @property BancosContratistas[] $bancosContratistas
 * @property DuracionesEmpresas[] $duracionesEmpresas
 * @property CierresEjercicios[] $cierresEjercicios
 * @property ComisariosAuditores[] $comisariosAuditores
 * @property DenominacionesComerciales[] $denominacionesComerciales
 * @property Clientes[] $clientes
 * @property NotasRevelatorias[] $notasRevelatorias
 * @property Sucursales[] $sucursales
 * @property ObjetosSociales[] $objetosSociales
 * @property NombresCajas[] $nombresCajas
 * @property PolizasContratadas[] $polizasContratadas
 * @property RazonesSociales[] $razonesSociales
 * @property RelacionesContratos[] $relacionesContratos
 * @property Domicilios[] $domicilios
 * @property SysCaev $comp1Caev
 * @property SysCaev $comp2Caev
 * @property PersonasNaturales $contacto
 * @property EstatusContratistas $estatusContratista
 * @property SysNaturalesJuridicas $naturalJuridica
 * @property SysCaev $ppalCaev
 */
class Contratistas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.contratistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['natural_juridica_id', 'estatus_contratista_id', 'principio_contable', 'ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contacto_id', 'tipo_sector'], 'required'],
            [['natural_juridica_id', 'estatus_contratista_id', 'ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contacto_id'], 'integer'],
            [['principio_contable', 'tipo_sector'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sigla'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica ID'),
            'estatus_contratista_id' => Yii::t('app', 'Estatus Contratista ID'),
            'sigla' => Yii::t('app', 'Sigla'),
            'principio_contable' => Yii::t('app', 'Principio Contable'),
            'ppal_caev_id' => Yii::t('app', 'Ppal Caev ID'),
            'comp1_caev_id' => Yii::t('app', 'Comp1 Caev ID'),
            'comp2_caev_id' => Yii::t('app', 'Comp2 Caev ID'),
            'contacto_id' => Yii::t('app', 'Contacto ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_sector' => Yii::t('app', 'Tipo Sector'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitales()
    {
        return $this->hasMany(Capitales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionistasOtros()
    {
        return $this->hasMany(AccionistasOtros::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancosContratistas()
    {
        return $this->hasMany(BancosContratistas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDuracionesEmpresas()
    {
        return $this->hasMany(DuracionesEmpresas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCierresEjercicios()
    {
        return $this->hasMany(CierresEjercicios::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComisariosAuditores()
    {
        return $this->hasMany(ComisariosAuditores::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDenominacionesComerciales()
    {
        return $this->hasMany(DenominacionesComerciales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasRevelatorias()
    {
        return $this->hasMany(NotasRevelatorias::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursales()
    {
        return $this->hasMany(Sucursales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosSociales()
    {
        return $this->hasMany(ObjetosSociales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombresCajas()
    {
        return $this->hasMany(NombresCajas::className(), ['contratistas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolizasContratadas()
    {
        return $this->hasMany(PolizasContratadas::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazonesSociales()
    {
        return $this->hasMany(RazonesSociales::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionesContratos()
    {
        return $this->hasMany(RelacionesContratos::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilios()
    {
        return $this->hasMany(Domicilios::className(), ['contratista_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComp1Caev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'comp1_caev_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComp2Caev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'comp2_caev_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacto()
    {
        return $this->hasOne(PersonasNaturales::className(), ['id' => 'contacto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatusContratista()
    {
        return $this->hasOne(EstatusContratistas::className(), ['id' => 'estatus_contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNaturalJuridica()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'natural_juridica_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpalCaev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'ppal_caev_id']);
    }
}
