<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.sys_totales".
 *
 * @property integer $id
 * @property string $classname
 * @property string $valor
 * @property integer $id_classname
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property boolean $total
 * @property string $ahno
 *
 * @property AEfectivosBancos[] $aEfectivosBancos
 * @property AInversionesNegociar[] $aInversionesNegociars
 */
class SysTotales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.sys_totales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['classname', 'valor', 'id_classname', 'contratista_id', 'ahno'], 'required'],
            [['id_classname', 'contratista_id'], 'integer'],
            [['sys_status', 'total'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['classname'], 'string', 'max' => 200],
            [['valor'], 'string', 'max' => 255],
            [['ahno'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'classname' => Yii::t('app', 'Classname'),
            'valor' => Yii::t('app', 'Valor'),
            'id_classname' => Yii::t('app', 'Id Classname'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'total' => Yii::t('app', 'Total'),
            'ahno' => Yii::t('app', 'Ahno'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAEfectivosBancos()
    {
        return $this->hasMany(AEfectivosBancos::className(), ['total_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAInversionesNegociars()
    {
        return $this->hasMany(AInversionesNegociar::className(), ['total_id' => 'id']);
    }
}
