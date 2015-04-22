<?php

namespace common\models\activos;

use Yii;

/**
 * This is the model class for table "activos.mejoras_propiedades".
 *
 * @property integer $id
 * @property string $clasificacion
 * @property integer $sys_tipo_bien_id
 * @property integer $principio_contable_id
 * @property boolean $depreciacion
 * @property boolean $deterioro
 * @property integer $bien_id
 * @property string $monto
 * @property string $fecha
 * @property boolean $capitalizable
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Bienes $bien
 * @property SysFormasOrg $principioContable
 * @property SysTiposBienes $sysTipoBien
 */
class MejorasPropiedades extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.mejoras_propiedades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clasificacion', 'sys_tipo_bien_id', 'principio_contable_id', 'bien_id', 'monto', 'fecha'], 'required'],
            [['sys_tipo_bien_id', 'principio_contable_id', 'bien_id'], 'integer'],
            [['depreciacion', 'deterioro', 'capitalizable', 'sys_status'], 'boolean'],
            [['monto'], 'number'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['clasificacion'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'clasificacion' => Yii::t('app', 'Clasificacion'),
            'sys_tipo_bien_id' => Yii::t('app', 'Sys Tipo Bien ID'),
            'principio_contable_id' => Yii::t('app', 'Principio Contable ID'),
            'depreciacion' => Yii::t('app', 'Depreciacion'),
            'deterioro' => Yii::t('app', 'Deterioro'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'monto' => Yii::t('app', 'Monto'),
            'fecha' => Yii::t('app', 'Fecha'),
            'capitalizable' => Yii::t('app', 'Capitalizable'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrincipioContable()
    {
        return $this->hasOne(SysFormasOrg::className(), ['id' => 'principio_contable_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysTipoBien()
    {
        return $this->hasOne(SysTiposBienes::className(), ['id' => 'sys_tipo_bien_id']);
    }
}
