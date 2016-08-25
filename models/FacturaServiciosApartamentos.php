<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "factura_servicios_apartamentos".
 *
 * @property integer $id_factura_servicios_apartamentos
 * @property string $factura_servicios_id
 * @property string $apartamentos_id
 *
 * @property FacturaServicios $facturaServicios
 * @property Apartamentos $apartamentos
 */
class FacturaServiciosApartamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factura_servicios_apartamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['factura_servicios_id', 'apartamentos_id'], 'required'],
            [['factura_servicios_id', 'apartamentos_id'], 'integer'],
            [['factura_servicios_id'], 'exist', 'skipOnError' => true, 'targetClass' => FacturaServicios::className(), 'targetAttribute' => ['factura_servicios_id' => 'id_factura_servicios']],
            [['apartamentos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartamentos::className(), 'targetAttribute' => ['apartamentos_id' => 'id_apartamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_factura_servicios_apartamentos' => 'Id Factura Servicios Apartamentos',
            'factura_servicios_id' => 'Factura Servicios ID',
            'apartamentos_id' => 'Apartamentos ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaServicios()
    {
        return $this->hasOne(FacturaServicios::className(), ['id_factura_servicios' => 'factura_servicios_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartamentos()
    {
        return $this->hasOne(Apartamentos::className(), ['id_apartamento' => 'apartamentos_id']);
    }
}
