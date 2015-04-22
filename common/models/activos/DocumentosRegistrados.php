<?php

namespace common\models\activos;

use Yii;

/**
 * This is the model class for table "activos.documentos_registrados".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $sys_tipo_documento_id
 * @property integer $sys_tipo_registro_id
 * @property string $circunscripcion
 * @property string $num_registro_notaria
 * @property string $tomo
 * @property string $folio
 * @property string $fecha_registro
 * @property string $valor_adquisicion
 * @property string $fecha_asamblea
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property SysTiposDocumentos $sysTipoDocumento
 * @property SysTiposRegistros $sysTipoRegistro
 */
class DocumentosRegistrados extends \common\components\BaseActiveRecord
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
            [['contratista_id', 'sys_tipo_documento_id', 'sys_tipo_registro_id', 'circunscripcion', 'num_registro_notaria', 'tomo', 'folio', 'fecha_registro', 'valor_adquisicion'], 'required'],
            [['contratista_id', 'sys_tipo_documento_id', 'sys_tipo_registro_id'], 'integer'],
            [['fecha_registro', 'fecha_asamblea', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['valor_adquisicion'], 'number'],
            [['sys_status'], 'boolean'],
            [['circunscripcion', 'num_registro_notaria'], 'string', 'max' => 255],
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
            'sys_tipo_documento_id' => Yii::t('app', 'Sys Tipo Documento ID'),
            'sys_tipo_registro_id' => Yii::t('app', 'Sys Tipo Registro ID'),
            'circunscripcion' => Yii::t('app', 'Circunscripcion'),
            'num_registro_notaria' => Yii::t('app', 'Num Registro Notaria'),
            'tomo' => Yii::t('app', 'Tomo'),
            'folio' => Yii::t('app', 'Folio'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'valor_adquisicion' => Yii::t('app', 'Valor Adquisicion'),
            'fecha_asamblea' => Yii::t('app', 'Fecha Asamblea'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
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
    public function getSysTipoDocumento()
    {
        return $this->hasOne(SysTiposDocumentos::className(), ['id' => 'sys_tipo_documento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysTipoRegistro()
    {
        return $this->hasOne(SysTiposRegistros::className(), ['id' => 'sys_tipo_registro_id']);
    }
}
