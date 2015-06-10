<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.sys_metodos_medicion".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $modelo_id
 * @property integer $clasificacion_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosMediciones[] $activosMediciones
 * @property ActivosSysClasificacionesMetodos $clasificacion
 * @property ActivosSysModelosMediciones $modelo
 * @property CuentasSysFormulasTecnicas[] $cuentasSysFormulasTecnicas
 */
class ActivosSysMetodosMedicion extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_metodos_medicion';
    }
    public static function Metodos($modelo_id = 1){
        return ActivosSysMetodosMedicion::find()->where(['modelo_id'=>$modelo_id])->all();
    }


    //por capas
    public $enero;
    public $febrero;
    public $marzo;
    public $abril;
    public $mayo;
    public $junio;
    public $julio;
    public $agosto;
    public $septiembre;
    public $octubre;
    public $noviembre;
    public $diciembre;

    //promedio
    public $desde;
    public $hasta;

    //deterioro
    public $valor_neto;
    public $valor_razo;
    public $costo_dis;
    public $valor_uso;
    public $importe_recu;
    public $diferencia;
    public $deterioro_acu;
    public $perdida;
    public $reverso;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'modelo_id', 'clasificacion_id'], 'required'],
            [['modelo_id', 'clasificacion_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre', 'descripcion'], 'string', 'max' => 255],
            [['nombre'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'modelo_id' => Yii::t('app', 'Modelo ID'),
            'clasificacion_id' => Yii::t('app', 'Clasificacion ID'),
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
    public function getActivosMediciones()
    {
        return $this->hasMany(ActivosMediciones::className(), ['sys_metodo_medicion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClasificacion()
    {
        return $this->hasOne(ActivosSysClasificacionesMetodos::className(), ['id' => 'clasificacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelo()
    {
        return $this->hasOne(ActivosSysModelosMediciones::className(), ['id' => 'modelo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasSysFormulasTecnicas()
    {
        return $this->hasMany(CuentasSysFormulasTecnicas::className(), ['tecnica_medicion_id' => 'id']);
    }

    public function Etiqueta(){
        return $this->modelo->nombre.' - '.$this->nombre;
    }
}
