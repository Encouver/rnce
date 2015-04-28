<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.actas_constitutivas".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
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
 * @property boolean $capital_principal
 * @property boolean $pago_capital
 * @property boolean $aporte_capitalizar
 * @property boolean $aumento_capital
 * @property boolean $coreccion_monetaria
 * @property boolean $disminucion_capital
 * @property boolean $limitacion_capital
 * @property boolean $limitacion_capital_afectado
 * @property boolean $fondo_emergencia
 * @property boolean $reintegro_perdida
 * @property boolean $venta_accion
 * @property boolean $fusion_empresarial
 * @property boolean $decreto_div_excedente
 * @property boolean $modificacion_balance
 *
 * @property Capitales[] $capitales
 * @property Certificados[] $certificados
 * @property FondosReservas[] $fondosReservas
 * @property Suplementarios[] $suplementarios
 * @property AumentosCapitales[] $aumentosCapitales
 * @property CorreccionesMonetarias[] $correccionesMonetarias
 * @property AportesCapitalizar[] $aportesCapitalizars
 * @property Acciones[] $acciones
 * @property AccionesDisminuidas[] $accionesDisminuidas
 * @property Contratistas $contratista
 * @property DocumentosRegistrados $documentoRegistrado
 * @property DuracionesEmpresas $duracionEmpresa
 * @property AccionistasOtros $accionistaOtro
 * @property CierresEjercicios $cierreEjercicio
 * @property ComisariosAuditores $comisarioAuditor
 * @property DenominacionesComerciales $denominacionComercial
 * @property Domicilios $domicilio
 * @property ObjetosSociales $objetoSocial
 * @property RazonesSociales $razonSocial
 * @property CertificadosDisminuidos[] $certificadosDisminuidos
 * @property EmpresasFusionadas[] $empresasFusionadas
 * @property FusionesEmpresariales[] $fusionesEmpresariales
 * @property LimitacionesCapitales[] $limitacionesCapitales
 * @property SuplementariosDisminuidos[] $suplementariosDisminuidos
 * @property LimitacionesCapitalesAfectados[] $limitacionesCapitalesAfectados
 * @property FondosEmergencias[] $fondosEmergencias
 * @property DecretosDivExcedentes[] $decretosDivExcedentes
 * @property ModificacionesBalances[] $modificacionesBalances
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
            [['contratista_id', 'documento_registrado_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'domicilio_id', 'accionista_otro', 'comisario_auditor_id', 'cierre_ejercicio_id', 'fecha_modificacion', 'capital_principal', 'pago_capital', 'aporte_capitalizar', 'aumento_capital', 'coreccion_monetaria', 'disminucion_capital', 'limitacion_capital', 'limitacion_capital_afectado', 'fondo_emergencia', 'reintegro_perdida', 'venta_accion', 'fusion_empresarial', 'decreto_div_excedente', 'modificacion_balance'], 'required'],
            [['contratista_id', 'documento_registrado_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'domicilio_id', 'accionista_otro', 'comisario_auditor_id', 'cierre_ejercicio_id'], 'integer'],
            [['fecha_modificacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status', 'capital_principal', 'pago_capital', 'aporte_capitalizar', 'aumento_capital', 'coreccion_monetaria', 'disminucion_capital', 'limitacion_capital', 'limitacion_capital_afectado', 'fondo_emergencia', 'reintegro_perdida', 'venta_accion', 'fusion_empresarial', 'decreto_div_excedente', 'modificacion_balance'], 'boolean']
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
            'capital_principal' => Yii::t('app', 'Capital Principal'),
            'pago_capital' => Yii::t('app', 'Pago Capital'),
            'aporte_capitalizar' => Yii::t('app', 'Aporte Capitalizar'),
            'aumento_capital' => Yii::t('app', 'Aumento Capital'),
            'coreccion_monetaria' => Yii::t('app', 'Coreccion Monetaria'),
            'disminucion_capital' => Yii::t('app', 'Disminucion Capital'),
            'limitacion_capital' => Yii::t('app', 'Limitacion Capital'),
            'limitacion_capital_afectado' => Yii::t('app', 'Limitacion Capital Afectado'),
            'fondo_emergencia' => Yii::t('app', 'Fondo Emergencia'),
            'reintegro_perdida' => Yii::t('app', 'Reintegro Perdida'),
            'venta_accion' => Yii::t('app', 'Venta Accion'),
            'fusion_empresarial' => Yii::t('app', 'Fusion Empresarial'),
            'decreto_div_excedente' => Yii::t('app', 'Decreto Div Excedente'),
            'modificacion_balance' => Yii::t('app', 'Modificacion Balance'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitales()
    {
        return $this->hasMany(Capitales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificados::className(), ['acta_constitutiva_id' => 'id']);
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
    public function getSuplementarios()
    {
        return $this->hasMany(Suplementarios::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAumentosCapitales()
    {
        return $this->hasMany(AumentosCapitales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorreccionesMonetarias()
    {
        return $this->hasMany(CorreccionesMonetarias::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAportesCapitalizars()
    {
        return $this->hasMany(AportesCapitalizar::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcciones()
    {
        return $this->hasMany(Acciones::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionesDisminuidas()
    {
        return $this->hasMany(AccionesDisminuidas::className(), ['acta_constitutiva_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificadosDisminuidos()
    {
        return $this->hasMany(CertificadosDisminuidos::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresasFusionadas()
    {
        return $this->hasMany(EmpresasFusionadas::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFusionesEmpresariales()
    {
        return $this->hasMany(FusionesEmpresariales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesCapitales()
    {
        return $this->hasMany(LimitacionesCapitales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuplementariosDisminuidos()
    {
        return $this->hasMany(SuplementariosDisminuidos::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesCapitalesAfectados()
    {
        return $this->hasMany(LimitacionesCapitalesAfectados::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFondosEmergencias()
    {
        return $this->hasMany(FondosEmergencias::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecretosDivExcedentes()
    {
        return $this->hasMany(DecretosDivExcedentes::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModificacionesBalances()
    {
        return $this->hasMany(ModificacionesBalances::className(), ['acta_constitutiva_id' => 'id']);
    }
}
