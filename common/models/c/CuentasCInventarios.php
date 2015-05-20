<?php

namespace common\models\c;

use Yii;

use common\models\c\CuentasCInventarios;
use common\models\c\CuentasCTiposInventarios;
use common\models\c\CuentasSysFormulasTecnicas;

use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\ActiveFormEvent;
use yii\helpers\Html;

/**
 * This is the model class for table "cuentas.c_inventarios".
 *
 * @property integer $id
 * @property integer $tipo_inventario_id
 * @property string $detalle_inventario
 * @property integer $tecnica_medicion_id
 * @property integer $formula_tecnica_id
 * @property string $inventario_inicial
 * @property string $compra_ejercicio
 * @property string $ventas_ejercicio
 * @property string $inventario_final
 * @property string $valor_neto_realizacion
 * @property integer $frecuencia_rotacion
 * @property string $variacion_inflacion
 * @property string $costo_ajustado
 * @property string $deterioro
 * @property string $reverso_deterioro
 * @property string $valor_neto_ajus_cierre
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 */
class CuentasCInventarios extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.c_inventarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_inventario_id', 'detalle_inventario', 'tecnica_medicion_id', 'formula_tecnica_id', 'inventario_inicial', 'compra_ejercicio', 'ventas_ejercicio', 'inventario_final', 'valor_neto_realizacion', 'frecuencia_rotacion', 'variacion_inflacion', 'costo_ajustado', 'deterioro', 'reverso_deterioro', 'valor_neto_ajus_cierre'], 'required'],
            [['tipo_inventario_id', 'tecnica_medicion_id', 'formula_tecnica_id', 'frecuencia_rotacion', 'creado_por', 'actualizado_por'], 'integer'],
            [['inventario_inicial', 'compra_ejercicio', 'ventas_ejercicio', 'inventario_final', 'valor_neto_realizacion', 'variacion_inflacion', 'costo_ajustado', 'deterioro', 'reverso_deterioro', 'valor_neto_ajus_cierre'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['detalle_inventario'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_inventario_id' => Yii::t('app', 'Tipo Inventario ID'),
            'detalle_inventario' => Yii::t('app', 'Detalle Inventario'),
            'tecnica_medicion_id' => Yii::t('app', 'Tecnica Medicion ID'),
            'formula_tecnica_id' => Yii::t('app', 'Formula Tecnica ID'),
            'inventario_inicial' => Yii::t('app', 'Inventario Inicial'),
            'compra_ejercicio' => Yii::t('app', 'Compra Ejercicio'),
            'ventas_ejercicio' => Yii::t('app', 'Ventas Ejercicio'),
            'inventario_final' => Yii::t('app', 'Inventario Final'),
            'valor_neto_realizacion' => Yii::t('app', 'Valor Neto Realizacion'),
            'frecuencia_rotacion' => Yii::t('app', 'Frecuencia Rotacion'),
            'variacion_inflacion' => Yii::t('app', 'Variacion Inflacion'),
            'costo_ajustado' => Yii::t('app', 'Costo Ajustado'),
            'deterioro' => Yii::t('app', 'Deterioro'),
            'reverso_deterioro' => Yii::t('app', 'Reverso Deterioro'),
            'valor_neto_ajus_cierre' => Yii::t('app', 'Valor Neto Ajus Cierre'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }




     public function getFormAttribs() 
    {
        return [
                // primary key column
            'id'=>[ // primary key attribute
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'tipo_inventario_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(CuentasCTiposInventarios::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Tipo inventario'],
            'detalle_inventario'=>['type'=>Form::INPUT_TEXT,'label'=>'Detalle'],
            'tecnica_medicion_id'=>['type'=>Form::INPUT_TEXT,'label'=>'Tecnica de medición'],  //apunta a la relacion
            'formula_tecnica_id'=>['type'=>Form::INPUT_TEXT,'label'=>'Formula tecnica'],   //apunta a la relacion
            'inventario_inicial'=>['type'=>Form::INPUT_TEXT,'label'=>'Inventario inicial'],
            'compra_ejercicio'=>['type'=>Form::INPUT_TEXT,'label'=>'Compras'],
            'ventas_ejercicio'=>['type'=>Form::INPUT_TEXT,'label'=>'Ventas'],
            'inventario_final'=>['type'=>Form::INPUT_TEXT,'label'=>'Inventario final'],
            'valor_neto_realizacion'=>['type'=>Form::INPUT_TEXT,'label'=>'Valor neto'],
            'frecuencia_rotacion'=>['type'=>Form::INPUT_TEXT,'label'=>'Frecuencia de rotación'],
            'variacion_inflacion'=>['type'=>Form::INPUT_TEXT,'label'=>'Variacion por inflación'],
            'costo_ajustado'=>['type'=>Form::INPUT_TEXT,'label'=>'Costo ajustado'],
            'deterioro'=>['type'=>Form::INPUT_TEXT,'label'=>'Deterioro'],
            'reverso_deterioro'=>['type'=>Form::INPUT_TEXT,'label'=>'Reverso deterioro'],
            'valor_neto_ajus_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Valor neto ajustado al cierre'],
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasCTiposInventarios()
    {
        return $this->hasOne(CuentasCTiposInventarios::className(), ['id' => 'tipo_inventario_id']);
    }
}
