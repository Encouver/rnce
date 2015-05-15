<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\AaObligacionesBancarias;

/**
 * AaObligacionesBancariasSearch represents the model behind the search form about `common\models\c\AaObligacionesBancarias`.
 */
class AaObligacionesBancariasSearch extends AaObligacionesBancarias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banco_id', 'condicion_pago_id', 'plazo', 'tipo_garantia_id', 'total_imp_deu_int', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['corriente', 'sys_status'], 'boolean'],
            [['num_documento', 'fecha_prestamo', 'fecha_vencimiento', 'anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['monto_otorgado', 'tasa_interes', 'interes_ejer_econ', 'interes_pagar', 'importe_deuda'], 'number'],
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
        $query = AaObligacionesBancarias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>100]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'corriente' => $this->corriente,
            'banco_id' => $this->banco_id,
            'monto_otorgado' => $this->monto_otorgado,
            'fecha_prestamo' => $this->fecha_prestamo,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'tasa_interes' => $this->tasa_interes,
            'condicion_pago_id' => $this->condicion_pago_id,
            'plazo' => $this->plazo,
            'tipo_garantia_id' => $this->tipo_garantia_id,
            'interes_ejer_econ' => $this->interes_ejer_econ,
            'interes_pagar' => $this->interes_pagar,
            'importe_deuda' => $this->importe_deuda,
            'total_imp_deu_int' => $this->total_imp_deu_int,
            'contratista_id' => Yii::$app->user->identity->contratista_id,//$this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'num_documento', $this->num_documento])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
