<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\TipoUsuarios;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property string $rif
 * @property string $correo
 * @property string $telefono
 * @property string $usuario
 * @property string $clave
 * @property integer $tipoUsuario_id_tipoUsuario
 *
 * @property TipoUsuarios $tipoUsuarioIdTipoUsuario
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
            [['nombre', 'correo', 'telefono', 'usuario', 'clave', 'tipoUsuarios_id_tipoUsuario'], 'required'],
            [['tipoUsuarios_id_tipoUsuario'], 'integer'],
            [['cedula', 'rif'], 'string', 'max' => 5000],
            [['nombre', 'apellido', 'telefono', 'usuario'], 'string', 'max' => 100],
            [['correo'], 'string', 'max' => 200],
            [['correo'], 'email'],
            [['clave'], 'string', 'max' => 250],
            [['tipoUsuarios_id_tipoUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuarios::className(), 'targetAttribute' => ['tipoUsuarios_id_tipoUsuario' => 'id_tipoUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre de Usuario',
            'apellido' => 'Apellido de Usuario',
            'cedula' => 'Cédula de Usuario',
            'rif' => 'Rif de Usuario',
            'correo' => 'Correo de Usuario',
            'telefono' => 'Telefono de Usuario',
            'usuario' => 'Usuario de Conexión',
            'clave' => 'Clave de Acceso',
            'tipoUsuarios_id_tipoUsuario' => 'Tipo Usuario',
            'tipoUsuarioIdTipoUsuario.nombre' => 'Tipo Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUsuarioIdTipoUsuario()
    {
        return $this->hasOne(TipoUsuarios::className(), ['id_tipoUsuario' => 'tipoUsuarios_id_tipoUsuario']);
    }

    public static function getListaTipoUsuarios()
    {
        $opciones = TipoUsuarios::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id_tipoUsuario', 'nombre');
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
