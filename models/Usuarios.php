<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $telefono
 * @property string $usuario
 * @property string $clave
 * @property integer $tipoUsuario_id_tipoUsuario
 *
 * @property TipoUsuario $tipoUsuarioIdTipoUsuario
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
            [['nombre', 'apellido', 'correo', 'telefono', 'usuario', 'clave', 'tipoUsuario_id_tipoUsuario'], 'required'],
            [['tipoUsuario_id_tipoUsuario'], 'integer'],
            [['nombre', 'apellido', 'telefono', 'usuario'], 'string', 'max' => 100],
            [['correo'], 'string', 'max' => 200],
            [['clave'], 'string', 'max' => 250],
            [['tipoUsuario_id_tipoUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['tipoUsuario_id_tipoUsuario' => 'id_tipoUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'correo' => 'Correo',
            'telefono' => 'Telefono',
            'usuario' => 'Usuario',
            'clave' => 'Clave',
            'tipoUsuario_id_tipoUsuario' => 'Tipo Usuario Id Tipo Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUsuarioIdTipoUsuario()
    {
        return $this->hasOne(TipoUsuario::className(), ['id_tipoUsuario' => 'tipoUsuario_id_tipoUsuario']);
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
