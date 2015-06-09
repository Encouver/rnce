<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\Suplementarios;

/**
 * SuplementariosSearch represents the model behind the search form about `common\models\p\Suplementarios`.
 */
class SuplementariosSearch extends Suplementarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numero', 'documento_registrado_id', 'contratista_id', 'creado_por', 'actualizado_por','certificacion_aporte_id'], 'integer'],
            [['valor', 'capital'], 'number'],
            [['tipo_suplementario', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['suscrito', 'sys_status','actual'], 'boolean'],
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
        $query = Suplementarios::find();

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
            'numero' => $this->numero,
            'valor' => $this->valor,
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
            'certificacion_aporte_id'=> $this->certificacion_aporte_id,
            'tipo_suplementario'=>$this->tipo_suplementario,
            'actual'=>$this->actual,
        ]);

       // $query->andFilterWhere(['like', 'tipo_suplementario', $this->tipo_suplementario]);

        return $dataProvider;
    }
}
