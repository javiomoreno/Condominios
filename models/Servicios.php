<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicios".
 *
 * @property integer $id_servicio
 * @property string $nombre
 * @property string $descripcion
 * @property double $precio
 * @property string $fecha_registro
 *
 * @property FacturaServicios[] $facturaServicios
 */
class Servicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['precio'], 'number'],
            [['fecha_registro'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_servicio' => 'Id Servicio',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'fecha_registro' => 'Fecha Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaServicios()
    {
        return $this->hasMany(FacturaServicios::className(), ['servicios_id_servicio' => 'id_servicio']);
    }
}
