<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.documentos_registrados".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $sys_tipo_registro_id
 * @property string $num_registro_notaria
 * @property string $tomo
 * @property string $folio
 * @property string $fecha_registro
 * @property string $fecha_asamblea
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $sys_circunscripcion_id
 *
 * @property ActivosSysTiposRegistros $sysTipoRegistro
 * @property Contratistas $contratista
 * @property SysCircunscripciones $sysCircunscripcion
 * @property AccionistasOtros[] $accionistasOtros
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property ActividadesEconomicas[] $actividadesEconomicas
 * @property CapitalesPropiedades[] $capitalesPropiedades
 * @property CierresEjercicios[] $cierresEjercicios
 * @property ComisariosAuditores[] $comisariosAuditores
 * @property DuracionesEmpresas[] $duracionesEmpresas
 * @property EmpresasFusionadas[] $empresasFusionadas
 * @property ObjetosSociales[] $objetosSociales
 */
class ActivosDocumentosRegistrados extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.documentos_registrados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'sys_tipo_registro_id', 'num_registro_notaria', 'tomo', 'folio', 'fecha_registro', 'sys_circunscripcion_id'], 'required'],
            [['contratista_id', 'sys_tipo_registro_id', 'sys_circunscripcion_id'], 'integer'],
            [['fecha_registro', 'fecha_asamblea', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['num_registro_notaria'], 'string', 'max' => 255],
            [['tomo', 'folio'], 'string', 'max' => 100]
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
            'sys_tipo_registro_id' => Yii::t('app', 'Sys Tipo Registro ID'),
            'num_registro_notaria' => Yii::t('app', 'Num Registro Notaria'),
            'tomo' => Yii::t('app', 'Tomo'),
            'folio' => Yii::t('app', 'Folio'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_asamblea' => Yii::t('app', 'Fecha Asamblea'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'sys_circunscripcion_id' => Yii::t('app', 'Sys Circunscripcion ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysTipoRegistro()
    {
        return $this->hasOne(ActivosSysTiposRegistros::className(), ['id' => 'sys_tipo_registro_id']);
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
    public function getSysCircunscripcion()
    {
        return $this->hasOne(SysCircunscripciones::className(), ['id' => 'sys_circunscripcion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionistasOtros()
    {
        return $this->hasMany(AccionistasOtros::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadesEconomicas()
    {
        return $this->hasMany(ActividadesEconomicas::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesPropiedades()
    {
        return $this->hasMany(CapitalesPropiedades::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCierresEjercicios()
    {
        return $this->hasMany(CierresEjercicios::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComisariosAuditores()
    {
        return $this->hasMany(ComisariosAuditores::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDuracionesEmpresas()
    {
        return $this->hasMany(DuracionesEmpresas::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresasFusionadas()
    {
        return $this->hasMany(EmpresasFusionadas::className(), ['documento_registrado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosSociales()
    {
        return $this->hasMany(ObjetosSociales::className(), ['documento_registrado_id' => 'id']);
    }
}
