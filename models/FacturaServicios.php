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
            [['apartamentos_id_apartamento', 'fecha_factura'], 'required'],
            [['apartamentos_id_apartamento', 'estado'], 'integer'],
            [['fecha_factura'], 'safe'],
            [['iva', 'total'], 'number'],
            [['observaciones'], 'string', 'max' => 250],
            [['apartamentos_id_apartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Apartamentos::className(), 'targetAttribute' => ['apartamentos_id_apartamento' => 'id_apartamento']],
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
    public function getFacturaServiciosServicios()
    {
        return $this->hasMany(FacturaServiciosServicios::className(), ['factura_servicios_id_factura_servicios' => 'id_factura_servicios']);
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
