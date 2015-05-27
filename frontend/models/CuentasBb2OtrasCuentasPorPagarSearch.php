<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasBb2OtrasCuentasPorPagar;

/**
 * CuentasBb2OtrasCuentasPorPagarSearch represents the model behind the search form about `common\models\c\CuentasBb2OtrasCuentasPorPagar`.
 */
class CuentasBb2OtrasCuentasPorPagarSearch extends CuentasBb2OtrasCuentasPorPagar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'garantia', 'plazo', 'criterio_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['criterio', 'fecha', 'otro_nombre', 'detalle', 'anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['saldo_conta_co', 'saldo_conta_nc', 'intereses'], 'number'],
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
        $query = CuentasBb2OtrasCuentasPorPagar::find();

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
            'fecha' => $this->fecha,
            'garantia' => $this->garantia,
            'plazo' => $this->plazo,
            'saldo_conta_co' => $this->saldo_conta_co,
            'saldo_conta_nc' => $this->saldo_conta_nc,
            'intereses' => $this->intereses,
            'criterio_id' => $this->criterio_id,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'criterio', $this->criterio])
            ->andFilterWhere(['like', 'otro_nombre', $this->otro_nombre])
            ->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
