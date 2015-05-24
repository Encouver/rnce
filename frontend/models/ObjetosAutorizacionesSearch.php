<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ObjetosAutorizaciones;

/**
 * ObjetosAutorizacionesSearch represents the model behind the search form about `common\models\p\ObjetosAutorizaciones`.
 */
class ObjetosAutorizacionesSearch extends ObjetosAutorizaciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'domicilio_fabricante_id','contratista_id' ,'origen_producto_id', 'idioma_redacion_id', 'creado_por', 'actualizado_por', 'natural_juridica_id'], 'integer'],
            [['productos', 'marcas', 'numero_identificacion', 'nombre_interprete', 'fecha_emision', 'fecha_vencimiento', 'tipo_objeto', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sello_firma', 'documento_traducido', 'sys_status'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ObjetosAutorizaciones::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'domicilio_fabricante_id' => $this->domicilio_fabricante_id,
            'origen_producto_id' => $this->origen_producto_id,
            'sello_firma' => $this->sello_firma,
            'idioma_redacion_id' => $this->idioma_redacion_id,
            'documento_traducido' => $this->documento_traducido,
            'fecha_emision' => $this->fecha_emision,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'natural_juridica_id' => $this->natural_juridica_id,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
        ]);

        $query->andFilterWhere(['like', 'productos', $this->productos])
            ->andFilterWhere(['like', 'marcas', $this->marcas])
            ->andFilterWhere(['like', 'numero_identificacion', $this->numero_identificacion])
            ->andFilterWhere(['like', 'nombre_interprete', $this->nombre_interprete])
            ->andFilterWhere(['like', 'fecha_vencimiento', $this->fecha_vencimiento])
            ->andFilterWhere(['like', 'tipo_objeto', $this->tipo_objeto]);

        return $dataProvider;
    }
}
