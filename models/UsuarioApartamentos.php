<?php

namespace app\models;

use Yii;
use app\models\Usuarios;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuario_apartamentos".
 *
 * @property integer $idusuario_apartamentos
 * @property integer $apartamentos_id_apartamento
 * @property integer $usuarios_id_usuario_ps
 * @property integer $usuarios_id_usuario_pp
 *
 * @property Apartamentos $apartamentosIdApartamento
 * @property Usuarios $usuariosIdUsuarioPs
 * @property Usuarios $usuariosIdUsuarioPp
 */
class UsuarioApartamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_apartamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apartamentos_id_apartamento', 'usuarios_id_usuario_pp'], 'required'],
            [['apartamentos_id_apartamento', 'usuarios_id_usuario_ps', 'usuarios_id_usuario_pp'], 'integer'],
            [['apartamentos_id_apartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Apartamentos::className(), 'targetAttribute' => ['apartamentos_id_apartamento' => 'id_apartamento']],
            [['usuarios_id_usuario_ps'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuarios_id_usuario_ps' => 'id_usuario']],
            [['usuarios_id_usuario_pp'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuarios_id_usuario_pp' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusuario_apartamentos' => 'Idusuario Apartamentos',
            'apartamentos_id_apartamento' => 'Apartamentos Id Apartamento',
            'usuarios_id_usuario_ps' => 'Usuarios Id Usuario Ps',
            'usuarios_id_usuario_pp' => 'Usuarios Id Usuario Pp',
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
    public function getUsuariosIdUsuarioPs()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuarios_id_usuario_ps']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosIdUsuarioPp()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuarios_id_usuario_pp']);
    }

    public static function getListaPropietariosPrincipales()
    {
        $opciones = Usuarios::find()->where(['condicionUsuarios_id_condicionUsuario' => 1])->asArray()->all();
        return ArrayHelper::map($opciones, 'id_usuario', 'nombre');
    }

    public static function getListaPropietariosSecundarios()
    {
      $opciones = Usuarios::find()->where(['condicionUsuarios_id_condicionUsuario' => 2])->asArray()->all();
      return ArrayHelper::map($opciones, 'id_usuario', 'nombre');
    }
}
