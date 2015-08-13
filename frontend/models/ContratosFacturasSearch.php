<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ContratosFacturas;

/**
 * ContratosFacturasSearch represents the model behind the search form about `common\models\p\ContratosFacturas`.
 */
class ContratosFacturasSearch extends ContratosFacturas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'relacion_contrato_id', 'orden_factura', 'creado_por', 'actualizado_por'], 'integer'],
            [['monto'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = ContratosFacturas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['relacionContrato']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'relacion_contrato_id' => $this->relacion_contrato_id,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'orden_factura' => $this->orden_factura,
            'monto' => $this->monto,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            //'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        return $dataProvider;
    }
}
