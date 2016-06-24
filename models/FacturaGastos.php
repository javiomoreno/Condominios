<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "factura_gastos".
 *
 * @property integer $id_factura_gastos
 * @property integer $apartamentos_id_apartamento
 * @property string $fecha_registro
 * @property double $iva
 * @property double $total
 * @property double $estado
 * @property string $descripcion
 *
 * @property Apartamentos $apartamentosIdApartamento
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
            [['apartamentos_id_apartamento', 'estado'], 'integer'],
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
            'id_factura_gastos' => 'Código de Factura',
            'apartamentos_id_apartamento' => 'Apartamento',
            'fecha_registro' => 'Fecha de Registro',
            'iva' => 'Iva',
            'total' => 'Total',
            'estado' => 'Estado',
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

    public static function getPropietarioPrincipal($id)
    {
      return UsuarioApartamentos::find()->where(['apartamentos_id_apartamento' => $id])->one();
    }

    public static function getListaApartamentos()
    {
        $opciones = Apartamentos::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_apartamento', 'ubicacion');
    }
}
