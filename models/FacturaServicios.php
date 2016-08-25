<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "factura_servicios".
 *
 * @property integer $id_factura_servicios
 * @property integer $apartamentos_id_apartamento
 * @property string $fecha_factura
 * @property string $fecha_vencimiento
 * @property double $iva
 * @property double $total
 * @property integer $estado
 * @property string $observaciones
 *
 * @property Apartamentos $apartamentosIdApartamento
 * @property FacturaServiciosServicios[] $facturaServiciosServicios
 */
class FacturaServicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

     var $check;
     var $apartamentos_id_apartamento;

    public static function tableName()
    {
        return 'factura_servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_factura'], 'required'],
            [['estado', 'todos', 'apartamentos_id_apartamento'], 'integer'],
            [['fecha_factura', 'check'], 'safe'],
            [['iva', 'total'], 'number'],
            [['observaciones'], 'string', 'max' => 250],
          ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_factura_servicios' => 'Código de Factura',
            'apartamentos_id_apartamento' => 'Apartamento',
            'fecha_factura' => 'Fecha de Factura',
            'iva' => 'Iva',
            'total' => 'Total',
            'estado' => 'Estado',
            'observaciones' => 'Observaciones',
            'check' => 'Todos los Apartamentos',

        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaServiciosServicios()
    {
        return $this->hasMany(FacturaServiciosServicios::className(), ['factura_servicios_id_factura_servicios' => 'id_factura_servicios']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaServiciosApartamentos()
    {
        return $this->hasMany(FacturaServiciosApartamentos::className(), ['factura_servicios_id' => 'id_factura_servicios']);
    }


    public static function getListaApartamentos()
    {
        $opciones = Apartamentos::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_apartamento', 'ubicacion');
    }
}
