<?php

namespace common\models\p;

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
            'zona' => Yii::t('app', 'Zona'),
            'calle' => Yii::t('app', 'Calle'),
            'casa' => Yii::t('app', 'Casa'),
            'nivel' => Yii::t('app', 'Nivel'),
            'numero' => Yii::t('app', 'Numero'),
            'referencia' => Yii::t('app', 'Referencia'),
            'sys_estado_id' => Yii::t('app', 'Sys Estado ID'),
            'sys_municipio_id' => Yii::t('app', 'Sys Municipio ID'),
            'sys_parroquia_id' => Yii::t('app', 'Sys Parroquia ID'),
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
}
