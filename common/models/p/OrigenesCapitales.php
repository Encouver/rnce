<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "origenes_capitales".
 *
 * @property integer $id
 * @property string $tipo_origen
 * @property integer $bien_id
 * @property integer $banco_contratista_id
 * @property string $monto
 * @property string $fecha
 * @property string $saldo_cierre_anterior
 * @property string $saldo_corte
 * @property string $fecha_corte
 * @property string $monto_aumento
 * @property string $saldo_aumento
 * @property integer $numero_accion
 * @property string $valor_acciones
 * @property string $saldo_cierre_ajustado
 * @property string $fecha_aumento
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $numero_transaccion
 *
 * @property ActivosBienes $bien
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property BancosContratistas $bancoContratista
 * @property Contratistas $contratista
 */
class OrigenesCapitales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'origenes_capitales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_origen', 'monto', 'contratista_id', 'documento_registrado_id'], 'required'],
            [['tipo_origen'], 'string'],
            [['monto'], 'required', 'on' => 'efectivo'],
            [['monto','banco_contratista_id','fecha','numero_transaccion'], 'required', 'on' => 'efectivoenbanco'],
            [['bien_id', 'banco_contratista_id', 'numero_accion', 'contratista_id', 'documento_registrado_id', 'creado_por', 'actualizado_por','numero_transaccion'], 'integer'],
            [['monto', 'saldo_cierre_anterior', 'saldo_corte', 'monto_aumento', 'saldo_aumento', 'valor_acciones', 'saldo_cierre_ajustado'], 'number'],
            [['fecha', 'fecha_corte', 'fecha_aumento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'tipo_origen' => Yii::t('app', 'Tipo Origen'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'banco_contratista_id' => Yii::t('app', 'Banco Contratista ID'),
            'monto' => Yii::t('app', 'Monto'),
            'fecha' => Yii::t('app', 'Fecha'),
            'saldo_cierre_anterior' => Yii::t('app', 'Saldo Cierre Anterior'),
            'saldo_corte' => Yii::t('app', 'Saldo Corte'),
            'fecha_corte' => Yii::t('app', 'Fecha Corte'),
            'monto_aumento' => Yii::t('app', 'Monto Aumento'),
            'saldo_aumento' => Yii::t('app', 'Saldo Aumento'),
            'numero_accion' => Yii::t('app', 'Numero Accion'),
            'valor_acciones' => Yii::t('app', 'Valor Acciones'),
            'saldo_cierre_ajustado' => Yii::t('app', 'Saldo Cierre Ajustado'),
            'fecha_aumento' => Yii::t('app', 'Fecha Aumento'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'numero_transaccion' => Yii::t('app', 'Numero Transaccion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'bien_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(ActivosDocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancoContratista()
    {
        return $this->hasOne(BancosContratistas::className(), ['id' => 'banco_contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
    public function getFormAttribs($id){
        
        if($id=='efectivo')
        {

            return [
                // primary key column
                'id'=>[ // primary key attribute
                    'type'=>TabularForm::INPUT_HIDDEN,
                    'columnOptions'=>['hidden'=>true]
                ],
                'nombre_caja_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(NombresCajas::find()->where(['nacional' => true])->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Nombre caja'],
                'saldo_cierre_ae'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo cierre'],
                //'tipo_moneda_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(SysDivisas::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Divisa'],
                //'monto_me'=>['type'=>Form::INPUT_TEXT,'label'=>'Depositos en transito'],
                //'tipo_cambio_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Nc no contabilizadas'],
            ];

        }
        if($id=='efectivoenbanco'){
            $ban = BancosContratistas::find()->all();
            $array = array();
            foreach ($ban as $key => $value) {
                if($value->banco->nacional)
                $array[] = ['id' => $value->id, 'nombre' => $value->banco->nombre];
            }

           return [
                'banco_contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map($array, 'id', 'nombre'), 'label'=>'Banco'],
                
                'nombre_caja_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(NombresCajas::find()->where(['nacional' => false])->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Nombre caja'],
                'saldo_cierre_ae'=>['type'=>Form::INPUT_TEXT,'label'=>'Saldo cierre'],
                'tipo_moneda_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(SysDivisas::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Divisa'],
                'monto_me'=>['type'=>Form::INPUT_TEXT,'label'=>'Monto moneda extranjera'],
                'tipo_cambio_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Tipo de cambio al cierre'],
            ];
        }
    }
}
