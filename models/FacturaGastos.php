<?php

namespace app\models;

use Yii;
use app\models\Items;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "factura_gastos".
 *
 * @property integer $id_factura_gastos
 * @property integer $items_id_item
 * @property integer $apartamentos_id_apartamento
 * @property string $fecha_registro
 * @property double $iva
 * @property double $total
 * @property string $descripcion
 *
 * @property Apartamentos $apartamentosIdApartamento
 * @property Items $itemsIdItem
 * @property FacturaGastosItems[] $facturaGastosItems
 */
class FacturaGastos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factura_gastos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apartamentos_id_apartamento'], 'required'],
            [['apartamentos_id_apartamento'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['iva', 'total'], 'number'],
            [['descripcion'], 'string', 'max' => 250],
            [['apartamentos_id_apartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Apartamentos::className(), 'targetAttribute' => ['apartamentos_id_apartamento' => 'id_apartamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_factura_gastos' => 'Id Factura Gastos',
            'apartamentos_id_apartamento' => 'Apartamentos Id Apartamento',
            'fecha_registro' => 'Fecha Registro',
            'iva' => 'Iva',
            'total' => 'Total',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartamentosIdApartamento()
    {
        return $this->hasOne(Apartamentos::className(), ['id_apartamento' => 'apartamentos_id_apartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaGastosItems()
    {
        return $this->hasMany(FacturaGastosItems::className(), ['factura_gastos_id_factura_gastos' => 'id_factura_gastos']);
    }

    public static function getListaApartamentos()
    {
        $opciones = Apartamentos::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_apartamento', 'ubicacion');
    }
}
