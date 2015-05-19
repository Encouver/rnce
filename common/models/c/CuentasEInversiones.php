<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.e_inversiones".
 *
 * @property integer $id
 * @property integer $empresa_relacionada_id
 * @property boolean $corriente
 * @property string $disponibilidad
 * @property string $tipo_instrumento
 * @property string $nombre_instrumento
 * @property string $motivo_retiro
 * @property integer $numero_acc_bon
 * @property integer $e_inversion_info_adicional_id
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $fecha_motivo
 *
 * @property CuentasEInversionesInfoAdicional $eInversionInfoAdicional
 * @property Contratistas $contratista
 * @property PersonasJuridicas $empresaRelacionada
 * @property CuentasETiposMovimientos[] $cuentasETiposMovimientos
 */
class CuentasEInversiones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.e_inversiones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empresa_relacionada_id', 'corriente', 'disponibilidad', 'tipo_instrumento', 'nombre_instrumento', 'numero_acc_bon', 'e_inversion_info_adicional_id', 'contratista_id', 'anho', 'fecha_motivo'], 'required'],
            [['empresa_relacionada_id', 'numero_acc_bon', 'e_inversion_info_adicional_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['corriente', 'sys_status'], 'boolean'],
            [['disponibilidad', 'tipo_instrumento', 'motivo_retiro'], 'string'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_motivo'], 'safe'],
            [['nombre_instrumento'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'empresa_relacionada_id' => Yii::t('app', 'Empresa Relacionada ID'),
            'corriente' => Yii::t('app', 'Corriente'),
            'disponibilidad' => Yii::t('app', 'Disponibilidad'),
            'tipo_instrumento' => Yii::t('app', 'Tipo Instrumento'),
            'nombre_instrumento' => Yii::t('app', 'Nombre Instrumento'),
            'motivo_retiro' => Yii::t('app', 'Motivo Retiro'),
            'numero_acc_bon' => Yii::t('app', 'Numero Acc Bon'),
            'e_inversion_info_adicional_id' => Yii::t('app', 'E Inversion Info Adicional ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'fecha_motivo' => Yii::t('app', 'Fecha Motivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEInversionInfoAdicional()
    {
        return $this->hasOne(CuentasEInversionesInfoAdicional::className(), ['id' => 'e_inversion_info_adicional_id']);
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
    public function getEmpresaRelacionada()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'empresa_relacionada_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasETiposMovimientos()
    {
        return $this->hasMany(CuentasETiposMovimientos::className(), ['e_inversion_id' => 'id']);
    }
}
