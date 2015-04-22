<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.actas_constitutivas".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property integer $capital_id
 * @property integer $denominacion_comercial_id
 * @property integer $duracion_empresa_id
 * @property integer $objeto_social_id
 * @property integer $razon_social_id
 * @property integer $domicilio_id
 * @property integer $accionista_otro
 * @property integer $comisario_auditor_id
 * @property integer $cierre_ejercicio_id
 * @property string $fecha_modificacion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property FondosReservas[] $fondosReservas
 * @property Contratistas $contratista
 * @property DocumentosRegistrados $documentoRegistrado
 * @property DuracionesEmpresas $duracionEmpresa
 * @property AccionistasOtros $accionistaOtro
 * @property Capitales $capital
 * @property CierresEjercicios $cierreEjercicio
 * @property ComisariosAuditores $comisarioAuditor
 * @property DenominacionesComerciales $denominacionComercial
 * @property Domicilios $domicilio
 * @property ObjetosSociales $objetoSocial
 * @property RazonesSociales $razonSocial
 */
class ActasConstitutivas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.actas_constitutivas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'documento_registrado_id', 'capital_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'domicilio_id', 'accionista_otro', 'comisario_auditor_id', 'cierre_ejercicio_id', 'fecha_modificacion'], 'required'],
            [['contratista_id', 'documento_registrado_id', 'capital_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'domicilio_id', 'accionista_otro', 'comisario_auditor_id', 'cierre_ejercicio_id'], 'integer'],
            [['fecha_modificacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'capital_id' => Yii::t('app', 'Capital ID'),
            'denominacion_comercial_id' => Yii::t('app', 'Denominacion Comercial ID'),
            'duracion_empresa_id' => Yii::t('app', 'Duracion Empresa ID'),
            'objeto_social_id' => Yii::t('app', 'Objeto Social ID'),
            'razon_social_id' => Yii::t('app', 'Razon Social ID'),
            'domicilio_id' => Yii::t('app', 'Domicilio ID'),
            'accionista_otro' => Yii::t('app', 'Accionista Otro'),
            'comisario_auditor_id' => Yii::t('app', 'Comisario Auditor ID'),
            'cierre_ejercicio_id' => Yii::t('app', 'Cierre Ejercicio ID'),
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificacion'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFondosReservas()
    {
        return $this->hasMany(FondosReservas::className(), ['acta_constitutiva_id' => 'id']);
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
    public function getDuracionEmpresa()
    {
        return $this->hasOne(DuracionesEmpresas::className(), ['id' => 'duracion_empresa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionistaOtro()
    {
        return $this->hasOne(AccionistasOtros::className(), ['id' => 'accionista_otro']);
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
    public function getCierreEjercicio()
    {
        return $this->hasOne(CierresEjercicios::className(), ['id' => 'cierre_ejercicio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComisarioAuditor()
    {
        return $this->hasOne(ComisariosAuditores::className(), ['id' => 'comisario_auditor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDenominacionComercial()
    {
        return $this->hasOne(DenominacionesComerciales::className(), ['id' => 'denominacion_comercial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilio()
    {
        return $this->hasOne(Domicilios::className(), ['id' => 'domicilio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetoSocial()
    {
        return $this->hasOne(ObjetosSociales::className(), ['id' => 'objeto_social_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazonSocial()
    {
        return $this->hasOne(RazonesSociales::className(), ['id' => 'razon_social_id']);
    }
}
