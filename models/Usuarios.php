<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\TipoUsuarios;
use app\models\CondicionUsuarios;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id_usuario
 * @property integer $condicionUsuarios_id_condicionUsuario
 * @property integer $tipoUsuarios_id_tipoUsuario
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property string $rif
 * @property string $correo
 * @property string $telefono
 * @property string $usuario
 * @property string $clave
 *
 * @property Apartamentos[] $apartamentos
 * @property UsuarioApartamentos[] $usuarioApartamentos
 * @property UsuarioApartamentos[] $usuarioApartamentos0
 * @property TipoUsuarios $tipoUsuariosIdTipoUsuario
 * @property CondicionUsuarios $condicionUsuariosIdCondicionUsuario
 */
class Usuarios extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['condicionUsuarios_id_condicionUsuario', 'tipoUsuarios_id_tipoUsuario'], 'integer'],
            [['tipoUsuarios_id_tipoUsuario', 'cedula', 'rif'], 'required'],
            [['nombre', 'apellido', 'correo', 'telefono', 'usuario', 'clave'], 'string', 'max' => 100],
            [['correo'], 'email'],
            [['cedula', 'rif'], 'string', 'max' => 50],
            [['tipoUsuarios_id_tipoUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuarios::className(), 'targetAttribute' => ['tipoUsuarios_id_tipoUsuario' => 'id_tipoUsuario']],
            [['condicionUsuarios_id_condicionUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => CondicionUsuarios::className(), 'targetAttribute' => ['condicionUsuarios_id_condicionUsuario' => 'id_condicionUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'condicionUsuarios_id_condicionUsuario' => 'Condicion Usuarios Id Condicion Usuario',
            'condicionUsuariosIdCondicionUsuario.nombre' => 'Condición de Usuario',
            'tipoUsuarios_id_tipoUsuario' => 'Tipo Usuarios Id Tipo Usuario',
            'tipoUsuariosIdTipoUsuario.nombre' => 'Tipo de Usuario',
            'nombre' => 'Nombre de Usuario',
            'apellido' => 'Apellido de Usuario',
            'cedula' => 'Cedula de Usuario',
            'rif' => 'Rif de Usuario',
            'correo' => 'Correo de Usuario',
            'telefono' => 'Telefono de Usuario',
            'usuario' => 'Usuario de Conexión',
            'clave' => 'Clave',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartamentos()
    {
        return $this->hasMany(Apartamentos::className(), ['usuarios_id_usuario_in' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioApartamentos()
    {
        return $this->hasMany(UsuarioApartamentos::className(), ['usuarios_id_usuario_ps' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioApartamentos0()
    {
        return $this->hasMany(UsuarioApartamentos::className(), ['usuarios_id_usuario_pp' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUsuariosIdTipoUsuario()
    {
        return $this->hasOne(TipoUsuarios::className(), ['id_tipoUsuario' => 'tipoUsuarios_id_tipoUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionUsuariosIdCondicionUsuario()
    {
        return $this->hasOne(CondicionUsuarios::className(), ['id_condicionUsuario' => 'condicionUsuarios_id_condicionUsuario']);
    }

    public static function getListaTipoUsuarios()
    {
        $opciones = TipoUsuarios::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_tipoUsuario', 'nombre');
    }

    public static function getListaCondicionUsuarios()
    {
        $opciones = CondicionUsuarios::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_condicionUsuario', 'nombre');
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id_usuario' => $id]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['usuario' => $username]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($usuaemai)
    {
        return static::findOne(['correo' => $usuaemai]);
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
      if (base64_decode($this->clave) == $password) {
        return true;
      }
      return false;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->clave = base64_encode($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @return password Decodificado
     */
    public function getPassword()
    {
        return base64_decode($this->clave);
    }


        /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    }

        /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

}
