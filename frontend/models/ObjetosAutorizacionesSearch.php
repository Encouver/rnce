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
            [['id', 'objeto_empresa_id', 'domicilio_fabricante_id', 'origen_producto_id', 'idioma_redacion_id', 'persona_juridica_id'], 'integer'],
            [['productos', 'marcas', 'numero_identificacion', 'nombre_interprete', 'fecha_emision', 'fecha_vencimiento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'tipo_objeto'], 'safe'],
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
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'objeto_empresa_id' => $this->objeto_empresa_id,
            'domicilio_fabricante_id' => $this->domicilio_fabricante_id,
            'origen_producto_id' => $this->origen_producto_id,
            'sello_firma' => $this->sello_firma,
            'idioma_redacion_id' => $this->idioma_redacion_id,
            'documento_traducido' => $this->documento_traducido,
            'fecha_emision' => $this->fecha_emision,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'persona_juridica_id' => $this->persona_juridica_id,
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
