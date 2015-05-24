<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\Acciones;

/**
 * AccionesSearch represents the model behind the search form about `common\models\p\Acciones`.
 */
class AccionesSearch extends Acciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numero_comun', 'numero_preferencial', 'documento_registrado_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['valor_comun', 'valor_preferencial', 'capital'], 'number'],
            [['tipo_accion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['suscrito', 'sys_status'], 'boolean'],
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
        $query = Acciones::find();

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
            'numero_comun' => $this->numero_comun,
            'numero_preferencial' => $this->numero_preferencial,
            'valor_comun' => $this->valor_comun,
            'valor_preferencial' => $this->valor_preferencial,
            'suscrito' => $this->suscrito,
            'documento_registrado_id' => $this->documento_registrado_id,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'capital' => $this->capital,
        ]);

        $query->andFilterWhere(['like', 'tipo_accion', $this->tipo_accion]);

        return $dataProvider;
    }
}
