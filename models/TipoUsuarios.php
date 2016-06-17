<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoUsuarios".
 *
 * @property integer $id_tipoUsuario
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Usuarios[] $usuarios
 */
class TipoUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoUsuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
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
            'id_tipoUsuario' => 'Id Tipo Usuario',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['tipoUsuario_id_tipoUsuario' => 'id_tipoUsuario']);
    }
}
