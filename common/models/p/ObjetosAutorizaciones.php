<?php

namespace common\models\p;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use common\models\p\SysPaises;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use Yii;

/**
 * This is the model class for table "objetos_autorizaciones".
 *
 * @property integer $id
 * @property integer $domicilio_fabricante_id
 * @property string $productos
 * @property string $marcas
 * @property integer $origen_producto_id
 * @property boolean $sello_firma
 * @property integer $idioma_redacion_id
 * @property boolean $documento_traducido
 * @property string $numero_identificacion
 * @property string $nombre_interprete
 * @property string $fecha_emision
 * @property string $fecha_vencimiento
 * @property string $tipo_objeto
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $natural_juridica_id
 * @property integer $contratista_id
 *
 * @property SysNaturalesJuridicas $naturalJuridica
 * @property SysPaises $domicilioFabricante
 * @property SysPaises $origenProducto
 */
class ObjetosAutorizaciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetos_autorizaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domicilio_fabricante_id', 'productos', 'marcas', 'origen_producto_id', 'tipo_objeto', 'natural_juridica_id','contratista_id','fecha_emision','fecha_vencimiento'], 'required'],
            [['domicilio_fabricante_id', 'origen_producto_id', 'idioma_redacion_id', 'creado_por', 'actualizado_por', 'natural_juridica_id','contratista_id'], 'integer'],
            [['productos', 'marcas', 'tipo_objeto'], 'string'],
            [['sello_firma', 'documento_traducido', 'sys_status'], 'boolean'],
            [['fecha_emision', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['numero_identificacion', 'nombre_interprete', 'fecha_vencimiento'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'domicilio_fabricante_id' => Yii::t('app', 'Domicilio del Fabricante'),
            'productos' => Yii::t('app', 'Productos'),
            'marcas' => Yii::t('app', 'Marcas'),
            'origen_producto_id' => Yii::t('app', 'Pais Origen del producto'),
            'sello_firma' => Yii::t('app', 'Sello Firma'),
            'idioma_redacion_id' => Yii::t('app', 'Idioma Redacion de Autorizacion'),
            'documento_traducido' => Yii::t('app', 'Documento Traducido'),
            'numero_identificacion' => Yii::t('app', 'Numero Identificacion'),
            'nombre_interprete' => Yii::t('app', 'Nombre Interprete'),
            'fecha_emision' => Yii::t('app', 'Fecha Emision'),
            'fecha_vencimiento' => Yii::t('app', 'Fecha Vencimiento'),
            'tipo_objeto' => Yii::t('app', 'Tipo Objeto'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'natural_juridica_id' => Yii::t('app', 'Nombre o numero de identificacion del fabricante'),
            'contratista_id' => Yii::t('app', 'Contratista'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNaturalJuridica()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'natural_juridica_id']);
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
    public function getDomicilioFabricante()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'domicilio_fabricante_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigenProducto()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'origen_producto_id']);
    }
     public function getFormAttribs() {
         
        $data=[ 'DISTRIBUIDOR AUTORIZADO' => 'DISTRIBUIDOR AUTORIZADO', 'DISTRIBUIDOR IMPORTADOR AUTORIZADO' => 'DISTRIBUIDOR IMPORTADOR AUTORIZADO', 'SERVICIOS COMERCIALES AUTORIZADO' => 'SERVICIOS COMERCIALES AUTORIZADO', ];
         return [
       'tipo_objeto'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$data,'options'=>['prompt'=>'Seleccione Pais']],
        'domicilio_fabricante_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione Pais']],
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'options'=>[],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term,juridica:true}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
                'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
        ],]],
        'productos'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca productos']],
        'marcas'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca marcas']],
        'origen_producto_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione Pais']],
        'idioma_redacion_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione Idioma']],
        'sello_firma'=>['type'=>Form::INPUT_CHECKBOX,'hint'=>'Solo extranjeros'],
        'documento_traducido'=>['type'=>Form::INPUT_CHECKBOX,'hint'=>'Solo sino es castellano'],
        'nombre_interprete'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Nombre y Apellido']],
        'numero_identificacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Interprete']],
        'fecha_emision'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                 ],
        'fecha_vencimiento'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                 ]
    ];

       
    }
}
