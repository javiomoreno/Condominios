<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "factura_servicios".
 *
 * @property integer $id_factura_servicios
 * @property integer $servicios_id_servicio
 * @property integer $apartamentos_id_apartamento
 * @property string $fecha_factura
 * @property string $fecha_vencimiento
 * @property double $iva
 * @property double $total
 * @property integer $estado
 * @property string $observciones
 *
 * @property Apartamentos $apartamentosIdApartamento
 * @property Servicios $serviciosIdServicio
 */
class FacturaServicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['servicios_id_servicio', 'apartamentos_id_apartamento'], 'required'],
            [['servicios_id_servicio', 'apartamentos_id_apartamento', 'estado'], 'integer'],
            [['fecha_factura', 'fecha_vencimiento'], 'safe'],
            [['iva', 'total'], 'number'],
            [['observciones'], 'string', 'max' => 250],
            [['apartamentos_id_apartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Apartamentos::className(), 'targetAttribute' => ['apartamentos_id_apartamento' => 'id_apartamento']],
            [['servicios_id_servicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['servicios_id_servicio' => 'id_servicio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_factura_servicios' => 'Id Factura Servicios',
            'servicios_id_servicio' => 'Servicios Id Servicio',
            'apartamentos_id_apartamento' => 'Apartamentos Id Apartamento',
            'fecha_factura' => 'Fecha Factura',
            'fecha_vencimiento' => 'Fecha Vencimiento',
            'iva' => 'Iva',
            'total' => 'Total',
            'estado' => 'Estado',
            'observciones' => 'Observciones',
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
    public function getServiciosIdServicio()
    {
        return $this->hasOne(Servicios::className(), ['id_servicio' => 'servicios_id_servicio']);
    }
}
