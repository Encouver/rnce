<?php

namespace common\models\p;

use Yii;


class RelacionesSucursales extends \common\components\BaseActiveRecord
{
     /**
     * @inheritdoc
     */
    public $rif;
    public $primer_nombre;
    public $segundo_nombre;
    public $primer_apellido;
    public $segundo_apellido;
    
    public $telefono_local;
    public $telefono_celular;
    public $fax;
    public $correo;
    public $pagina_web;
    public $facebook;
    public $twitter;
    public $instagram;
    
    
    public $sys_estado_id;
    public $sys_municipio_id;
    public $sys_parroquia_id;
    public $zona;
    public $calle;
    public $casa;
    public $nivel;
    public $numero;
    public $referencia;
    
    public $representante;
    public $accionista;
    
     public function rules()
    {
        return [
            [['primer_nombre', 'segundo_nombre','primer_apellido', 'segundo_apellido','zona', 'calle', 'casa', 'nivel', 'numero', 'sys_estado_id', 'sys_municipio_id', 'sys_parroquia_id'], 'required'],
            [['sys_estado_id', 'sys_municipio_id', 'sys_parroquia_id'], 'integer'],
            [['representante', 'accionista'], 'boolean'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'pagina_web', 'facebook', 'twitter', 'instagram', 'numero_identificacion','zona', 'calle', 'casa'], 'string', 'max' => 255],
            [['rif','numero'], 'string', 'max' => 20],
            [['telefono_local', 'telefono_celular', 'fax','nivel'], 'string', 'max' => 50],
            [['correo'], 'string', 'max' => 150],
        ];
    }
    
    
    
     public function attributeLabels()
    {
        return [
            'primer_nombre' => Yii::t('app', 'Primer Nombre'),
            'segundo_nombre' => Yii::t('app', 'Segundo Nombre'),
            'rif' => Yii::t('app', 'Rif'),
            'primer_apellido' => Yii::t('app', 'Primer Apellido'),
            'segundo_apellido' => Yii::t('app', 'Segundo Apellido'),
            'telefono_local' => Yii::t('app', 'Telefono Local'),
            'telefono_celular' => Yii::t('app', 'Telefono Celular'),
            'fax' => Yii::t('app', 'Fax'),
            'correo' => Yii::t('app', 'Correo'),
            'pagina_web' => Yii::t('app', 'Pagina Web'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'instagram' => Yii::t('app', 'Instagram'),
            'zona' => Yii::t('app', 'Zona'),
            'calle' => Yii::t('app', 'Calle'),
            'casa' => Yii::t('app', 'Casa'),
            'nivel' => Yii::t('app', 'Nivel'),
            'numero' => Yii::t('app', 'Numero'),
            'referencia' => Yii::t('app', 'Referencia'),
            'sys_estado_id' => Yii::t('app', 'Estado'),
            'sys_municipio_id' => Yii::t('app', 'Municipio'),
            'sys_parroquia_id' => Yii::t('app', 'Parroquia'),
            'representante' => Yii::t('app', 'Representante'),
            'accionista' => Yii::t('app', 'Accionista'),
        ];
    }
}