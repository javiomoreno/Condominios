<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FacturaServicios;

/**
 * FacturaServiciosSearch represents the model behind the search form about `app\models\FacturaServicios`.
 */
class FacturaServiciosSearch extends FacturaServicios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_factura_servicios', 'servicios_id_servicio', 'apartamentos_id_apartamento', 'estado'], 'integer'],
            [['fecha_factura', 'fecha_vencimiento', 'observciones'], 'safe'],
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
        $query = FacturaServicios::find();

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
            'id_factura_servicios' => $this->id_factura_servicios,
            'servicios_id_servicio' => $this->servicios_id_servicio,
            'apartamentos_id_apartamento' => $this->apartamentos_id_apartamento,
            'fecha_factura' => $this->fecha_factura,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'iva' => $this->iva,
            'total' => $this->total,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'observciones', $this->observciones]);

        return $dataProvider;
    }
}
