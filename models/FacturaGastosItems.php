<?php

namespace app\models;

use Yii;
use app\models\Items;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "factura_gastos_items".
 *
 * @property integer $id_factura_gastos_items
 * @property integer $items_id_item
 * @property integer $factura_gastos_id_factura_gastos
 * @property integer $cantidad
 *
 * @property FacturaGastos $facturaGastosIdFacturaGastos
 * @property Items $itemsIdItem
 */
class FacturaGastosItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factura_gastos_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['items_id_item'], 'required'],
            [['items_id_item', 'factura_gastos_id_factura_gastos', 'cantidad'], 'integer'],
            [['factura_gastos_id_factura_gastos'], 'exist', 'skipOnError' => true, 'targetClass' => FacturaGastos::className(), 'targetAttribute' => ['factura_gastos_id_factura_gastos' => 'id_factura_gastos']],
            [['items_id_item'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['items_id_item' => 'id_item']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_factura_gastos_items' => 'Id Factura Gastos Items',
            'items_id_item' => 'Item',
            'factura_gastos_id_factura_gastos' => 'Factura Gastos Id Factura Gastos',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaGastosIdFacturaGastos()
    {
        return $this->hasOne(FacturaGastos::className(), ['id_factura_gastos' => 'factura_gastos_id_factura_gastos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsIdItem()
    {
        return $this->hasOne(Items::className(), ['id_item' => 'items_id_item']);
    }

    public static function getListaItems()
    {
        $opciones = Items::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_item', 'nombre');
    }
}
