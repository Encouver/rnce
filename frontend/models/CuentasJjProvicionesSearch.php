<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasJjProviciones;

/**
 * CuentasJjProvicionesSearch represents the model behind the search form about `common\models\c\CuentasJjProviciones`.
 */
class CuentasJjProvicionesSearch extends CuentasJjProviciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'concepto_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'otro_nombre'], 'safe'],
            [['saldo_p_anterior', 'importe_provisionado_periodo', 'aplicacion_amortizacion', 'saldo_al_cierre'], 'number'],
            [['corriente', 'sys_status'], 'boolean'],
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
        $query = CuentasJjProviciones::find();

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
            'saldo_p_anterior' => $this->saldo_p_anterior,
            'importe_provisionado_periodo' => $this->importe_provisionado_periodo,
            'aplicacion_amortizacion' => $this->aplicacion_amortizacion,
            'saldo_al_cierre' => $this->saldo_al_cierre,
            'corriente' => $this->corriente,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'otro_nombre' => $this->otro_nombre,
        ]);

        $query->andFilterWhere(['like', 'concepto_id', $this->concepto_id])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
