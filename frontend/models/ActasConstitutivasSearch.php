<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ActasConstitutivas;

/**
 * ActasConstitutivasSearch represents the model behind the search form about `common\models\p\ActasConstitutivas`.
 */
class ActasConstitutivasSearch extends ActasConstitutivas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'documento_registrado_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'cierre_ejercicio_id', 'creado_por', 'actualizado_por', 'domicilio_fiscal_id', 'domicilio_principal_id', 'modificacion_acta_id'], 'integer'],
            [['sys_status', 'acciones', 'certificados', 'suplementarios', 'actual'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['capital_suscrito', 'capital_pagado'], 'number'],
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
        $query = ActasConstitutivas::find();

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
            'contratista_id' => $this->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'denominacion_comercial_id' => $this->denominacion_comercial_id,
            'duracion_empresa_id' => $this->duracion_empresa_id,
            'objeto_social_id' => $this->objeto_social_id,
            'razon_social_id' => $this->razon_social_id,
            'cierre_ejercicio_id' => $this->cierre_ejercicio_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'domicilio_fiscal_id' => $this->domicilio_fiscal_id,
            'domicilio_principal_id' => $this->domicilio_principal_id,
            'acciones' => $this->acciones,
            'certificados' => $this->certificados,
            'suplementarios' => $this->suplementarios,
            'capital_suscrito' => $this->capital_suscrito,
            'capital_pagado' => $this->capital_pagado,
            'actual' => $this->actual,
            'modificacion_acta_id' => $this->modificacion_acta_id,
        ]);

        return $dataProvider;
    }
}
