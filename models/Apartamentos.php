<?php

namespace app\models;

use Yii;
use app\models\Usuarios;
use app\models\UsuarioApartamentos;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "apartamentos".
 *
 * @property integer $id_apartamento
 * @property integer $usuarios_id_usuario_in
 * @property string $ubicacion
 * @property string $observaciones
 *
 * @property Usuarios $usuariosIdUsuarioIn
 * @property FacturaGastos[] $facturaGastos
 * @property FacturaServicios[] $facturaServicios
 * @property UsuarioApartamentos[] $usuarioApartamentos
 */
class Apartamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apartamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuarios_id_usuario_in'], 'integer'],
            [['ubicacion', 'observaciones'], 'string', 'max' => 250],
            [['usuarios_id_usuario_in'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuarios_id_usuario_in' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_apartamento' => 'Id Apartamento',
            'usuarios_id_usuario_in' => 'Usuario Inquilino',
            'usuariosIdUsuarioIn.nombre' => 'Usuario Inquilino',
            'ubicacion' => 'Ubicacion',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosIdUsuarioIn()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuarios_id_usuario_in']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaGastos()
    {
        return $this->hasMany(FacturaGastos::className(), ['apartamentos_id_apartamento' => 'id_apartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaServicios()
    {
        return $this->hasMany(FacturaServicios::className(), ['apartamentos_id_apartamento' => 'id_apartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioApartamentos()
    {
        return $this->hasMany(UsuarioApartamentos::className(), ['apartamentos_id_apartamento' => 'id_apartamento']);
    }

    public static function getListaInquilinos()
    {
      $opciones = Usuarios::find()->where(['condicionUsuarios_id_condicionUsuario' => 3])->asArray()->all();
      return ArrayHelper::map($opciones, 'id_usuario', 'nombre');
    }

    public static function getPropietarios($id)
    {
      return UsuarioApartamentos::find()->where(['apartamentos_id_apartamento' => $id])->one();
    }
}
