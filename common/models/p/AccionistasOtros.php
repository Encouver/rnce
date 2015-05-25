<?php

namespace common\models\p;
use kartik\builder\Form;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use Yii;
/**
 * This is the model class for table "accionistas_otros".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $natural_juridica_id
 * @property string $porcentaje_accionario
 * @property string $valor_compra
 * @property string $fecha
 * @property boolean $accionista
 * @property boolean $junta_directiva
 * @property boolean $rep_legal
 * @property integer $documento_registrado_id
 * @property string $repr_legal_vigencia
 * @property integer $empresa_fusionada_id
 * @property string $tipo_obligacion
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property boolean $empresa_relacionada
 * @property string $tipo_cargo
 *
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property Contratistas $contratista
 * @property EmpresasFusionadas $empresaFusionada
 * @property SysNaturalesJuridicas $naturalJuridica
 * @property ActasConstitutivas[] $actasConstitutivas
 * @property PagosAccionistasDecretos[] $pagosAccionistasDecretos
 */
class AccionistasOtros extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accionistas_otros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'natural_juridica_id', 'documento_registrado_id', 'tipo_obligacion','accionista'], 'required'],
            [['contratista_id', 'natural_juridica_id', 'documento_registrado_id', 'empresa_fusionada_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['porcentaje_accionario', 'valor_compra'], 'number'],
            [['fecha', 'repr_legal_vigencia', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['accionista', 'junta_directiva', 'rep_legal', 'sys_status', 'empresa_relacionada'], 'boolean'],
            [['tipo_obligacion', 'tipo_cargo'], 'string'],
            //[['accionista'],'default','value'=>'0'],
             /*['accionista', 'required', 'when' => function ($model) {
                return $model->porcentaje_accionario != null;
            }, 'whenClient' => "function (attribute, value) {
                return $('#accionistasotros-porcentaje_accionario').val() =='';
            }"],
           /* ['accionista', 'required', 'when' => function ($model) {
               return $model->porcentaje_accionario != "";
           }, 'whenClient' => "function (attribute, value) {
               return $('#accionistasotros-porcentaje_accionario').val() != '' &&  $('#accionistasotros-accionista').is(':checked');
           }"]*/
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
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica ID'),
            'porcentaje_accionario' => Yii::t('app', 'Porcentaje Accionario'),
            'valor_compra' => Yii::t('app', 'Valor Compra'),
            'fecha' => Yii::t('app', 'Fecha'),
            'accionista' => Yii::t('app', 'Accionista'),
            'junta_directiva' => Yii::t('app', 'Junta Directiva'),
            'rep_legal' => Yii::t('app', 'Rep Legal'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'repr_legal_vigencia' => Yii::t('app', 'Repr Legal Vigencia'),
            'empresa_fusionada_id' => Yii::t('app', 'Empresa Fusionada ID'),
            'tipo_obligacion' => Yii::t('app', 'Tipo Obligacion'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'empresa_relacionada' => Yii::t('app', 'Empresa Relacionada'),
            'tipo_cargo' => Yii::t('app', 'Tipo Cargo'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaFusionada()
    {
        return $this->hasOne(EmpresasFusionadas::className(), ['id' => 'empresa_fusionada_id']);
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
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['accionista_otro' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagosAccionistasDecretos()
    {
        return $this->hasMany(PagosAccionistasDecretos::className(), ['accionista_id' => 'id']);
    }
     public function getFormAttribs() {
         
        $cargos=[ 'PRESIDENTE' => 'PRESIDENTE', 'DIRECTOR' => 'DIRECTOR', 'VOCERO DE LA UNIDAD DE ADMINISTRACION' => 'VOCERO DE LA UNIDAD DE ADMINISTRACION', 'VOCERO DE LA UNIDAD DE GESTION PRODUCTIVA' => 'VOCERO DE LA UNIDAD DE GESTION PRODUCTIVA', 'VOCERO DE LA UNIDAD DE FORMACION' => 'VOCERO DE LA UNIDAD DE FORMACION', 'VOCERO DE LA UNIDAD DE CONTRALORIA SOCIAL' => 'VOCERO DE LA UNIDAD DE CONTRALORIA SOCIAL', 'INSTANCIA DE ADMINISTRACION' => 'INSTANCIA DE ADMINISTRACION', 'INSTANCIA DE CONTROL Y EVALUACION' => 'INSTANCIA DE CONTROL Y EVALUACION', 'INSTANCIA DE EDUCACION' => 'INSTANCIA DE EDUCACION', ];
       $obligacion=[ 'FIRMA CONJUNTA' => 'FIRMA CONJUNTA', 'FIRMA SEPARADA' => 'FIRMA SEPARADA', ];
        return [
        'natural_juridica_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>[
                'options'=>[],'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
                'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
        ],]],
        'accionista'=>['type'=>Form::INPUT_CHECKBOX,'hint'=>'Solo si es accionista'],
        'junta_directiva'=>['type'=>Form::INPUT_CHECKBOX,'hint'=>'Solo si parte de la junta directiva'],
        'rep_legal'=>['type'=>Form::INPUT_CHECKBOX,'hint'=>'Solo si parte de la junta directiva'],
        'porcentaje_accionario'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Nombre y Apellido']],
        'junta_directiva'=>['type'=>Form::INPUT_CHECKBOX,'hint'=>'Solo si parte de la junta directiva'],
        'tipo_cargo'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$cargos,'options'=>['prompt'=>'Seleccione cargo']],
        'repr_legal_vigencia'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DatePicker', 
                'options'=>['pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]],
                 ],
        'tipo_obligacion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$obligacion,'options'=>['prompt'=>'Seleccione obligacion']],

    ];

       
    }
}
