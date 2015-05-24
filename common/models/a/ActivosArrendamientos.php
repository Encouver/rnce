<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.arrendamientos".
 *
 * @property integer $id
 * @property integer $tipo_arrendamiento_id
 * @property string $valor_bien_arrendado
 * @property integer $propietario_id
 * @property string $num_doc_notariado
 * @property string $fecha_registro
 * @property string $fecha_inicio
 * @property string $fecha_finalizacion
 * @property integer $unidad_duracion_id
 * @property integer $numero_duracion
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosSysTiposArrendamientos $tipoArrendamiento
 * @property ActivosSysUnidades $unidadDuracion
 * @property ActivosBienes[] $activosBienes
 */
class ActivosArrendamientos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.arrendamientos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_arrendamiento_id', 'propietario_id', 'unidad_duracion_id', 'numero_duracion', 'creado_por', 'actualizado_por'], 'integer'],
            [['valor_bien_arrendado'], 'number'],
            [['propietario_id', 'num_doc_notariado', 'fecha_registro', 'fecha_inicio', 'fecha_finalizacion', 'unidad_duracion_id', 'numero_duracion'], 'required'],
            [['fecha_registro', 'fecha_inicio', 'fecha_finalizacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['num_doc_notariado'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_arrendamiento_id' => Yii::t('app', 'Tipo Arrendamiento ID'),
            'valor_bien_arrendado' => Yii::t('app', 'Valor Bien Arrendado'),
            'propietario_id' => Yii::t('app', 'Propietario ID'),
            'num_doc_notariado' => Yii::t('app', 'Num Doc Notariado'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_finalizacion' => Yii::t('app', 'Fecha Finalizacion'),
            'unidad_duracion_id' => Yii::t('app', 'Unidad Duracion ID'),
            'numero_duracion' => Yii::t('app', 'Numero Duracion'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoArrendamiento()
    {
        return $this->hasOne(ActivosSysTiposArrendamientos::className(), ['id' => 'tipo_arrendamiento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadDuracion()
    {
        return $this->hasOne(ActivosSysUnidades::className(), ['id' => 'unidad_duracion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosBienes()
    {
        return $this->hasMany(ActivosBienes::className(), ['arrendamiento_id' => 'id']);
    }
}
