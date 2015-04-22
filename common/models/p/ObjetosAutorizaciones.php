<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.objetos_autorizaciones".
 *
 * @property integer $id
 * @property integer $objeto_empresa_id
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
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $persona_juridica_id
 *
 * @property SysPaises $domicilioFabricante
 * @property ObjetosEmpresas $objetoEmpresa
 * @property SysPaises $origenProducto
 * @property PersonasJuridicas $personaJuridica
 */
class ObjetosAutorizaciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.objetos_autorizaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objeto_empresa_id', 'domicilio_fabricante_id', 'productos', 'marcas', 'origen_producto_id', 'persona_juridica_id'], 'required'],
            [['objeto_empresa_id', 'domicilio_fabricante_id', 'origen_producto_id', 'idioma_redacion_id', 'persona_juridica_id'], 'integer'],
            [['productos', 'marcas'], 'string'],
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
            'objeto_empresa_id' => Yii::t('app', 'Objeto Empresa ID'),
            'domicilio_fabricante_id' => Yii::t('app', 'Domicilio Fabricante ID'),
            'productos' => Yii::t('app', 'Productos'),
            'marcas' => Yii::t('app', 'Marcas'),
            'origen_producto_id' => Yii::t('app', 'Origen Producto ID'),
            'sello_firma' => Yii::t('app', 'Sello Firma'),
            'idioma_redacion_id' => Yii::t('app', 'Idioma Redacion ID'),
            'documento_traducido' => Yii::t('app', 'Documento Traducido'),
            'numero_identificacion' => Yii::t('app', 'Numero Identificacion'),
            'nombre_interprete' => Yii::t('app', 'Nombre Interprete'),
            'fecha_emision' => Yii::t('app', 'Fecha Emision'),
            'fecha_vencimiento' => Yii::t('app', 'Fecha Vencimiento'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'persona_juridica_id' => Yii::t('app', 'Persona Juridica ID'),
        ];
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
    public function getObjetoEmpresa()
    {
        return $this->hasOne(ObjetosEmpresas::className(), ['id' => 'objeto_empresa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigenProducto()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'origen_producto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaJuridica()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'persona_juridica_id']);
    }
}
