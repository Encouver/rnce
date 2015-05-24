<?php

namespace common\models\p;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use common\models\p\SysEstados;
use common\models\p\SysMunicipios;
use common\models\p\SysParroquias;
use Yii;

/**
 * This is the model class for table "public.direcciones".
 *
 * @property integer $id
 * @property string $zona
 * @property string $calle
 * @property string $casa
 * @property string $nivel
 * @property string $numero
 * @property string $referencia
 * @property integer $sys_estado_id
 * @property integer $sys_municipio_id
 * @property integer $sys_parroquia_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property SysEstados $sysEstado
 * @property SysMunicipios $sysMunicipio
 * @property SysParroquias $sysParroquia
 * @property Sucursales[] $sucursales
 * @property Domicilios[] $domicilios
 */
class Direcciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.direcciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zona', 'calle', 'casa', 'nivel', 'numero', 'sys_estado_id', 'sys_municipio_id', 'sys_parroquia_id'], 'required'],
            [['referencia'], 'string'],
            [['referencia'], 'required','on'=>'principal'],
            [['sys_estado_id', 'sys_municipio_id', 'sys_parroquia_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['zona', 'calle', 'casa'], 'string', 'max' => 255],
            [['nivel'], 'string', 'max' => 50],
            [['numero'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'zona' => Yii::t('app', 'Sector / Zona / Urbanizacion'),
            'calle' => Yii::t('app', 'Avenida / Calle / Esquina'),
            'casa' => Yii::t('app', 'Edificio / Casa / Centro Comercial'),
            'nivel' => Yii::t('app', 'Piso / Nivel'),
            'numero' => Yii::t('app', 'Casa / Local / Apartamento / Oficina'),
            'referencia' => Yii::t('app', 'Punto de Referencia'),
            'sys_estado_id' => Yii::t('app', 'Estado'),
            'sys_municipio_id' => Yii::t('app', 'Municipio'),
            'sys_parroquia_id' => Yii::t('app', 'Parroquia'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysEstado()
    {
        return $this->hasOne(SysEstados::className(), ['id' => 'sys_estado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysMunicipio()
    {
        return $this->hasOne(SysMunicipios::className(), ['id' => 'sys_municipio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysParroquia()
    {
        return $this->hasOne(SysParroquias::className(), ['id' => 'sys_parroquia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursales()
    {
        return $this->hasMany(Sucursales::className(), ['direccion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilios()
    {
        return $this->hasMany(Domicilios::className(), ['principal_id' => 'id']);
    }
    
    public function getFormAttribs($id=null) {
        //$data=[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ];
    if($id=="principal"){
         return [
        //'tipo_nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$data , 'options'=>['placeholder'=>'Enter username...']],
        
        'sys_estado_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysEstados::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione estado']],
        'sys_municipio_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysMunicipios::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione municipio']],
        'sys_parroquia_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysParroquias::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione parroquia']],
        'zona'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca zona']],
        'calle'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca direccion']],
        'casa'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca tipo']],
        'nivel'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca nivel']],
        'numero'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca numero']],
        'referencia'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca pto. referencia']],
    ];
    }
    if($id=="fiscal"){
         return [
        //'tipo_nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$data , 'options'=>['placeholder'=>'Enter username...']],
        
        'sys_estado_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysEstados::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione estado']],
        'sys_municipio_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysMunicipios::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione municipio']],
        'sys_parroquia_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysParroquias::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione parroquia']],
        'zona'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca zona']],
        'calle'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca direccion']],
        'casa'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca tipo']],
        'nivel'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca nivel']],
        'numero'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca numero']],
        
    ];
    }
       
    }
}
