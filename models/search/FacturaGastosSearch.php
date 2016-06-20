<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FacturaGastos;

/**
 * FacturaGastosSearch represents the model behind the search form about `app\models\FacturaGastos`.
 */
class FacturaGastosSearch extends FacturaGastos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_factura_gastos', 'items_id_item', 'apartamentos_id_apartamento'], 'integer'],
            [['fecha_registro', 'descripcion'], 'safe'],
            [['iva', 'total'], 'number'],
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
        $query = FacturaGastos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_factura_gastos' => $this->id_factura_gastos,
            'items_id_item' => $this->items_id_item,
            'apartamentos_id_apartamento' => $this->apartamentos_id_apartamento,
            'fecha_registro' => $this->fecha_registro,
            'iva' => $this->iva,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
