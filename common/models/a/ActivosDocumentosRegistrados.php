<?php

namespace common\models\a;

use common\models\p\SysCircunscripciones;
use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

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
 * @property integer $tipo_documento_id
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
            [['contratista_id', 'sys_tipo_registro_id', 'num_registro_notaria', 'tomo', 'folio', 'fecha_registro', 'sys_circunscripcion_id'], 'required', 'on'=>'bien-registro'],
            [['contratista_id', 'sys_tipo_registro_id', 'num_registro_notaria', 'tomo', 'folio', 'fecha_registro', 'sys_circunscripcion_id'], 'required', 'on'=>'bien-notaria'],
            [['contratista_id', 'sys_tipo_registro_id', 'sys_circunscripcion_id','tipo_documento_id'], 'integer'],
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
            'sys_tipo_registro_id' => Yii::t('app', 'Tipo de Registro'),
            'num_registro_notaria' => Yii::t('app', 'Numero de Registro / Notaria'),
            'tomo' => Yii::t('app', 'Tomo'),
            'folio' => Yii::t('app', 'Folio'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_asamblea' => Yii::t('app', 'Fecha Asamblea'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'sys_circunscripcion_id' => Yii::t('app', 'Circunscripcion'),
            'tipo_documento_id' => Yii::t('app', 'Tipo Documento ID'),
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
       // $scenarios['bien-notaria'] = ['',];//Scenario Values Only Accepted
        return $scenarios;
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

    public function getFormAttribs() {
        $attributes = [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'tipo_documento_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysTiposDocumentos::find()->all(),'id','nombre'),'options'=>['onchange'=>'']]],
            'sys_tipo_registro_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysTiposRegistros::find()->all(),'id','nombre'),'options'=>['onchange'=>'']]],
            'num_registro_notaria'=>['type'=>Form::INPUT_TEXT,],
            'tomo'=>['type'=>Form::INPUT_TEXT,],
            'folio'=>['type'=>Form::INPUT_TEXT,],
            'valor_adquisicion'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],

            //'principio_contable_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(ActivosSysFormasOrg::find()->asArray()->all(),'id','nombre')]],
            /*'fecha_origen'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(),'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]],
                'columnOptions'=>['hidden'=>true]
            ],*/
            //'nacional'=>['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['hidden'=>true]],
            //'contratista_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(Contratistas::find()->asArray()->all(),'id','nombre'),],

        ];

        if($this->scenario == 'bien')
            return $attributes;

       // if($this->scenario == 'actas')
            //Actas
            return [
                'sys_circunscripcion_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysCircunscripciones::find()->all(),'id','nombre') , 'options'=>['prompt'=>'Seleccione circunscripcion']],
                'num_registro_notaria'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
                'tomo'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
                'folio'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Numero de colegiatura']],
                'fecha_registro'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'\kartik\widgets\DatePicker',
                    'options'=>['pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]],
                ],
                'fecha_asamblea'=>[
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass'=>'\kartik\widgets\DatePicker',
                    'options'=>['pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]],
                ],

            ];

    }

}
