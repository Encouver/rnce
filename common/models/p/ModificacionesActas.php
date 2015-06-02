<?php

namespace common\models\p;
use common\models\a\ActivosDocumentosRegistrados;
use Yii;

/**
 * This is the model class for table "modificaciones_actas".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
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
 * @property boolean $razon_social
 * @property boolean $denominacion_comercial
 * @property boolean $domicilio_fiscal
 * @property boolean $domicilio_principal
 * @property boolean $objeto_social
 * @property boolean $representante_legal
 * @property boolean $junta_directiva
 * @property boolean $duracion_empresa
 * @property boolean $cierre_ejercicio
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 */
class ModificacionesActas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modificaciones_actas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'documento_registrado_id'], 'required'],
            [['contratista_id', 'documento_registrado_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['pago_capital', 'aporte_capitalizar', 'aumento_capital', 'coreccion_monetaria', 'disminucion_capital', 'limitacion_capital', 'limitacion_capital_afectado', 'fondo_emergencia', 'reintegro_perdida', 'venta_accion', 'fusion_empresarial', 'decreto_div_excedente', 'modificacion_balance', 'razon_social', 'denominacion_comercial', 'domicilio_fiscal', 'domicilio_principal', 'objeto_social', 'representante_legal', 'junta_directiva', 'duracion_empresa', 'cierre_ejercicio', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
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
            'razon_social' => Yii::t('app', 'Razon Social'),
            'denominacion_comercial' => Yii::t('app', 'Denominacion Comercial'),
            'domicilio_fiscal' => Yii::t('app', 'Domicilio Fiscal'),
            'domicilio_principal' => Yii::t('app', 'Domicilio Principal'),
            'objeto_social' => Yii::t('app', 'Objeto Social'),
            'representante_legal' => Yii::t('app', 'Representante Legal'),
            'junta_directiva' => Yii::t('app', 'Junta Directiva'),
            'duracion_empresa' => Yii::t('app', 'Duracion Empresa'),
            'cierre_ejercicio' => Yii::t('app', 'Cierre Ejercicio'),
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
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(ActivosDocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
     public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);       
       if(isset($registro)){
          $modificacion= ModificacionesActas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
           if(isset($modificacion)){
               
                return true;   
            }else{
                $this->documento_registrado_id=$registro->id;
                return false;
            }
        }else{
            return true;
        }
    }
}
