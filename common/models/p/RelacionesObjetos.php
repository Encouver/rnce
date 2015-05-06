<?php

namespace common\models\p;

use Yii;


class RelacionesObjetos extends \common\components\BaseActiveRecord
{
     /**
     * @inheritdoc
     */
    public $numero_identificacion;
    public $denominacion;
    public $productos;
    public $origen_producto_id;
    public $sello_firma;
    public $marcas;
    public $idioma_redaccion_id;
    public $documento_traducido;
    public $traductor_identificacion;
    public $nombre_interprete;
    public $fecha_emision;
    public $fecha_vencimiento;
    public $tipo_objeto;
    
    public $domicilio_fabricante_id;
    
     public function rules()
    {
        return [
            [['domicilio_fabricante_id', 'productos', 'marcas', 'origen_producto_id', 'tipo_objeto','denominacion','fecha_emision','fecha_vencimiento','numero_identificacion'], 'required'],
            [['domicilio_fabricante_id', 'origen_producto_id','idioma_redaccion_id'], 'integer'],
            [['sello_firma','documento_traducido'], 'boolean'],
            [['numero_identificacion','traductor_identificacion'], 'string', 'max' => 20],
        ];
    }
    
    
    
     public function attributeLabels()
    {
        return [
            'numero_identitifacion' => Yii::t('app', 'Numero Identificacion'),
            'denominacion' => Yii::t('app', 'Nombre o Razon Social'),
            'productos' => Yii::t('app', 'Productos'),
            'origen_producto_id' => Yii::t('app', 'Origen del Producto'),
            'sello_firma' => Yii::t('app', 'Sello o Firma'),
            'marcas' => Yii::t('app', 'Marcas'),
            'idioma_redacion_id' => Yii::t('app', 'Idioma de Redaccion'),
            'documento_traducido' => Yii::t('app', 'Documento Traducido al Castellano?'),
            'nombre_interprete' => Yii::t('app', 'Nombre y Apellido del traductor'),
            'fecha_emision' => Yii::t('app', 'Fecha de Emision'),
            'fecha_vencimiento' => Yii::t('app', 'Fecha de Vencimiento'),
            'tipo_objeto' => Yii::t('app', 'Tipo de Autorizacion'),
            'domicilio_fabricante_id' => Yii::t('app', 'Domicilio del Fabricante'),
        ];
    }
}