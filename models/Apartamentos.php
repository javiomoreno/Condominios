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
            [['usuarios_id_usuario_in', 'usuarios_id_usuario_pr'], 'integer'],
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
            'usuarios_id_usuario_pr' => 'Usuario Propietario',
            'usuariosIdUsuarioIn.nombre' => 'Usuario Inquilino',
            'usuariosIdUsuarioPr.nombre' => 'Usuario Propietario',
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
    public function getUsuariosIdUsuarioPr()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuarios_id_usuario_pr']);
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
    public function getFacturaServiciosApartamentos()
    {
        return $this->hasMany(FacturaServiciosApartamentos::className(), ['apartamentos_id_apartamento' => 'id_apartamento']);
    }


    public static function getListaInquilinos()
    {
      $opciones = Usuarios::find()->where(['condicionUsuarios_id_condicionUsuario' => 2])->asArray()->all();
      return ArrayHelper::map($opciones, 'id_usuario', 'nombre');
    }

    public static function getListaPropietarios()
    {
      $opciones = Usuarios::find()->where(['condicionUsuarios_id_condicionUsuario' => 1])->asArray()->all();
      return ArrayHelper::map($opciones, 'id_usuario', 'nombre');
    }

}
