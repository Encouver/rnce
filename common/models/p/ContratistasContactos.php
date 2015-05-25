<?php

namespace common\models\p;
use Yii;

/**
 * This is the model class for table "public.contratistas_contactos".
 *
 * @property integer $id
 * @property integer $contacto_id
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property PersonasNaturales $contacto
 * @property Contratistas $contratista
 */
class ContratistasContactos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.contratistas_contactos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contacto_id', 'contratista_id'], 'required'],
            [['contacto_id', 'contratista_id'], 'integer'],
            [['sys_status'], 'boolean'],
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
            'contacto_id' => Yii::t('app', 'Contacto ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacto()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'contacto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}
