<?php

namespace app\models;

use Yii;
use app\models\Servicios;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "factura_servicios_servicios".
 *
 * @property integer $id_factura_servicios_servicios
 * @property integer $factura_servicios_id_factura_servicios
 * @property integer $servicios_id_servicio
 * @property integer $cantidad
 *
 * @property Servicios $serviciosIdServicio
 * @property FacturaServicios $facturaServiciosIdFacturaServicios
 */
class FacturaServiciosServicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factura_servicios_servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicios_id_servicio'], 'required'],
            [['factura_servicios_id_factura_servicios', 'servicios_id_servicio', 'cantidad'], 'integer'],
            [['servicios_id_servicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['servicios_id_servicio' => 'id_servicio']],
            [['factura_servicios_id_factura_servicios'], 'exist', 'skipOnError' => true, 'targetClass' => FacturaServicios::className(), 'targetAttribute' => ['factura_servicios_id_factura_servicios' => 'id_factura_servicios']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_factura_servicios_servicios' => 'Id Factura Servicios Servicios',
            'factura_servicios_id_factura_servicios' => 'Factura Servicios Id Factura Servicios',
            'servicios_id_servicio' => 'Servicios Id Servicio',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiciosIdServicio()
    {
        return $this->hasOne(Servicios::className(), ['id_servicio' => 'servicios_id_servicio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaServiciosIdFacturaServicios()
    {
        return $this->hasOne(FacturaServicios::className(), ['id_factura_servicios' => 'factura_servicios_id_factura_servicios']);
    }

    public static function getListaServicios()
    {
        $opciones = Servicios::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_servicio', 'nombre');
    }
}
