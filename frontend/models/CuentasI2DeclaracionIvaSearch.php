<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasI2DeclaracionIva;

/**
 * CuentasI2DeclaracionIvaSearch represents the model behind the search form about `common\models\c\CuentasI2DeclaracionIva`.
 */
class CuentasI2DeclaracionIvaSearch extends CuentasI2DeclaracionIva
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'periodo_id', 'certificado_electronico', 'creado_por', 'actualizado_por', 'contratista_id'], 'integer'],
            [['ventas_grabadas', 'ventas_no_grabadas', 'ingresos_totales', 'debito_fiscal', 'compras_gravadas', 'compras_no_gravadas', 'egresos_totales_compra', 'credito_fiscal', 'imp_pagar_compensar'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'anho'], 'safe'],
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
        $query = CuentasI2DeclaracionIva::find();

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
            'periodo_id' => $this->periodo_id,
            'certificado_electronico' => $this->certificado_electronico,
            'ventas_grabadas' => $this->ventas_grabadas,
            'ventas_no_grabadas' => $this->ventas_no_grabadas,
            'ingresos_totales' => $this->ingresos_totales,
            'debito_fiscal' => $this->debito_fiscal,
            'compras_gravadas' => $this->compras_gravadas,
            'compras_no_gravadas' => $this->compras_no_gravadas,
            'egresos_totales_compra' => $this->egresos_totales_compra,
            'credito_fiscal' => $this->credito_fiscal,
            'imp_pagar_compensar' => $this->imp_pagar_compensar,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
        ]);

        $query->andFilterWhere(['like', 'anho', $this->anhoContable/*$this->anho*/]);

        return $dataProvider;
    }
}
