<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "condicionUsuarios".
 *
 * @property integer $id_condicionUsuario
 * @property string $nombre
 * @property string $descricion
 *
 * @property Usuarios[] $usuarios
 */
class CondicionUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'condicionUsuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 100],
            [['descricion'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_condicionUsuario' => 'Id Condicion Usuario',
            'nombre' => 'Nombre',
            'descricion' => 'Descricion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['condicionUsuarios_id_condicionUsuario' => 'id_condicionUsuario']);
    }
}
