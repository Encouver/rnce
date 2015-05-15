<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\ActivosFacturas;

/**
 * ActivosFacturasSearch represents the model behind the search form about `common\models\a\ActivosFacturas`.
 */
class ActivosFacturasSearch extends ActivosFacturas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'imprenta_id', 'comprador_id', 'contratista_id', 'bien_id'], 'integer'],
            [['num_factura', 'fecha_emision', 'fecha_emision_talonario', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['base_imponible_gravable', 'exento', 'iva'], 'number'],
            [['sys_status'], 'boolean'],
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
        $query = ActivosFacturas::find();

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
            'proveedor_id' => $this->proveedor_id,
            'fecha_emision' => $this->fecha_emision,
            'imprenta_id' => $this->imprenta_id,
            'fecha_emision_talonario' => $this->fecha_emision_talonario,
            'comprador_id' => $this->comprador_id,
            'base_imponible_gravable' => $this->base_imponible_gravable,
            'exento' => $this->exento,
            'iva' => $this->iva,
            'contratista_id' => $this->contratista_id,
            'bien_id' => $this->bien_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'num_factura', $this->num_factura]);

        return $dataProvider;
    }
}
